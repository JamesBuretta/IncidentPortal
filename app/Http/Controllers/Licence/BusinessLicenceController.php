<?php

namespace App\Http\Controllers\Licence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessLicenceController extends Controller
{
   public function renew_licence(){
       return view('pages.manage.renew_licence');
   }
}
