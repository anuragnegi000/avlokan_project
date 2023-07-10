<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illluminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AdminController extends Controller
{
    public function adminregister(Request $request){
        $admin=Admin::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>\Illuminate\Support\Facades\Hash::make($request->password)
        ]);
        if($admin){
            return response()->json([$admin,'status'=>true]);
        }
        else{
            return response()->json(['status'=>false]);
        }
    }
    

    public function adminlog(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->guard('admin-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $admin = auth()->guard('admin-api')->user();
        $accessToken = $admin->createToken('Personal Access Token')->plainTextToken;

        $personalAccessToken = PersonalAccessToken::findToken($accessToken);
        $personalAccessToken->update([
            'name' => 'Personal Access Token',
        ]);

        return response()->json([
            'token' => $accessToken,
            'admin' => $admin,
        ]);
    }



    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
