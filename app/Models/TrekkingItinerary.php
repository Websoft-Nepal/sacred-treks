<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrekkingItinerary extends Model
{
    use HasFactory;
    protected $fillable = ['trekking_id','day','title','answer'];

    /**
     * Get the trekking that owns the TrekkingItinerary
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trekking(): BelongsTo
    {
        return $this->belongsTo(Trekking::class, 'trekking_id', 'id');
    }
}
