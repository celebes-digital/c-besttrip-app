<div>
    {{ $this->form }}

    @if ($dataPaket !== null)

        {{-- @foreach ($dataPaket as $month => $items) --}}
            {{-- <h2 class="text-2xl font-bold my-4">{{ $month }}</h2> --}}
            <div class="grid md:grid-col-2 lg:grid-cols-3 gap-4 w-full my-4 overflow-x-auto">

                @foreach ($dataPaket as $item)

                    <div
                        class="w-full space-y-2 border p-4 rounded-2xl {{ $paketId === $item['id'] ? 'border-rose-400 bg-rose-100/25' : 'border-zinc-200' }}">
                        <div class="w-full aspect-video bg-slate-200 rounded-xl overflow-hidden object-center">
                            @if ($item['foto'] !== null)                                
                                <img src="{{ url('storage/' . $item['foto']) }}" alt="" class="object-cover  h-full w-full">
                            @endif
                        </div>
                        <div class="space-y-2">
                            <h1 class="font-semibold text-lg">
                                Paket {{ $item['nama_paket'] }}
                            </h1>
                            <p
                                class="bg-rose-400/25 w-fit h-fit border border-rose-50 rounded-md px-2 py-1 font-medium text-rose-700">
                                {{ $item['tgl_paket'] }}
                            </p>
                            <p class="line-clamp-2 text-base font-light">
                                Lorem, ipsum dolor sit amet consectetur
                                adipisicing
                                elit. Sint vel aliquid, culpa nam provident qui eveniet cumque rerum? Quam sint totam
                                eaque
                                explicabo recusandae praesentium pariatur dolores animi commodi sunt.
                            </p>
                            <div class="py-2">
                                <span class="text-rose-500 font-semibold text-xl !py-12">
                                    {{ h_format_currency($item['harga']) }}
                                </span>
                            </div>
                        </div>
                        <button wire:click.prevent="updateDataPaketId({{ $item['id'] }})"
                            class="bg-rose-600 hover:bg-rose-500 transition-all ease-in-out rounded-lg text-white w-full p-2">
                            {{ $paketId === $item['id'] ? 'Terpilih' : 'Pilih Paket' }}
                        </button>
                    </div>

                @endforeach
                
            </div>
        {{-- @endforeach --}}

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
</div>
