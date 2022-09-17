<?php

namespace App\Http\modules\products\service;


use App\Http\modules\base\service\BaseApiService;
use App\Http\modules\products\repository\BrandRepository;
use Illuminate\Http\JsonResponse;

class BrandService extends BaseApiService
{

    public $checkAuth = false;


    public $fillable = [
        'name',
    ];

    public $validationRules = [
        'name' => ['required', 'string', 'max:255'],
    ];

    /**
     *  BrandService constructor.
     *
     * @param BrandRepository $repository
     */
    public function __construct(BrandRepository $repository)
    {
        parent::__construct($repository);
    }
}
