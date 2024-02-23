<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Dedoc\Scramble\Support\Generator\SecuritySchemes\OAuthFlow;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Scramble::extendOpenApi(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::oauth2()
                ->flow('implicit', function (OAuthFlow $flow) {
                    $flow
                        ->authorizationUrl('http://127.0.0.1:8000/api/login')
                        ->addScope('write:pets', 'modify pets in your account');
                })
            );
        });
    }
}
