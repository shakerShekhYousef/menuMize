<?php

namespace App\Http\Controllers\auth;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\website\BusinessController;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Http\Requests\website\business\CreateBusinessRequest;
use App\Models\User;
use App\Traits\User\AuthTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    //Traits
    use AuthTrait;

    //Create new account function
    public function register(RegisterRequest $request)
    {
        //Start transaction
        DB::beginTransaction();
        //Create user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($request->account_type == 'business') {
            //Assign user_id to request
            $request['user_id'] = $user->id;
            //Create a new business
            (new BusinessController())->store(CreateBusinessRequest::createFrom($request));
        }
        //Get role
        $role = Role::where('name', $request->account_type)->first();
        //Assign role
        $user->assignRole($role);
        //Create token
        $token = $this->create_token($user);
        //Commit transaction
        DB::commit();
        //Data to send
        $user['token'] = $token;
        //Response
        return success_response($user);
    }

    //Login function
    public function login(LoginRequest $request)
    {
        if ($token = Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            $user['token'] = $this->create_token($user);

            return $user;
        } else {
            throw new GeneralException('Login Failed');
        }
    }
    //Reset password function
}
