<?php

namespace App\Traits;

use App\Models\Audit;
use Illuminate\Http\Request;

trait AuditLog {

    public function addLog($action, $table, $farm_new, $farm_old)
    {
        $log_entry = [
            $action,
            $table,
            $farm_new,
            $farm_old,
        ];
        Audit::create($log_entry);
    }

}