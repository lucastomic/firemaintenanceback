<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'status', 'datetime', 'id', 'status'
    ]; 

    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}
