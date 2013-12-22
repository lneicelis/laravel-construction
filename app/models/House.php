<?php

class House extends Eloquent{

    protected $table = 'houses';

    public function floors()
    {
        return $this->hasMany('Floor');
    }

    public function layout()
    {
        return $this->belongsTo('Layout', 'layout_id');
    }
} 