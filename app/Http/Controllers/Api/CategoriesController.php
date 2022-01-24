<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\GeneralTraits;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // inherate general traits
    use GeneralTraits;

    public function index()
    {
        $categories = Category::select('id', 'name_' . app()->getLocale() . ' as name')->get();

        // return response()->json($categories);
        return $this->returnData('catrgoties',$categories,'Get Categories Successfully');
    }

    public function getCategoryById(Request $request)
    {
        $category = Category::select('id', 'name_' . app()->getLocale() . ' as name')->find($request->id);

        if (!$category)
            return $this->returnError('404', 'Not Found');
        return $this->returnData('category', $category ,'Get Category Successfully');
    }
}
