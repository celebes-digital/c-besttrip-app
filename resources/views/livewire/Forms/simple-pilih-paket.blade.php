<div>
    @if ($dataPaket !== null)

        <div class="flex gap-4 overflow-x-scroll py-8">
            <div class="flex flex-nowrap gap-4 px-2 wire:transition">

                @foreach ($dataPaket as $item)

                    <div
                        class="w-64 md:w-[22rem] space-y-2 border p-3 md:p-4 rounded-xl md:rounded-2xl 
                        {{ 
                        $paketId === $item['id'] 
                                ? 'border-rose-400 bg-rose-100/25' 
                                : 'border-zinc-200' 
                        }}">
                        <div class="w-full aspect-video bg-slate-200 rounded-xl overflow-hidden object-center">

                            @if ($item['foto'] !== null)                                
                                <img 
                                    src="{{ url('storage/' . $item['foto']) }}" 
                                    alt="" 
                                    class="object-cover  h-full w-full">
                            @endif

                        </div>
                        <div class="space-y-2">
                            <h1 class="font-semibold md:text-lg text-md line-clamp-1">
                                {{ $item['nama_paket'] }}
                            </h1>
                            <p
                                class="bg-rose-400/25 w-fit h-fit md:text-lg text-md border border-rose-50 rounded-md px-2 py-1 font-medium text-rose-700">
                                {{ $item['tgl_paket'] }}
                            </p>
                            <p class="line-clamp-2 text-base font-light md:text-lg text-md">
                                {{ $item['deskripsi'] }}
                            </p>
                            <div class="py-2">
                                <span class="text-rose-500 font-semibold md:text-xl !py-12 text-lg">
                                    {{ h_format_currency($item['harga']) }}
                                </span>
                            </div>
                        </div>
                        <div class="flex gap-2 w-full">
                            <div class="w-1/2">
                                {{ ($this->viewAction)(['paket' => $item['id']]) }}
                            </div>
                            <button 
                                wire:click.prevent="updateDataPaketId({{ $item['id'] }})"
                                class="bg-rose-600 hover:bg-rose-500 transition-all ease-in-out rounded-lg text-white w-1/2 md:p-2  md:text-lg text-base font-medium wire:transition">
                                {{ $paketId === $item['id'] ? 'Terpilih' : 'Pilih Paket' }}
                            </button>
                        </div>
                    </div>

                @endforeach
                
            </div>
        </div>

    @else

        <div class="w-full h-24 bg-slate-100 rounded-lg flex flex-col justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p class="font-semibold text-xl">Tidak ada paket yang tersedia</p>
        </div>

    @endif
        
    <x-filament-actions::modals />
</div>
