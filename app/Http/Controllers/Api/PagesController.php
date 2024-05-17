<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\BlogPage;
use App\Models\Gallery;
use App\Models\HomePage;
use App\Models\MainGallery;
use App\Models\Owner;
use App\Models\Tour;
use App\Models\Trekking;
use App\Models\TourPage;
use App\Models\TrekkingLocation;
use App\Models\TrekkingPage;
use Illuminate\Http\Request;

class PagesController extends BaseController
{
    public function home()
    {
        try {
            // For home page
            $home = HomePage::first();
            $home['headimg1'] = $this->HttpImage('headimg1',$home);
            $home['headimg1'] = $this->HttpImage('headimg1',$home);
            $home['bookimg'] = $this->HttpImage('bookimg',$home);

            // For owner or CEO
            $owner = Owner::first();
            $owner['image'] = config('app.url') . "/" . $owner['image'];

            //For Tour Popular
            $tourPopular = collect();
            $places = Tour::select('place')->orderByDesc('count')->distinct()->limit(8)->get();
            // $tour_ids = Tour::select('place')->orderByDesc('count')->distinct()->limit(8)->pluck('id');
            $tourCount = Tour::select('place')->orderByDesc('count')->distinct()->limit(8)->count();

            foreach ($places as $place) {
                $tour = Tour::where('place', $place->place)->with('transportation')->orderByDesc('count')->first();
                $tour['image'] = $this->HttpImage('image',$tour);
                $tour['featureimg1'] = $this->HttpImage('featureimg1',$tour);
                $tour['featureimg2'] = $this->HttpImage('featureimg2',$tour);
                $tour['map'] = $this->HttpImage('map',$tour);

                if ($tour) {
                    $tourPopular->push($tour); // Push each tour object onto the collection
                }
            }


            // For popular trekking
            $trekkingPopular = collect();
            $locations = Trekking::select('location_id')->orderByDesc('count')->distinct()->limit(8)->get();
            // $trekking_ids = Trekking::select('location_id')->orderByDesc('count')->distinct()->limit(8)->pluck('id');
            $trekkingCount = Trekking::select('location_id')->orderByDesc('count')->distinct()->limit(8)->count();

            foreach ($locations as $trek) {
                $trek = Trekking::where('location_id', $trek->location_id)->orderByDesc('count')->first();

                // $trek['boundary'] = $trek->location_id->location;
                $location = TrekkingLocation::findOrFail($trek->location_id);
                $trek['boundary'] = $location->location;

                $trek['image'] = $this->HttpImage('image',$trek);
                $trek['featureimg1'] = $this->HttpImage('featureimg1',$trek);
                $trek['featureimg2'] = $this->HttpImage('featureimg2',$trek);
                $trek['map'] = $this->HttpImage('map',$trek);

                if ($trek) {
                    $trekkingPopular->push($trek); // Push each tour object onto the collection
                }
            }


            // data to send
            $data = [
                'home' => $home,
                'tourPopular' => $tourPopular,
                'trekkingPopular' => $trekkingPopular,
                'owner' => $owner,
            ];
            return $this->SendResponse($data, "home fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch home data.", 500);
        }
    }
    public function tour()
    {
        try {
            $tour = TourPage::first();
            return $this->SendResponse($tour, "tour fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch tour data.", 500);
        }
    }
    public function trekking()
    {
        try {
            $trekking = TrekkingPage::first();
            return $this->SendResponse($trekking, "Blogs fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch trekking data.", 500);
        }
    }
    public function gallery()
    {
        try {
            $galleryfirst = Gallery::take(4)->get();
            $excludeIds = array();
            $i = 0;
            foreach ($galleryfirst as $g) {
                $g['image'] = $this->HttpImage('image',$g);
                $excludeIds[$i++] = $g->id;
            }
            $gallerysecond = Gallery::whereNotIn('id', $excludeIds)->take(4)->get();
            if (count($gallerysecond) < 1) {
                $gallerysecond = Gallery::take(4)->get();
                foreach ($gallerysecond as $sec) {
                    $sec['image'] = $this->HttpImage('image',$sec);
                }
            }
            $data = [
                'galleryfirst' => $galleryfirst,
                'gallerysecond' => $gallerysecond,
            ];
            return $this->SendResponse($data, "gallery fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch gallery data.", 500);
        }
    }

    public function blog()
    {
        try {
            $blog = BlogPage::first();
            return $this->SendResponse($blog, "blog fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch blog data.", 500);
        }
    }

    private function HttpImage($name, $arr){
        if ($arr[$name] != null) {
            if (substr_count($arr[$name], 'http') < 1) {
                return config('app.url') . "/" . $arr[$name];
            }else{
                return $arr[$name];
            }
        }else{
            return null;
        }
    }
}
