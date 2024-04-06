<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trekking extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title','status','image','slug','description','count','duration','cost','location_id'];
    /**
     * Get the location that owns the Trekking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(TrekkingLocation::class, 'location_id', 'id');
    }

    /**
     * Get all of the bookings for the Trekking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Trekking::class, 'trekking_id', 'id');
    }

    /**
     * Get the trekkingCostInclude associated with the Trekking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function trekkingCostInclude(): HasOne
    {
        return $this->hasOne(TrekkingCostInclude::class, 'trekking_id', 'id');
    }

    /**
     * Get all of the trekkingItinerary for the Trekking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trekkingItinerary(): HasMany
    {
        return $this->hasMany(TrekkingItinerary::class, 'trekking_id', 'id');
    }
}
