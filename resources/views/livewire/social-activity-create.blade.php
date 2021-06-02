<div>
    <div class="flex items-center justify-between mb-10">
        <div>
            {{-- <h2 class="font-semibold uppercase text-2xl">create host admin</h2> --}}
        </div>

        <div>
            <a href="{{ route("dashboard") }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Go
                Back</a>
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

                        @if(session()->has("error"))
                            <x-alert status="error" :message="session('error')"/>
                        @endif
                    </div>

                    {!! Form::open(["wire:submit.prevent" => $form_method, "method" => ""]) !!}
                    @foreach($inputs["fields"] as $input_key => $input_options)
                        <fieldset class="mb-4">
                            {!! $input_options["label"] !!}
                            {!! $input_options["input"] !!}
                            @error($input_key)
                            <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    @endforeach

                    <fieldset>
                        {!! $inputs["form_bottom_buttons"]["submit"] !!}
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
