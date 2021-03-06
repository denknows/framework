<?php

namespace Shopper\Framework\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'address',
        'country',
        'state',
        'city',
        'user_id',
        'postcode',
        'phone',
        'is_default',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return shopper_table('addresses');
    }

    /**
     * Define if an address is default or not.
     *
     * @return bool
     */
    public function isDefault()
    {
        return $this->is_default === true;
    }

    /**
     * Return the customer's information.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(config('auth.providers.users.model', User::class), 'user_id');
    }
}
