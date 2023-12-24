<?php
declare(strict_types=1);
/*
 * This file is part of Laravel Commentable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LoLong\Kh15;

use Illuminate\Support\ServiceProvider;

class Kh15ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/create_kh15s_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_kh15s_table.php'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/kh15.php' => config_path('kh15.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/kh15.php', 'kh15');
    }
}
