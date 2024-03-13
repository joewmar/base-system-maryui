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
                "link" => "/",
            ],
            [
                "name" => "Requisition",
                "sub" => array(
                    ["name" => "Weekly Order", "link" =>route("requisition.weekly-requisition-home")],
                    ["name" => "Create Daily Inventory", "link" =>route("requisition.daily-inventory-create")],
                )
            ],
            [
                "name" =>  "Raw Materials",
                "sub" =>  array(
                    ["name" => "Ingredients Storage", "link" =>route("raw-materials.ingredients-storage.home")],
                    ["name" => "Materials Storage", "link" =>route("raw-materials.material-storage-home")],


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
                "sub" => array (
                    ["name"=> "Premixes","link"=> ""],
                    ["name"=> "Production Order", "link"=>route("production-management.production-order-home")],
                    ["name"=> "Feed Information", "link"=> ""],
                )
            ],
            [
                "name" => "Delivery Management",
                "sub"=> array(
                    ["name"=> "Schedule","link"=> route('delivery-management.schedule-home')],
                    ["name"=> "Gate Pass", "link"=> ""],
                )
            ],
            [
                "name" => "Record Management",
                "sub"=> array(
                    ["name"=> "Feed Type Information","link"=>route("record-management.feed-type-home")],
                    ["name"=> "Quality Assurance", "link"=>route('record-management.quality-assurance-home')],
                    ["name"=> "DownTime", "link"=>route('record-management.downtime-home')],
                    // farm location and farm information
                    ["name"=> "Farm Information", "link"=>route('farm.information.farm')],
                    ["name"=> "Farm Location", "link"=>route('farm.information.location')],
                )
            ],

            [
                "name" => "Reports",
                "sub" =>  array(
                    ["name" => "Accounting Bills", "link" =>route("reports.electric-cost.home")],
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
