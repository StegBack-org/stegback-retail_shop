<?php

namespace Stegback\RetailShop\Models;

use Illuminate\Database\Eloquent\Model;
use Stegback\RetailShop\Models\StoreOrder;
use Stegback\RetailShop\Traits\LogActivity;
use Stegback\RetailShop\Models\StoreProduct;
use Stegback\RetailShop\Helpers\CommonHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stegback\RetailShop\Traits\HaveUser;

class StoreHistory extends Model
{
    use LogActivity;
    use HasFactory;
    use HaveUser;

    protected $guarded = [];
    protected $casts = [
        'data' => 'array'
    ];
    public function module()
    {
        $relation = null;
        $history_type = CommonHelper::HistoryType();
        switch ($this->type) {
            case $history_type['store_order']:
                $relation = $this->belongsTo(StoreOrder::class, 'module_id');
                break;
            case $history_type['store_product']:
                $relation = $this->belongsTo(StoreProduct::class, 'module_id');
                break;
        }

        return $relation;
    }

    public  static function saveHistory($user_id, $module_id, $type, $data = [])
    {

        $history_type = CommonHelper::HistoryType();
        switch ($type) {
            case $history_type['store_product']:
                $data = Self::prepareProductHistoryData($data);
                break;
        }
        StoreHistory::create([
            'user_id' => $user_id,
            'module_id' => $module_id,
            'type' => $type,
            'data' => $data,
        ]);
    }
}
