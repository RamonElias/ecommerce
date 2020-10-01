<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'category_id', 'name', 'description', 'quantity', 'price',
  ];

  /**
  * The relationships that should always be loaded.
  *
  * @var array
  */
  protected $with = ['category'];

  /**
  * Get the products from this category.
  */
  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  /**
  * Get the route key for the model.
  *
  * @return string
  */
  public function getRouteKeyName()
  {
    return 'name';
  }

  /**
  * Decrease product quantity stock.
  *
  * @return void
  */
  public static function decrease_product_quantity($product_id, $quantity)
  {
    $product = self::where('id', $product_id)->first();

    $product->quantity = $product->quantity - $quantity;

    $product->save();
  }
}
