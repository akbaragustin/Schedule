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
    protected $fillable = ['id_schedule', 'id_rapat', 'id_user'];

     public static function getInvite($id_rapat){
      	$query = " select schedule.id_schedule,users.name_pic,users.id_unit_kerja from schedule 
					LEFT JOIN users ON schedule.id_user = users.id_user
					where schedule.id_rapat =".$id_rapat." ";
            

		  $listData = \DB::select($query);
      	 return $listData;


      }


}
