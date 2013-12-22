<?php

class Floor extends Eloquent{

    protected $table = 'floors';

    public function apartments()
    {
        return $this->hasMany('Apartment');
    }

    public function house()
    {
        return $this->belongsTo('House');
    }
    public function layout()
    {
        return $this->belongsTo('Layout', 'layout_id');
    }

} 