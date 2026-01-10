<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name','email','phone','document_number','address','city','state','country','zip'
    ];
}
