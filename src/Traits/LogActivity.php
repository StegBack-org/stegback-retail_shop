<?php

namespace Stegback\RetailShop\Traits;

use Illuminate\Database\Eloquent\Builder;
use Stegback\RetailShop\Models\StoreHistory;

trait LogActivity
{
    public static function prepareProductHistoryData($data)
    {

        return [
            'activity' => $data['text'],
            'increment' => $data['quantity'] ?? "",
        ];
    }
}
