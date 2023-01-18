<?php

namespace Rajabit\LaravelInventory;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = "inventory";
    public $timestamps = true;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'integer',
        'quantity' => 'integer',
        'balance' => 'integer',
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'order_type',
        'product_id',
        'product_type',
        'caption',
        'price',
        'quantity',
        'balance',
        'started_at',
        'expired_at',
    ];

    /**
     * Get the order model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function order()
    {
        return $this->morphTo('order');
    }


    /**
     * Get the product model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function product()
    {
        return $this->morphTo('product');
    }
}
