<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get the products for this title
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the platforms for this title through the products table
     */
    public function platform()
    {
        return $this->belongsToMany(Platform::class, 'products')
            ->withPivot(['price', 'stock']);
    }
}
