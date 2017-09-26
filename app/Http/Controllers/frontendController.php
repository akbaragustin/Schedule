<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\User as US;
use App\Models\Rapat as RP ;
use App\Models\Ruangan as RU ;
use App\Models\Schedule as SC ;
use App\Models\Invite_name as IN ;
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
    public function indexRuangan()
    {

          return view('ruanganFe');
    }
    public function indexEselonKapus()
    {

          return view('eselon_kapus');
    }
    public function indexKapus()
    {

          return view('kapusShow');
    }

    public function indexAjax(){
            $draw=$_REQUEST['draw'];
            $length=$_REQUEST['length'];
            $start=$_REQUEST['start'];
            $search=$_REQUEST['search']["value"];
            // ======= count ===== //
             $queryCount = RP::getAllCount($id =18);
            $query = RP::getAll($id =18);
            $total=count($queryCount);
            // ======= count ===== //

            $output=array();
            $output['draw']=$draw;
            $output['recordsTotal']=$output['recordsFiltered']=$total;
            $output['data']=array();

            $list = [];
            foreach ($query as $key => $row) {
                $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
                $hari =date('w',strtotime($row->start_tgl_rapat));
                $day ="";
                    if ($hari == 1) {
                        $day ="Senin";
                    }elseif ($hari ==2) {
                        $day ="Selasa";
                    }elseif($hari ==3){
                        $day ="Rabu";
                    }elseif ($hari ==4) {
                        $day ="Kamis";
                    }elseif($hari == 5){
                        $day ="Jumat";
                    }elseif($hari ==6){
                        $day ="Sabtu";
                    }elseif ($hari == 0) {
                        $day ="Minggu";
                    }

                $waktu = date('H:i:s', strtotime($row->start_tgl_rapat));
                $tempat = "";
                if (!empty($row->tempat_rapat)) {
                    $tempat = $row->tempat_rapat;

            }else{
                $tempat = $row->name_ruangan;
            }

            $json['agenda_rapat'] = $row->agenda_rapat;
            $json['pj_rapat'] = $row->pj_rapat;
            $json['start_tgl_rapat'] =$day.", ".$start;
            $json['waktu'] = $waktu;
            $json['tempat_rapat'] = $tempat;
            $json['id_rapat'] = $row->id_rapat;
            $infant_eselon =SC::getInviteInfant($row->id_rapat);
            $infant_biasa =IN::getInviteInfant($row->id_rapat);
            $pejabat_eselon =SC::getInviteUndang($row->id_rapat);
            $pejabat_biasa =IN::getInviteUndang($row->id_rapat);

            $data_undang ="";
            if (!empty($pejabat_eselon) OR !empty($pejabat_biasa)) {
                $data_undang ="<ol>";
                if (!empty($pejabat_biasa)) {
                    foreach ($pejabat_biasa as $k => $v) {
                        $data_undang .= "<li>";
                        $data_undang .= $v->disposisi_rapat." ";
                        $data_undang .= "</li>";
                    }
                }
                if (!empty($pejabat_eselon)) {
                foreach ($pejabat_eselon as $key => $value) {
                    $data_undang .= "<li>";
                    $data_undang .= $value->name_pic." ";
                    $data_undang .= "</li>";
                    }
                }
                $data_undang .="</ol>";
            }
            $data_infant ="";
            if (!empty($infant_eselon) OR !empty($infant_biasa)) {
                $data_infant ="<ol>";
                if (!empty($infant_biasa)) {
                    foreach ($infant_biasa as $k => $v) {
                        $data_infant .= "<li>";
                        $data_infant .= $v->disposisi_rapat." ";
                        $data_infant .= "</li>";
                    }
                }
                if (!empty($infant_eselon)) {
                foreach ($infant_eselon as $key => $value) {
                    $data_infant .= "<li>";
                    $data_infant .= $value->name_pic." ";
                    $data_infant .= "</li>";
                    }
                }
                $data_infant .="</ol>";
            }
            $json['infant'] = $data_infant;
            $json['pejabat'] = $data_undang;
            // echo "<pre>";
            // print_r($infant_biasa);die;

            $list[] = $json;
        }
        $output['data']  = $list;
        echo json_encode($output);

    }

    public function showAjax(){
          $id_rapat = Input::get('id');
          $query = RP::getShow($id =18,$id_rapat);
          $list =[];
          foreach ($query as $key => $value) {
              $data['infant_eselon'] =SC::getInviteInfant($value->id_rapat);
              $data['undang_eselon'] =SC::getInviteUndang($value->id_rapat);
              $data['name_infant'] =IN::getInviteInfant($value->id_rapat);
              $data['disposisi_rapat'] =IN::getInviteUndang($value->id_rapat);
          $list['data'][] =$data;
          }
            $view = view('viewShow',$list)->render();
            $output['data'] = $view;
          echo json_encode($output);


     }
    public function showAjaxKapus(){
          $id_rapat = Input::get('id');
          $query = RP::getShow($id =14,$id_rapat);
          $list =[];
          foreach ($query as $key => $value) {
              $data['infant_eselon'] =SC::getInviteInfant($value->id_rapat);
              $data['undang_eselon'] =SC::getInviteUndang($value->id_rapat);
              $data['name_infant'] =IN::getInviteInfant($value->id_rapat);
              $data['disposisi_rapat'] =IN::getInviteUndang($value->id_rapat);
          $list['data'][] =$data;
          }
            $view = view('viewShowKapus',$list)->render();
            $output['data'] = $view;
          echo json_encode($output);


     }
    public function showAjaxEselon(){
          $id_rapat = Input::get('id');
          $query = RP::getShow($id =15,$id_rapat);
          $list =[];
          foreach ($query as $key => $value) {
              $data['infant_eselon'] =SC::getInviteInfant($value->id_rapat);
              $data['undang_eselon'] =SC::getInviteUndang($value->id_rapat);
              $data['name_infant'] =IN::getInviteInfant($value->id_rapat);
              $data['disposisi_rapat'] =IN::getInviteUndang($value->id_rapat);
              $data['name_eselon'] =SC::getInviteEselon($value->id_rapat);

          $list['data'][] =$data;
          }
            $view = view('viewShowEselon',$list)->render();
            $output['data'] = $view;
          echo json_encode($output);


     }
     public function indexAjaxEselon(){
        //  echo "<pre>";
        //  print_r(Input::all());die;
         $draw=$_REQUEST['draw'];
         $length=$_REQUEST['length'];
         $start=$_REQUEST['start'];
         $search=$_REQUEST['search']["value"];
         $listWajib = new RP;
         // ======= count ===== //
         $queryCount = RP::getAllCount($id =15);
         $total = count($queryCount);
         // ======= count ===== //
         $output=array();
         $output['draw']=$draw;
         $output['recordsTotal']=$output['recordsFiltered']= $total;
         $output['data']=array();
         $query = RP::getAll($id =15);
         $list = [];
         foreach ($query as $key => $row) {
             $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
             $waktu = date('H:i:s', strtotime($row->start_tgl_rapat));
             $hari =date('w',strtotime($row->start_tgl_rapat));
             $day ="";
                 if ($hari == 1) {
                     $day ="Senin";
                 }elseif ($hari ==2) {
                     $day ="Selasa";
                 }elseif($hari ==3){
                     $day ="Rabu";
                 }elseif ($hari ==4) {
                     $day ="Kamis";
                 }elseif($hari == 5){
                     $day ="Jumat";
                 }elseif($hari ==6){
                     $day ="Sabtu";
                 }elseif ($hari == 0) {
                     $day ="Minggu";
                 }
             $tempat = "";
             if (!empty($row->tempat_rapat)) {
                 $tempat = $row->tempat_rapat;

         }else{
             $tempat = $row->name_ruangan;
         }
         $json['agenda_rapat'] = $row->agenda_rapat;
         $json['pj_rapat'] = $row->pj_rapat;
         $json['start_tgl_rapat'] =$day .", ". $start;
         $json['waktu'] = $waktu;
         $json['tempat_rapat'] = $tempat;
         $json['id_rapat'] = $row->id_rapat;
         $infant_eselon =SC::getInviteInfant($row->id_rapat);
         $infant_biasa =IN::getInviteInfant($row->id_rapat);
         $pejabat_eselon =SC::getInviteUndang($row->id_rapat);
         $name_eselon =SC::getInviteEselon($row->id_rapat);
         $eselon ="";
         if (!empty($pejabat_eselon) OR !empty($name_eselon) OR !empty($infant_eselon)) {
             $eselon ="<ol>";
             if (!empty($name_eselon)) {
                 foreach ($name_eselon as $k => $v) {
                     $eselon .= "<li>";
                     $eselon .= $v->name_pic." ";
                     $eselon .= "</li>";
                 }
             }
             if (!empty($pejabat_eselon)) {
             foreach ($pejabat_eselon as $key => $value) {
                 $eselon .= "<li>";
                 $eselon .= $value->name_pic." ";
                 $eselon .= "</li>";
                 }
             }
             if (!empty($infant_eselon)) {
             foreach ($infant_eselon as $keys => $values) {
                 $eselon .= "<li>";
                 $eselon .= $values->name_pic." ";
                 $eselon .= "</li>";
                 }
             }
             $eselon .="</ol>";
         }
         $data_infant ="";
              $data_infant ="<ol>";
             if (!empty($infant_biasa)) {
                 foreach ($infant_biasa as $k => $v) {
                     $data_infant .= "<li>";
                     $data_infant .= $v->disposisi_rapat." ";
                     $data_infant .= "</li>";
                 }
             }

             $data_infant .="</ol>";
             $json['name_eselon'] =$eselon;
             $json['infant_biasa'] =$data_infant;
             $list[] = $json;
         }

     $output['data']  = $list;
     echo json_encode($output);

 }
     public function indexAjaxKapus(){
         $draw=$_REQUEST['draw'];
         $length=$_REQUEST['length'];
         $start=$_REQUEST['start'];
         $search=$_REQUEST['search']["value"];
         // ======= count ===== //
         $queryCount =RP::getAllCount($id =14);
         $query = RP::getAll($id =14);
         $total=count($queryCount);
         // ======= count ===== //

         $output=array();
         $output['draw']=$draw;
         $output['recordsTotal']=$output['recordsFiltered']=$total;
         $output['data']=array();
         $list = [];
         foreach ($query as $key => $row) {
             $start = date('d-m-Y',strtotime($row->start_tgl_rapat));
             $waktu = date('H:i:s', strtotime($row->start_tgl_rapat));
             $hari =date('w',strtotime($row->start_tgl_rapat));
             $day ="";
                 if ($hari == 1) {
                     $day ="Senin";
                 }elseif ($hari ==2) {
                     $day ="Selasa";
                 }elseif($hari ==3){
                     $day ="Rabu";
                 }elseif ($hari ==4) {
                     $day ="Kamis";
                 }elseif($hari == 5){
                     $day ="Jumat";
                 }elseif($hari ==6){
                     $day ="Sabtu";
                 }elseif ($hari == 0) {
                     $day ="Minggu";
                 }
             $tempat = "";
             if (!empty($row->tempat_rapat)) {
                 $tempat = $row->tempat_rapat;

         }else{
             $tempat = $row->name_ruangan;
         }
         $json['agenda_rapat'] = $row->agenda_rapat;
         $json['pj_rapat'] = $row->pj_rapat;
         $json['start_tgl_rapat'] = $day.", ".$start;
         $json['waktu'] = $waktu;
         $json['tempat_rapat'] = $tempat;
         $json['id_rapat'] = $row->id_rapat;
         $infant_eselon =SC::getInviteInfant($row->id_rapat);
         $infant_biasa =IN::getInviteInfant($row->id_rapat);
         $data_infant ="";
         if (!empty($infant_eselon) OR !empty($infant_biasa)) {
             $data_infant ="<ol>";
             if (!empty($infant_biasa)) {
                 foreach ($infant_biasa as $k => $v) {
                     $data_infant .= "<li>";
                     $data_infant .= $v->disposisi_rapat." ";
                     $data_infant .= "</li>";
                 }
             }
             if (!empty($infant_eselon)) {
             foreach ($infant_eselon as $key => $value) {
                 $data_infant .= "<li>";
                 $data_infant .= $value->name_pic." ";
                 $data_infant .= "</li>";
                 }
             }
             $data_infant .="</ol>";
         }
         $json['infant'] = $data_infant;
         $list [] = $json;
     }

     $output['data']  = $list;
     echo json_encode($output);

 }
 public function indexAjaxRuangan(){
     $queryRuanganAll = RP::getShowAllRuangan();
     $draw=$_REQUEST['draw'];
     $length=$_REQUEST['length'];
     $start=$_REQUEST['start'];
     $search=$_REQUEST['search']["value"];
     // ======= count ===== //
     $count = count($queryRuanganAll);
     // ======= count ===== //

     $output=array();
     $output['draw']=$draw;
     $output['recordsTotal']=$output['recordsFiltered']=$count;
     $output['data']=array();
     $status =[];
     foreach ($queryRuanganAll as $key => $value) {

         $data['ruangan'] = $value->name_ruangan ;
         $data['kapasitas'] = $value->max_ruangan;
         $data['showIsi'] =RP::getShowRuangan($value->id_ruangan);
          if (empty($data['showIsi'])) {
              $data['status'] ="Kosong";

          }else {
              $data['status'] ="Terisi";
          }
          if ($data['status']== "Terisi") {
              $start ="<ol>";
              $keterangan ="<ol>";
                foreach ($data['showIsi'] as $key => $value) {
                    $hari =date('w',strtotime($value->start_tgl_rapat));
                    $day ="";
                        if ($hari == 1) {
                            $day ="Senin";
                        }elseif ($hari ==2) {
                            $day ="Selasa";
                        }elseif($hari ==3){
                            $day ="Rabu";
                        }elseif ($hari ==4) {
                            $day ="Kamis";
                        }elseif($hari == 5){
                            $day ="Jumat";
                        }elseif($hari ==6){
                            $day ="Sabtu";
                        }elseif ($hari == 0) {
                            $day ="Minggu";
                        }
                    $hariE =date('w',strtotime($value->end_tgl_rapat));
                    $dayE ="";
                        if ($hariE == 1) {
                            $dayE ="Senin";
                        }elseif ($hariE ==2) {
                            $dayE ="Selasa";
                        }elseif($hariE ==3){
                            $dayE ="Rabu";
                        }elseif ($hariE ==4) {
                            $dayE ="Kamis";
                        }elseif($hariE == 5){
                            $dayE ="Jumat";
                        }elseif($hariE ==6){
                            $dayE ="Sabtu";
                        }elseif ($hariE == 0) {
                            $dayE ="Minggu";
                        }
                    $start .="<li>";
                    $start .= $day.", ".date("d-m-Y H:i:s", strtotime($value->start_tgl_rapat))." s/d ".$dayE.", ".date("d-m-Y H:i:s", strtotime($value->end_tgl_rapat));
                    $start .="</li>";
                    $keterangan .= "<li>";
                    $keterangan .= $value->agenda_rapat;
                    $keterangan .= "</li>";
                }
                $start .="</ol>";
                $keterangan .="</ol>";
            $data['waktu'] = $start;
            $data['keterangan'] = $keterangan;
        }else{
            $data['keterangan'] = "-";
            $data['waktu'] = "-";
        }

      $output['data'][]=$data;
     }
     echo json_encode($output);
 }

}
