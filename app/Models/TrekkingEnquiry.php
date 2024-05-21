<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrekkingEnquiry extends Model
{
    use HasFactory;
    protected $fillable = ['tripPackage','name','email','phoneNumber','startDate','endDate','travellersNo'];
}
