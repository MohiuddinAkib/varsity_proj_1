@props(["disabled" => false, "errors", "multiline" => false, "message" => ""])

@php
    $input_classes = "rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50";
    $feedback_classes = "font-bold text-sm mt-1";

    if(isset($errors) && $errors->has($attributes->get("name"))) {
        $input_classes .= " border-red-400";
        $feedback_classes .= " text-red-400";
    }
@endphp

@if($multiline)
    <textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $input_classes]) !!}></textarea>
@else
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $input_classes]) !!}>
@endif

@isset($message)
    <div class="font-bold text-sm mt-1 text-gray-300">
        {{ $message }}
    </div>
@endisset

@isset($errors)
    <div class="{{ $feedback_classes }}">
        {{ $errors->first($attributes->get("name")) }}
    </div>
@endisset

