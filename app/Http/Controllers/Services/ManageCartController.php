<?php

namespace App\Http\Controllers\Services;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ManageCartController extends Controller
{
  /**
   * Store or Update a resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function fill(Request $request)
  {
    $cart_item = Cart::get_user_cart_item($request->product_id);

    if ($cart_item) {
      return $cart_item->update_user_cart_item($request);
    }

    $cart_item = new Cart;

    return $cart_item->fill_user_cart_item($request);
  }

  /**
   * Charge items in Cart.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function charge(Request $request)
  {
    foreach ($request->cart_items as $cart_item) {
      Product::decrease_product_quantity($cart_item['product_id'], $cart_item['quantity']);
    }

    Cart::void_auth_user_cart_items();

    $message = auth()->user()->name . ' Cart total cost charged => ' . substr($request->totalCost, 0, -2) . ',' . substr($request->totalCost, -2);

    session([
      'charged-message' => $message,
    ]);

    return $message;
  }

  /**
 * Remove the specified resource from storage.
 *
 * @param  \App\Cart  $cart
 * @return \Illuminate\Http\Response
 */
  public function destroy(Request $request)
  {
    $cart_item = Cart::get_user_cart_item($request->product_id);

    if ($cart_item) {
      $cart_item->delete();
    }

    return 'reset ok';
  }
}
