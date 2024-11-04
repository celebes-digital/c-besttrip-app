<?php

namespace App\Filament\Widgets;

use App\Models\SetoranJemaah;
use Filament\Widgets\ChartWidget;

class StatSetoranMasukWidget extends ChartWidget
{
    protected static ?string $heading = 'Pemasukan Setoran';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = SetoranJemaah::where('status_setoran', true)
            ->whereBetween('waktu_setor', [now()->startOfYear(), now()->endOfYear()])
            ->get()
            ->groupBy(function ($item) {
                return $item->waktu_setor->format('m');
            })->map(function ($item) {
                return $item->sum('nominal');
            });

        $data = collect(range(1, 12))->map(function ($month) use ($data) {
            return $data->get(str_pad($month, 2, '0', STR_PAD_LEFT), 0);
        });

        return [
            'datasets' => [
                [
                    'label' => 'Setoran Masuk',
                    'data' => $data,
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'lineTension' => 0.1,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
