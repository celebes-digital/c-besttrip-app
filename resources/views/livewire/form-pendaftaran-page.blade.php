{{-- <x-filament::page> --}}
<div class="max-w-7xl flex flex-col mx-auto my-4 px-4 md:my-8 gap-y-4">
    <div class="w-full h-24 bg-gradient-to-br from-red-900 via-red-700 to-red-600 rounded-xl flex justify-center items-center">
        <h1 class="text-lg lg:text-2xl text-white text-center font-semibold">Form Pendaftaran - Bestrip</h1>
    </div>
    <form wire:submit="create">
        {{ $this->form }}
    </form>
</div>
{{-- </x-filament::page> --}}