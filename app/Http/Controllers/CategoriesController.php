<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;

class CategoriesController extends Controller
{
    public function gotoCategories(){
        $pageConfigs = ['pageHeader' => false];
        return view('/categories/categories', ['pageConfigs' => $pageConfigs]);
    }

    public function showCategories(Request $request)
    {
        if($request->type=="brand") $result = Brand::all();
        else if($request->type="cat") $result = Category::all();
        return datatables()->of($result)->make(true);
    }

    public function deleteCategory(Request $request){
        if($request->type=="brand") Brand::find($request->id)->delete();
        else if ($request->type=="cat") Category::find($request->id)->delete();
    }
}
