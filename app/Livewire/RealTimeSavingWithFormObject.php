<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class UserForm extends Form
{
    public User $user;

    #[Validate('required')]
    public string $name;
    #[Validate('required|email')]
    public string $email;

    public function setModel(User $user)
    {
        $this->user = $user;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function saveField($name, $value)
    {
        // Remove the "form." prefix from the field name
        $name = str_replace('form.', '', $name);

        $this->user->update([
            $name => $value,
        ]);
    }
}

class RealTimeSavingWithFormObject extends Component
{
    public UserForm $form;

    public function mount()
    {
        $this->form->setModel(User::first());
    }

    public function updated($name, $value)
    {
        $this->validateOnly($name);
        $this->form->saveField($name, $value);
        $this->dispatch('notify', 'User updated successfully!');
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <x-gt-input wire:model.blur="form.name" for="form.name" label="Name" />
                <x-gt-input wire:model.blur="form.email" for="form.email" label="Email" />
            </div>
        HTML;
    }
}
