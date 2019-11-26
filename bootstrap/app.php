<?php

use App\TvShow\Application\BrandFitScoreDecorator;

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

 $app->withFacades();

$app->withEloquent();
/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//     App\Http\Middleware\ExampleMiddleware::class
// ]);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

//Load Configuration
$app->register(App\Providers\AppServiceProvider::class);

$app->bind('App\Configuration\APIConfiguration', function () {
    return new App\Configuration\APIConfiguration(
        env('API_TVMAZE_URL'),
        env('CACHE_TIME'),
        env('CACHE_ENABLED'),
        env('CSV_DELIMITER')
    );
});

$app->bind('App\DataProcessor\Application\Configuration\DataProcessorConfiguration', function() {
    return new App\DataProcessor\Infrastructure\Configuration\Configuration(
        new App\Configuration\APIConfiguration(
            env('API_TVMAZE_URL'),
            env('CACHE_TIME'),
            env('CACHE_ENABLED'),
            env('CSV_DELIMITER')
        )
    );
});

/* CSVProcessorController */
$app->bind(
    'App\DataProcessor\Application\Service\FileValidator',
    'App\DataProcessor\Infrastructure\Service\FileValidator'
);

$app->bind(
    'App\DataProcessor\Application\Service\CsvReader', function() {
        return new App\DataProcessor\Infrastructure\Service\CsvReader(
        new \App\DataProcessor\Application\Factory\ScoreFactory()
    );
});

$app->bind(
    'App\DataProcessor\Application\Factory\CsvProcessorErrorFactory',
    'App\DataProcessor\Infrastructure\Factory\CsvProcessorErrorFactory'
);

$app->bind(
    'App\DataProcessor\Domain\Repository\ScoreRepository',
    'App\DataProcessor\Infrastructure\Repository\ScoreEloquentRepository'
);

/* TvShowController */
$app->bind('App\TvShow\Application\QueryHandler\QueryHandler', function () {
    return new App\TvShow\Application\QueryHandler\TvShowQueryHandler(
        new \App\TvShow\Infrastructure\Adapter\CacheProxy(env("CACHE_ENABLED"), new \Illuminate\Support\Facades\Cache()),
        new \App\TvShow\Infrastructure\Client\TvMazeClient(
            new \GuzzleHttp\Client(), new \App\TvShow\Application\ValueObject\Url(env("API_TVMAZE_URL"))
        ),
        new \App\TvShow\Infrastructure\Configuration\Configuration(
            env("CACHE_TIME"),
            env("CACHE_ENABLED")
        ),
        new \App\TvShow\Application\Searcher\TvShowSearcher(),
        new \App\TvShow\Infrastructure\Repository\ScoreEloquentRepository(new \App\TvShow\Domain\Score()),
        new \App\TvShow\Application\Decorator\ResponseDecorator()
    );
});

$app->bind(
    'App\TvShow\Application\Factory\ErrorFactory',
    'App\TvShow\Infrastructure\Factory\ErrorResponseFactory'
);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;
