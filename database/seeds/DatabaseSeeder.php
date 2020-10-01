<?php

use App\Category;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // $this->call(UsersTableSeeder::class);

    factory(User::class)->create([
      'name' => 'Qwerty',
      'email' => 'qwerty@gmail.com',
      'password' => bcrypt('secretpassw'),
    ]);

    factory(User::class, 59)->create([
      'password' => bcrypt('secretpassw'),
    ]);

    for ($i = 1; $i < 11; $i++) {
      factory(Category::class)->create([
        'name' => 'Category ' . $i,
      ]);
    }

    for ($i = 1; $i < 101; $i++) {
      factory(Product::class)->create([
        'name' => 'Product ' . $i,
      ]);
    }
  }
}

