<?php

class Apartment extends Eloquent{

    protected $table = 'apartments';

    public function floor()
    {
        return $this->belongsTo('Floor', 'floor_id');
    }

    public function layout()
    {
        return $this->belongsTo('Layout', 'layout_id');
    }

    public function scopeVacant($query, $floor_id)
    {
        return $query->where('floor_id', '=', $floor_id)->where('status', '=', '0')->get();
    }
} 