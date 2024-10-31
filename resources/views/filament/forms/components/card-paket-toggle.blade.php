<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field">
    <div class="grid md:grid-col-2 lg:grid-cols-3 gap-4 w-full my-4">
        @foreach(\App\Models\Paket::whereBetween('tgl_paket', [$this->data['from_date'], $this->data['to_date']])->get()->toArray() as $item)
        <div class="w-full space-y-2 border p-4 rounded-2xl {{$this->data['paket_id'] === $item['id'] ? 'border-teal-400 bg-teal-100/20' : 'border-zinc-200'}}">
            <div class="w-full aspect-video bg-slate-200 rounded-xl"></div>
            <div class="space-y-2">
                <h1 class="font-semibold text-lg">Paket {{ $item['nama_paket'] }}</h1>
                <p class="bg-teal-400/25 w-fit h-fit border border-teal-50 rounded-md px-2 py-1 font-medium text-teal-700">{{$item['tgl_paket']}}</p>
                <p class="line-clamp-2 text-base font-light">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint vel aliquid, culpa nam provident qui eveniet cumque rerum? Quam sint totam eaque explicabo recusandae praesentium pariatur dolores animi commodi sunt.</p>
                <div class="py-2">
                    <span class="text-teal-500 font-semibold text-xl !py-12">Rp{{$item['harga']}}</span>
                </div>
            </div>
            <button wire:click="set('data.paket_id', {{ $item['id'] }})" class="bg-teal-600 hover:bg-teal-500 transition-all ease-in-out rounded-lg text-white w-full p-2">{{$this->data['paket_id'] === $item['id'] ? 'Terpilih' : 'Pilih Paket'}}</button>
        </div>
        @endforeach
    </div>
</x-dynamic-component>