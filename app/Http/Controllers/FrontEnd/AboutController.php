<?php


namespace App\Http\Controllers\FrontEnd;


use App\CMS;

class AboutController {

	public function index()
	{
		$cms = CMS::find(1);
		$about = $cms->about;
		return view('frontend.cms.about',compact('about'));
	}
}