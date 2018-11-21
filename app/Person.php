<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "persons";
    protected $fillable = ['document', 'documentType', 'firstName', 'lastName', 'company', 'emailAddres', 'addres', 'city', 'province', 'country', 'phone', 'mobile'];

    public function dType(){
        return $this->belongsTo("App\DocumentType");
    }
}
