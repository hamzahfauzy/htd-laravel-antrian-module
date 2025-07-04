<?php

namespace App\Modules\Antrian\Providers;

use App\Libraries\Dashboard;
use App\Libraries\NavPanel;
use App\Modules\Antrian\Libraries\Utility;
use Illuminate\Support\ServiceProvider;

class AntrianServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Databases/migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Views', 'antrian');

        Dashboard::add(\App\Modules\Antrian\Services\DashboardService::queueDisplayDashboard());
    
        Dashboard::setWelcomeScreen(view('antrian::index'));

        NavPanel::add([
            'url' => url('/queue-display'),
            'label' => 'Display Antrian',
            'icon' => 'bx bx-desktop',
            'can' => function(){
                return Utility::getUserOrganization(auth()->user())?->organization_id;
            }
        ]);
    }
}