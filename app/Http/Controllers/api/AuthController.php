<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','tasjil','checkusernamejcartoon','checkuseremail']]);
    }
  /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }




        return $this->respondWithToken($token);
    }


    public function tasjil(Request $request)
    {

        $valid = Validator::make($request->all(),[
            'email' => 'required|string|email|unique:users',
            // 'userspecial_name' => 'required|string|unique:users,userspecial_name',
        ]);


        if ($valid->fails()) {
            return response()->json([
                'message' => 'الإيميل موجود بالفعل , جرب بريد أخر أو سجل الدخول',
                ],402);
        }



        $data['name'] =  $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['userspecial_name'] = $request->userspecial_name;
        $data['isverified'] = 0;
        $data['isadmin'] = 0;
        $data['whatcando'] = 'normal';
        $data['account_type'] = 'pubic';
        
       /* if ($request->profil != null) {

            $path = $request->userspecial_name . '.jpg';
         
             file_get_contents(storage_path('app/public/'.$path),base64_decode($request->profil));
             //Storage::disk('public')->putFile('images', file_get_contents($request->userspecial_name . '.jpg',base64_decode($request->profil)));

            $data['profil'] = storage_path('app/public/'.$path);
          
        
        } */
 
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Customize the storage path and file name as needed
            $path = $request->userspecial_name.'.jpg';
            $image->move(public_path('uploads/userprofil'), $path);
            $data['profil'] = 'https://epesodes.hyperwatching.com/public/uploads/userprofil/'.$path;
            // Do additional processing or save the file path to the database if needed
            
        }
        
        $data['noads'] = 0;
        $data['Subscription'] = 0;
        $data['banned'] = 0;
        $data['insta_url'] = null;
        $data['face_url'] = null;
        $data['twitter_url'] = null;
        $data['profile_desc'] = null;
        $data['rooms_number'] = 5;
        $data['device_id'] = $request->device_id;
        $data['country'] = $request->country;


        $user = User::create($data);


        return response()->json([


           'message' => 'تم إنشاء الحساب بنجاح',
           'user' => $user,
           'followings' => $user->followings()->count(),
           'followers' => $user->followers()->count()


           ],201);

    }

    public function checkusernamejcartoon(Request $request)
    {

        $valid = Validator::make($request->all(),[
         'userspecial_name' => 'required|string|unique:users',
        ]);


        if ($valid->fails()) {
            return response()->json([
                'message' =>'exist',
                ],201);
        }

        return response()->json([
            'message' => 'done',
            'username' => $request->userspecial_name,
            ],201);

    }
    
     public function checkuseremail(Request $request)
    {

        $valid = Validator::make($request->all(),[
         'email' => 'required|string|email|unique:users',
        ]);


        if ($valid->fails()) {
            return response()->json([
                'message' => 'exist',
                ],201);
        }

        return response()->json([
            'message' => 'done',
            'email' => $request->email,
            ],201);

    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {


        $user = auth()->user();



        return response()->json([
            'user' => $user,
            'followings' => $user->followings()->count(),
            'followers' => $user->followers()->count()
        ]);
    }





}
