<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductCoupon extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $dates = ['start_date', 'expire_date'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $searchable = [
        'columns' => [
            'product_coupons.code' => 10,
        ]
    ];

    public function status()
    {
        return $this->status ? 'Active' : 'Inactive';
    }


}
