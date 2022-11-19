<?php
session_start();
class Ingreso{

	public static function ingresoController(){

		if(isset($_POST["usuarioIngreso"]) && isset($_POST["passwordIngreso"])){

				$userPass = $_POST["passwordIngreso"];

				$datosController = array("email"=>$_POST["usuarioIngreso"]);

				$respuesta = IngresoModels::ingresoModel($datosController, "usuarios");

				if ($respuesta ){
					if($respuesta["estado"] == "1")
					{
						if (password_verify($userPass, $respuesta["password"] )) {
							$_SESSION["estado"] = true;
							$_SESSION["id"] = $respuesta["id"];
							$_SESSION["permisos"] = $respuesta["permisos"];
							$_SESSION["email"] = $respuesta["email"];
							$_SESSION["nombre"] = $respuesta["nombres"];
							$_SESSION["foto"] = $respuesta["foto"];
							//$_SESSION["perfil"] = $respuesta["perfil"];
							if ($respuesta["permisos"] == 'admin')
							{
								echo '<script>window.location="admin/index.php?page=inicioAdmin";</script>';
							}
							else if ($respuesta["permisos"] == 'cashier')
							{
								echo '<script>window.location="cashier";</script>';
							}
							else if ($respuesta["permisos"] == 'host')
							{
								echo '<script>window.location="hosts/";</script>';
							}
						}
						else 
						{	
							echo '<div class="alert alert-danger text-center">Verifique su usuario y/o password</div>';
						}
					}
					else
					{
						echo '<div class="alert alert-danger text-center">Usuario Inactivo <br> Contacte al administrador del sistema</div>';
					}
				} 
				else 
				{
					echo '<div class="alert alert-danger text-center">Usuario No Registrado <br> Contacte al administrador del sistema</div>';
				}
				

		}// si se capturo usuarioIngreso

	} // function Ingreso

} //Class