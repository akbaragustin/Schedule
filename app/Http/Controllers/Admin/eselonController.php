<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use App\Models\Ruangan as RU;
use App\Models\Invite_name as IN;
use App\Models\Invite_jabatan as IJ;
use App\Models\Rapat as RP;
use App\Models\Schedule as SC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class eselonController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data['name_pic'] = US::all()->toArray();
        $data['allRuangan'] = RU::all()->toArray();
       return view('admin/eselon',$data);
    }
    public function searchAjax()
    {
      $isiSearch =Input::get('q.term');
      $query = US::getName_pic($isiSearch);
        $list =[];
            foreach ($query as $key => $value) {

                $json['id'] = $value->id_user;
                $json['text'] = $value->name_pic;
                $list[] =$json;
            }

        echo json_encode($list);

     }


    public function save()
    {

        $start =date("Y-m-d H:i:s",strtotime(substr(Input::get('start_tgl_rapat'), 0,-3).":00"));
        $end = date("Y-m-d H:i:s",strtotime(substr(Input::get('end_tgl_rapat'), 0,-3).":00"));
        $s = strtotime(substr(Input::get('start_tgl_rapat'), 0,-3).":00");
        $e = strtotime(substr(Input::get('end_tgl_rapat'), 0,-3).":00");

        if ($s >  $e ) {
            \Session::flash('insertFailsdate','gagal');
            return \Redirect::to(route('eselon.index'));
        }
        if (!empty (Input::get('ruangan_rapat'))) {
            $data['start'] =$start;
            $data['end'] =$end;
            $data['ruangan'] =Input::get('ruangan_rapat');
            $checkRuangan =RP::checkRuangan($data);

            if (!empty($checkRuangan)) {

                 \Session::flash('insertFailsRuangan','gagal');
             return \Redirect::to(route('eselon.index'));
            }

        }
        $rules=[
            'name_pic'=>'required',
            'start_tgl_rapat'=>'required',
            'end_tgl_rapat'=>'required',
            'agenda_rapat'=>'required',
            'status_ruangan_rapat'=>'required'
             ];
        $messages=[
            'name_pic.required'=>config('constants.ERROR_JML_WAJIB'),
            'start_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'end_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'agenda_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'status_ruangan_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
          ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
        $eselon =new RP;
        $eselon->agenda_rapat =Input::get('agenda_rapat');
        $eselon->pj_rapat =Input::get('pj_rapat');
        $eselon->start_tgl_rapat =$start;
        $eselon->end_tgl_rapat =$end;
        $eselon->status_ruangan_rapat =Input::get('status_ruangan_rapat');
        $eselon->tempat_rapat =Input::get('tempat_rapat');
        $eselon->id_ruangan =Input::get('ruangan_rapat');
        $eselon->status_active_rapat =1;
        $eselon->save();
        $last_id = $eselon->id_rapat;
        //Insert Eselon Name
        $name_pic = Input::get('name_pic');
            foreach ($name_pic as $key => $value) {
                $schedule = new SC;
                $schedule ->id_rapat = $last_id;
                $schedule ->id_user = $value;
                $schedule ->status_jabatan = 1;
                $schedule->save();
            }
            //Insert Infant Nama Bebas (No Db)
            $name_infant = Input::get('name_infant');
            if (!empty($name_infant)) {
                foreach ($name_infant as $key => $value) {
                    $invite_name = new IN;
                    $invite_name ->id_rapat = $last_id;
                    $invite_name ->disposisi_rapat = $value;
                    $invite_name ->status_jabatan = 2;
                    $invite_name->save();
                }
            }
        $invite_jabatan = new IJ;
        $invite_jabatan ->id_rapat =$last_id;
        $invite_jabatan ->id_jabatan =15;
        $invite_jabatan->save();

         \Session::flash('insertSuccess', 'BERHASIL');
           return \Redirect::to(route('eselon.index'));
          } else {
            \Session::flash('insertError', 'Gagal Menambahkan!');
           return \Redirect::to(route('eselon.index'));
        }
    }
    public function indexAjax(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $queryCount =RP::getAllCount($id =15);
        
        // ======= count ===== //
        $total =count($queryCount);
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = RP::getAll($id =15);

        $list = [];
        foreach ($query as $key => $row) {
            $start = date('d-m-Y H:i:s',strtotime($row->start_tgl_rapat));
            $end = date('d-m-Y H:i:s',strtotime($row->end_tgl_rapat));
            $json['agenda_rapat'] = $row->agenda_rapat;
            $json['start_tgl_rapat'] = $start;
            $json['end_tgl_rapat'] = $end;
            $json['status_ruangan_rapat'] = $row->status_ruangan_rapat;
            if (!empty($row->name_ruangan)) {
                    $json['tempat_rapat'] = $row->name_ruangan;
            }else{
                    $json['tempat_rapat'] = $row->tempat_rapat;
            }
            $json['pj_rapat'] = $row->pj_rapat;
            $json['id_rapat'] = $row->id_rapat;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);

    }

    public function delete($id_rapat){
        $schedule = SC::where('id_rapat',$id_rapat);
        $schedule->delete();
        $invite_name = IN::where('id_rapat',$id_rapat);
        $invite_name->delete();
        $invite_jabatan = IJ::where('id_rapat',$id_rapat);
        $invite_jabatan->delete();
       $eselon = RP::find($id_rapat);
       $eselon->delete();
       \Session::flash('insertSuccess', 'BERHASIL');
       return \Redirect::to(route('eselon.index'));


    }
    public function edit($id_rapat){

        $update = RP::getShow($id =15,$id_rapat);
        $data   = [];
        $data['name_pic'] = US::all()->toArray();
        $data['allRuangan'] = RU::all()->toArray();
        $data['data'] = RU::all();
        foreach ($update as $key => $row) {
                 $start = date('d-m-Y H:i:s',strtotime($row->start_tgl_rapat));
            $end = date('d-m-Y H:i:s',strtotime($row->end_tgl_rapat));
            $data['agenda_rapat'] = $row->agenda_rapat;
            $data['pj_rapat'] = $row->pj_rapat;
            $data['start_tgl_rapat'] = $start;
            $data['end_tgl_rapat'] = $end;
            $data['status_ruangan_rapat'] = $row->status_ruangan_rapat;
            $data['id_ruangan'] = $row->id_ruangan;
            $data['tempat_rapat'] = $row->tempat_rapat;
            $data['name_eselon'][] = SC::getInviteEselon($row->id_rapat);
            $data['name_infant'][] = IN::getInviteInfant($row->id_rapat);
            $data['id_rapat'] = $row->id_rapat;

        }
       return view('admin/eselon',$data);
    }

    public function update (){
        $start =date("Y-m-d H:i:s",strtotime(substr(Input::get('start_tgl_rapat'), 0,-3).":00"));
        $end = date("Y-m-d H:i:s",strtotime(substr(Input::get('end_tgl_rapat'), 0,-3).":00"));
        $s = strtotime(substr(Input::get('start_tgl_rapat'), 0,-3).":00");
        $e = strtotime(substr(Input::get('end_tgl_rapat'), 0,-3).":00");

        if ($s >  $e ) {
            \Session::flash('insertFailsdate','gagal');
            return \Redirect::to(route('eselon.index'));
        }
        if (!empty (Input::get('ruangan_rapat'))) {
            $data['start'] =$start;
            $data['end'] =$end;
            $data['ruangan'] =Input::get('ruangan_rapat');
            $checkRuangan =RP::checkRuangan($data);

            if (!empty($checkRuangan)) {

                 \Session::flash('insertFailsRuangan','gagal');
             return \Redirect::to(route('eselon.index'));
            }

        }
         $rules=[
            'name_pic'=>'required',
            'start_tgl_rapat'=>'required',
            'end_tgl_rapat'=>'required',
            'agenda_rapat'=>'required',
            'status_ruangan_rapat'=>'required'
             ];
        $messages=[
            'name_pic.required'=>config('constants.ERROR_JML_WAJIB'),
            'start_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'end_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'agenda_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'status_ruangan_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
          ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
            $invite_name = IN::where('id_rapat',input::get('update'));
            $invite_name->delete();
            $schedule = SC::where('id_rapat',input::get('update'));
            $schedule->delete();
            $invite_jabatan = IJ::where('id_rapat',input::get('update'));
            $invite_jabatan->delete();

                $eselon = RP::find(Input::get('update'));
                $eselon->agenda_rapat =Input::get('agenda_rapat');
                $eselon->pj_rapat =Input::get('pj_rapat');
                $eselon->start_tgl_rapat =$start;
                $eselon->end_tgl_rapat =$end;
                $eselon->status_ruangan_rapat =Input::get('status_ruangan_rapat');
                $eselon->tempat_rapat =Input::get('tempat_rapat');
                $eselon->id_ruangan =Input::get('ruangan_rapat');
                $eselon->update();
             $last_id = $eselon->id_rapat;
             //Insert Eselon Name
             $name_pic = Input::get('name_pic');
                 foreach ($name_pic as $key => $value) {
                     $schedule = new SC;
                     $schedule ->id_rapat = $last_id;
                     $schedule ->id_user = $value;
                     $schedule ->status_jabatan = 1;
                     $schedule->save();
                 }
                 //Insert Infant Nama Bebas (No Db)
                 $name_infant = Input::get('name_infant');
                 if (!empty($name_infant)) {
                     foreach ($name_infant as $key => $value) {
                         $invite_name = new IN;
                         $invite_name ->id_rapat = $last_id;
                         $invite_name ->disposisi_rapat = $value;
                         $invite_name ->status_jabatan = 2;
                         $invite_name->save();
                     }
                 }
        $invite_jabatan = new IJ;
        $invite_jabatan ->id_rapat =$last_id;
        $invite_jabatan ->id_jabatan =15;
        $invite_jabatan->save();


                 \Session::flash('insertSuccess', 'BERHASIL');
                return \Redirect::to(route('eselon.index'));
             } else {
            \Session::flash('insertError', 'Gagal Merubah!');
            return \Redirect::to(route('eselon.index'));
        }
    }

        public function showAjax(){
              $id_rapat = Input::get('id_rapat');
              $query = RP::getShow($id =14,$id_rapat);
              $list =[];
              foreach ($query as $key => $value) {
                  $data['agenda_rapat'] =$value->agenda_rapat;
                  $data['start_tgl_rapat'] =$value->start_tgl_rapat;
                  $data['end_tgl_rapat'] =$value->end_tgl_rapat;
                  $data['status_ruangan_rapat'] =$value->status_ruangan_rapat;
                  $data['ruangan_rapat'] =$value->name_ruangan;
                  $data['tempat_rapat'] =$value->tempat_rapat;
                  $data['pj_rapat'] =$value->pj_rapat;
                  $data['infant_eselon'] =SC::getInviteInfant($value->id_rapat);
                  $data['undang_eselon'] =SC::getInviteUndang($value->id_rapat);
                  $data['name_infant'] =IN::getInviteInfant($value->id_rapat);
                  $data['disposisi_rapat'] =IN::getInviteUndang($value->id_rapat);
                  $data['name_eselon'] =SC::getInviteEselon($value->id_rapat);
              $list['data'][] =$data;
              }
             return view('admin/viewShowEselon',$list);
         }
   public function showRuangan(){
       $queryRuanganAll = RP::getShowAllRuangan();
       $status =[];
       $list =[];
       $data['tanggalM'] = date("Y-m-d ",strtotime(substr(Input::get('waktuM'), 0,-3).":00"));
       $data['tanggalA'] = date("Y-m-d ",strtotime(substr(Input::get('waktuA'), 0,-3).":00"));

       foreach ($queryRuanganAll as $key => $value) {
           $data['keterangan'] = "-";
           $data['waktu'] = "-";
           $data['ruangan'] = $value->name_ruangan ;
           $data['kapasitas'] = $value->max_ruangan;
           $data['showIsi'] =RP::getShowRuangan($value->id_ruangan);
            if (empty($data['showIsi'])) {
                $data['status'] ="Kosong";

            }else {
                $data['status'] ="Terisi";
            }

        $list['data'][]=$data;
       }

       return view('admin/kapusShow',$list);
   }
  }
