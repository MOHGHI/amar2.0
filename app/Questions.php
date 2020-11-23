<?php

namespace App;

class Questions extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'shop_id',
                    'customer_id',
                    'product_id',
                    'message',
                    'status',
                 ];
    
    public function shop()
    {
        return $this->belongsTo(\App\Shop::class, 'shop_id');
    }

    public function customer()
    {
        return $this->belongsTo(\App\Customer::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Product::class, 'product_id');
    }
}
