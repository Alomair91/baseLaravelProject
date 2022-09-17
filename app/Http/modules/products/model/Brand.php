<?php

namespace App\Http\modules\products\model;

use App\Http\Common\db\DBTables;
use App\Http\modules\base\model\BaseModel;
use Database\Factories\product\BrandFactory;

class Brand extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = DBTables::BRANDS;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /** @return BrandFactory */
    protected static function newFactory()
    {
        return BrandFactory::new();
    }
}
