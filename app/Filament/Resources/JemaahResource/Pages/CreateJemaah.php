<?php

namespace App\Filament\Resources\JemaahResource\Pages;

use App\Filament\Resources\JemaahResource;
use App\Models\JemaahPaket;
use App\Models\Paket;
use App\Models\SetoranJemaah;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        // dd($data);
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

    protected function getSteps(): array
    {
        return [
            Step::make('Paket')
                ->schema([
                    Forms\Components\Group::make([
                        Forms\Components\DatePicker::make('from_date')
                            ->label('Dari tanggal')
                            ->native(false)
                            ->live(onBlur: true)
                            ->displayFormat('d F Y')
                            ->default(now()),
                        Forms\Components\DatePicker::make('to_date')
                            ->label('Sampai tanggal')
                            ->live(onBlur: true)
                            ->displayFormat('d F Y')
                            ->native(false)
                            ->default(now()->addMonths(3))
                    ])
                    ->columns(3),
                    Forms\Components\Hidden::make('harga_paket'),
                    Forms\Components\ViewField::make('paket_id')
                        ->label('Daftar paket tersedia')
                        ->required()
                        ->afterStateUpdated(
                            function ($state, Set $set) 
                            {
                                $hargaPaket = Paket::where('id', $state)->first();
                                $set('harga_paket', $hargaPaket->harga);
                            }
                        )
                        ->view('filament.forms.components.card-paket-toggle'),
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

            Step::make('Setoran Awal')
                ->schema([
                    Forms\Components\Split::make([
                        Forms\Components\FileUpload::make('bukti_setor')
                            ->label('Bukti Setoran Awal')
                            ->required()
                            ->image()
                            ->directory('foto/bukti-setor'),
                        Forms\Components\Select::make('nominal')
                            ->label('Setoran Awal')
                            ->required()
                            ->options(
                                function (Get $get) {
                                    return [
                                        '5000000'               => 'Rp5.000.000',
                                        '10000000'              => 'Rp10.000.000',
                                        $get('harga_paket')     => 'Rp' . $get('harga_paket') . ' (Lunas)',
                                    ];
                                }
                            )
                            ->native(false)
                    ])
                ])
                ->icon('heroicon-o-banknotes')
                ->completedIcon('heroicon-o-document-check'),
        ];
    }
}
