<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class ActivitylogHome extends Component
{

    public $users;
    public $headers;
    public function mount()
    {
        $this->users = collect([
            [ 'name' => 'John Doe', 'username' =>'johndoe' , 'email' => 'johndoe@me.com'],
            [ 'name' => 'Jane Doe', 'username' => 'jsnerd', 'email' => 'jsnerd@me.com'],
            [ 'name' => 'Joe Doe', 'username' => 'joed', 'email' => 'joed@me.com'],
            [ 'name' => 'Jill Doe', 'username' => 'jilld', 'email' => 'jilld@me.com'],
        ]);

        $this->headers = [
            ['key' => 'name', 'label' => 'Name'  ],
            ['key' => 'username', 'label' => 'username' ],
            ['key' => 'email', 'label' => 'email'  ],
        ];
    }
    public function render()
    {
        return view('livewire.settings.activitylog-home');
    }
}
