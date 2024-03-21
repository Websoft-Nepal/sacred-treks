<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourBooking extends Model
{
    use HasFactory;
    protected $fillable = ['firstName','lastName','email','status','noOfAdults','noOfChildren','number','address','cost','payment','message','tour_id'];
    /**
     * Get the tourBooking that owns the TourBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }
}
