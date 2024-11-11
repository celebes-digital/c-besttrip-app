<?php

namespace App\Filament\Widgets;

use App\Models\Jemaah;
use App\Models\Paket;
use App\Models\SetoranJemaah;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Jemaah', $this->getTotalJemaah())
                ->description($this->getJemaahThisMonth() . ' Jemaah bulan ini')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('primary'),
            Stat::make('Total Setoran', $this->getTotalSetoran())
                ->description($this->getSetoranThisMonth() . ' bulan ini')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('info'),
            Stat::make('Kouta Bulan Ini', $this->getKoutaBulanIni())
                ->description($this->getTerisiBulanIni() . ' Terisi')
                ->descriptionIcon('heroicon-o-cube')
                ->color('success'),
        ];
    }

    private function getTotalJemaah(): string
    {
        return Jemaah::count() . ' Jemaah';
    }

    private function getJemaahThisMonth(): int
    {
        return Jemaah::whereMonth('created_at', now()->month)->count();
    }

    private function getTotalSetoran(): string
    {
        return $this->formatCurrency(SetoranJemaah::where('status_setoran', 'Terverifikasi')->sum('nominal'));
    }

    private function getSetoranThisMonth(): string
    {
        return $this->formatCurrency(SetoranJemaah::where('status_setoran', 'Terverifikasi')->whereMonth('waktu_setor', now()->month)->sum('nominal'));
    }

    private function getKoutaBulanIni(): string
    {
        return Paket::whereMonth('tgl_paket', now()->month)->sum('kuota') . ' Kuota';
    }

    private function getTerisiBulanIni(): int
    {
        return Paket::whereMonth('tgl_paket', now()->month)->sum('terisi');
    }

    private function formatCurrency($amount): string
    {
        if ($amount >= 1_000_000_000_000) {
            return 'Rp ' . number_format($amount / 1_000_000_000_000, 2, ',', '.') . ' Triliun';
        } elseif ($amount >= 1_000_000_000) {
            return 'Rp ' . number_format($amount / 1_000_000_000, 2, ',', '.') . ' M';
        } elseif ($amount >= 1_000_000) {
            return 'Rp ' . number_format($amount / 1_000_000, 1, ',', '.') . ' Jt';
        } else {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }
    }
}
