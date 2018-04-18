<?php

namespace App\Http\Controllers;
use App\Category;
use App\Page;
use App\Product;
use Auth;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
      $products = Auth::user()->products;
      return view('web.index', compact('products'));
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $pages = Page::where('category_id', $category->id)->paginate(12);
        if(view()->exists('web/cat-'.$slug)) {
            return view('web/cat-'.$slug, compact('category', 'pages'));
        } else {
            return view('web/cat', compact('category', 'pages'));
        }
    }
    public function page($category, $slug)
    {
        $page = Page::where('slug', $slug)->first();
        if (view()->exists('web.page-cat-'.$category)) {
            return view('web/page-cat-'.$category, compact('page'));
        } else {
            return view('web/page', compact('page'));
        }
    }
}
