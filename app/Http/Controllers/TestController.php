<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        return view('theme.test.index');
    }

    public function callbackFunc(Request $request)
    {
        //
        return view('theme.test.index');
    }
}
