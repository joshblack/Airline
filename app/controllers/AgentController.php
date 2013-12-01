<?php

class AgentController extends BaseController {

	public function showIndex() {

		$trips = DB::table('trip')->get();

		return View::make('users.agents.index', array(
			'trips' => $trips
			));
	}
}