<?php

namespace App\Filament\Resources\SetoranJemaahResource\Pages;

use App\Enums\StatusSetoran;
use App\Filament\Resources\SetoranJemaahResource;
use App\Models\SetoranJemaah;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSetoranJemaahs extends ListRecords
{
    protected static string $resource = SetoranJemaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all'           
                => Tab::make(),
                
            'pending'       
                => Tab::make()
                ->icon(StatusSetoran::Pending->getIcon())
                ->label(StatusSetoran::Pending->getLabel())
                ->badgeColor(StatusSetoran::Pending->getColor())
                ->badge(
                    SetoranJemaah::query()->where('status_setoran', StatusSetoran::Pending)->count())
                ->modifyQueryUsing(
                    fn(Builder $query) 
                    => $query->where('status_setoran', StatusSetoran::Pending)),

            'terverifikasi' 
                => Tab::make()
                ->icon(StatusSetoran::Terverifikasi->getIcon())
                ->label(StatusSetoran::Terverifikasi->getLabel())
                ->badgeColor(StatusSetoran::Terverifikasi->getColor())
                ->badge(
                    SetoranJemaah::query()->where('status_setoran', StatusSetoran::Terverifikasi)->count()
                )
                ->modifyQueryUsing(
                    fn(Builder $query) 
                    => $query->where('status_setoran', StatusSetoran::Terverifikasi)),

            'ditolak' 
                => Tab::make()
                ->icon(StatusSetoran::Ditolak->getIcon())
                ->label(StatusSetoran::Ditolak->getLabel())
                ->badgeColor(StatusSetoran::Pending->getColor())
                ->badge(
                    SetoranJemaah::query()->where('status_setoran', StatusSetoran::Ditolak)->count()
                )
                ->modifyQueryUsing(
                    fn(Builder $query) 
                    => $query->where('status_setoran', StatusSetoran::Ditolak)),
        ];
    }
}
