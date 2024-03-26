<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;
    protected $fillable = ['heading','subheading','headimg1','headimg2','bookimg','gallery_title','trekking_title',             'trekking_slogan','tour_title','tour_slogan','feature_title','footer'];
}
