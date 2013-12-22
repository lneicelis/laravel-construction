<?php

class Layout extends Eloquent{

    protected $table = 'layouts';

    protected $fillable = array('type', 'obj_id', 'title', 'schema_image', 'svg', 'album_id');

    public function album()
    {
        return $this->belongsTo('Album');
    }

} 