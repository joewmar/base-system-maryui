<?php

namespace App\Livewire\DeliveryManagement;

use Livewire\Component;

class ScheduleHome extends Component
{
    public $events;

    public function mount()
    {
        $this->events = [
            [
                'label' => 'Day off',
                'description' => 'Playing <u>tennis.</u>',
                'css' => '!bg-amber-200',
                'date' => now()->startOfMonth()->addDays(3),
            ],
            [
                'label' => 'Health',
                'description' => 'I am sick',
                'css' => '!bg-green-200',
                'date' => now()->startOfMonth()->addDays(8),
            ],
            [
                'label' => 'Laracon',
                'description' => 'Let`s go!',
                'css' => '!bg-blue-200',
                'range' => [
                    now()->startOfMonth()->addDays(13),
                    now()->startOfMonth()->addDays(15)
                ]
            ],
        ];
    }
    public function render()
    {
        return view('livewire.delivery-management.schedule-home');
    }
}
