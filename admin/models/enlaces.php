<?php

class EnlacesModels{

	public static function enlacesModel($enlaces){

		if($enlaces == "inicio" ||
			 $enlaces == "asistencia" ||
		   $enlaces == "ingreso" ||
		   $enlaces == "registroUsuario" ||
		   $enlaces == "lostPassword"||
		   $enlaces == "propiedades" ||
		   $enlaces == "mis-propiedades" ||
		   $enlaces == "agrega-propiedad" ||
		   $enlaces == "edita-propiedad" ||
		   $enlaces == "mis-usuarios" ||
		   $enlaces == "agrega-usuario" ||
		   $enlaces == "edita-usuario" ||
		   $enlaces == "property" ||
		   //$enlaces == "perfil" ||
		   $enlaces == "salir"
		   ){

			$module = "views/modules/".$enlaces.".php";
		}

		else if($enlaces == "index"){
			$module = "views/modules/login.php";
		}

		else{
			$module = "views/modules/login.php";
		}

		return $module;

	}


}