@props(["value", "error" => false])

@php
    $label_classes = "block font-medium text-sm text-gray-700";

    if($error) {
        $label_classes .= " text-red-400";
    }
@endphp

<label {{ $attributes->merge(["class" => $label_classes]) }}>
    {{ $value ?? $slot }}
</label>
