<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>C-Besttrip</title>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    
    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body>
        <nav class="fixed top-0 w-full z-30 bg-sky-800 p-2">
            <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
                <div class="relative flex items-center justify-between h-12">
                    <!-- Logo -->
                    <div class="flex items-center gap-2">
                        <img style="text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5)" class="h-24 w-24" src="{{ url('/img/public/logo.png') }}" alt="Logo" />
                    </div>

                    <!-- Navbar Menu (Centered) -->
                    <div class="hidden md:flex flex-1 items-center justify-center space-x-8">
                        <a href="#home" class="text-white hover:bg-red-600 px-3 py-1 rounded-md text-sm font-medium">Beranda</a>
                        <a href="#about" class="text-white hover:bg-red-600 px-3 py-1 rounded-md text-sm font-medium">Tentang</a>
                        <a href="#paket" class="text-white hover:bg-red-600 px-3 py-1 rounded-md text-sm font-medium">Paket</a>
                        <a href="#footer" class="text-white hover:bg-red-600 px-3 py-1 rounded-md text-sm font-medium">Kontak</a>
                    </div>

                    <!-- Button Daftar Sekarang-->
                    <div class="hidden md:block">
                        <a href="https://besttrip.celebesdigital.id/daftar" class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-full text-xs text-white">Daftar sekarang</a>
                    </div>
                    <div class="md:hidden">
                        <button id="hamburger-icon" class="text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="fixed top-12 z-40 bg-sky-700 text-white space-y-4 w-full px-6 py-4 md:hidden hidden">
            <a href="#home" class="block hover:bg-blue-500 mobile-menu-link">Beranda</a>
            <a href="#about" class="block hover:bg-blue-500 mobile-menu-link">Tentang</a>
            <a href="#paket" class="block hover:bg-blue-500 mobile-menu-link">Paket</a>
            <a href="#footer" class="block hover:bg-blue-500 mobile-menu-link">Kontak</a>
            <a href="https://besttrip.celebesdigital.id/daftar" class="block text-center bg-red-600 hover:bg-red-700 px-6 py-2 rounded-lg">Daftar Sekarang</a>
        </div>

        <!-- hero section -->
        <section id="home" class="relative w-full lg:h-screen h-[500px] bg-cover bg-center" style="background-image: url('{{ url('/img/public/hero.jpg')}}' )">
            <div class="absolute inset-0 bg-black bg-opacity-60"></div>
            <div class="relative z-10 flex flex-col justify-center items-center w-full h-full text-white text-center px-4">
                <h1 class="text-4xl mt-6">Temukan Kedamaian dalam Ibadah <br />Umrah bersama Kami</h1>
                <p class="mt-6 text-xl font-thin">Dilengkapi Fasilitas Nyaman dan Pendampingan Penuh, Wujudkan Perjalanan Ibadah Anda Bersama Kami</p>
                <a href="https://besttrip.celebesdigital.id/daftar" class="mt-6 px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-full">Daftar sekarang</a>
            </div>
        </section>

        <!-- card kelebihan -->
        <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4 py-10 container mx-auto">
            <!-- card 1 -->
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <img class="w-16 h-16 mx-auto mb-4" src="{{ url('/img/public/Group.png') }}" alt="Icon jamaah" />
                <h4 class="font-bold text-lg">10.000+</h4>
                <p class="text-slate-500">Jamaah yang telah di layani</p>
            </div>
            <!-- card 2 -->
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <img class="w-16 h-16 mx-auto mb-4" src="{{ url('/img/public/leader.png') }}" alt="Icon jamaah" />
                <h4 class="font-bold text-lg">24/7</h4>
                <p class="text-slate-500">Panduan Ibadah</p>
            </div>
            <!-- card 3 -->
            <div class="bg-white shadow-lg rounded-lg p-8 text-center">
                <img class="w-16 h-16 mx-auto mb-3" src="{{ url('/img/public/event.png') }}" alt="Icon jamaah" />
                <h4 class="font-bold text-lg">5</h4>
                <p class="text-slate-500">Tahun pengalaman</p>
            </div>
        </div>

        <!-- about -->
        <section id="about" class="mx-auto py-5">
            <div class="container mx-auto w-full max-w-screen-lg p-5">
                <h2 class="text-4xl mb-5 text-center">ABOUT</h2>
                <div class="flex flex-col lg:flex-row items-center space-y-6 lg:space-y-0 lg:space-x-10">
                    <!-- Gambar -->
                    <div class="flex-shrink-0 w-full lg:w-96 h-96 bg-gray-200 rounded-lg overflow-hidden shadow-md">
                        <img src="{{ url('/img/public/about.jpg') }}" alt="About Me" class="w-full h-full object-cover" />
                    </div>

                    <!-- Deskripsi Teks -->
                    <div class="text-center lg:text-left px-4 lg:px-8 max-w-2xl">
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus totam cupiditate, error numquam dignissimos labore iure aspernatur esse magni sequi, incidunt pariatur eaque deserunt dolore culpa autem aut
                            fugiat maxime.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- keunggulan -->
        <section>
            <div class="container mx-auto w-full max-w-screen-lg flex flex-col md:flex-row justify-between bg-white p-6 space-y-6 md:space-y-0">
                <!-- Harga Terjangkau -->
                <div class="flex gap-3">
                    <img src="{{ url('img/public/money.png') }}" alt="Icon Harga Terjangkau" class="w-16 h-16" />
                    <div>
                        <h3 class="font-bold text-lg">Harga Terjangkau</h3>
                        <p class="text-gray-500 text-sm">Memberikan harga terbaik dan murah</p>
                    </div>
                </div>

                <!-- Travel Terpercaya -->
                <div class="flex gap-3">
                    <img src="{{ url('img/public/achieve.png') }}" alt="Icon Travel Terpercaya" class="w-16 h-16" />
                    <div>
                        <h3 class="font-bold text-lg">Travel Terpercaya</h3>
                        <p class="text-gray-500 text-sm">Telah melayani 10.000 orang</p>
                    </div>
                </div>

                <!-- Aman & Nyaman -->
                <div class="flex gap-3">
                    <img src="{{ url('img/public/protect.png') }}" alt="Icon Aman dan Nyaman" class="w-16 h-16" />
                    <div>
                        <h3 class="font-bold text-lg">Aman & Nyaman</h3>
                        <p class="text-gray-500 text-sm">Memberikan keamanan dalam perjalanan anda</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- paket -->
        <section id="paket" class="py-8">
          <div class="text-center container max-w-screen-lg mx-auto w-full">
            <h2 class="text-4xl mb-8" style="text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5)">PAKET YANG TERSEDIA</h2>

            <div class="overflow-x-auto px-4">
              <div class="flex space-x-4 whitespace-nowrap pb-8">

                @foreach ($paket as $item)
                  <!-- Card 1 -->
                  <div class="w-fit bg-white shadow-lg rounded-lg p-10 border inline-block">
                    <div class="flex justify-between items-center mb-4">
                      <div>
                        <h3 class="text-xl font-semibold">
                          {{-- {{ $item['nama_paket'] }} --}}
                          Paket Umrah
                        </h3>
                        <p class="text-sm mb-2">{{ $item['tgl_paket'] }}</p>
                        <div class="flex justify-center space-x-2 mb-2">
                          <span class="rounded-full border border-sky-100 bg-sky-50 px-2 py-0.5 dark:text-sky-300 dark:border-sky-500/15 dark:bg-sky-500/10">10 hari</span>
                          <span class="rounded-full border border-sky-100 bg-sky-50 px-2 py-0.5 dark:text-sky-300 dark:border-sky-500/15 dark:bg-sky-500/10">direct</span>
                        </div>
                      </div>
                      <img src="{{ url('img/public/image.png') }}" alt="Image description" class="w-36 h-24 ml-4 rounded-md" />
                    </div>
                    <hr />
                    <p class="flex space-x-2 text-sm mt-3 mb-3">
                      <span>Makassar</span>
                      <img src="{{ url('img/public/plane.png') }}" alt="Plane icon" class="w-4 h-4" />
                      <span>Jeddah</span>
                    </p>
                    <hr />
                    <div class="flex gap-4 mt-3 mb-3">
                      <div class="text-left">
                        <p class="font-semibold">Include :</p>
                        <ul class="list-disc list-inside text-sm">
                          <li>Bus</li>
                          <li>Makan</li>
                          <li>Hotel</li>
                          <li>Koper</li>
                          <li>Visa</li>
                          <li>Tour Guide</li>
                        </ul>
                      </div>
                      <div class="text-left">
                        <p class="font-semibold">Exclude :</p>
                        <ul class="list-disc list-inside text-sm">
                          <li>Tiket domestik</li>
                          <li>Bagasi berlebih (overload)</li>
                        </ul>
                      </div>
                    </div>
                    <hr />
                    <div class="mt-3 mb-3 text-left">
                      <p class="text-sm text-gray-600">MEKKAH</p>
                      <div class="flex items-center space-x-1 mb-2">
                        <span class="text-sm">Hotel</span>
                        <img src="{{ url('img/public/star.png') }}" alt="Star icon" class="w-4 h-4" />
                        <img src="{{ url('img/public/star.png') }}" alt="Star icon" class="w-4 h-4" />
                        <img src="{{ url('img/public/star.png') }}" alt="Star icon" class="w-4 h-4" />
                        <img src="{{ url('img/public/star.png') }}" alt="Star icon" class="w-4 h-4" />
                        <img src="{{ url('img/public/star.png') }}" alt="Star icon" class="w-4 h-4" />
                      </div>
                      <p class="text-sm text-gray-600">MEDINA</p>
                      <div class="flex items-center space-x-1 mb-2">
                        <span class="text-sm">Hotel</span>
                        <img src="{{ url('img/public/star.png') }}" alt="Star icon" class="w-4 h-4" />
                        <img src="{{ url('img/public/star.png') }}" alt="Star icon" class="w-4 h-4" />
                        <img src="{{ url('img/public/star.png') }}" alt="Star icon" class="w-4 h-4" />
                        <img src="{{ url('img/public/star.png') }}" alt="Star icon" class="w-4 h-4" />
                      </div>
                    </div>
                    <hr />
                    <div class="flex justify-between items-center mt-4">
                      <button class="bg-blue-600 text-white px-4 py-1 rounded-md text-sm hover:bg-blue-800">SEAT TERBATAS</button>
                      <div class="text-right">
                        <p class="text-sm text-gray-500">
                          <span class="line-through text-rose-700">
                            {{ h_format_currency($item['harga'] + 3000000) }}
                          </span>
                        </p>
                        <p class="text-xl font-bold">{{ h_format_currency($item['harga']) }}</p>
                      </div>
                    </div>
                  </div>              
                @endforeach
                
              </div>
            </div>
          </div>
        </section>

        <!-- foto -->
        <div class="container max-w-screen-lg mx-auto w-full">
            <div class="text-center mt-5 mb-5">
                <h2 class="text-4xl" style="text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5)">JAMAAH KAMI</h2>
            </div>
            <div class="card-foto overflow-x-auto">
                <div class="flex gap-3 w-fit">
                    <div class="rounded-lg border-8 border-sky-800 w-96">
                        <div class="overflow-hidden">
                            <img src="{{ url('img/public/jamaah.jpg') }}" alt="" class="transition-all duration-300 rounded-lg hover:scale-110 hover:rounded-lg" />
                        </div>
                        <div class="px-5 py-6 border-t-4 border-sky-800">
                            <h3 class="mt-2 text-2xl font-serif">Jamaah Platinum Oktober 2024</h3>
                            <div class="flex justify-between">
                                <p class="text-zinc-400">bestTrip Travel</p>
                                <img src="{{ url('img/public/logo1.png') }}" alt="" class="h-16 w-16" />
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border-8 border-sky-800 w-96">
                        <div class="overflow-hidden">
                            <img src="{{ url('img/public/jamaah.jpg') }}" alt="" class="transition-all duration-300 rounded-lg hover:scale-110 hover:rounded-lg" />
                        </div>
                        <div class="px-5 py-6 border-t-4 border-sky-800">
                            <h3 class="mt-2 text-2xl font-serif">Jamaah Platinum Oktober 2024</h3>
                            <div class="flex justify-between">
                                <p class="text-zinc-400">bestTrip Travel</p>
                                <img src="{{ url('img/public/logo1.png') }}" alt="" class="h-16 w-16" />
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border-8 border-sky-800 w-96">
                        <div class="overflow-hidden">
                            <img src="{{ url('img/public/jamaah.jpg') }}" alt="" class="transition-all duration-300 rounded-lg hover:scale-110 hover:rounded-lg" />
                        </div>
                        <div class="px-5 py-6 border-t-4 border-sky-800">
                            <h3 class="mt-2 text-2xl font-serif">Jamaah Platinum Oktober 2024</h3>
                            <div class="flex justify-between">
                                <p class="text-zinc-400">bestTrip Travel</p>
                                <img src="{{ url('img/public/logo1.png') }}" alt="" class="h-16 w-16" />
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border-8 border-sky-800 w-96">
                        <div class="overflow-hidden">
                            <img src="{{ url('img/public/jamaah.jpg') }}" alt="" class="transition-all duration-300 rounded-lg hover:scale-110 hover:rounded-lg" />
                        </div>
                        <div class="px-5 py-6 border-t-4 border-sky-800">
                            <h3 class="mt-2 text-2xl font-serif">Jamaah Platinum Oktober 2024</h3>
                            <div class="flex justify-between">
                                <p class="text-zinc-400">bestTrip Travel</p>
                                <img src="{{ url('img/public/logo1.png') }}" alt="" class="h-16 w-16" />
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border-8 border-sky-800 w-96">
                        <div class="overflow-hidden">
                            <img src="{{ url('img/public/jamaah.jpg') }}" alt="" class="transition-all duration-300 rounded-lg hover:scale-110 hover:rounded-lg" />
                        </div>
                        <div class="px-5 py-6 border-t-4 border-sky-800">
                            <h3 class="mt-2 text-2xl font-serif">Jamaah Platinum Oktober 2024</h3>
                            <div class="flex justify-between">
                                <p class="text-zinc-400">bestTrip Travel</p>
                                <img src="{{ url('img/public/logo1.png') }}" alt="" class="h-16 w-16" />
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border-8 border-sky-800 w-96">
                        <div class="overflow-hidden">
                            <img src="{{ url('img/public/jamaah.jpg') }}" alt="" class="transition-all duration-300 rounded-lg hover:scale-110 hover:rounded-lg" />
                        </div>
                        <div class="px-5 py-6 border-t-4 border-sky-800">
                            <h3 class="mt-2 text-2xl font-serif">Jamaah Platinum Oktober 2024</h3>
                            <div class="flex justify-between">
                                <p class="text-zinc-400">bestTrip Travel</p>
                                <img src="{{ url('img/public/logo1.png') }}" alt="" class="h-16 w-16" />
                            </div>
                        </div>
                    </div>
                    <div class="rounded-lg border-8 border-sky-800 w-96">
                        <div class="overflow-hidden">
                            <img src="{{ url('img/public/jamaah.jpg') }}" alt="" class="transition-all duration-300 rounded-lg hover:scale-110 hover:rounded-lg" />
                        </div>
                        <div class="px-5 py-6 border-t-4 border-sky-800">
                            <h3 class="mt-2 text-2xl font-serif">Jamaah Platinum Oktober 2024</h3>
                            <div class="flex justify-between">
                                <p class="text-zinc-400">bestTrip Travel</p>
                                <img src="{{ url('img/public/logo1.png') }}" alt="" class="h-16 w-16" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- testimoni -->
        <div class="container max-w-screen-lg mx-auto w-full">
            <div class="text-center text-lg mt-10 mb-3">
                <h2 class="text-4xl mb-8" style="text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5)">TESTIMONI JAMAAH</h2>
            </div>
            <div class="card-tetimoni overflow-x-auto">
                <div class="flex gap-3 w-fit">
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                    <div class="bg-sky-800 w-72 h-97 items-center rounded-lg p-5">
                        <img src="{{ url('img/public/IMG_5371.jpeg') }}" alt="" class="w-fit h-full shadow-2xl" />
                    </div>
                </div>
            </div>
        </div>

        <!--icon wa-->
        <div class="fixed bottom-4 right-4 z-50">
            <a href="https://wa.me/6287885906389" class="flex items-center justify-center w-16 h-16 text-white rounded-full shadow-lg hover:scale-110 duration-300">
                <img src="{{ url('/img/public/whatsapp.png') }}" alt="WhatsApp" class="w-12 h-12" />
            </a>
        </div>

        <section class="container max-w-screen-lg mx-auto w-full mt-10 mb-10 grid gap-y-8 md:grid-cols-2 sm:grid-cols-1">
            <div>
                <iframe
                    class="w-full rounded-lg"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127156.09363136976!2d119.27037189726555!3d-5.163411699999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee33c12065e47%3A0xda6d2b591322fb5a!2sPT%20Celebes%20solusi%20digital!5e0!3m2!1sid!2sid!4v1730702718827!5m2!1sid!2sid"
                    width="675"
                    height="309"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
            <div class="mx-10 lg:w-fit">
                <div class="bg-sky-800 p-5 rounded-lg">
                    <div class="text-center text-white">
                        <div class="font-semibold">Tetap Up To Date</div>
                        <div class="font-thin">Dapatkan penawaran umroh, tips umroh dan update lainnya melalui Nomor Telepon Anda.</div>
                    </div>
                    <div class="flex m-5 justify-center">
                        <div class="text-left text-base px-2 rounded-md h-7 mx-2">
                            <input type="number" name="" id="" placeholder="Masukkan No Telepon anda" class="w-full h-full bg-white border border-gray-300 rounded-md px-2" />
                        </div>
                        <button type="submit" class="rounded-lg bg-cyan-600 h-7 w-24 text-center text-white font-light px-1 hover:bg-cyan-700">Langganan</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- <div class="container mx-auto w-full">
			<div class="text-center text-5xl font-semibold font-serif mt-5 mb-5">
				<p>JAMAAH KAMI</p>
			</div>

			<div class="card-foto w-full overflow-x-auto">
				<div class="flex gap-3 w-fit">
				<div class="p-3 rounded-lg w-96 shadow-lg bg-red-900">
					<img class="w-full h-64 shadow-lg rounded-lg" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-300 italic font-semibold">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-red-900">
					<img class="w-full h-64 shadow-lg rounded-lg" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-300 italic font-semibold">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-red-900">
					<img class="w-full h-64 shadow-lg rounded-lg" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-300 italic font-semibold">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-red-900">
					<img class="w-full h-64 shadow-lg rounded-lg" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-300 italic font-semibold">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-red-700">
					<img class="w-full h-64 shadow-lg rounded-lg" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-300 italic font-semibold">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-red-700">
					<img class="w-full h-64 shadow-lg rounded-lg" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-300 italic font-semibold">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-red-700">
					<img class="w-full h-64 shadow-lg rounded-lg" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-300 italic font-semibold">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-red-700">
					<img class="w-full h-64 shadow-lg rounded-lg" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-300 italic font-semibold">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-cyan-600">
					<img class="w-full h-64 shadow-lg rounded-xl" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-700 italic">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-cyan-600">
					<img class="w-full h-64 shadow-lg rounded-xl" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-700 italic">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-cyan-600">
					<img class="w-full h-64 shadow-lg rounded-xl" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-700 italic">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				<div class="p-3 rounded-lg w-96 shadow-lg bg-cyan-600">
					<img class="w-full h-64 shadow-lg rounded-xl" src="{{ url('img/public/jamaahoktober.jpg') }}" alt="foto jamaah" />
					<div class="py-4 text-center text-white">
					<div class="text-xl font-serif font-thin mb-2">JAMAAH PEMBERANGKATAN</div>
					<p class="text-gray-700 italic">Oktober Platinum 2024</p>
					</div>
					<div class="mx-3 flex flex-row-reverse">
					<img src="{{ url('img/public/logo1.png') }}" alt="logo bestTrip" class="w-20 h-20" />
					</div>
				</div>
				</div>
			</div>
			</div> -->

        <footer id="footer" class="bg-sky-800 text-gray-900 py-8">
            <div class="container mx-auto px-4 md:px-0 flex flex-col md:flex-row justify-around items-start">
                <!-- Contact Information -->
                <div class="mb-6 md:w-1/3">
                    <div class="flex items-center mb-4">
                        <img src="{{ url('img/public/logo.png') }}" alt="BestTrip Logo" class="w-20 h-20 mr-2" />
                        <h4 class="text-lg font-semibold text-gray-100" style="text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5)">BEST trip travel</h4>
                    </div>
                    <div class="text-sm">
                        <div class="flex items-center mb-3">
                            <!-- <img src="{{ url('img/public/address.png') }}" alt="Address icon" class="w-5 h-5 mr-3" /> -->
                            <!-- <i class="fa-regular fa-map text-white mr-3"></i> -->
                            <i class="fa-solid fa-map-location-dot text-white mr-3"></i>
                            <p class="text-white">Jl. Boulevard Ruko Ruby No.26, Masale, Kec. Panakkukang, Kota Makassar, Sulawesi Selatan 90231</p>
                        </div>
                        <div class="flex items-center mb-3">
                            <!-- <img src="{{ url('img/public/email.png') }}" alt="Email icon" class="w-5 h-5 mr-3" /> -->
                            <i class="fa-solid fa-envelope-open-text text-white mr-3"></i>
                            <p class="text-white">bestTrip@gmail.com</p>
                        </div>
                        <div class="flex items-center">
                            <!-- <img src="{{ url('img/public/call.png') }}" alt="Phone icon" class="w-5 h-5 mr-3" /> -->
                            <i class="fa-solid fa-phone text-white mr-3"></i>
                            <p class="text-white">087885906389</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex justify-around mb-6 md:w-1/3 space-x-10">
                    <div>
                        <h4 class="text-red-100 font-semibold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5)">COMPANY</h4>
                        <ul class="space-y-1">
                            <li><a href="#home" class="text-sm text-white hover:text-red-500">Beranda</a></li>
                            <li><a href="#about" class="text-sm text-white hover:text-red-500">Tentang</a></li>
                            <li><a href="#paket" class="text-sm text-white hover:text-red-500">Paket</a></li>
                            <li><a href="#footer" class="text-sm text-white hover:text-red-500">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-red-100 font-semibold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5)">SUPPORT</h4>
                        <ul class="space-y-1">
                            <li><a href="https://wa.me/6287885906389" class="text-sm text-white hover:text-red-500">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="flex flex-col items-center md:w-1/3 space-y-4">
                    <h4 class="text-red-100 font-semibold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5)">FOLLOW US</h4>
                    <div class="flex space-x-4">
                        <div class="border border-white rounded-full p-3 flex items-center justify-center w-8 h-8 hover:bg-red-600 hover:text-white">
                            <a href="https://wa.me/6287885906389" class="fab fa-whatsapp text-white"></a>
                        </div>
                        <div class="border border-white rounded-full p-3 flex items-center justify-center w-8 h-8 hover:bg-red-600 hover:text-white">
                            <a class="fa-brands fa-instagram text-white" href="https://www.instagram.com/cbesttrip"></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
    
    @filamentScripts

    <script>
        const hamburgerIcon = document.getElementById("hamburger-icon");
        const mobileMenu = document.getElementById("mobile-menu");
        const menuLinks = document.querySelectorAll(".mobile-menu-link");

        hamburgerIcon.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        menuLinks.forEach((link) => {
            link.addEventListener("click", () => {
                mobileMenu.classList.add("hidden");
            });
        });
    </script>
</html>