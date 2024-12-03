<main class="max-w-5xl mx-auto my-8 px-4 space-y-4 text-rose-700">
    <div class="w-full h-24 bg-gradient-to-br from-rose-700 to-rose-500 rounded-xl flex justify-center border items-center">
        <h1 class="text-lg lg:text-2xl text-white text-center font-semibold">Besttrip - Your Travel</h1>
    </div>

    <div class="border border-rose-100 px-2 py-4 rounded-lg md:flex md:px-8 md:py-10">
        <h1 class="text-rose-900 text-lg font-semibold mb-2 md:w-1/4">Profile Jemaah</h1>
        <div class="space-y-2 md:w-3/4">
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-sm sm:text-base font-medium">Nama</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-white border-rose-100">
                    <p class="text-sm sm:text-base font-medium">{{ $data->jemaah->nama_ktp ?? '-' }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-sm sm:text-base font-medium">NIK</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-white border-rose-100">
                    <p class="text-sm sm:text-base font-medium">{{ $data->jemaah->nik ? substr($data->jemaah->nik, 0, 4) . ' **** **** **' . substr($data->jemaah->nik, -2) : 'Nik belum didaftarakan' }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-sm sm:text-base font-medium">Nomor Whatsapp</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-white border-rose-100">
                    <p class="text-sm sm:text-base font-medium">{{ $data->jemaah->no_hp ? '+62 ' . substr($data->jemaah->no_hp, 1, 3) . ' **** ' . substr($data->jemaah->no_hp, -4) : '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-2 py-4 rounded-md md:flex md:px-8 md:py-10">
        <h1 class="text-rose-900 text-lg font-semibold mb-2 md:w-1/4">Riwayat Setoran</h1>
        <div class="space-y-2 md:w-3/4">
            @foreach ($data->setorans->sortBy('waktu_setor') as $key => $item)
                <div class="flex items-center">
                    <div class="w-1/4">
                        <p class="text-sm sm:text-base font-medium">{{$key === 0 ? 'Setoran Awal' : 'Setoran ke-' . $key+1}}</p>
                    </div>
                    <div class="w-3/4 px-2 py-1 flex flex-col md:flex-row justify-between">
                        <p class="text-sm sm:text-base font-medium">{{ h_format_currency($item->nominal) }}</p>
                        <p class="text-sm sm:text-base font-medium text-rose-800">{{ h_format_datetime($item->waktu_setor) }}</p>
                    </div>
                </div>
            @endforeach
            <div class="flex items-center border-t border-t-rose-400">
                <div class="w-1/4">
                    <p class="text-sm sm:text-base font-medium">Jumlah</p>
                </div>
                <div class="w-3/4 px-2 py-1 flex flex-col md:flex-row justify-between">
                    <p class="text-sm sm:text-base font-medium">
                        {{ h_format_currency($data->setorans->sum('nominal')) }}
                    </p>
                </div>
            </div>
            <div class="flex items-center border-t border-t-rose-400">
                <div class="w-1/4">
                    <p class="text-sm sm:text-base font-medium">Sisa</p>
                </div>
                <div class="w-3/4 px-2 py-1 flex flex-col md:flex-row justify-between">
                    <p class="text-sm sm:text-base font-medium">
                        {{ h_format_currency($data->paket->harga - $data->setorans->sum('nominal')) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-2 py-4 rounded-md md:flex md:px-8 md:py-10">
        <h1 class="text-rose-900 text-lg font-semibold mb-2 md:w-1/4">Detail Paket</h1>
        <div class="space-y-2 md:w-3/4">
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-sm sm:text-base font-medium">Nama Paket</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-rose-50 border-rose-100">
                    <p class="text-sm sm:text-base font-medium">{{ $data->paket->nama_paket }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-sm sm:text-base font-medium">Tanggal</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-rose-50 border-rose-100">
                    <p class="text-sm sm:text-base font-medium">{{ $data->paket->tgl_paket }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-sm sm:text-base font-medium">Harga</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-rose-50 border-rose-100">
                    <p class="text-sm sm:text-base font-medium">{{ h_format_currency($data->paket->harga) }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-sm sm:text-base font-medium">Sisa Kuota</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-rose-50 border-rose-100">
                    <p class="text-sm sm:text-base font-medium">
                        {{ $data->paket->kuota - $data->paket->jemaahs->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if ($data->paket->itenaryPakets)
    <div class="px-2 py-4 rounded-md md:px-8 md:py-10">
        <h1 class="text-rose-900 text-lg font-semibold mb-2 md:w-1/4">Itenary Paket Umrah</h1>
        <div class="space-y-2 py-2">

            @foreach ($data->paket->itenaryPakets as $itenary)
                <div class="flex items-center">
                    <div class="w-1/4">
                        <p class="text-sm sm:text-base font-medium">Hari {{ $itenary->hari_ke }}</p>
                    </div>
                    <div class="w-3/4 border px-2 py-1 rounded-lg bg-rose-50 border-rose-100">
                        <p class="text-sm sm:text-base font-medium">{{ $itenary->kegiatan }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    @endif

    <div class="w-full py-8 bg-rose-200/25 border border-rose-300 rounded-lg flex flex-col items-center">
        <h1 class="text-rose-500 font-semibold text-lg md:text-xl mb-4 text-center">
            Jika ada Pertanyaan silahkan hubungi admin
        </h1>
        <a 
            href="https://wa.me/{{ $data->paket->no_wa_admin }}" 
            class="bg-rose-400 hover:bg-red-300 rounded-lg py-2 px-4 text-white font-semibold flex justify-center gap-2">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                </svg>
            </span>
            Kontak Admin
        </a>
    </div>

</main>
