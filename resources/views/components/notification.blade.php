<div x-data="{ open: false, message: '' }" x-cloak
    x-init="
        open = {{ json_encode(session()->has('notification')) }};
        message = '{{ session('notification') }}';
        setTimeout(() => { open = false }, 4000);
    "
    x-show="open">

    <div class="bx pxy-1 flex va-c my">
        <svg class="icon txt-green">
            <use xlink:href="/svg/naykel-ui.svg#check-circle"></use>
        </svg>

        <div x-text="message" class="ml-075"></div>

        <button class="ml-auto close">
            <svg class="icon" @click="open = false">
                <use xlink:href="/svg/naykel-ui.svg#x-mark"></use>
            </svg>
        </button>
    </div>
</div>

@push('head')
    <script src="//unpkg.com/alpinejs" defer></script>
@endpush
