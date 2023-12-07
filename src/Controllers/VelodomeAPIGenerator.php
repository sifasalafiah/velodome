<?php

namespace Velodome\Velodome\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;
use Velodome\Velodome\Traits\OpenAITrait;

class VelodomeAPIGenerator extends Controller
{
    use OpenAITrait;

    public function index()
    {
        return view('velodome::api-generator', ['props' => null, 'object_name' => null,  'flash' => null]);
    }

    public function analize(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $file->storeAs('uploads', $filename);
        $base64File = base64_encode(file_get_contents($file));
        $props = $this->completions($base64File);
        return view('velodome::api-generator', ['props' => $props, 'object_name' => null, 'flash' => null]);
    }

    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'object_name' => 'required',
            'props' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fieldsString = $request->props;
        $fieldsArray = explode(',', $fieldsString);
        $fieldNames = [];
        foreach ($fieldsArray as $field) {
            $fieldName = trim(explode(':', $field)[0]);
            $fieldNames[] = $fieldName;
        }
        $fieldNamesString = implode(',', $fieldNames);

        $modelName = $this->toPascalCase($request->object_name);
        $migrationName = $this->toSnakeCase($request->object_name);
        $routeName = $this->toKebabCase($request->object_name);
        $controllerName = $modelName . 'Controller';
        Artisan::call(str_replace(", ", ",", "velodome:generate:migration $migrationName --fields=$fieldsString"));
        Artisan::call("velodome:generate:model $modelName --fillable=$fieldNamesString");
        Artisan::call("velodome:generate:controller $modelName");
        Artisan::call("velodome:generate:route $routeName $controllerName");

        try {
            Artisan::call("migrate");
        } catch (\Throwable $th) {
            //throw $th;
        }

        return view(
            'velodome::api-generator',
            [
                'props' => null, 'object_name' => null, 'flash' => [
                    'type' => 'success',
                    'title' => 'Success',
                    'message' => 'Generate API ' . $request->object_name
                ]
            ]
        );
    }

    function toPascalCase($string)
    {
        $string = str_replace(' ', '', ucwords(preg_replace('/[^a-zA-Z0-9\x7f-\xff]++/', ' ', $string)));
        return $string;
    }

    function toSnakeCase($string)
    {
        $string = preg_replace('/\s+/u', '', ucwords($string));
        $string = lcfirst($string);
        $string = preg_replace('/\B([A-Z])/', '_$1', $string);

        return strtolower($string);
    }

    function toKebabCase($string)
    {
        $string = preg_replace('/[^a-zA-Z0-9]/', ' ', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        $string = trim($string);
        $string = strtolower($string);
        return str_replace(' ', '-', $string);
    }
}
