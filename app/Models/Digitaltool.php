<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Digitaltool extends Model
{
    use HasFactory;

    // فیلدهایی که اجازه پر شدن دارند
    protected $fillable = [
        'name',
        'brand',
        'serial_it',
        'serial_jam',
       'cpu',
        'ram',
        'content',
        'accessories',
    ];
    protected $casts = [
        'accessories' => 'array',
    ];
    public function histories()
    {
        return $this->hasMany(Digital_history::class, 'digitaltool_id');
    }

    public function latestHistory()
    {
        return $this->hasOne(Digital_history::class, 'digitaltool_id')->latestOfMany();
    }

    // تاریخچه فعال (مثلاً لپتاپ دست کسیه و تاریخ برگشت null هست)
    public function activeHistory()
    {
        return $this->hasOne(Digital_history::class, 'digitaltool_id')->whereNull('to_date');
    }
    public function hasActiveSend(): bool
    {
        return $this->histories()
            ->where('status', \App\Models\Digital_history::STATUS_SEND)
            ->whereNull('to_date')
            ->exists();
    }

}
