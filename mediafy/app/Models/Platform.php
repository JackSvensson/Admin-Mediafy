<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Platform extends Model
{
    //
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'type'
    ];

    /**
     * Get all titles for this platform
     */
    public function titles()
    {
        return $this->belongsToMany(Title::class, 'products')
            ->withPivot(['price', 'stock']);
    }

    /**
     * Get all products for this platform
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
