<?php

namespace App\Traits;

use App\Models\Audit;
use Illuminate\Support\Collection;

trait BfcFunction {

    public function addItemKey(Collection $items, string $prefix)
    {
        $lastIndex = 1;
        while(true){
            if(!in_array($prefix.$lastIndex, $items->keys()->toArray())){
                break;
            }  
            else $lastIndex ++;
        }
        return $prefix.$lastIndex;
    }

}