<?php

namespace App\Livewire\Forms;

use App\Models\Paket;
use Carbon\Carbon;
use Filament\Forms;
use Livewire\Component;

class PilihPaket extends Component implements Forms\Contracts\HasForms
{
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
                    ->afterStateUpdated(
                        function ($state) {
                            $this->startDate = $state;
                            $this->getDataPaket();
                        }
                    )
                    ->displayFormat('d F Y')
                    ->native(false)
            ])
            ->columns(3)
            ->statePath('dataFilter');
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

        if ($this->endDate) {
            $query->where('tgl_paket', '<=', $this->endDate);
        }

        $this->dataPaket = $query
            ->orderBy('tgl_paket', 'asc')
            ->get()
            ->groupBy(fn ($value) => Carbon::parse($value->tgl_paket)->format('F Y'))
            ->toArray();
    }

    public function render()
    {
        return view('livewire.forms.pilih-paket');
    }
}
