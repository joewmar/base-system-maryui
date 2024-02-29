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
                "name" => "Requisition",
                "sub" => array(
                    ["name" => "Weekly Order", "link" => ""],
                )
            ],
            [
                "name" =>  "Raw Materials",
                "sub" =>  array(
                    ["name" => "Micro Storage", "link" => ""],
                    ["name" => "Macro Storage", "link" => ""],
                    ["name" => "Medicine Storage", "link" => ""],
                    ["name" => "Feed Types", "link" =>route("raw-materials.feed-type-home")],
                    ["name" => "Material Inventory", "link" => ""],

                ),
            ],
            [
                "name" => "Production Management",
                "sub" => array (
                    ["name"=> "Premixes","link"=> ""],
                    ["name"=> "Production Order", "link"=> ""],
                    ["name"=> "Feed Information", "link"=> ""],
                    ["name" => "Formulation", "link" => ""],
                )
            ],
            [
                "name" => "Delivery Management",
                "sub"=> array(
                    ["name"=> "Schedule","link"=> ""],
                    ["name"=> "Gate Pass", "link"=> ""],
                    // farm location and farm information
                    ["name"=> "Farm Information", "link"=> ""],
                    ["name"=> "Farm Location", "link"=> ""],
                    ["name"=> "Accounting", "link"=> ""],
                    ["name"=> "Delivery Status", "link"=> ""],
                )
            ],
            [
                "name" => "Forecasting",
                "sub" =>  array(
                    ["name" => "Monitoring Inventory Levels", "link" => ""],
                ),
            ],
            [
                "name" => "reports",
                "sub" =>  array(
                    ["name" => "Accounting Bills", "link" => ""],
                    ["name"=> "Pivot logs", "link"=> ""],
                    ["name"=> "Audit Logs", "link"=> ""],
                ),
            ],
            // [
            //     "name" => "Records Inventory Management",
            //     "sub" =>  array(
            //         // ["name" => "Farm Information", "link" => ""],
            //         ["name" => "Farm Information", "link" => route('farm.information.home')],
            //     ),
            // ],
            // [
            //     "name" => "Forecasting",
            //     "sub" =>  array(
            //         ["name" => "Monitoring Inventory Levels", "link" => ""],
            //     ),
            // ],
            // [
            //     "name" => "Production Management",
            //     "sub" =>  array(
            //         ["name" => "Production Order", "link" => ""],
            //         ["name" => "Premixes on ASANA", "link" => ""],
            //         ["name" => "Feed Information", "link" => ""],
            //     ),
            // ],
            // [
            //     "name" => "Reports",
            //     "sub" =>  array(
            //         ["name" => "Accounting Bills", "link" => ""],
            //         // ["name" => "Accounting Bills", "link" => route('accounting.bills.home')],
            //         ["name" => "Accounting Payrolls", "link" => ""],
            //         ["name" => "Pivot Logs", "link" => ""],
            //         ["name" => "Audit Logs", "link" => ""],
            //     ),
            // ], 
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
