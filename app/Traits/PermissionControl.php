<?php

namespace App\Traits;

use App\Models\Audit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

trait PermissionControl {
    
    public function getModules()
    {
        $arrAccessList = array(
            'requisition' => [
                "module",
            ],
            "raw_materials" => [
                "materials_storage_module",
                "materials_storage_create",
                "materials_storage_edit",
                "materials_storage_delete",
                "feed_types_formula_module",
                "feed_types_formula_create",
                "feed_types_formula_edit",
                "feed_types_formula_delete",
            ],
            'forecasting_monitoring_inventory_level' => [
                "module",
            ],
            "production_management" => [
                "module",
                "premixes ",
                "production_inventory ",
                "feed_information",
            ],
            "delivery_management" => [
                "module",
                "schedule",
            ],
            "record_management" => [
                "module",
                "feed_type_information",
                "quantity_assurance",
                "downtime",
                "farm_information",
                "farm_location",
            ],
            "reports" => [
                "module",
                "accounting_bills",
                "pivot_logs"
            ],
        );
        return $arrAccessList;
    }
    public function checkModule(array $modules)
    {
        $mods = $this->getModules();
    }
    public function strToArray(string $value)
    {
        $arr = explode(',', $value);
        foreach ($arr as $key => $value) {
            $mod = Str::before($value, '(');
            $submod = Str::between ($value, '(', ')');
            $new[$mod][] = $submod;
        }

        return $new ?? [] ;
    }

}