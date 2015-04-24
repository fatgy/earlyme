<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hybrid_Endpoint;
use Hybrid_Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

    public function index($identifier_id)
    {
        $data = [];
        $data['user'] = DB::table('users')->where('identifier', $identifier_id)->first();
        return view('user.index', $data);
    }

}