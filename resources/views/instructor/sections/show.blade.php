<div class="md:flex items-center">
    <h1 class="md:flex-1 truncate handle cursor-move">
        Sección {{ $loop->iteration }}:
        <br class="md:hidden">
        <span class="font-semibold">
            {{ $section->name }}
        </span>
    </h1>

    <div class="space-x-3 md:shrink-0 md:ml-4">
        <button wire:click="edit({{ $section->id }})">
            <i class="fas fa-edit hover:text-indigo-600"></i>
        </button>
        <button x-on:click="destroySection({{ $section->id }})">
            <i class="far fa-trash-alt hover:text-red-600"></i>
        </button>
    </div>
</div>