<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;


class Rapat extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 't_rapat';
    protected $primaryKey = 'id_rapat';
    public $timestamps = false;
    protected $fillable = ['id_rapat', 'start_tgl_ruangan','end_tgl_ruangan','pj_rapat','infant_rapat','status_jabtan_rapat', 'id_ruangan', 'agenda_rapat', 'creator', 'created', 'editor', 'edited'];

     public static function getAll($status)
    {
        $id_user = \Session::get('auth');
        $input = Input::get('search.value');
        $get = Input::all();
        $where = "where invite_jabatan.id_jabatan = ".$status."";
      /*  if (!empty($input)) {
            $where = " WHERE pay like '%".$input."%' OR total like '%".$input."%' ";
        }

        if (!empty($get['name_jabatan'])) {
            if (!empty($where)) {
                $where .= " or name_ruangan  like '%".$get['name_ruangan']."%'";
            } else {
                $where .= " WHERE name_ruangan like '%".$get['name_ruangan']."%'";
            }
            if (!empty($where)) {
                $where .= " or name_ruangan  like '%".$get['name_ruangan']."%'";
            } else {
                $where .= " WHERE name_ruangan like '%".$get['name_ruangan']."%'";
            }
        }
*/
        // if (!empty($id_user['id_user'])) {
        //     if (!empty($where)) {
        //         $where .= " and id_user = ".$id_user['id_user'];
        //     } else {
        //         $where .= " WHERE id_user = ".$id_user['id_user'];
        //     }
        // }




        // limit 10 OFFSET 1
        $start = Input::get('start');
        $length = Input::get('length');
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        $query = " select * from t_rapat 
					Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
					Left JOIN invite_jabatan on invite_jabatan.id_rapat = t_rapat.id_rapat
    								
					where invite_jabatan.id_jabatan = ".$status."
                ".$limit."
                ";
        $listData = \DB::select($query);
      	 return $listData;
      }

      public static function getShow($id_jabatan,$id_rapat){
        $query = " select * from t_rapat 
                    Left JOIN ruangan on ruangan.id_ruangan = t_rapat.id_ruangan
                    where t_rapat.id_rapat =".$id_rapat." ";
            

          $listData = \DB::select($query);
         return $listData;


      }

}
