<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\BlogPage;
use App\Models\Gallery;
use App\Models\HomePage;
use App\Models\Tour;
use App\Models\Trekking;
use App\Models\TourPage;
use App\Models\TrekkingPage;
use Illuminate\Http\Request;

class PagesController extends BaseController
{
    public function home(){
        try {
            $home = HomePage::first();
            $tourPopular = Tour::orderByDesc('count')->limit(6)->get();
            $trekkingPopular = Trekking::orderByDesc('count')->limit(6)->get();
            $data = [
                'home' => $home,
                'tourPopular' => $tourPopular,
                'trekkingPopular' => $trekkingPopular,
            ];
            return $this->SendResponse($data,"home fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th,"Cannot fetch home data.",500);
        }
    }
    public function tour(){
        try {
            $tour = TourPage::first();
            return $this->SendResponse($tour,"tour fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th,"Cannot fetch tour data.",500);
        }
    }
    public function trekking(){
        try {
            $trekking = TrekkingPage::first();
            return $this->SendResponse($trekking,"Blogs fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th,"Cannot fetch trekking data.",500);
        }
    }
    public function gallery(){
        try {
            $galleryfirst = Gallery::take(4)->get();
            $excludeIds = array();
            $i = 0;
            foreach($galleryfirst as $g){
                $excludeIds[$i++] = $g->id;
            }
            $gallerysecond = Gallery::whereNotIn('id',$excludeIds)->take(4)->get();
            if(count($gallerysecond)<1){
                $gallerysecond = Gallery::take(4)->get();
            }
            $data = [
                'galleryfirst' => $galleryfirst,
                'gallerysecond' => $gallerysecond,
            ];
            return $this->SendResponse($data,"gallery fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th,"Cannot fetch gallery data.",500);
        }
    }
    public function blog(){
        try {
            $blog = BlogPage::first();
            return $this->SendResponse($blog,"blog fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th,"Cannot fetch blog data.",500);
        }
    }
}
