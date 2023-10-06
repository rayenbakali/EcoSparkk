<?php

namespace App\Providers;
use Faker\Generator;

use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind( Generator::class, function ( $app ) {

            $faker = \Faker\Factory::create();
            $faker->addProvider( new CustomFakerProvider( $faker ) );

            return $faker;
        } );
    }
    private function registerFaker()
    {
        if (class_exists(Generator::class)) {
            $this->app->extend(Generator::class, function (Generator $generator, $app) {
                $generator->addProvider(new MyCustomProvider($generator));
                
                return $generator;
            });
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
