<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Trait\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
class UserController extends Controller
{
    use HttpResponses;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return $this->error('Some datas i`ts wrong', 422, $validator->errors());
        }
        $validated = $validator->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);
        if ($user) {
            return $this->response('User Created', 201, new UserResource($user));
        }
        
        return $this->error('User Not Created', 400, $user);
    }

    public function login(Request $request)
    {
        $registred = Auth::attempt($request->only('email', 'password'));
        if ($registred) {
            $user = User::where('email', $request->email)->first();

            // Inicializando as habilidades padrão
            $abilities = ['*'];
            $token = $request->user()->createToken('schedule', $abilities)->plainTextToken;
            return response()->json($token);
        }
        return $this->error('User Not Found', 400, 'Maybe the User it whong or User not registred , try again');
    }

    public function logout(Request $request)
    {
        //
    }
}