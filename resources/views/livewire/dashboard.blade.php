<div class="min-h-full">
    @role("super_admin")
    <livewire:host-admin-creation-modal :open="$openUserCreateModal"/>
    <x-button wire:click="toggleUserCreationModal">Create User</x-button>
    @endrole
</div>

