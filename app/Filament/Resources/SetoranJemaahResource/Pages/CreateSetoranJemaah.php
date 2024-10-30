<?php

namespace App\Filament\Resources\SetoranJemaahResource\Pages;

use App\Filament\Resources\SetoranJemaahResource;
use App\Models\SetoranJemaah;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSetoranJemaah extends CreateRecord
{
    protected static string $resource = SetoranJemaahResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        dd($data);
        $jemaahPaket = SetoranJemaah::where('jemaah_id', $data['id_jemaah'])
            ->where('paket_id', $data['id_paket'])
            ->first();
        
        $data['jemaah_paket_id'] = $jemaahPaket->id;
        return $data;
    }
}
