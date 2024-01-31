@isset($laravel)
    <div {{ $attributes->class("fg1 bx bg-sky-50 self-start") }}>
        {{ $laravel }}
    </div>
@endisset

@isset($livewire)
    <div {{ $attributes->class("fg1 bx bg-rose-50 self-start") }}>
        {{ $livewire }}
    </div>
@endisset


