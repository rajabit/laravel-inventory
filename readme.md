# Laravel Inventory

1. Installation

```sh
composer require rajabit/laravel-inventory
```

Publish package file
```sh
php artisan vendor:publish --provider="Rajabit\LaravelInventory\LaravelInventoryServiceProvider"
```

Migrate table
```sh
php artisan migrate
```

2. use the Inventory in your model's
```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rajabit\LaravelInventory\HasInventory;

class Product extends Model
{
    use HasInventory;
}
```

# Documention
Load model current quantity
```
Product::query()
->withSum('inventory', 'quantity')
...
->get();
```
