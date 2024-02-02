<div class="container-md">
    @isset($laravel)
        <div class="bx bg-sky-50">
            <div>
                {{ $laravel }}
            </div>
        </div>
    @endisset

    @isset($livewire)
        <div class="bx bg-rose-50">
            <div>
                {{ $livewire }}
            </div>
        </div>
    @endisset

    <div class="col-span-2">
        {{ $slot }}
    </div>
</div>
