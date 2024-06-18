<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    use HasFactory, HasUuids;
//    protected $primaryKey = 'id';
//    public $incrementing = false;
//    protected $keyType = 'string';

    protected $fillable = [

        'name',
        'description',
        'story',
        'price',
        'quantity',
        'image',
        'color',
        'size',
        'category',
        'shop_id'
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)-withTimestamps()->using(OrderProduct::class)->withPivot('quantity');
    }
}

