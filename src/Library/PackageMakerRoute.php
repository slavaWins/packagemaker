<?php


namespace PackageMaker\Library;


use Illuminate\Support\Facades\Route;

class PackageMakerRoute
{

    public static function routes()
    {
        Route::get('/example/packagemaker', [\PackageMaker\Http\Controllers\PagePackageMakerController::class, 'index']);
    }

}
