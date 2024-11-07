<main class="max-w-5xl mx-auto my-8 px-2 space-y-4 text-slate-900">
    <div class="border border-rose-100 px-2 py-4 rounded-lg md:flex md:px-8 md:py-10">
        <h1 class="text-rose-900 text-lg font-semibold mb-2 md:w-1/4">Profile Jemaah</h1>
        <div class="space-y-2 md:w-3/4">
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Nama</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-white border-slate-100">
                    <p class="text-base font-medium">{{ $data->jemaah->nama_ktp ?? '-' }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">NIK</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-white border-slate-100">
                    <p class="text-base font-medium">5009 **** **** **32</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Nomor Whatsapp</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-white border-slate-100">
                    <p class="text-base font-medium">+62 *** **** 3546</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-2 py-4 rounded-md md:flex md:px-8 md:py-10">
        <h1 class="text-rose-900 text-lg font-semibold mb-2 md:w-1/4">Riwayat Setoran</h1>
        <div class="space-y-2 md:w-3/4">
            @foreach ($data->setorans as $item)
                <div class="flex items-center">
                    <div class="w-1/4">
                        <p class="text-base font-medium">Setoran Awal</p>
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
                        {{ h_format_currency($data->setorans->sum('nominal')) }}
                    </p>
                </div>
            </div>
            <div class="flex items-center border-t border-t-rose-400">
                <div class="w-1/4">
                    <p class="text-base font-medium">Sisa</p>
                </div>
                <div class="w-3/4 px-2 py-1 flex flex-col md:flex-row justify-between">
                    <p class="text-base font-medium">
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
                    <p class="text-base font-medium">Nama Paket</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">{{ $data->paket->nama_paket }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Tanggal</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">{{ $data->paket->tgl_paket }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Harga</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">{{ h_format_currency($data->paket->harga) }}</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Sisa Kuota</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">
                        {{ $data->paket->kuota - $data->paket->jemaahs->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="px-2 py-4 rounded-md md:px-8 md:py-10">
        <h1 class="text-rose-900 text-lg font-semibold mb-2 md:w-1/4">Itenary Paket Umrah</h1>
        <div class="space-y-2 py-2">
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Hari 1</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">Keberangkatan dari Jakarta menuju Jeddah</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Hari 2</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">Tiba di Jeddah, perjalanan menuju Madinah</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Hari 3</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">Ziarah di Madinah</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Hari 4</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">Perjalanan menuju Mekkah</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Hari 5</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">Ibadah Umrah di Mekkah</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Hari 6</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">Ziarah di Mekkah</p>
                </div>
            </div>
            <div class="flex items-center">
                <div class="w-1/4">
                    <p class="text-base font-medium">Hari 7</p>
                </div>
                <div class="w-3/4 border px-2 py-1 rounded-lg bg-slate-50 border-slate-100">
                    <p class="text-base font-medium">Kepulangan ke Jakarta</p>
                </div>
            </div>
        </div>
    </div>
</main>
