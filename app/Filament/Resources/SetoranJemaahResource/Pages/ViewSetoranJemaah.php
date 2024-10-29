<?php

namespace App\Filament\Resources\SetoranJemaahResource\Pages;

use App\Filament\Resources\SetoranJemaahResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSetoranJemaah extends ViewRecord
{
    protected static string $resource = SetoranJemaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
