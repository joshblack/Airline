<?php

class HomeController extends BaseController {

	public function showWelcome()
	{
		return View::make('index');
	}

	public function bookFlight() {
		return View::make('flights');
	}

}