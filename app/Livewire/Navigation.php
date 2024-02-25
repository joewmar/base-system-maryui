<?php

namespace App\Livewire;

use Livewire\Component;

class Navigation extends Component
{
	public $home;

    public function render()
    {
        return view('livewire.navigation');
    }


    public function home()
    {
    	$this->dispatchBrowserEvent('home-clicked', [
    		'title' => 'Home',
    		'icon' => 'success',
    		'text' => 'Home',
    	]);
    }
}