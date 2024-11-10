{{-- <main class="max-w-5xl mx-auto my-8 px-2 space-y-4 text-rose-900"> --}}
    <div class="py-4 rounded-md md:py-2">
        <h1 class="text-rose-900 text-lg font-semibold mb-2">Detail Paket</h1>
        <div class="space-y-2">
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Nama Paket</p>
                </div>
                <div class="w-3/4 border px-4 py-1 rounded-lg bg-rose-50 border-rose-100">
                    <p class="text-base font-medium">{{ $data->nama_paket }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Tanggal</p>
                </div>
                <div class="w-3/4 border px-4 py-1 rounded-lg bg-rose-50 border-rose-100">
                    <p class="text-base font-medium">{{ $data->tgl_paket }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Harga</p>
                </div>
                <div class="w-3/4 border px-4 py-1 rounded-lg bg-rose-50 border-rose-100">
                    <p class="text-base font-medium">{{ h_format_currency($data->harga) }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Sisa Kuota</p>
                </div>
                <div class="w-3/4 border px-4 py-1 rounded-lg bg-rose-50 border-rose-100">
                    <p class="text-base font-medium">
                        {{ $data->kuota - $data->jemaahs->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4 rounded-md md:py-2">
        <h1 class="text-rose-900 text-lg font-semibold mb-2 md:w-1/4">Itenary Paket Umrah</h1>
        <div class="space-y-2 py-2">
            
            @if (($data->itenaryPakets)->count() > 0)
                @foreach ($data->itenaryPakets as $itenary)
                    <div class="flex items-center">
                        <div class="w-1/4">
                            <p class="text-base font-medium">Hari {{ $itenary->hari_ke }}</p>
                        </div>
                        <div class="w-3/4 border px-4 py-1 rounded-lg bg-rose-50 border-rose-100">
                            <p class="text-base font-medium">{{ $itenary->kegiatan }}</p>
                        </div>
                    </div>
                @endforeach

            @else
                <div class="flex justify-center w-full border py-8 rounded-lg bg-rose-50 border-rose-100">
                    <p class="text-base font-medium">Belum ada data itenary</p>
                </div>
            @endif

        </div>
    </div>

{{-- </main> --}}
