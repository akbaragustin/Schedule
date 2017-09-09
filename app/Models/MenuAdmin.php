<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MenuAdmin extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'menu_admin';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;
    protected $fillable = ['id_menu', 'leve_menu', 'parent_menu', 'position_menu', 'url_menu', 'icon_menu', 'name_menu', 'created', 'creator', 'edited', 'editor'];

}
