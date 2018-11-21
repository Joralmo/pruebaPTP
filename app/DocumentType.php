<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = "documentTypes";
    protected $fillable = ['description'];

    public function persons(){
        return $this->hasMany("App\Person");
    }
}
