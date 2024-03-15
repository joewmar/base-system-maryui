<?php

namespace App\Traits;

use App\Models\Farm;
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
    public function feedTypeFarm(Collection $collects) : Collection
    {
        $collects = $collects->map(function (array $item, string $key) {
            if(isset($item['farm_id']) && !empty($item['farm_id'])) {
                $farm = Farm::find($item['farm_id']);
                foreach($farm->feedTypes ?? [] as $key => $feedType){
                    $item['feed_types']['ft'.$key+1]['id'] = encrypt($feedType->id);
                    $item['feed_types']['ft'.$key+1]['name'] = $feedType->feed_type_name;
                }
            }
            else unset($item['feed_types']);

            return $item;
        });
        return $collects;
    }

}