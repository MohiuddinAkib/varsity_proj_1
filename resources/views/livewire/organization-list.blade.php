<div>
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="font-semibold uppercase text-2xl">{{ $page_title }}</h2>
        </div>

        <div>
{{--            <a href="{{ route("dashboard") }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Go Back</a>--}}
        </div>
    </div>

    <div>
        <livewire:organization-list-table />
    </div>
</div>
