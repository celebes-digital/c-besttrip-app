<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

use App\Filament\Resources\JemaahResource;
use App\Models\Jemaah;
use App\Models\JemaahPaket;
use App\Models\Paket;
use App\Models\SetoranJemaah;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FormPendaftaranPage extends Component implements HasForms
{
    use InteractsWithForms;
    // use CreateRecord\Concerns\HasWizard;

    // protected static string $resource       = JemaahResource::class;
    // protected static ?string $title         = 'Tambah Jemaah';
    // protected static ?string $breadcrumb    = 'Tambah';

    // public function hasSkippableSteps(): bool
    // {
    //     return false;
    // }

    // protected function getSubmitFormAction(): Action
    // {
    //     return Action::make('create')
    //         ->label('Simpan Data')
    //         ->submit('create');
    // }

    // protected function handleRecordCreation(array $data): Model
    // {
    //     // dd($data);
    //     return DB::transaction(function () use ($data) {
    //         $jemaah = static::getModel()::create($data);

    //         // Buat paket jemaah
    //         $paketJemaah = new JemaahPaket;

    //         $paketJemaah->jemaah_id = $jemaah->id;
    //         $paketJemaah->paket_id  = $data['paket_id'];

    //         $paketJemaah->save();

    //         // Buat data setoran awal
    //         $setoran = new SetoranJemaah;

    //         $setoran->jemaah_paket_id   = $paketJemaah->id;
    //         $setoran->bukti_setor       = $data['bukti_setor'];
    //         $setoran->nominal           = $data['nominal'];
    //         $setoran->waktu_setor       = now();

    //         $setoran->save();

    //         return $jemaah;
    //     });
    // }

    public ?array $data = [];

    public Jemaah $jemaah;

    public function mount(Jemaah $jemaah): void
    {
        $this->form->fill($jemaah->toArray());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
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
                                    function ($state, Set $set) {
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
                ])
            ])
            ->statePath('data')
            ->model(Jemaah::class);
    }

    public function create(): void
    {
        // $data = $this->data;
        // DB::transaction(function () use ($data) {
        //     $jemaah = Jemaah::create($data);

        //     // Buat paket jemaah
        //     $paketJemaah = new JemaahPaket;

        //     $paketJemaah->jemaah_id = $jemaah->id;
        //     $paketJemaah->paket_id  = $data['paket_id'];

        //     $paketJemaah->save();

        //     // Buat data setoran awal
        //     $setoran = new SetoranJemaah;

        //     $setoran->jemaah_paket_id   = $paketJemaah->id;
        //     $setoran->bukti_setor       = $data['bukti_setor'];
        //     $setoran->nominal           = $data['nominal'];
        //     $setoran->waktu_setor       = now();

        //     $setoran->save();

        //     return $jemaah;
        // });
    }

    public function render()
    {
        return view('livewire.form-pendaftaran-page');
    }
}
