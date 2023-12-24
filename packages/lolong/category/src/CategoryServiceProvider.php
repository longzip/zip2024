<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Categories.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LoLong\Category;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/create_categories_tables.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_categories_tables.php'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/category.php' => config_path('category.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/category.php', 'category');
    }
}
