<?php

namespace App\Http\modules\products\controller;

use App\Http\modules\base\controller\BaseApiController;
use App\Http\modules\products\service\BrandService;

class BrandController extends BaseApiController
{
    protected $activeAuthApi = false;

    /**
     * BrandController Constructor
     *
     * @param BrandService $service
     *
     */
    public function __construct(BrandService $service)
    {
        parent::__construct($service);
    }
}
