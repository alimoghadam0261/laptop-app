<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Digital_history extends Model
{
    use HasFactory;

    protected $table = 'digital_histories';

    protected $fillable = [
        'digitaltool_id',
        'card_number',
        'status',
        'name_receiver',
        'phone',
        'name_project',
        'from_date',
        'to_date',
        'content',
        'status',
        'accessories',

    ];
    protected $casts = [
        'accessories' => 'array',
        'from_date'   => 'date',
        'to_date'     => 'date',
    ];
    public function laptop()
    {
        return $this->belongsTo(Digitaltool::class, 'digitaltool_id');
    }

}
