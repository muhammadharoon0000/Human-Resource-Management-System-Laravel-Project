<?php


namespace App\Http\View\Composers;

use Exception;
use Illuminate\View\View;
use JoeDixon\Translation\Drivers\Translation;


use App\GeneralSetting;


class LayoutComposer {

	private $translation;

	public function __construct(Translation $translation)
	{
		$this->translation = $translation;
	}

	public function compose(View $view)
	{

		$general_settings = GeneralSetting::select('site_title', 'site_logo','theme')->firstOrfail();

		$languages = $this->translation->allLanguages();

		$view->with(['general_settings'=>$general_settings,'languages'=>$languages]);
	}

}