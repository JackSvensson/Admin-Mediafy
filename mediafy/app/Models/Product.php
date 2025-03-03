<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_id',
        'platform_id',
        'price',
        'stock'
    ];

    /**
     * Get the title this product belongs to
     */
    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    /**
     * Get the platform this product belongs to
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
