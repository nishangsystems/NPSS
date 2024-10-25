<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;
     protected $fillable = ['name', 'address', 'contact', 'motto'];
     protected $dates = ['created_at', 'updated_at'];
}
