<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trekking extends Model
{
    use HasFactory;
    protected $fillable = ['title','status','image','slug','description','duration','cost','location_id'];
    /**
     * Get the location that owns the Trekking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(TrekkingLocation::class, 'location_id', 'id');
    }
}
