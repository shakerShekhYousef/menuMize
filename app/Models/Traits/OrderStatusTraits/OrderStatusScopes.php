<?php

namespace App\Models\Traits\OrderStatusTraits;

trait OrderStatusScopes
{
    public function scopeStatus($query, $lang, $name)
    {
        $query->where([
            ['lang', $lang],
            ['name', 'like', '%'.$name.'%'],
        ]);
    }
}
