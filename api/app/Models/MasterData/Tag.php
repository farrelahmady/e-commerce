<?php

namespace App\Models\MasterData;

use App\Models\Operational\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_tags');
    }
}
