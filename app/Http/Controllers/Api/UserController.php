<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Common\CommonApiController;
use App\Models\User;
use App\Transformers\Api\UserTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Rules\Password;
use Laravolt\Avatar\Facade as Avatar;

class UserController extends CommonApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->respondWithSuccess(fractal(User::all(), new UserTransformer())->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'username' => ['required', 'string', 'min:6', 'max:255'],
            'email' => ['required', 'string', 'email', 'min:6', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', new Password],
            'gender' => ['required', 'string', Rule::in(['Male', 'Female', 'Unknown'])],
            'role' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return $this->respondFailedValidation($validator);
        }

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($request->role);

        return $this->respondCreated($user);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBase64Avatar($id)
    {
        return $this->respondOk(Avatar::create(User::findOrFail($id)->name)->toBase64());
    }
}
