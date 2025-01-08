<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validity extends Model
{
    use HasFactory;

    protected $table = 'validity';
    protected $fillable = ['status'];
}
