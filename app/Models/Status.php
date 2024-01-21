<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'status', 'datetime', 'id'
    ]; 

    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}
