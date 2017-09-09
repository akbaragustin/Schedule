<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User as US;
use App\Models\Rapat as RP ;
use Illuminate\Http\Request;

class frontendController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

          return view('frontend');
    }    
    public function indexAjax()
    {
    
        $data['allData'] = RP::all();
    
        echo json_encode($data);
       
    }

  

   
}
