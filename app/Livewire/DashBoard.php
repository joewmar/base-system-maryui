<?php

namespace App\Livewire;

use Livewire\Component;


class DashBoard extends Component
{

    public array $Toonageperday = [
        'type' => 'bar',
        'data' => [
            'labels' => ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'],
            'datasets' => [
                [
                    'label' => 'Tons Produced',
                ],
                [   
                    'type' => 'line',
                    'label' =>'Product Target (TONS)',
                ]   
            ],
        ]
    ];
    
     

    public array $TonsProduceOverTarget = [
        'type' => 'bar',
        'data' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => 'Tons Produced',
                ],
                [   
                    'type' => 'line',
                    'label' =>'Product Target (TONS)',
                ]   
            ]
        ]
    ];

    public array $TonsPerHour = [
        'type' => 'bar',
        'data' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => 'Tons Per Hour',
                ],
                [   
                    'type' => 'line',
                    'label' =>'Target Tons Per Hour',
                ]   
            ]
        ]
    ];

    public array $kwHPerKilos = [
        'type' => 'line',
        'data' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => '2021',
                ],
                [   
                    'type' => 'line',
                    'label' =>'2022',
                ],
                [   
                    'type' => 'line',
                    'label' =>'2023',
                ]    
            ]
        ]
    ];

    public array $ManHourPerKilos = [
        'type' => 'line',
        'data' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => '2021',
                ],
                [   
                    'type' => 'line',
                    'label' =>'2022',
                ],
                [   
                    'type' => 'line',
                    'label' =>'2023',
                ],    
            ]
        ]
    ];

    public array $OTCostPerKilos = [
        'type' => 'line',
        'data' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => '2021',
                ],
                [   
                    'type' => 'line',
                    'label' =>'2022',
                ],
                [   
                    'type' => 'line',
                    'label' =>'2023',
                ]    
            ]
        ]
    ];

    public array $ElectricCost = [
        'type' => 'bar',
        'data' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'datasets' => [
                [
                    'label' => 'Electric Cost',
                ]
            ]
        ]
    ];

    public function render()
    {
        return view('livewire.dash-board');
    }
     
}
