<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tools_history extends Model
{
    use HasFactory;

    protected $fillable = [
        'tools_id',
        'card_number',
        'status',
        'name_receiver',
        'phone',
        'name_project',
        'from_date',
        'to_date',
        'content',
        'status',

    ];

    public function tool()
    {
        return $this->belongsTo(Tools::class, 'tools_id');
    }
}
