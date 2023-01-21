<?php

namespace PackageMaker\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagePackageMakerController extends Controller
{


    public function index()
    {
        return view('packagemaker::page');
    }
}
