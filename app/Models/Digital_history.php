<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Digital_history extends Model
{
    use HasFactory;

    protected $table = 'digital_histories';

    // کانستنت‌ها برای وضعیت‌ها — از این‌ها در کامپوننت و blade استفاده کن
    public const STATUS_SEND = 'send';
    public const STATUS_RETURN = 'return';

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
        'accessories',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'accessories' => 'array',
        'from_date'   => 'date',
        'to_date'     => 'date',
    ];

    public function laptop(): BelongsTo
    {
        return $this->belongsTo(Digitaltool::class, 'digitaltool_id');
    }
}
