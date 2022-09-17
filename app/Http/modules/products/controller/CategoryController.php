<?php

namespace App\Http\modules\products\controller;

use App\Http\modules\base\controller\BaseApiController;
use App\Http\modules\products\service\CategoryService;

class CategoryController extends BaseApiController
{
    protected $activeAuthApi = false;

    /**
     * CategoryController Constructor
     *
     * @param CategoryService $service
     *
     */
    public function __construct(CategoryService $service)
    {
        parent::__construct($service);
    }
}
