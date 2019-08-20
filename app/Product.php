<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Don't apply mass assignment
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * It belongs to many orders
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot(['quantity']);
        ;
    }
}
