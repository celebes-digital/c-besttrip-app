<?php

namespace App\Filament\Resources\JemaahResource\Pages;

use App\Filament\Resources\JemaahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJemaahs extends ListRecords
{
    protected static string $resource = JemaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Jemaah'),
        ];
    }
}
