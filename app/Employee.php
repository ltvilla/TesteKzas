<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'CPF',
        'company_id'
    ];

    public function addresse()
    {
        return $this->hasOne(Address::class, 'employee_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
