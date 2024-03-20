<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrekkingCostInclude extends Model
{
    use HasFactory;
    protected $fillable = ['trekking_id','description'];

    /**
     * Get the trekking that owns the TrekkingCostInclude
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trekking(): BelongsTo
    {
        return $this->belongsTo(Trekking::class, 'trekking_id', 'id');
    }
}
