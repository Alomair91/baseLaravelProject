<?php

namespace App\Http\modules\base\service;

use App\Http\Common\db\DBUtil;
use App\Http\Common\response\ApiResponse;
use App\Http\Common\util\AuthUtil;
use App\Http\Common\util\DataUtil;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/*
 * This class Will do:
 * - Check auth and catch errors in one place
 * - Do transactions to database in one place
 * - validate data
 */
abstract class BaseService
{
    use ApiResponse, AuthUtil, DBUtil, DataUtil;


    /**
     * Check if the user has the right permission then complete the task and wrap the code with try/catch
     *
     * @param bool $checkAuth
     * @param callable $callable
     * @return JsonResponse
     */
    public function execute(bool $checkAuth, callable $callable): JsonResponse
    {
        try {
            // check auth
            if ($checkAuth) {
                if (!$this->hasAuth())
                    return $this->responseUnauthorized();
            }

            // execute anonymous function
            return $callable();

        } catch (\Exception $e) {
            return $this->responseCatchError($e->getMessage());
        }
    }

    /**
     * Wrap update and delete transaction
     *
     * @param callable $callable
     * @return JsonResponse
     */
    public function dbTransaction(callable $callable): JsonResponse
    {
        DB::beginTransaction();
        try {
            //execute anonymous function
            $result = $callable() ?? null;
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseCatchError($e->getMessage());
        }
        DB::commit();

        if ($result)
            return $this->responseWithData($result);

        return $this->responseErrorThereIsNoData();
    }

    /**
     * Validate before insert or update data
     *
     * @param array $data
     * @param array $rules
     * @return JsonResponse|null
     */
    public function validate(array $data, array $rules): ?JsonResponse
    {
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
            return $this->responseErrorWithValidatorObject($validator->errors());
        return null;
    }
}
