<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LocaleController extends Controller
{
	public function languageSwitch($locale)
	{
		setcookie('language', $locale, time() + (86400 * 365), "/");

		return back();
	}

    public function languageDelete(Request $request)
    {
        File::deleteDirectory('resources/lang/'.$request->langVal);
        return response()->json('success');
    }
}
