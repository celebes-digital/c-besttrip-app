<?php

namespace App\Filament\Resources\JemaahResource\Pages;

use App\Filament\Resources\JemaahResource;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Wizard\Step;

class CreateJemaah extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = JemaahResource::class;

    public function hasSkippableSteps(): bool
    {
        return false;
    }

    protected function getSubmitFormAction(): Action
    {
        return Action::make('submit')
            ->label('Simpan Data');
    }

    protected function getSteps(): array
    {
        return [
            Step::make('Paket')
                ->schema([
                    TextInput::make('nama_paket')
                        ->label('Nama Paket')
                        ->required(),
                ])
                ->icon('heroicon-o-cube')
                ->completedIcon('heroicon-o-document-check'),

            Step::make('Data Utama')
                ->schema([
                    JemaahResource::getDataPribadiFormField(),
                    JemaahResource::getKontakFormField(),
                    JemaahResource::getAlamatFormField(),
                ])
                ->icon('heroicon-o-user')
                ->completedIcon('heroicon-o-document-check'),

            Step::make('Data Pendukung')
                ->schema([
                    JemaahResource::getPasporFormField(),
                    JemaahResource::getDokumenPendukungFormField(),
                ])
                ->icon('heroicon-o-puzzle-piece')
                ->completedIcon('heroicon-o-document-check'),
        ];
    }
}
