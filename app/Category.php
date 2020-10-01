<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'description',
  ];

  /**
  * Get the products from this category.
  */
  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
