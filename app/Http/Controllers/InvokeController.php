<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvokeController extends Controller
{
   	public function __invoke() {
   		return "Hello from invoke Controller";
   	}

   	public function show() {
   		return "show";
   	}
}
