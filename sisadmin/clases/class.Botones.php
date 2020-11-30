<?php
class Botones_permisos
{
	/*================================*
	*  Proyecto: AUTOBUSES AEXA		  *
	*  Compañia: CAPSE 				  *
	*  Fecha: 24/08/2019     		  *
	* I.S.C José Carlos Santillán     *
	*=================================*/
	
	
	/* ============== Declaración de variables ==============*/
	
	public $titulo;
	public $funcion;
	public $permiso;
	public $icon;
	public $estilos;
    public $title;
	
	 // 1 = guardar, 2 = modificar, 3 = eliminar 
	public $tipo;
	
	/*=======================================================*/
	/* ============ Inicia metodos de clase =================*/
	
	//Funcion que sirve para construir un boton de acuerdo a la configuracion de permisos
	public function armar_boton()
	{
		$permisos = explode("|",$this->permiso);
		 
		switch($this->tipo)
		{
			case 1:
					if($permisos[0] == 1){
?>
						<button type="button" onClick="<?php echo $this->funcion; ?>" class="btn btn-outline-primary" style="<?php echo $this->estilos; ?>" title="<?php echo $this->title; ?>">
<?php
							if($this->icon != ''){
?>
								<i class="mdi <?php echo $this->icon ?>"></i>
<?php
							}
							echo $this->titulo;
?>
						</button>

<?php
					}else{
						return;
					}
				break;
			case 2:
				if($permisos[1] == 1){
?>
						<button type="button" onClick="<?php echo $this->funcion; ?>" class="btn btn-outline-info" style="<?php echo $this->estilos; ?>" title="<?php echo $this->title; ?>">
<?php
							if($this->icon != ''){
?>
								<i class="mdi <?php echo $this->icon ?>"></i>
<?php
							}
							echo $this->titulo;
?>
						</button>

<?php
					}else{
						return;
					}
				break;
			case 3:
				if($permisos[2] == 1){
?>
						<button type="button" onClick="<?php echo $this->funcion; ?>" class="btn btn-outline-danger" style="<?php echo $this->estilos; ?>" title="<?php echo $this->title; ?>">
<?php
							if($this->icon != ''){
?>
								<i class="mdi <?php echo $this->icon ?>"></i>
<?php
							}
							echo $this->titulo;
?>
						</button>

<?php
					}else{
						return;
					}
				break;
		}		
	}
}
?>