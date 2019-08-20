<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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
        return $this->belongsToMany(Product::class)->withPivot(['quantity']);
    }
}
