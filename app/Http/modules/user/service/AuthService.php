<?php

namespace App\Http\modules\user\service;


use App\Http\modules\base\service\BaseApiService;
use App\Http\modules\user\repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseApiService
{

    public $checkAuth = false;


    public $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];

    public $validationRules = [
        'name' => ['required', 'string', 'min:3', 'max:50'],
        'phone' => ['required', 'string', 'min:10', 'max:10', 'unique:users'],
        'email' => ['required', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'max:20'],
    ];


    public $loginValidationRules = [
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:6', 'max:20'],
    ];

    /**
     *  AuthService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }


    public function store(array $data = []): JsonResponse
    {
        if ($value = self::validate($data, $this->validationRules))
            return $value;

        $result = $this->repository->save([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if($result)
            return $this->login($data);

        return $this->responseErrorCanNotSaveData();
    }

    public function update(int $id, array $data = [], bool $restore = false): JsonResponse
    {
        $this->validationRules["phone"] =['required', 'string', 'min:10', 'max:20', 'unique:users,phone,' . $id];
        $this->validationRules["email"] =['required', 'email', 'min:10', 'max:255', 'unique:users,email,' . $id];

        return parent::update($id, $data, $restore);
    }

    public function login(array $data = []): JsonResponse
    {
        if ($value = self::validate($data, $this->loginValidationRules))
            return $value;

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Revoke all tokens...
            $user->tokens()->delete();
            // Create access token
            $user->token = $user->createToken("Personal Access Token")->plainTextToken;

            return $this->responseWithData($user);
        }
        return $this->responseUnauthorized();
    }


    public function logout(Request $request): JsonResponse
    {
        if ($request->user() != null) {
            $user = $request->user();

            // Delete any token related to user
            $user->tokens()->delete();

            return $this->responseSuccessWithMessage("");
        }
        return $this->responseUnauthorized();
    }

}
