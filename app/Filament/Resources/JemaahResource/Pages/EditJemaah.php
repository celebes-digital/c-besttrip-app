<?php

namespace App\Filament\Resources\JemaahResource\Pages;

use App\Filament\Resources\JemaahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJemaah extends EditRecord
{
    protected static string $resource = JemaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
            Actions\Action::make('kembali')
                ->label('Kembali')
                ->color('gray')
                ->url(JemaahResource::getUrl())
        ];
    }
}
