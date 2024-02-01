<div class="grid cols-2 fg1">
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

    <div class="col-span-2">
        {{ $slot }}
    </div>
</div>
