<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Schedule extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'schedule';
    protected $primaryKey = 'id_schedule';
    public $timestamps = false;
    protected $fillable = ['id_schedule', 'id_rapat', 'id_user','status_jabatan'];

     public static function getInvite($id_rapat){
      	$query = " select schedule.id_schedule,users.name_pic,users.id_unit_kerja from schedule
					LEFT JOIN users ON schedule.id_user = users.id_user
					where schedule.id_rapat =".$id_rapat." ";


		  $listData = \DB::select($query);
      	 return $listData;


      }
      public static function getInviteInfant($id_rapat){
          $infant =2;
          $query ="select schedule.id_schedule,schedule.id_user,users.name_pic,users.id_unit_kerja,master_unit_kerja.name_unit_kerja from schedule
  					LEFT JOIN users ON schedule.id_user = users.id_user
  					LEFT JOIN master_unit_kerja ON users.id_unit_kerja = master_unit_kerja.id_unit_kerja
  					where schedule.id_rapat =".$id_rapat." AND status_jabatan = ".$infant." ";
        $listData = \DB::select($query);
    	 return $listData;
      }
      public static function getInviteUndang($id_rapat){
          $infant =3;
          $query ="select schedule.id_schedule,schedule.id_user,users.name_pic,users.id_unit_kerja,master_unit_kerja.name_unit_kerja from schedule
  					LEFT JOIN users ON schedule.id_user = users.id_user
                    LEFT JOIN master_unit_kerja ON users.id_unit_kerja = master_unit_kerja.id_unit_kerja
  					where schedule.id_rapat =".$id_rapat." AND status_jabatan = ".$infant." ";
        $listData = \DB::select($query);
    	 return $listData;
      }
      public static function getInviteEselon($id_rapat){
          $infant =1;
          $query ="select schedule.id_schedule,schedule.id_user,users.name_pic,users.id_unit_kerja,master_unit_kerja.name_unit_kerja from schedule
  					LEFT JOIN users ON schedule.id_user = users.id_user
                    LEFT JOIN master_unit_kerja ON users.id_unit_kerja = master_unit_kerja.id_unit_kerja
  					where schedule.id_rapat =".$id_rapat." AND status_jabatan = ".$infant." ";
        $listData = \DB::select($query);
    	 return $listData;
      }
      public static function checkData($id_rapat){
          $query ="Select * from schedule where id_rapat='".$id_rapat."'";
          $listData = \DB::select($query);
      	 return $listData;
      }
}
