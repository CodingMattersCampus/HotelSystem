<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Requests\User\Session;

use App\Models\User\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class OfficeLoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            "username" => "required|min:1",
            "password" => "required|min:1",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return Auth::guard('office')->guest();
    }

    public function isAuthorized(string $username, string $password, string $guard = null) : bool
    {
        return Auth::guard($guard)->attempt([
            'username'  => $username,
            'password'  => $password,
            'is_active' => true,
            'role'      => UserRole::ADMINISTRATOR,
        ]);
    }
}
