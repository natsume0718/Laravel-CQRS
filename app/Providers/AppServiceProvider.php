<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\DataProvider\Database\RegisterReviewDataProvider;
use App\DataProvider\RegisterReviewProviderInterface;
use App\Foundation\ElasticsearchClient;
use Illuminate\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //照合順序による文字長の変更
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RegisterReviewProviderInterface::class, function () {
            return new RegisterReviewDataProvider();
        });
        $this->app->singleton(ElasticsearchClient::class, function (Application $app) {
            $config = $app['config']->get('elasticsearch');
            return new ElasticsearchClient($config['hosts']);
        });
    }
}
