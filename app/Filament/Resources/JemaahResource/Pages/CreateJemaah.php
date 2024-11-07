<?php

namespace App\Filament\Resources\JemaahResource\Pages;

use App\Filament\Resources\JemaahResource;
use App\Livewire\Forms\PilihPaket;

use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use Filament\Forms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class CreateJemaah extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource       = JemaahResource::class;
    protected static ?string $title         = 'Tambah Jemaah';
    protected static ?string $breadcrumb    = 'Tambah';

    public function hasSkippableSteps(): bool
    {
        return false;
    }

    protected function getSubmitFormAction(): Action
    {
        return Action::make('create')
            ->label('Simpan Data')
            ->submit('create');
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $jemaah = static::getModel()::create($data);

            $jemaahPaket = $jemaah->jemaahPakets()->create([
                'paket_id' => $data['paket_id'],
            ]);
            
            $jemaahPaket->setorans()->create([
                'jemaah_paket_id'   => $jemaahPaket->id,
                'bukti_setor'       => $data['bukti_setor'],
                'nominal'           => $data['nominal'],
                'waktu_setor'       => now(),
            ]);

            return $jemaah;
        });
    }

    #[On('updateDataPaketId')]
    public function updatePaketId(int $paketId): void
    {
        $this->data['paket_id'] = $paketId;
    }

    protected function getSteps(): array
    {
        return [
            Forms\Components\Wizard\Step::make('Paket')
                ->schema([
                Forms\Components\Hidden::make('paket_id'),
                Forms\Components\Livewire::make(PilihPaket::class)
                    ->live(onBlur: true)
                ])
                ->icon('heroicon-o-cube')
                ->completedIcon('heroicon-o-document-check'),

            Forms\Components\Wizard\Step::make('Data Utama')
                ->schema([
                    JemaahResource::getDataPribadiFormField(),
                    JemaahResource::getKontakFormField(),
                    JemaahResource::getAlamatFormField(),
                ])
                ->icon('heroicon-o-user')
                ->completedIcon('heroicon-o-document-check'),

            Forms\Components\Wizard\Step::make('Data Pendukung')
                ->schema([
                    JemaahResource::getPasporFormField(),
                    JemaahResource::getDokumenPendukungFormField(),
                ])
                ->icon('heroicon-o-puzzle-piece')
                ->completedIcon('heroicon-o-document-check'),

            JemaahResource::getSetoranAwalFormField(),
        ];
    }
}
