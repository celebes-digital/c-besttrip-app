<?php

namespace App\Filament\Resources\SetoranJemaahResource\Pages;

use App\Filament\Resources\SetoranJemaahResource;
use App\Models\JemaahPaket;

use Filament\Resources\Pages\CreateRecord;

class CreateSetoranJemaah extends CreateRecord
{
    protected static string $resource = SetoranJemaahResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $jemaahPaket = JemaahPaket::where('jemaah_id', $data['jemaahPaket']['jemaah_id'])
                        ->where('paket_id', $data['jemaahPaket']['paket_id'])
                        ->firstOrFail();
        
        $data['jemaah_paket_id'] = $jemaahPaket->id;
        
        return $data;
    }
}
