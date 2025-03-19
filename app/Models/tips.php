<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tips extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function educational_resources(){
        return $this->hasMany(EducationalResource::class);
    }
}
