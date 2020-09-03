<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDetails extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date','event_id'];
}