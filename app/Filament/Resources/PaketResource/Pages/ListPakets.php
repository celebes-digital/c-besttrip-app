<?php

namespace App\Filament\Resources\PaketResource\Pages;

use App\Filament\Resources\PaketResource;
use App\Models\Paket;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

use Illuminate\Database\Eloquent\Builder;

class ListPakets extends ListRecords
{
    protected static string $resource = PaketResource::class;

    public function getTabs(): array
    {
        return [
            'all'       => Tab::make('Semua')
                                ->badge(
                                    Paket::count()
                                ),
            'active'    => Tab::make('Aktif')
                                ->badge(
                                    Paket::where('is_active', true)->count()
                                )
                                ->modifyQueryUsing(
                                    fn(Builder $query) => $query->where('is_active', true)
                                ),
            'inactive'  => Tab::make('Tidak Aktif')
                                ->badge(
                                    Paket::where('is_active', false)->count()
                                )
                                ->modifyQueryUsing(
                                    fn(Builder $query) => $query->where('is_active', false)
                                ),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'active';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat Paket'),
        ];
    }
}
