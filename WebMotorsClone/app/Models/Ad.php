<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'vehicle_type', 'price', 'mileage', 'year', 'license_plate_start', 'transmission', 'single_owner', 'color', 'photos', 'user_id'
    ];    
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
