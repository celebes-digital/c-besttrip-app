<?php

namespace App\Livewire\Forms;

use App\Models\Paket;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PilihPaket extends Component implements Forms\Contracts\HasForms, HasActions
{
    use InteractsWithActions;
    use Forms\Concerns\InteractsWithForms;

    public $dataPaket   = [];
    public $dataFilter  = [];
    public $startDate   = null;
    public $endDate     = null;
    public $paketId     = null;

    public function mount(): void
    {
        $this->startDate = Carbon::now();

        $this->form->fill([
            'from_date' => $this->startDate,
        ]);

        $this->getDataPaket();
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('from_date')
                    ->label('Dari tanggal')
                    ->native(false)
                    ->placeholder('Tentukan filter tanggal')
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        function ($state) 
                        {
                            $this->startDate = $state;
                            $this->getDataPaket();
                        }
                    )
                    ->displayFormat('d F Y'),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Sampai tanggal')
                    ->live(onBlur: true)
                    ->placeholder('Tentukan filter tanggal')
                    ->afterStateUpdated(
                        function ($state) {
                            $this->endDate = $state;
                            $this->getDataPaket();
                        }
                    )
                    ->displayFormat('d F Y')
                    ->native(false)
            ])
            ->columns(3)
            ->statePath('dataFilter');
    }

    public function viewAction(): Action
    {
        return Action::make('view')
            ->label('Detail Paket')
            ->button()
            ->outlined()
            ->modal()
            ->action(fn(Paket $record) => $record->advance())
            ->modalContent(
                function (array $arguments): View {
                    $paket = Paket::find($arguments['paket']);

                    return view(
                        'components.detail-paket',
                        ['data' => $paket]
                    );
                }
            )
            ->extraAttributes([
                'class' => 'w-full h-full',
            ])
            ->action(fn() => $this->post->delete());
    }

    public function updateDataPaketId(int $paketId): void
    {
        $this->paketId = $paketId;
        $this->dispatch('updateDataPaketId', $paketId);
    }
    
    public function getDataPaket()
    {
        $query = Paket::query();
        
        $query
            ->where('is_active', true)
            ->where('tgl_paket', '>=', $this->startDate);

        if ( $this->endDate ) {
            $query->where('tgl_paket', '<=', $this->endDate);
        }

        $this->dataPaket = $query
            ->orderBy('tgl_paket', 'asc')
            ->get()
            // ->groupBy(fn ($value) => Carbon::parse($value->tgl_paket)->format('F Y'))
            ->toArray();
    }

    public function render()
    {
        return view('livewire.forms.pilih-paket');
    }
}
