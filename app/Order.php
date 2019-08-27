<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Boot the model
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($order) {
            $order->saveSubtotal();
        });
    }

    /**
     * Don't apply mass assigment
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Belongs to a owner
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Has many products
     *
     * @return Illuminate\Datbase\Eloquent\Collection
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity', 'price']);
    }

    /**
     * Get subtotal attribute
     *
     * @return int
     */
    public function getSubtotal() : int
    {
        return $this->products->reduce(function ($accumulator, $product) {
            return $accumulator += $product->pivot->price * $product->pivot->quantity;
        }, 0);
    }

    public function saveSubtotal()
    {
        $this->update([
            'subtotal' => $this->getSubtotal()
        ]);
    }

    /**
     * Mark a order as completed
     *
     * @return void
     */
    public function markAsCompleted()
    {
        $this->update([
            'completed_at' => now()
        ]);
    }

    /**
     * Order path
     *
     * @return string
     */
    public function path()
    {
        return route('orders.show', $this);
    }
}
