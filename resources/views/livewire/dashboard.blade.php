<div class="min-h-full">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="font-semibold uppercase text-2xl">{{ $page_title }}</h2>
        </div>
        @role("super_admin")
            <div>
                <a href="{{ route("host_admin.create") }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Create Host Admin</a>
            </div>
        @endrole

        @role("host_admin")
            <div>
                <a href="{{ route("organiztion.create") }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Create Organization</a>
            </div>
        @endrole
    </div>

    <div class="">
        @role("host_admin")
            <x-organization-table />
        @endrole

        @role("super_admin")
            <x-host-admin-table/>
        @endrole
    </div>
</div>

