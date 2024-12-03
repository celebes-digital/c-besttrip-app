
<main class="max-w-7xl flex flex-col mx-auto my-2 md:my-4 px-4 gap-y-4">
    <div class="w-full h-24 bg-gradient-to-br from-rose-700 to-rose-500 rounded-xl flex justify-center border items-center">
        <h1 class="text-lg lg:text-2xl text-white text-center font-semibold">Form Pendaftaran - Bestrip</h1>
    </div>
    <form wire:submit="create">
        {{ $this->form }}

        <x-filament::button
            type="submit"
            form="create"
            size="xl"
            icon="heroicon-m-sparkles"
            tooltip="Pastikan data yang Anda masukkan sudah benar"
            class="w-full bg-gradient-to-br from-rose-700 to-rose-500 text-white font-semibold my-8"
        >
            Kirim Data
        </x-filament::button>
    </form>
    @livewire('notifications')
</main>
