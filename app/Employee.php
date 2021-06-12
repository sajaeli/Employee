<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = ['name', 'company_id'];

    function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
