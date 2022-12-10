<?php

namespace App\Models\Operational;

use App\Models\Operational\Product;
use App\Models\ManagementAccess\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'stores';

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'string',
        'address' => 'string',
        'contact' => 'string',
        'postal_code' => 'string',
    ];

    /**
     * Interact with the store's name.
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

    /**
     * Interact with the user's address.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Interact with the user's city.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function city(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Interact with the user's province.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function province(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    protected function district(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    protected function village(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    protected function contact(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $value = $value[0] == "0" ? substr_replace($value, "+62", 0, 1) : $value;
                return str_replace(array('(', ')', ' '), '', $value);
            },
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
