<?php

namespace App\Filament\Resources\PaketResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

use App\Filament\Resources\PaketResource;

class ViewPaket extends ViewRecord
{
    protected static string $resource = PaketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('kembali')
                ->url(PaketResource::getUrl())
                ->color('gray')
        ];
    }
}
