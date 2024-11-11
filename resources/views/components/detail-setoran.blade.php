
    <div class="px-2 py-4 rounded-md md:flex md:px-8 md:py-10">
        <h1 class="text-rose-900 text-lg font-semibold mb-2 md:w-1/4">Riwayat Setoran</h1>
        <div class="space-y-2 md:w-3/4">
            @foreach ($data->sortBy('waktu_setor') as $key => $item)
                <div class="flex items-center">
                    <div class="w-1/4">
                        <p class="text-base font-medium">{{$key === 0 ? 'Setoran Awal' : 'Setoran ke-' . $key+1}}</p>
                    </div>
                    <div class="w-3/4 px-2 py-1 flex flex-col md:flex-row justify-between">
                        <p class="text-base font-medium">{{ h_format_currency($item->nominal) }}</p>
                        <p class="text-base font-medium">{{ h_format_datetime($item->waktu_setor) }}</p>
                    </div>
                </div>
            @endforeach
            <div class="flex items-center border-t border-t-rose-400">
                <div class="w-1/4">
                    <p class="text-base font-medium">Jumlah</p>
                </div>
                <div class="w-3/4 px-2 py-1 flex flex-col md:flex-row justify-between">
                    <p class="text-base font-medium">
                        {{ h_format_currency($data->sum('nominal')) }}
                    </p>
                </div>
            </div>
            {{-- <div class="flex items-center border-t border-t-rose-400">
                <div class="w-1/4">
                    <p class="text-base font-medium">Sisa</p>
                </div>
                <div class="w-3/4 px-2 py-1 flex flex-col md:flex-row justify-between">
                    <p class="text-base font-medium">
                        {{ h_format_currency($data->paket->harga - $data->sum('nominal')) }}
                    </p>
                </div>
            </div> --}}
        </div>
    </div>
