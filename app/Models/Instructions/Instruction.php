<?php

namespace App\Models\Instructions;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    protected $fillable = [
    	'name',
	    'content'
    ];
}
