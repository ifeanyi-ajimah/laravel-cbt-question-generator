<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['question_id', 'option_a', 'option_b', 'option_c','option_d'];
    
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

}
