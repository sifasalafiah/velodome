<?php

namespace Velodome\Velodome\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateFillableModel extends Command
{
    protected $signature = 'velodome:generate:model {name : The name of the model} {--fillable= : Comma-separated fillable fields}';

    protected $description = 'Generate a model with fillable fields';

    public function handle()
    {
        $modelName = $this->argument('name');
        $tableName = $this->toSnakeCase($modelName);

        $modelFilePath = base_path("app/Models/{$modelName}.php");
        if (file_exists($modelFilePath)) {
            $this->info('Model is exist');
        } else {
            $fillableFields = $this->option('fillable');
            $this->call('make:model', [
                'name' => $modelName
            ]);
            $this->addFillableProperty($modelFilePath, $fillableFields, $tableName);
            $this->info('Model generated with fillable fields.');
        }
    }

    private function addFillableProperty($filePath, $fields, $tableName)
    {
        $fillable = explode(',', $fields);
        $fillableString = "\n\tprotected \$table = "."'".$tableName."'".";\n\tprotected \$fillable = ['" . implode("', '", $fillable) . "'];";
        $fileContent = File::get($filePath);
        $insertPosition = strpos($fileContent, '//') + strlen('//');
        $newFileContent = substr_replace($fileContent, $fillableString . "\n", $insertPosition, 0);
        File::put($filePath, $newFileContent);
    }

    function toSnakeCase($string) {
        $string = preg_replace('/\s+/u', '', ucwords($string));
        $string = lcfirst($string);
        $string = preg_replace('/\B([A-Z])/', '_$1', $string);
    
        return strtolower($string);
    }
}
