<?php


namespace App\Http\Controllers\FrontEnd;


use App\CMS;

class HomeController {

	public function index()
	{
		$cms = CMS::find(1);
		$home = $cms->home;
		return view('frontend.cms.home',compact('home'));
	}
}