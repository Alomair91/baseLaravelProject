<?php

namespace App\Http\modules\products\service;


use App\Http\modules\base\service\BaseApiService;
use App\Http\modules\products\repository\CategoryRepository;
use Illuminate\Http\JsonResponse;

class CategoryService extends BaseApiService
{

    public $checkAuth = false;


    public $fillable = [
        'name',
    ];

    public $validationRules = [
        'name' => ['required', 'string', 'max:255'],
    ];

    /**
     *  CategoryService constructor.
     *
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }
}
