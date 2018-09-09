<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

use App\User;

class vendedoresController extends Controller
{

      /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {
      return view('auth.register',compact('usuario'));
    }

    public function showRegistrationForm()
    {
        $usuarios = new User();
        $usuario = $usuarios->all();
        return view('auth.register',compact('usuario'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

     protected function create(array $data)
     {
         return User::create([
             'name' => $data['name'],
             'email' => $data['email'],
             'password' => bcrypt($data['password']),
             'idSucursal' => $data['sucursal'],
             'permisos' => $data['permisos'],
         ]);
     }
     public function register1(Request $request)
      {
          //dd(Auth::User()->id);
          $this->validator($request->all())->validate();

          event(new Registered($user = $this->create($request->all())));
          /*
          $this->guard()->login($user);

          return $this->registered($request, $user)
                          ?: redirect($this->redirectPath());*/
          \Session::flash('Guardado','Se Agrego el usuario correctamente');
          return redirect()->route("register");
      }
      protected function guard()
      {
          return Auth::guard();
      }

      /**
       * The user has been registered.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  mixed  $user
       * @return mixed
       */
      protected function registered(Request $request, $user)
      {
          //
      }

}
