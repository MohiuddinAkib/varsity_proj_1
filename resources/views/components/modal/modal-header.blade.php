<x-card.card-header class="p-4 pb-0" {{ $attributes }}>
    {{ $slot  }}

    @isset($action)
        <x-slot name="action">
            {{ $action  }}
        </x-slot>
    @endisset
</x-card.card-header>
