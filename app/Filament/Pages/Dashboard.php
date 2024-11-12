<?php

namespace App\Filament\Pages;

use App\Filament\Widgets;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $title             = 'Dashboard';
    protected static ?string $navigationLabel   = 'Dashboard';

    public function getWidgets(): array
    {
        return [
            Widgets\StatsOverviewWidget::class,
            Widgets\StatSetoranMasukWidget::class,
            Widgets\StatPieChartJemaahByJenisKelamin::class,
        ];
    }
}
