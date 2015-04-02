<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
	protected $table="fabricantes";
	protected $fillable = array('nombre','telefono');
	
	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 
	
	public function vehiculos()
	{
		return $this->hasMany('App\Vehiculo');
	}

}