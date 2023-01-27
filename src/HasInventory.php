<?php

namespace Rajabit\LaravelInventory;

use Illuminate\Database\Eloquent\Model;

trait HasInventory
{
    /*** 
     * Related model invertory relation
     */
    public function inventory()
    {
        return $this->morphMany(Inventory::class, 'product');
    }

    /**
     * Add products quantity to the inventory
     * 
     * @param int $quantity (required) how much or how many do you want to add to the inventory.
     * @param object|int|string $order (optional) Order id or order eloquent model to store the order record.
     * @param string $caption (optional) The transaction record caption, it can be helpful for future reports.
     * @param int|string $price (optional) How much this transaction cost to add to the inventory.
     * @param string $expires_at (optional) The product expiration date (leave it empty if the product does not expire)
     * @param string $availables_at (optional) When the product is available and ready to use in the inventory.
     */
    public function addInventory(
        int $quantity,
        object|int|string $order = null,
        string $caption = null,
        string|int $price = null,
        string $expires_at = null,
        string $availables_at = null
    ) {

        $order_id = $order;
        $order_type = null;

        if ($order instanceof Model) {
            $order_id = $order->id;
            $order_type = $order::class;
        }

        if (empty($caption) && !empty($order_id)) {
            $caption = "Added by order #$order_id.";
        }

        return $this->inventory()->create([
            'order_id' => $order_id,
            'order_type' => $order_type,
            'caption' => $caption,
            'price' => $price,
            'quantity' => $quantity,
            'started_at' => $availables_at,
            'expired_at' => $expires_at
        ]);
    }

    /**
     * Sub products quantity to the inventory
     * 
     * @param int $quantity (required) how much or how many do you want to sub from the inventory.
     * @param object|int|string $order (optional) Order id or order eloquent model to store the order record.
     * @param string $caption (optional) The transaction record caption, it can be helpful for future reports.
     * @param int|string $price (optional) How much this transaction cost to sub from the inventory.
     */
    public function subInventory(
        int $quantity,
        object|int|string $order = null,
        string $caption = null,
        string|int $price = null,
    ) {
        return $this->addInventory($quantity * -1, $order, $caption, $price);
    }
}
