<?php

namespace App\Providers;

use App\Contracts\EmailInterface;
use App\Contracts\UploadFile;
use App\Services\EmailService;
use App\Services\StudentInterface;
use App\Services\StudentServices;
use App\Services\UploadImageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(StudentInterface::class,StudentServices::class);
        $this->app->bind(EmailInterface::class,EmailService::class);
        $this->app->bind(UploadFile::class,UploadImageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
