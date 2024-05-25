<div>

    @persist('player')
        <audio src="{{ asset('audio/music.mp3') }}" controls></audio>
    @endpersist

    <x-button wire:click="redirigir">
        Ir a prueba
    </x-button>

    <h1 class="text-2xl font-semibold">
        Soy el componente padre
    </h1>

    <x-input wire:model.live="name"></x-input>
    <hr class="my-5">
    <div class="">
        {{-- @livewire('children', [
            'name' => $name,
        ]) --}}
        {{-- <livewire:children wire:model="name" /> --}}

        @for ($i = 0; $i < 5; $i++)
            @livewire('contador', [], key('contador-' . $i))
        @endfor

    </div>
</div>
