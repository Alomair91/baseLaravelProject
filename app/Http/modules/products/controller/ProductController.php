<?php

namespace App\Http\modules\products\controller;

use App\Http\modules\base\controller\BaseApiController;
use App\Http\modules\products\service\ProductService;

class ProductController extends BaseApiController
{
    protected $activeAuthApi = false;

    /**
     * ProductController Constructor
     *
     * @param ProductService $service
     *
     */
    public function __construct(ProductService $service)
    {
        parent::__construct($service);
    }
}
