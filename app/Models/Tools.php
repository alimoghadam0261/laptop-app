<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tools extends Model
{
    use HasFactory;
    protected $fillable = [
        'content','name','category_id','serial_jam','size'
        ,'model','color','user_id'
    ];



    public function category()
    {
        return $this->belongsTo(Category_tools::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function histories()
    {
        return $this->hasMany(\App\Models\tools_history::class, 'tools_id');
    }

}
