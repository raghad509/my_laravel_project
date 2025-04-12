<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class educational_resources extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function tip(){
        return $this->belongsTo(Tip::class);
    }
}
