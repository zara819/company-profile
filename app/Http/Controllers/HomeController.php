<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.editor.dashboard.index');
    }

    public function notification():JsonResponse
    {
        $contact = Contact::where('is_read',0)->count();
        $total = 0;
        if($contact>0){
            $total+=1;
        }
        $res = ['contact'=>$contact,'total'=>$total];
        return response()->json($res);
    }
}
