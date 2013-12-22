<?php

class Album extends Eloquent
{

    protected $table = 'albums';

    protected $fillable = array('user_id', 'title', 'description', 'cover_photo', 'no_photos');

    /**
     * @return mixed
     */
    public function photos()
    {
        return $this->hasMany('Photo', 'album_id');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * @return mixed
     */
    public function userInfo()
    {
        return $this->belongsTo('UserInfo');
    }
} 