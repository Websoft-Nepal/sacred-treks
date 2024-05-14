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
            if ($home['headimg1'] != null) {
                if (substr_count($home['headimg1'], 'http') < 1) {
                    $home['headimg1'] = config('app.url') . "/" . $home['headimg1'];
                }
            }
            if ($home['headimg2'] != null) {
                if (substr_count($home['headimg2'], 'http') < 1) {
                    $home['headimg2'] = config('app.url') . "/" . $home['headimg2'];
                }
            }
            if ($home['bookimg'] != null) {
                if (substr_count($home['bookimg'], 'http') < 1) {
                    $home['bookimg'] = config('app.url') . "/" . $home['bookimg'];
                }
            }

            // For owner or CEO
            $owner = Owner::first();
            $owner['image'] = config('app.url') . "/" . $owner['image'];

            //For Tour Popular
            $tourPopular = collect();
            $places = Tour::select('place')->orderByDesc('count')->distinct()->limit(6)->get();
            foreach ($places as $place) {
                $tour = Tour::where('place', $place->place)->with('transportation')->orderByDesc('count')->first();
                if ($tour['image'] != null) {
                    if (substr_count($tour['image'], 'http') < 1) {
                        $tour['image'] = config('app.url') . "/" . $tour['image'];
                    }
                }
                if ($tour['featureimg1'] != null) {
                    if (substr_count($tour['featureimg1'], 'http') < 1) {
                        $tour['featureimg1'] = config('app.url') . "/" . $tour['featureimg1'];
                    }
                }
                if ($tour['featureimg2'] != null) {
                    if (substr_count($tour['featureimg2'], 'http') < 1) {
                        $tour['featureimg2'] = config('app.url') . "/" . $tour['featureimg2'];
                    }
                }
                if ($tour['map'] != null) {
                    if (substr_count($tour['map'], 'http') < 1) {
                        $tour['map'] = config('app.url') . "/" . $tour['map'];
                    }
                }
                if ($tour) {
                    $tourPopular->push($tour); // Push each tour object onto the collection
                }
            }

            // For popular trekking
            $trekkingPopular = collect();
            $locations = Trekking::select('location_id')->orderByDesc('count')->distinct()->limit(6)->get();
            // $trekkingPopular = Trekking::orderByDesc('count')->limit(6)->get();

            foreach ($locations as $trek) {
                $trek = Trekking::where('location_id', $trek->location_id)->orderByDesc('count')->first();

                // $trek['boundary'] = $trek->location_id->location;
                $location = TrekkingLocation::findOrFail($trek->location_id);
                $trek['boundary'] = $location->location;

                if ($trek['image'] != null) {
                    if (substr_count($trek['image'], 'http') < 1) {
                        $trek['image'] = config('app.url') . "/" . $trek['image'];
                    }
                }
                if ($trek['featureimg1'] != null) {
                    if (substr_count($trek['featureimg1'], 'http') < 1) {
                        $trek['featureimg1'] = config('app.url') . "/" . $trek['featureimg1'];
                    }
                }
                if ($trek['featureimg2'] != null) {
                    if (substr_count($trek['featureimg2'], 'http') < 1) {
                        $trek['featureimg2'] = config('app.url') . "/" . $trek['featureimg2'];
                    }
                }
                if ($trek['map'] != null) {
                    $trek['map'] = config('app.url') . "/" . $trek['map'];
                }
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
                if ($g['image'] != null) {
                    if (substr_count($g['image'], 'http') < 1) {
                        $g['image'] = config('app.url') . "/" . $g['image'];
                    }
                }
                $excludeIds[$i++] = $g->id;
            }
            $gallerysecond = Gallery::whereNotIn('id', $excludeIds)->take(4)->get();
            if (count($gallerysecond) < 1) {
                $gallerysecond = Gallery::take(4)->get();
                foreach ($gallerysecond as $sec) {
                    if ($sec['image'] != null) {
                        if (substr_count($sec['image'], 'http') < 1) {
                            $sec['image'] = config('app.url') . "/" . $sec['image'];
                        }
                    }
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

    public function  mainGallery()
    {
        try {
            $galleries = MainGallery::all();
            foreach ($galleries as $gallery) {
                if ($gallery['image'] != null) {
                    $gallery['image'] = config('app.url') . "/" . $gallery['image'];
                }
            }
            return $this->SendResponse($galleries, "gallerys fetched successfully.");
        } catch (\Throwable $th) {
            return $this->SendError(throw $th, "Cannot fetch gallerys data.", 500);
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
}
