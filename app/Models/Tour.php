<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = ['title','status','image','place','slug','description','duration','cost','boundary','maps','transportation_id'];

    public function transportation(): BelongsTo
    {
        return $this->belongsTo(TourTransportation::class, 'transportation_id', 'id');
    }
}
