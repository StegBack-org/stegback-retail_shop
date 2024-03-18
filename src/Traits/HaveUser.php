<?php

namespace Stegback\RetailShop\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HaveUser
{
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->user_id = auth()->id();
        });

        self::addGlobalScope(function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }
}
