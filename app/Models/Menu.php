<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    //use HasUuid;
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'route_name',
        'name',
        'icon',
        'slug',
        'badge',
        'badgeClass',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    public function grandchildren()
    {
        return $this->children()->with('grandchildren');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
