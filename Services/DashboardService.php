<?php

namespace App\Modules\Antrian\Services;

class DashboardService
{
    static function queueDisplayDashboard()
    {
        return view('antrian::dashboard.queue-display');
    }
}