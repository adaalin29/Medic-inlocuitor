<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    
    
    public function index()
    {
         
      return view('index', [
        ]);
      
    }

    public function despre()
    {
         
      return view('despre', [
        ]);
      
    }
    public function termeni()
    {
         
      return view('termeni', [
        ]);
      
    }

    public function politica()
    {
         
      return view('politica', [
        ]);
      
    }

    public function cookie()
    {
         
      return view('cookie', [
        ]);
      
    }
    public function servicii()
    {
         
      return view('servicii', [
        ]);
      
    }
    
    
}