<?php

namespace App\Http\Controllers\Auth;



use App\User;
use App\Http\Requests\UserValid;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    // protected $fileName;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    { }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    { }


    public function storeUser(UserValid $request)
    {

        if ($request->hasFile('image')) {
            $files = $request->file('image');

            $ImageUpload = Image::make($files);
            $originalPath = public_path('/images/profileUser/');
            $ImageUpload->resize(400, 400);

            $ImageUpload->save($originalPath . time() . $files->getClientOriginalName());
            
            $fileName = time() . $files->getClientOriginalName();
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'image' => $fileName,
            'role_id' => 1
        ]);

        session()->flash('success', ' Register Succesfully ');
        return redirect()->back();
    }
}
