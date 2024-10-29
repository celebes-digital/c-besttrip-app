<?php

namespace App\Filament\Resources\JemaahResource\Pages;

use App\Filament\Resources\JemaahResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJemaah extends ViewRecord
{
    protected static string $resource = JemaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
