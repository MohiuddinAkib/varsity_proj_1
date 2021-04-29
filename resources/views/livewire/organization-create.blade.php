<div>
    <div class="flex items-center justify-between mb-5">
        <div>
            {{-- <h2 class="font-semibold uppercase text-2xl">create host admin</h2> --}}
        </div>

        <div>
            <a href="{{ route("dashboard") }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Go Back</a>
        </div>
    </div>

    <div class="flex">
        <div class="w-2/4 mx-auto mt-3">
            <div class="bg-white shadow-sm rounded-md">
                @isset($card_title)
                    <div class="p-2 border-b">
                        <h3 class="font-semibold uppercase text-xl">{{ $card_title }}</h3>
                    </div>
                @endisset

                <div class="p-3 px-5">
                    <div class="mb-4">
                        @if(session()->has("success"))
                            <x-alert status="success" :message="session('success')"/>
                        @endif
                    </div>

                    <form wire:submit.prevent="{{ $form_method }}">
                        @csrf

                        @foreach($inputs as $inputkey => $inputoptions)
                            <fieldset class="mb-4">
                                <x-label for="name" :value="$inputoptions['label']" :error="$errors->has($inputkey)"/>
                                <x-input
                                    autofocus
                                    :id="$inputkey"
                                    :name="$inputkey"
                                    :errors="$errors"
                                    :wire:model="$inputkey"
                                    class="block mt-1 w-full"
                                    :type="$inputoptions['type']"
                                />
                            </fieldset>
                        @endforeach

                        <fieldset>
                            <x-button type="submit">Create</x-button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
