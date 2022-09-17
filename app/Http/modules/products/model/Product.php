<?php

namespace App\Http\modules\products\model;

use App\Http\Common\db\DBTables;
use App\Http\modules\base\model\BaseModel;
use Database\Factories\product\ProductFactory;

class Product extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DBTables::PRODUCTS;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'brand_id',

        'name',
        'details',
        'price',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'category_id',
        'brand_id',

        'created_by',
        'updated_by',
        'deleted_by',

        'updated_at',
        'deleted_at'
    ];

    /** @return ProductFactory */
    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function category()
    {
        return $this->belongsTo(Category::class,"category_id")->withTrashed();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,"brand_id")->withTrashed();
    }
}
