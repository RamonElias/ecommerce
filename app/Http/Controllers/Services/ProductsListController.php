<?php

namespace App\Http\Controllers\Services;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsListController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request)
  {
    return Product::where('quantity', '>', 0)
                  ->orderBy('id', 'asc')
                  ->paginate(9);
  }
}


