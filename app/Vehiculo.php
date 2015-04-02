<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
	protected $table="vehiculos";
	protected $primaryKey='serie';
	protected $fillable = array('color','cilindraje','potencia','peso','fabricante_id');

	// Aquí ponemos los campos que no queremos que se devuelvan en las consultas.
	protected $hidden = ['created_at','updated_at']; 

	public function fabricante()
	{
		return $this->belongsTo('App\Fabricante');
	}
}