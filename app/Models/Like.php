<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    // add "SoftDeletes" trait to enable soft deleting
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id'];
}
