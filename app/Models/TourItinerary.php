<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourItinerary extends Model
{
    use HasFactory;
    protected $fillable = ['tour_id','day','title','answer'];
    /**
     * Get the tour that owns the TourItinerary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'id');
    }
}
