<div {{ $attributes->class(["flex justify-between" => isset($action)])->merge(["class" => "p-3"])  }}>
    {{ $slot  }}

    @isset($action)
        {{ $action  }}
    @endisset
</div>
