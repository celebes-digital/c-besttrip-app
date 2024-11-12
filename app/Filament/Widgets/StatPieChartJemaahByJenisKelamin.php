<?php

namespace App\Filament\Widgets;

use App\Models\Jemaah;
use Filament\Widgets\ChartWidget;

class StatPieChartJemaahByJenisKelamin extends ChartWidget
{
    protected static ?string $heading = '';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Jemaah::selectRaw('kelamin, COUNT(*) as count')
                  ->groupBy('kelamin')
                  ->pluck('count', 'kelamin')
                  ->values()
                  ->toArray();

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => ['#36A2EB', '#FF6384'],
                    'animation' => [
                        'duration' => 3000,
                    ]
                ],
            ],
            'labels' => ['Laki-laki', 'Perempuan'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
                'datalabels' => [
                    'formatter' => function($value) {
                        return $value + "%";
                    },
                    'color' => '#fff',
                    'font' => [
                        'size' => 14,
                    ],
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => false,
                ],
                'y' => [
                    'display' => false,
                ],
            ]
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
