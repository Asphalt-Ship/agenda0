<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // on demande au manager de laisser passer ces données
    protected $fillable = ["first_name", "last_name", "age", "email", "tel"];

    // protected $guarded = [];
        // cette méthode laisse passer toute donnée
        //  mais on préfère préciser abec $fillable
}
