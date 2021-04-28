@push("styles")

@endpush

<div>
    <x-modal.modal :open="$isOpen">
        <x-modal.modal-header>
            <x-modal.modal-title>
                Create Host admin
            </x-modal.modal-title>

            <x-slot name="action">
                <x-modal.modal-header-action wire:click="toggle">
                    <i class="fas fa-times"></i>
                </x-modal.modal-header-action>
            </x-slot>
        </x-modal.modal-header>

        <x-modal.modal-content class="w-96">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

            <form method="POST" wire:submit.prevent="saveUser">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')"/>

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="name" required
                             autofocus/>
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')"/>

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model="email"
                             required/>
                </div>

                <!-- Contact Number -->
                <div class="mt-4">
                    <x-label for="contact_number" :value="__('Contact Number')"/>

                    <x-input id="contact_number" class="block mt-1 w-full"
                             type="text"
                             id="contact_number"
                             wire:model="contact_number"
                             name="contact_number" required/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')"/>

                    <x-input id="password" class="block mt-1 w-full"
                             id="password"
                             name="password"
                             type="password"
                             wire:model="password"
                             required autocomplete="new-password"/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                    <x-input
                        type="password"
                        id="password_confirmation"
                        class="block mt-1 w-full"
                        wire:model="password_confirmation"
                        name="password_confirmation" required/>
                </div>

                <x-button type="submit" class="mt-4">Submit</x-button>
            </form>
        </x-modal.modal-content>
    </x-modal.modal>
</div>

@push("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        })
    </script>
@endpush
