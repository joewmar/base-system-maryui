<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * The component's list of items.
     *
     * @var array
     */
    public $list;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->list = [
            [
                "name" => "Dashboard",
                "link" => "",
            ],
            [
                "name" =>  "Formulation Storage",
                "sub" =>  array(
                    ["name" => "Micro Storage", "link" => ""],
                    ["name" => "Macro Storage", "link" => ""],
                    ["name" => "Medicine Storage", "link" => ""],
                    ["name" => "Formulation", "link" => ""],
                ),
            ],
            [
                "name" => "Records Inventory Management",
                "sub" =>  array(
                    ["name" => "Weekly Request", "link" => ""],
                    // ["name" => "Farm Information", "link" => ""],
                    ["name" => "Farm Information", "link" => route('farm.information.home')],
                ),
            ],
            [
                "name" => "Forecasting",
                "sub" =>  array(
                    ["name" => "Monitoring Inventory Levels", "link" => ""],
                ),
            ],
            [
                "name" => "Production Management",
                "sub" =>  array(
                    ["name" => "Production Order", "link" => ""],
                    ["name" => "Premixes on ASANA", "link" => ""],
                    ["name" => "Feed Information", "link" => ""],
                ),
            ],
            [
                "name" => "Reports",
                "sub" =>  array(
                    ["name" => "Accounting Bills", "link" => ""],
                    // ["name" => "Accounting Bills", "link" => route('accounting.bills.home')],
                    ["name" => "Accounting Payrolls", "link" => ""],
                    ["name" => "Pivot Logs", "link" => ""],
                    ["name" => "Audit Logs", "link" => ""],
                ),
            ], 
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
