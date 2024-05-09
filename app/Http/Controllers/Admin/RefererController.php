<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RefererController extends Controller
{
    public function index()
    {
        $referer_code = auth()->user()->referer_code;
        return view('admin.referer.index', compact('referer_code'));
    }

    public function generateCode()
    {
        // check if code already exists from User
        $code = $this->generateRandomString();
        if (User::where('referer_code', $code)->exists()) {
            return $this->generateCode();
        }
        return $code;
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }
}
