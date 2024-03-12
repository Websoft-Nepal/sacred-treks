<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrekkingLocation extends Model
{
    use HasFactory;
    protected $fillable = ['location'];

    /**
     * Get all of the trekkings for the TrekkingLocation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trekkings(): HasMany
    {
        return $this->hasMany(Trekking::class, 'location_id', 'id');
    }
}
