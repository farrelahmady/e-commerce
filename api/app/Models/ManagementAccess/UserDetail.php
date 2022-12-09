<?php

namespace App\Models\ManagementAccess;

use App\Models\ManagementAccess\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetail extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'user_details';

    protected $guarded = ['id'];

    protected $appends = ['name'];

    protected $casts = [
        'birthdate' => 'date',
        'contact' => 'string',
        'gender' => 'integer',
        'postal_code' => 'string',
    ];

    /**
     * Interact with the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Interact with the user's last name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function lastName(): Attribute
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



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
