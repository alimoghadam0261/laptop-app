<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_tools extends Model
{
    use HasFactory;
    protected $fillable = [
        'description','name',
        ];


    public function tools()
    {
        return $this->hasMany(Tools::class, 'category_id');
    }
}

