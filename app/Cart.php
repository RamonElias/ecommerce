<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 'product_id', 'quantity', 'price',
  ];

  /**
  * The relationships that should always be loaded.
  *
  * @var array
  */
  protected $with = ['product'];

  /**
  * Get the product record associated with this cart item.
  */
  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  /**
  * Get user cart items.
  */
  public static function get_user_cart_items()
  {
    return self::where('user_id', auth()->id())
                ->orderBy('updated_at', 'desc')
                ->get();
  }

  /**
  * Get user cart items count.
  */
  public static function get_user_cart_items_count()
  {
    return self::where('user_id', auth()->id())->count();
  }

  /**
  * Get user cart item.
  */
  public static function get_user_cart_item($product_id)
  {
    return self::where('user_id', auth()->id())
                ->where('product_id', $product_id)
                ->first();
  }

  /**
  * Clean authenticated user cart items.
  *
  * @return void
  */
  public static function void_auth_user_cart_items()
  {
    $cart_items = self::get_user_cart_items();

    foreach ($cart_items as $cart_item) {
      $cart_item->delete();
    }
  }

  /**
  * Update user cart item.
  */
  public function update_user_cart_item($request)
  {
    $this->quantity = $request->quantity;
    $this->price = $request->price;
    $this->save();

    return $this->fresh();
  }

  /**
  * Fill user cart item.
  */
  public function fill_user_cart_item($request)
  {
    $this->user_id = auth()->id();
    $this->product_id = $request->product_id;
    $this->quantity = $request->quantity;
    $this->price = $request->price;

    $this->save();

    return $this->fresh();
  }
}
