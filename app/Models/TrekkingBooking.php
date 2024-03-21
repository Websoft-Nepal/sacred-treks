<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrekkingBooking extends Model
{
    use HasFactory;
    protected $fillable = ['firstName','lastName','email','status','noOfAdults','noOfChildren','number','address', 'cost','payment','message','trekking_id'];
    /**
     * Get the trekkingBooking that owns the TrekkingBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trekking(): BelongsTo
    {
        return $this->belongsTo(Trekking::class, 'trekking_id', 'id');
    }
}
