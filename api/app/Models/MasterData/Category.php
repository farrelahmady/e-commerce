<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterData\ProductCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $guarded = ['id'];

    public function productCategory()
    {
        return $this->hasMany(ProductCategory::class);
    }
}
