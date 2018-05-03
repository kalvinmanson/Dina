<?php

namespace App\Http\Controllers;
use App\Category;
use App\Page;
use App\Product;
use Auth;
use Carbon;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
      Carbon::setLocale('es');
      return view('web.index');
    }
    public function printview()
    {
      Carbon::setLocale('es');
      return view('web.print');
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

    /*public function migrar() {
      $string = file_get_contents(public_path("products.json"));
      $records = json_decode($string, true);
      $category = Category::first();
      foreach($records as $record) {
        $product = new Product;
        $product->name = $record['name'];
        $product->description = $record['description'];
        $product->presentation = $record['presentation'];
        $product->price = filter_var($record['price'], FILTER_SANITIZE_NUMBER_INT);
        $product->category_id = $category->id;
        $product->save();
      }
    }*/
}
