<?php

namespace App\Models\Operational;

use App\Models\MasterData\Tag;
use App\Models\Operational\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductsTags extends Model
{
    use HasFactory;

    protected $table = 'products_tags';

    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
