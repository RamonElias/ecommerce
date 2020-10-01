<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cart_items = Cart::get_user_cart_items();

    return view('cart.index', [
      'api_token' => auth()->user()->api_token,
      'cart_items' => $cart_items,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Cart  $cart
   * @return \Illuminate\Http\Response
   */
  public function show(Cart $cart)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Cart  $cart
   * @return \Illuminate\Http\Response
   */
  public function edit(Cart $cart)
  {
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Cart  $cart
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Cart $cart)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Cart  $cart
   * @return \Illuminate\Http\Response
   */
  public function destroy(Cart $cart)
  {
  }
}
