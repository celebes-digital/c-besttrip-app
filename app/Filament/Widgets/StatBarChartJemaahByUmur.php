<?php

namespace App\Filament\Widgets;

use App\Models\Jemaah;
use Filament\Widgets\ChartWidget;

class StatBarChartJemaahByUmur extends ChartWidget
{
    protected static ?string $heading = '';
    protected static ?string $maxHeight = '300px';

    protected int | string | array $columnSpan = [
        'md' => 2,
    ];

    protected function getData(): array
    {
        $data = Jemaah::get()
                ->groupBy(fn ($jemaah) => $jemaah->age)
                ->map(fn ($group) => $group->count())
                ->sortKeys();

        return [
            'datasets' => [
                [
                    'label' => 'Jemaah',
                    'data' => $data->values()->toArray(),
                    'animation' => [
                        'duration' => 3000,
                    ]
                ],
            ], 
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
                'datalabels' => [
                    'formatter' => function($value) {
                        return $value;
                    },
                    'color' => '#fff',
                    'font' => [
                        'size' => 14,
                    ],
                ],
                'title' => [
                    'display' => true,
                    'text' => 'Statistik Jemaah Berdasar Umur',
                    'font' => [
                        'size' => 16,
                    ],
                ]
            ],
            'scales' =>  [
                'x' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Umur',
                        'font' => [
                            'size' => 14,
                        ],
                    ],
                ],
                'y' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah',
                        'font' => [
                            'size' => 14,
                        ],
                    ],
                ],
            ]
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
