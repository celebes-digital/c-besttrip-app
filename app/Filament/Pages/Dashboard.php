<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverviewWidget;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $title             = 'Dashboard';
    protected static ?string $navigationLabel   = 'Dashboard';

    public function getWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
        ];
    }
}
