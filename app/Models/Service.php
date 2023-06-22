<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
