<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $table = "parents";

    protected $fillable = [
        'father_name','mother_name','mobile_number',
    ];

    protected $casts = [
        'created_at' =>  'datetime:Y-m-d H:00',
        'updated_at' =>  'datetime:Y-m-d H:00',
    ];

    public function child(){ 
        return $this->hasMany(Child::class,"parent_id");
    }
}
