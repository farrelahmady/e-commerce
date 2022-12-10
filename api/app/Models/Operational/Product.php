<?php

namespace App\Models\Operational;

use App\Models\MasterData\Tag;
use App\Models\Operational\Store;
use App\Models\MasterData\Category;
use Illuminate\Database\Eloquent\Model;
use App\Models\Operational\ProductImage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'products';

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'price' => 'float',
        'stock' => 'integer',
        'weight' => 'integer',
    ];

    /**
     * Interact with the product's name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function categories()
    {
        return $this->hasOne(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'products_tags');
    }
}
