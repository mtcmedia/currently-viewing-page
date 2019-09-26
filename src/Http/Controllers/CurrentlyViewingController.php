<?php

namespace Mtc\CurrentlyViewing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mtc\CurrentlyViewing\Facades\ViewLog;
use Mtc\CurrentlyViewing\Http\Resources\UserLog;

/**
 * Class CurrentlyViewingController
 *
 * @package Mtc\CurrentlyViewing
 */
class CurrentlyViewingController extends Controller
{
    /**
     * List users currently viewing this page
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        ViewLog::addUser(Auth::user(), $request->input('url'));
        return new UserLog(ViewLog::currentlyViewing($request->input('url')));
    }
}