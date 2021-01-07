<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreType extends Model
{
    protected $table = 'store_types';
    protected $primaryKey = 'type_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_type'
    ];

    /**
     * App\Store relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }

}
