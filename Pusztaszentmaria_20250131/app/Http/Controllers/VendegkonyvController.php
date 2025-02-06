<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendegkonyv;

class VendegkonyvController extends Controller
{
    public function vendegkonyv(){
        return view('vendegkonyv', [
            'req'   => vendegkonyv::OrderBy('date', 'DESC')
            ->get()
        ]);
    }
    public function vendegkonyvData(Request $req){
        $req->validate([
            'nev'           =>  'required',
            'email'         =>  'required|email',
            'message'       =>  'required|min:10'
        ], [
            'nev.required'      =>  'NEM ADOTT MEG NEVET',
            'email.required'    =>  'NEM ADOTT MEG E-MAIL CÍMET',
            'message.required'  =>  'NEM ADOTT MEG ÜZENETET',
            'message.min'       =>  'MINIMUM 10 KARAKTERT ADJON MEG',
            'email.email'       =>  'NEM HELYES E-MAIL FORMÁTUM'
        ]);

            $data               = new vendegkonyv;
            $data->nev          = $req->nev;
            $data->email        = $req->email;
            $data->message      = $req->message;
            $data->date         = date("Y-m-d");

            $data->Save();

            return redirect('/vendegkonyv');
    }
}
