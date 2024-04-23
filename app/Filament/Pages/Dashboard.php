<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Models\Villa;
use Filament\Pages\Dashboard as PagesDashboard;
use Filament\Widgets\StatsOverviewWidget\Card;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class Dashboard extends PagesDashboard
{
    protected static string $view = 'filament.pages.dashboard';
    // protected static ?string $title = 'Welcome';
}
