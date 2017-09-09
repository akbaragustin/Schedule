<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;


class Invite_name extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'Invite_name';
    protected $primaryKey = 'id_invite_name';
    public $timestamps = false;
    protected $fillable = ['id_invite_name', 'id_rapat', 'disposisi_rapat'];

     public static function getInvite($id_rapat){
      	$query = " select * from Invite_name 
					where Invite_name.id_rapat =".$id_rapat." ";
            

		  $listData = \DB::select($query);
      	 return $listData;


      }
}
