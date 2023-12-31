<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id',];

    public function parent()
    {
        return $this->hasOne(Type::class, 'id', 'parent_id');
    }
}
