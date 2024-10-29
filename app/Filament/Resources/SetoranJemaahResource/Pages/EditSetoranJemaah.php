<?php

namespace App\Filament\Resources\SetoranJemaahResource\Pages;

use App\Filament\Resources\SetoranJemaahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSetoranJemaah extends EditRecord
{
    protected static string $resource = SetoranJemaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
