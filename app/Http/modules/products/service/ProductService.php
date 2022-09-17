<?php

namespace App\Http\modules\products\service;


use App\Http\modules\base\service\BaseApiService;
use App\Http\modules\products\repository\ProductRepository;
use Illuminate\Http\JsonResponse;

class ProductService extends BaseApiService
{

    public $checkAuth = false;

    public $filters = [
        'category_id',
        'brand_id',
    ];

    public $fillable = [
        'category_id',
        'brand_id',

        'name',
        'details',
        'price',
    ];

    public $validationRules = [
        'category_id' => ['required', 'numeric'],
        'brand_id' => ['required', 'numeric'],
        'name' => ['required', 'string', 'max:255'],
        //'details' => ['required', 'string'],
        'price' => ['required', 'numeric'],
    ];

    /**
     *  ProductService constructor.
     *
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }
}
