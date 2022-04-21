<?php

namespace App\Models\RealEstate;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    use HasStatus;

    protected $table = 'r_e_facilities';

    protected $fillable = [
        'name',
        'icon',
        'distance',
        'status',
    ];
}
