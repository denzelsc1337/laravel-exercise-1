<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public $incrementing = true;


    public function users(){
        return this->belongsToMany(User:class);
    }

}
