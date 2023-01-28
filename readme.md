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
##Load model current quantity
```
Product::query()
->withSum('inventory', 'quantity')
...
->get();
```

##Get model inventory history
```
$product->inventory()
...
->latest()
->paginate();
```

##Add products to the inventory
```
$product->addInventory($quantity);
```

Here you can add more detail
```
$product->addInventory(
    $quantity, // (required) how much or how many do you want to add to the inventory
    $order, // (optional) Order id or order eloquent model to store the order record.
    $caption, // (optional) The transaction record caption, it can be helpful for future reports.
    $price // (optional) How much does this transaction cost
);
```

If your product has time limitions
```
$product->addInventory(
    $quantity, // (required) how much or how many do you want to add to the inventory
    $order, // (optional) Order id or order eloquent model to store the order record.
    $caption, // (optional) The transaction record caption, it can be helpful for future reports.
    $price, // (optional) How much does this transaction cost
    $expires_at, // (optional) The product expiration date (leave it empty if the product does not expire)
    $availables_at // (optional) When the product is available and ready to use in the inventory.
);
```

##Subtract products from the inventory
```
$product->subInventory($quantity);
```
Here you can add more detail
```
$product->addInventory(
    $quantity, // (required) How much or how many do you want to subtract from the inventory
    $order, // (optional) Order id or order eloquent model to store the order record.
    $caption, // (optional) The transaction record caption, it can be helpful for future reports.
    $price // (optional) How much does this transaction cost
);
```
