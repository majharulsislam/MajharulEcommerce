<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;

class AdminPagesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
       return view('admin.pages.index');
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
       //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
       //
    }

    
    public function destroy($id)
    {
       //
    }


}
