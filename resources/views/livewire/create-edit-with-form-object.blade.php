<form wire:submit="save">
    <x-gt-input wire:model="form.title" for="form.title" label="course title" />
    <div class="tar">
        <x-gt-button wire:click="save" class="primary" text="Save"/>
    </div>
</form>
