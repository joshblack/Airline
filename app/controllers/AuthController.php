<?php

class AuthController extends BaseController {

	public function login() {

		// validate
		$input = Input::get();

		$attempt = Auth::attempt([
			'username'	=> $input['username'],
			'password'	=> $input['password']
		]);

		if ($attempt) 
			return Redirect::intended('profile');
		else 
			return Redirect::to('login')->with('error', 'Invalid credentials'); 
	}

	public function signup() {
		$input = Input::get();

		$firstName = $input['firstName'];
		$lastName = $input['lastName'];
		$username = $input['username'];
		$password = $input['password'];
		$role = $input['role'];

		$user = new User;
		$user->firstname = $firstName;
		$user->lastname = $lastName;
		$user->username = $username;
		$user->password = Hash::make($password);
		$user->role = $role;
		$user->save();

		return Redirect::to('signup')->with('success', 'Successfully created an account');
	}
}