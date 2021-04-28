<div x-data="{open: {{ json_encode($open)  }}}" x-cloak>
    <div
        x-show="open"
        {{ $attributes->merge(["class" => "fixed w-full h-full"]) }}
    >
        <x-backdrop class="flex justify-center items-center">
            <x-card.card
                 class="inline-block rounded-md"
                 x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-90"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-90"
            >
                {{ $slot  }}
            </x-card.card>
        </x-backdrop>
    </div>
</div>
