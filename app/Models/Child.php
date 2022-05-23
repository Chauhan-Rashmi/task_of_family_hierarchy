<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $table = 'childs';
    protected $fillable = [
        'name','father_name','mother_name','date_of_birth',
    ];

    protected $casts = [
        'created_at' =>  'datetime:Y-m-d H:00',
        'updated_at' =>  'datetime:Y-m-d H:00',
    ];

    public function parents(){
        return $this->belongsTo(Parents::class,"parent_id");
    }
}
