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

use Filament\Forms\Components\Wizard\Step;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;

class FormPendaftaranPage extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Jemaah $jemaah;

    public function mount(Jemaah $jemaah): void
    {
        $data = $jemaah->toArray();

        $data['from_date'] = now();
        $data['to_date'] = now()->addMonths(3);

        $this->form->fill($data);
    }

    public function updatePaketId(int $paketId): void
    {

        $this->data['paket_id'] = $paketId;
    }

    public static function form(Form $form): Form
    {
        $now = now();

        return $form
            ->schema([
                Wizard::make([
                    Step::make('Paket')
                        ->schema([
                            Forms\Components\Group::make([
                                Forms\Components\DatePicker::make('from_date')
                                    ->label('Dari tanggal')
                                    ->default($now)
                                    ->native(false)
                                    ->live(onBlur: true)
                                    ->displayFormat('d F Y'),
                                Forms\Components\DatePicker::make('to_date')
                                    ->label('Sampai tanggal')
                                    ->live(onBlur: true)
                                    ->displayFormat('d F Y')
                                    ->native(false)
                                    ->default($now->addMonths(3))
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
            ->submitAction(
                new HtmlString(Blade::render(
                <<<BLADE
                    <x-filament::button
                        type="submit"
                        size="sm"
                    >
                        Submit
                    </x-filament::button>
                BLADE)))
            ])
            ->statePath('data')
            ->model(Jemaah::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        DB::transaction(function () use ($data) {
            $jemaah = Jemaah::create($data);

            // Buat paket jemaah
            $paketJemaah = new JemaahPaket;

            $paketJemaah->jemaah_id = $jemaah->id;
            $paketJemaah->paket_id  = $data['paket_id'];

            $paketJemaah->save();

            // Buat data setoran awal
            $setoran = new SetoranJemaah;

            $setoran->jemaah_paket_id   = $paketJemaah->id;
            $setoran->bukti_setor       = $data['bukti_setor'];
            $setoran->nominal           = $data['nominal'];
            $setoran->waktu_setor       = now();

            $setoran->save();
        });

        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.form-pendaftaran-page');
    }
}
