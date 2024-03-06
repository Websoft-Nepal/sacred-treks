<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BaseController extends Controller
{
    public function uploadImage($image, $location = 'uploads/'){
        $filename = Str::uuid()->toString() . '-' . time() . '.' . $image->getClientOriginalExtension();
        $image->move($location, $filename);

        return $filename;
    }

    protected function slugValidate(string $tableName, $ignoreId = null): string
    {
        $uniqueRule = Rule::unique($tableName);

        if ($ignoreId !== null) {
            $uniqueRule->ignore($ignoreId);
        }

        return 'required|' . $uniqueRule . '|min:3|regex:/^[a-z0-9-]+$/';
    }

    public function generateSlug($title,$modelName):string
    {
        $slug = Str::slug($title);

        // Check if slug already exists in the table
        $count = $modelName::where('slug', $slug)->count();

        if ($count > 0) {
            // If slug exists, append a number to make it unique
            $i = 1;
            do {
                $newSlug = $slug . '-' . $i;
                $count = $modelName::where('slug', $newSlug)->count();
                $i++;
            } while ($count > 0);
            $slug = $newSlug;
        }

        return $slug;
    }
}
