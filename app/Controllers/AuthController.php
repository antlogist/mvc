<?php
namespace App\Controllers;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\ValidateRequest;
use App\Models\User;

class AuthController extends BaseController {
	function showRegisterForm() {
    return view("register");
  }

	function showLoginForm() {
    return view("login");
  }

  function register() {
    if(Request::has('post')){
      $request = Request::get('post');
      if(CSRFToken::verifyCSRFToken($request->token)) {
        $rules = [
          'username' => ['required' => true, 'maxLength' => 20, 'string' => true, 'unique' => 'users'],
          'email' => ['required' => true, 'email' => true, 'unique' => 'users'],
          'password' => ['required' => true, 'minLength' => 6],
          'fullname' => ['required' => true, 'minLength' => 6, 'maxLength' => 50],
          'address' => ['required' => true, 'minLength' => 4, 'maxLength' => 500, 'mixed' => true]
        ];

        $validate = new ValidateRequest;
        $validate->abide($_POST, $rules);

        if($validate->hasError()){
          $errors = $validate->getErrorMessages();
          return view('register', ['errors' => $errors]);
        }

        //insert into database
        User::create([
          'username' => $request->username,
          'email' => $request->email,
          'password' => password_hash($request->password, PASSWORD_BCRYPT),
          'fullname' => $request->fullname,
          'address' => $request->address,
          'role' => 'user',
        ]);

        Request::refresh();
        return view('register', ['success' => 'Account created, please login']);

      }

      throw new \Exception('Token Mismatch');

    }

    return null;

  }

  function login() {

  }
}
