<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 - C-Besttrip</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-100 dark:bg-zinc-800">
    <section class="grid min-h-screen place-items-center bg-white px-2 sm:px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center bg-rose-100/20 px-4 py-8 rounded-lg sm:px-12">
            <p class="font-bold text-lg text-rose-600">404</p>
            <h1 class="mt-4 text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-7xl">Halaman tidak ditemukan
            </h1>
            <p class="mt-6 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">Maaf, kami tidak dapat menemukan halaman yang Anda cari.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="/"
                    wire:click.prevent="$this->redirect('/')"
                    class="rounded-md bg-rose-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600">Kembali ke beranda</a>
                <a href="#" class="text-sm font-semibold text-gray-900">Hubungi Admin<span
                        aria-hidden="true">&rarr;</span></a>
            </div>
        </div>
    </section>
</body>

</html>
