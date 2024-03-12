<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourTransportation extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    /**
     * Get all of the Tours for the TourTransportation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'transportation_id', 'id');
    }
}
