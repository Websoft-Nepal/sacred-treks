<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = ['title','status','image','place','slug','description','duration','cost','boundary','maps','transportation_id'];

    public function transportation(): BelongsTo
    {
        return $this->belongsTo(TourTransportation::class, 'transportation_id', 'id');
    }

    /**
     * Get all of the bookings for the Tour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(TourBooking::class, 'tour_id', 'id');
    }
}
