<?php

namespace Velodome\Velodome\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'velodome:generate:route {name : The name of the route} {controllerName : The name of the controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a finished crud routes';

    public function handle()
    {
        $routeName = $this->argument('name');
        $controllerName = $this->argument('controllerName');
        $getRoute = "\n".'$router->get'."('/$routeName', '$controllerName@index');";
        $getDetailRoute = "\n".'$router->get'."('/$routeName/{id}', '$controllerName@show');";
        $postRoute = "\n".'$router->post'."('/$routeName', '$controllerName@store');";
        $putRoute = "\n".'$router->put'."('/$routeName/{id}', '$controllerName@update');";
        $deleteRoute = "\n".'$router->delete'."('/$routeName/{id}', '$controllerName@destroy');";
        $routes = $getRoute.$getDetailRoute.$postRoute.$putRoute.$deleteRoute;
        $filePath = base_path("routes/web.php");
        $fileContent = File::get($filePath);
        $insertPosition = strrpos($fileContent, "\n") + 10;
        $newFileContent = substr_replace($fileContent, $routes . "\n", $insertPosition, -1);
        File::put($filePath, $newFileContent);
        $this->info('Routes created with finished crud functionality.');
    }
}
