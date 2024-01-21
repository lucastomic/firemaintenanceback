<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
        'datetime',
        'user_id',
        'equipment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

}
