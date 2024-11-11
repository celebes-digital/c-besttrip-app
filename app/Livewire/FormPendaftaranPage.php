<?php

namespace App\Livewire;

use Livewire\Component;

use App\Filament\Resources\JemaahResource;
use App\Livewire\Forms\PilihPaket;
use App\Models\Jemaah;

use Exception;

use Filament\Forms;
use Filament\Forms\Form;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\On;

class FormPendaftaranPage extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?array $data = [];

    public function mount(Jemaah $jemaah): void
    {
        $data = $jemaah->toArray();

        $this->form->fill($data);
    }

    #[On('updateDataPaketId')]
    public function updatePaketId(int $paketId): void
    {
        $this->data['paket_id'] = $paketId;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Paket')
                        ->schema([
                            Forms\Components\Hidden::make('paket_id')
                                ->required(),
                            Forms\Components\Livewire::make(PilihPaket::class)
                                ->live()
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
                ])
                ->submitAction(
                    new HtmlString(
                        Blade::render(
                            <<<BLADE
                                <x-filament::button
                                    type="submit"
                                    form="create"
                                    size="sm"
                                >
                                    Submit
                                </x-filament::button>
                            BLADE
                        )
                    )
                )
            ])
            ->statePath('data')
            ->model(Jemaah::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        try 
        {
            $jemaahPaket = DB::transaction(function () use ($data) {
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

                return $jemaahPaket;
            });

            $this->form->fill();
            
            redirect()->to('/jemaah/' . $jemaahPaket['kode_paket'] . '/paket');
        } 
        catch (Exception $e) 
        {
            redirect()->to('/error')->with('error', 'Data gagal disimpan. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.form-pendaftaran-page');
    }
}
