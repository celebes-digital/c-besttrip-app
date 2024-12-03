<?php

namespace App\Livewire;

use Livewire\Component;

use App\Filament\Resources\JemaahResource;
use App\Models\Jemaah;
use App\Models\Paket;
use Exception;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;

class SimpleFormPendaftaranPage 
extends Component 
implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?array $data = [];

    public function mount(Jemaah $jemaah): void
    {
        $data = $jemaah->toArray();

        $this->form->fill($data);
    }

    // #[On('updateDataPaketId')]
    // public function updatePaketId(int $paketId): void
    // {
    //     $this->data['paket_id'] = $paketId;
    //     $this->data['nominal']  = null;
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    // Paket
                    // Forms\Components\Hidden::make('paket_id')
                    // ->live()
                    // ->required(),
                    // Forms\Components\Livewire::make(SimplePilihPaket::class)
                    // ->live(),

                    Forms\Components\Fieldset::make('Paket')
                    ->schema([
                        Forms\Components\Select::make('paket_id')
                        ->label('Paket Umrah')
                        ->required()
                        ->live()
                        ->options(
                            function () {
                                return Paket::where('tgl_paket', '>=', now())
                                    ->where('is_active', true)
                                    ->get()
                                    ->mapWithKeys(
                                        function ($paket) {
                                            return [$paket->id => $paket->nama_paket . ' (' . $paket->tgl_paket . ')'];
                                        }
                                    );
                            }
                        )
                        ->preload()
                        ->native(false),
                    ]),

                    // Data Utama
                    JemaahResource::getDataPribadiFormField(),
                    JemaahResource::getKontakFormField(),
                    JemaahResource::getAlamatFormField(),
                    
                    // Data Tambahan
                    JemaahResource::getPasporFormField(),
                    JemaahResource::getDokumenPendukungFormField(),

                    // Setoran Awal
                    Forms\Components\Fieldset::make('Setoran Awal')
                    ->schema([
                        Forms\Components\Select::make('metode_setor')
                        ->label('Metode Pembayaran')
                        ->options([
                            'Tunai'     => 'Tunai',
                            'Transfer'  => 'Transfer',
                        ])
                        ->native(false)
                        ->live()
                        ->required(),
                        Forms\Components\Select::make('nominal')
                        ->label('Setoran Awal')
                        ->required()
                        ->placeholder('Pilih Setoran Awal')
                        ->helperText('Pilih paket umrah terlebih dahulu untuk melihat nominal setoran awal')
                        ->live()
                        ->disabled(fn (Get $get) => $get('paket_id') === null)
                        ->options(
                            function (Get $get, Set $set) {
                                if($get('paket_id') === null) {
                                    $set('nominal', null);
                                    return [];
                                }

                                $hargaPaket = Paket::find($get('paket_id'));

                                return [
                                    '5000000'               => 'IDR 5.000.000',
                                    '10000000'              => 'IDR 10.000.000',
                                    $hargaPaket?->harga ?? 0 => h_format_currency($hargaPaket?->harga ?? 0) . ' (Lunas)',
                                ];
                            }
                        )
                        ->native(false),
                        Forms\Components\FileUpload::make('bukti_setor')
                        ->label('Bukti Setoran Awal')
                        ->required(fn (Get $get) => $get('metode_setor') === 'Transfer')
                        ->columnSpanFull()
                        ->image()
                        ->directory('foto/bukti-setor'),
                    ]),
            ])
            ->statePath('data');
    } 

    public function create(): void
    {
        $data = $this->form->getState();
        
        try 
        {
            // $jemaahPaket = DB::transaction(function () use ($data) {
                $jemaah = Jemaah::create($data);

                $jemaahPaket = $jemaah->jemaahPakets()->create([
                    'paket_id' => $data['paket_id'],
                ]);

                $jemaahPaket->setorans()->create([
                    'jemaah_paket_id'   => $jemaahPaket->id,
                    'bukti_setor'       => $data['bukti_setor'],
                    'nominal'           => $data['nominal'],
                    'waktu_setor'       => now(),
                ]);

            //     return $jemaahPaket;
            // });

            Notification::make()
                ->title('Berhasil Mendaftar')
                ->body('Anda telah berhasil mendaftar paket umrah, silahkan menunggu konfirmasi dari admin')
                ->success()
                ->send();

            $this->form->fill([]);
            
            redirect()->to('/jemaah/' . $jemaahPaket['kode_paket'] . '/paket');
        } 
        catch (Exception $e) 
        {
            dd($e);
            Notification::make()
                ->title('Gagal Mendaftar, Silahkan Coba Lagi')
                ->body($e->getMessage() ?? 'Terjadi kesalahan saat mendaftar, silahkan coba lagi')
                ->danger()
                ->send();
        }
    }

    public function render()
    {
        return view('livewire.simple-form-pendaftaran-page');
    }
}
