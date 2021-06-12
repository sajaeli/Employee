<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable=['name','description'];
    function employees(){
        return $this->hasMany(Employee::class,'company_id');
    }
}
