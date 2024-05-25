<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div>
        <x-input type="text" wire:model.live="name" />

        <x-button wire:click="save">
            Save
        </x-button>
    </div>

    <p>{{ $name }}</p>
</div>
