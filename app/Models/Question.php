<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    protected $fillable = ['title', 'questioncategory_id'];

    public function questioncategory()
    {
        return $this->belongsTo('App\Models\Questioncategory');
    }

    public function option()
    {
        return $this->hasOne('App\Models\Option');
    }

}
