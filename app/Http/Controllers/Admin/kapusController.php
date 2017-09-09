<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\User as US;
use App\Models\Ruangan as RU;
use App\Models\Invite_name as IN;
use App\Models\Invite_Jabatan as IJ;
use App\Models\Rapat as RP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class kapusController extends Controller
{
    private $parser = array();
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['allRuangan'] = RU::all()->toArray();
       return view('admin/kapus',$data);
    }   
    
    public function save()
    {
        $start = date('Y-m-d H:i:s',strtotime(Input::get('start_tgl_rapat')));
        $end = date('Y-m-d H:i:s',strtotime(Input::get('end_tgl_rapat')));
        $rules=[
            'start_tgl_rapat'=>'required',
            'end_tgl_rapat'=>'required',
            'agenda_rapat'=>'required',
            'status_ruangan_rapat'=>'required'
             ];
        $messages=[
            'start_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'end_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'agenda_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'status_ruangan_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
          ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {
        $eselon =new RP;
        $eselon->agenda_rapat =Input::get('agenda_rapat');
        $eselon->start_tgl_rapat =$start;
        $eselon->end_tgl_rapat =$end;
        $eselon->status_ruangan_rapat =Input::get('status_ruangan_rapat');
        if (!empty(Input::get('tempat_rapat'))) {
        $eselon->tempat_rapat =Input::get('tempat_rapat');
          
        }
        $eselon->pj_rapat =Input::get('pj_rapat');
        $eselon->status_active_rapat =1;
        $eselon->id_ruangan =Input::get('ruangan_rapat');
        $eselon->infant_rapat =Input::get('infant_rapat');
        $eselon->save();

        $last_id = $eselon->id_rapat;
        $disposisi_rapat = Input::get('disposisi_rapat');
            foreach ($disposisi_rapat as $key => $value) {
                $invite_name = new IN;
                $invite_name ->id_rapat = $last_id;
                $invite_name ->disposisi_rapat = $value;
                $invite_name->save();
            }
        $invite_jabatan = new IJ;
        $invite_jabatan ->id_rapat =$last_id;
        $invite_jabatan ->id_jabatan =14;
        $invite_jabatan->save();

         \Session::flash('insertSuccess', 'BERHASIL');
           return \Redirect::to(route('kapus.index'));
          } else {
            \Session::flash('insertError', 'Gagal Menambahkan!');
           return \Redirect::to(route('kapus.index'));      
        }          
    } 
    public function indexAjax(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $listJabatan = new RU;
        // ======= count ===== //
        $total=RU::count();
        // ======= count ===== //

        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();
        $query = RP::getAll($id =14);

        $list = [];
        foreach ($query as $key => $row) {
            $start = date('d-m-Y H:i:s',strtotime($row->start_tgl_rapat));
            $end = date('d-m-Y H:i:s',strtotime($row->end_tgl_rapat));
            $json['agenda_rapat'] = $row->agenda_rapat;
            $json['pj_rapat'] = $row->agenda_rapat;
            $json['start_tgl_rapat'] = $start;
            $json['end_tgl_rapat'] = $end;
            $json['status_ruangan_rapat'] = $row->status_ruangan_rapat;
            $json['ruangan_rapat'] = $row->name_ruangan;
            $json['tempat_rapat'] = $row->tempat_rapat;
            $json['infant_rapat'] = $row->infant_rapat;
            $json['id_rapat'] = $row->id_rapat;
            $list[] = $json;
        }

        $output['data']  = $list;
        echo json_encode($output);

    }

    public function delete($id_rapat){
        $invite_name = IN::where('id_rapat',$id_rapat);
        $invite_name->delete(); 
        $invite_jabatan = IJ::where('id_rapat',$id_rapat);
        $invite_jabatan->delete(); 
       $eselon = RP::find($id_rapat);
       $eselon->delete();
       return \Redirect::to(route('kapus.index'));


    }
    public function edit($id_rapat){
       
        $update = RP::getShow($id =14,$id_rapat);
        $data   = [];
        $data['allRuangan'] = RU::all()->toArray();
        $data['data'] = RU::all();
        foreach ($update as $key => $row) {
                 $start = date('d-m-Y H:i:s',strtotime($row->start_tgl_rapat));
            $end = date('d-m-Y H:i:s',strtotime($row->end_tgl_rapat));
            $data['agenda_rapat'] = $row->agenda_rapat;
            $data['start_tgl_rapat'] = $start;
            $data['end_tgl_rapat'] = $end;
            $data['status_ruangan_rapat'] = $row->status_ruangan_rapat;
            $data['id_ruangan'] = $row->id_ruangan;

            $data['pj_rapat'] = $row->pj_rapat;
            $data['tempat_rapat'] = $row->tempat_rapat;
            $data['infant_rapat'] = $row->infant_rapat;
            $data['disposisi_rapat'][] = IN::getInvite($row->id_rapat);;
            $data['id_rapat'] = $row->id_rapat;
            
        }
       return view('admin/kapus',$data);
    }
     
    public function update (){
          $start = date('Y-m-d H:i:s',strtotime(Input::get('start_tgl_rapat')));
        $end = date('Y-m-d H:i:s',strtotime(Input::get('end_tgl_rapat')));

         $rules=[
            'start_tgl_rapat'=>'required',
            'end_tgl_rapat'=>'required',
            'agenda_rapat'=>'required',
            'status_ruangan_rapat'=>'required'
             ];
        $messages=[
            'start_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'end_tgl_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'agenda_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
             'status_ruangan_rapat.required'=>config('constants.ERROR_JML_WAJIB'),
          ];
           $validator=Validator::make(Input::all(), $rules, $messages);
           if ($validator->passes()) {   
            $invite_name = IN::where('id_rapat',input::get('update'));
            $invite_name->delete();
            $invite_jabatan = IJ::where('id_rapat',input::get('update'));
            $invite_jabatan->delete();
                
                $eselon = RP::find(Input::get('update'));
                $eselon->agenda_rapat =Input::get('agenda_rapat');
                $eselon->start_tgl_rapat =$start;
                $eselon->end_tgl_rapat =$end;
                $eselon->status_ruangan_rapat =Input::get('status_ruangan_rapat');
                $eselon->pj_rapat =Input::get('pj_rapat');
                $eselon->tempat_rapat =Input::get('tempat_rapat');
                $eselon->id_ruangan =Input::get('ruangan_rapat');
                $eselon->infant_rapat =Input::get('infant_rapat');
                $eselon->update();
             $last_id = $eselon->id_rapat;
             $disposisi_rapat = Input::get('disposisi_rapat');
            foreach ($disposisi_rapat as $key => $value) {
                $invite_name = new IN;
                $invite_name ->id_rapat = $last_id;
                $invite_name ->disposisi_rapat = $value;
                $invite_name->save();
            }
        $invite_jabatan = new IJ;
        $invite_jabatan ->id_rapat =$last_id;
        $invite_jabatan ->id_jabatan =14;
        $invite_jabatan->save();


                 \Session::flash('insertSuccess', 'BERHASIL');
                return \Redirect::to(route('kapus.index'));
             } else {
            \Session::flash('insertError', 'Gagal Merubah!');
            return \Redirect::to(route('kapus.index'));      
        }          
      }
     
     
  public function showAjax(){
        $id_rapat = Input::get('id');
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
            $data['infant_rapat'] =$value->infant_rapat;
            $data['disposisi_rapat'][] =IN::getInvite($value->id_rapat);;
        $list =$data; 
        }

        echo json_encode($list);
        

   }
            
}
