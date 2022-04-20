<?php

namespace App\Transformers\Api;


use App\Models\User;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use Laravolt\Avatar\Facade as Avatar;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user): array
    {
        return [
            'responsive_id' => '',
            'id' => $user->id,
            'full_name' => $user->name,
            'role' => $user->getRoleNames()->first(),
            'username' => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'address' => $user->address,
            'base64_avatar' => Avatar::create($user->name)->toBase64(),
            'birthday' => $user->birthday,
            'description' => $user->description,
            'status' => $user->status,
            'last_login' => $user->last_login,
        ];
    }
}
