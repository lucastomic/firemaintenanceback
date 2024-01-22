<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type', 'id', 'photo'
    ]; 

    public function maintenances(){
        return $this->hasMany(Maintenance::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
    public function statuses(){
        return $this->hasMany(Status::class);
    }

    public function latestStatus()
    {
        return $this->statuses()->orderBy('datetime', 'desc')->first();
    }

}
