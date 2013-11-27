<?php

class AuthController extends BaseController {

	public function login() {
		$input = Input::all();
		$username = $input['username'];
		$password = Hash::make($input['password']);

		if (Auth::attempt(array('username' => $input['username'], 'password' => $input['password'])) {
			
		}
	}
}