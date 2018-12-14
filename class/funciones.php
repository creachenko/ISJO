<?php
require_once "conexionbd.php";

class funcionesBD extends conexionBD{

	public function __construct(){
       parent:: __construct();

	}


/*esta funcion es para hacer la conexion a la base de datos*/
  public function conexion(){
        return $this->bd;

   }

	 //funcion para registrar usuarios
			 public function registroUsuario(){

			 $ing=" SELECT idEmpleado from usuario where idEmpleado='".$_POST["idEmpleado"]."'";
			 $respuesta =$this->bd->query($ing);
					 if (mysqli_num_rows($respuesta)==0){
			 $query="INSERT into usuario VALUES (not null ,'".$_POST["idEmpleado"]."','".$_POST["nombre"]."','".md5($_POST["pass"])."','".($_POST["idNivelAcceso"])."')";
			 $this->bd->query($query);
						echo '<script type="text/javascript">alert("Usted se ha registrado correctamente");window.location="index.php";</script>';
			 }
			 else{
			 echo '<script type="text/javascript">alert("El empleado ya tiene un usuario");window.location="nuevoUsuario.php";</script>';
			 }}

	 //

	 public function passEstablecida($idEmpleado){
		 $sql = "SELECT * FROM usuario WHERE idEmpleado = '$idEmpleado'";
		 $resp = $this->bd->query($sql);
		 return  mysqli_num_rows($resp);
	 }

	 public function questions(){
		 $sql="SELECT * FROM sq WHERE idEmpleado = '".$_POST["idempleado"]."'";
		 return $this->bd->query($sql);
	 }


	 public function verificar_questions(){
		 $sql = "SELECT empleados.idEmpleado, sq.respuesta1, sq.respuesta2, sq.respuesta3, sq.idEmpleado FROM empleados
		 INNER JOIN sq ON
		 empleados.idEmpleado= sq.idEmpleado
		 WHERE respuesta1 = '".$_POST["question1"]."' and respuesta2 = '".$_POST["question2"]."' and respuesta3 = '".$_POST["question3"]."'";
		 return $this->bd->query($sql);
	 }


	 public function vertarif(){
		 $sql="SELECT empleados.idEmpleado, empleados.nombreEmpleado, empleados.apellidoEmpleado, cargos.idCargo, cargos.nombreCargo FROM empleados
		 INNER JOIN cargos ON empleados.idCargo = cargos.idCargo
		 WHERE identidad = '".$_POST["identidad"]."' AND nombreCargo = 'Director'";
		 return $this->bd->query($sql);
	 }

	 public function verificar_empleado(){
		 $sql="SELECT * FROM empleados WHERE idEmpleado = '1'";
		 return $this->bd->query($sql);
	 }



	 public function obtenerNivelAccesos(){
		 $sql = "SELECT * FROM nivelacceso";

		 return $this->bd->query($sql);
	 }


	//funcion para loguearse
	 public function logueo2($a,$b){
	      $usuario = mysqli_real_escape_string($this->bd, $a);
	      $password = mysqli_real_escape_string($this->bd,md5($b));

	      $sql="SELECT * FROM usuario
				 			INNER JOIN empleados
							ON usuario.idEmpleado = empleados.idEmpleado
							WHERE nombreUsuario = '$usuario' AND contrasena = '$password'";
				$resp = $this->bd->query($sql);



				if ($resp->num_rows > 0) {
					session_start();
					$aux = $resp->fetch_assoc();
					$_SESSION['ses_id'] = $aux['idEmpleado'];
					$_SESSION['idUser'] = $aux['idUsuario'];
					$_SESSION['nombreUsuario'] = $aux['nombreEmpleado'];
					$_SESSION['nivelAcceso']=$aux['idNivelAcceso'];
					header('location:home.php');
				}else {
					echo "<script> alert('Usuario/Contraseña Incorrecta')</script>";
				}
	  }





	//Inicio FUNCIONES PARA LA GESTION DE Cargos
	public function obtenerCargos(){
		$query = "SELECT * FROM cargos";
		return $this->bd->query($query);
	}

	public function ingresarCargo($cargo,$descrip){
		$query = "INSERT INTO cargos (nombreCargo,descripcion) VALUES ('$cargo','$descrip')";
		$this->bd->query($query);
	}

	public function eliminarCargo($idCargo){
		$query = "DELETE FROM cargos WHERE idCargo = $idCargo";
		$this->bd->query($query);
	}

	public function editarCargo($idCargo,$nombreCargo){
		$query = "UPDATE cargos SET nombreCargo = '$nombreCargo' WHERE idCargo = $idCargo";
		$this->bd->query($query);
	}
	//final FUNCIONES PARA LA GESTIOS DE Cargos

	//INICIO FUNCIONES PARA GESTION Modalidades----------------------------------------------------
	public function insertarModalidad($nombreModalidad,$jornada){
		$sql="INSERT INTO modalidades (nombreModalidad,jornada) VALUES ('$nombreModalidad','$jornada')";
		$this->bd->query($sql);
		return $this->bd->insert_id;
	}
	public function insertarParcialesPorModalidad($a,$b,$c,$d){
		$sql="INSERT INTO parcialespormodalidad (nombreParcialPorModalidad,desde,hasta,idModalidad) VALUES ('$a','$b','$c',$d)";
		$this->bd->query($sql);
	}

	public function obtenerModalidades(){
		$query = "SELECT modalidades.idModalidad,nombreModalidad,jornada, COUNT(parcialespormodalidad.idParcialPorModalidad) AS parciales FROM modalidades INNER JOIN parcialespormodalidad ON modalidades.idModalidad = parcialespormodalidad.idModalidad GROUP BY idModalidad";
		return $this->bd->query($query);
	}

	public function eliminarModalidad($idModalidad){
		$query = "DELETE FROM modalidades WHERE idModalidad='$idModalidad'";
		$this->bd->query($query);
	}
	//FIN FUNCIONES PARA GESTION Modalidades----------------------------------------------------
	//INICIO FUNCIONES PARA GESTION Asignaturas----------------------------------------------------
	public function insertarAsignatura($a,$b,$c){
		$sql="INSERT INTO asignaturas (nombreAsignatura,descripcion,idModalidad) VALUES ('$a','$b','$c')";
		$this->bd->query($sql);
	}
	public function obtenerAsignaturas(){
		$sql="SELECT idAsignatura,nombreAsignatura,nombreModalidad FROM asignaturas
						INNER JOIN modalidades
						ON asignaturas.idModalidad = modalidades.idModalidad
						ORDER BY nombreModalidad";
		$resp = $this->bd->query($sql);

		if ($resp->num_rows == 0) {
			return "No hay datos para mostrar";
		}else {
			return $resp;
		}
		// $rows = $this->bd-num_rows($resp)
	}
	//FINAL FUNCIONES PARA GESTION Asignaturas----------------------------------------------------
	//INICIO FUNCIONES PARA GESTION Cursos----------------------------------------------------
	public function insertarCurso($a,$b,$c,$d){
		$sql="INSERT INTO cursos (nombreCurso,seccion,idModalidad,idAnioLectivo) VALUES ('$a','$b','$c','$d')";
		$this->bd->query($sql);
	}
	public function obtenerCursos(){
		$sql="SELECT idCurso,nombreCurso,seccion,nombreModalidad,anio FROM cursos INNER JOIN modalidades ON cursos.idModalidad = modalidades.idModalidad INNER JOIN aniolectivo ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo ";
		return $this->bd->query($sql);
	}


	public function eliminarCurso($idCurso){
		$query = "DELETE FROM cursos WHERE idCurso='$idCurso'";
		$this->bd->query($query);
	}
	public function editarCurso($a,$b,$c){
		$query = "UPDATE cursos SET nombreCurso='$a', seccion='$b' WHERE idCurso='$c'";
		$this->bd->query($query);
	}

	//FINAL FUNCIONES PARA GESTION Cursos----------------------------------------------------
	//INICIO FUNCIONES PARA GESTION Empleados----------------------------------------------------
	public function insertarEmpleado($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m){
		$sql="INSERT INTO empleados (nombreEmpleado,apellidoEmpleado,identidad,correo,fechaNacimiento,genero,imprema,idCargo,direccion,fechaIniLabor,celular,tituloMedia,tituloUniversitario) VALUES ('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m')";
		$this->bd->query($sql);
	}
	public function obtenerEmpleados(){
		$sql="SELECT idEmpleado,nombreEmpleado,apellidoEmpleado,identidad,correo,fechaNacimiento,genero,imprema,empleados.idCargo AS empleadoIdCargo,nombreCargo,direccion,empleados.fechaIniLabor,celular,tituloMedia,tituloUniversitario FROM empleados INNER JOIN cargos ON empleados.idCargo = cargos.idCargo";
		return $this->bd->query($sql);
	}
	public function eliminarEmpleado($idEmpleado){
		$query = "DELETE FROM empleados WHERE idEmpleado='$idEmpleado'";
		$this->bd->query($query);
	}
	public function editarEmpleado($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n){
		$query = "UPDATE empleados SET nombreEmpleado='$b',apellidoEmpleado='$c',identidad='$d',correo='$e',fechaNacimiento='$f',genero='$g',imprema='$h',idCargo='$i',direccion='$j',fechaIniLabor='$k',celular='$l',tituloMedia='$m',tituloUniversitario='$n' WHERE idEmpleado='$a'";
		$this->bd->query($query);
	}
	public function editarmiusuario(){
	 $sql=" SELECT idUsuario, idEmpleado, nombreUsuario, contrasena from usuario where idEmpleado=".$_SESSION['ses_id'];
	 return $this->bd->query($sql);
	}
	public function guardarNusuario($a,$b){
	$query = "UPDATE usuario SET  contrasena='$b' WHERE idUsuario='$a'";
	echo "<script>console.log('".$a."')</script>";
	echo "<script>console.log('".$b."')</script>";

	$this->bd->query($query);
}
	//FINAL FUNCIONES PARA GESTION Empleados----------------------------------------------------
	//INICIO FUNCIONES PARA GESTION Encargados----------------------------------------------------
	public function insertarEncargado($a,$b,$c,$d,$e,$f,$h,$i){
		$sql="INSERT INTO encargados (nombreEncargado,apellidoEncargado,telefono,genero,identidad,correo,profesion,direccion) VALUES ('$a','$b','$c','$d','$e','$f','$h','$i')";
		$this->bd->query($sql);
	}
	public function eliminarEncargado($a){
		$sql="DELETE FROM encargados WHERE idEncargado='$a'";
		$this->bd->query($sql);
	}
	public function obtenerEncargados(){
		$sql="SELECT * FROM encargados";
		return $this->bd->query($sql);
	}
	public function editarEncargado($idEncargado,$nombre,$apellido,$telefono,$identidad,$genero,$direccion,$profesion,$correo){
		$query = "UPDATE encargados SET nombreEncargado='$nombre',apellidoEncargado='$apellido',telefono='$telefono',genero='$genero',identidad='$identidad',correo='$correo',profesion='$profesion',direccion='$direccion' WHERE idEncargado='$idEncargado' ";
		$this->bd->query($query);
	}

	//Fin FUNCIONES PARA GESTION Encargados------------------------------------------------
	//Inicio FUNCIONES PARA GESTION Estudiantes------------------------------------------------
	public function matricularAlumno($a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$b1){
		//Almaceno los datos del Alumno
		$sql="INSERT INTO estudiantes (nombreEstudiante,apellidoEstudiante,identidad,correo,fechaNacimiento,genero,direccion,idEncargado,parentescoConEncargado,telefono) VALUES ('$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10')";
		$this->bd->query($sql);
		$idEstudiante = $this->bd->insert_id;
		//Matriculo al estudiante en el curso que se solicito
		$sql = "INSERT INTO matricula (idEstudiante,idCurso) VALUES ('$idEstudiante','$b1')";
		$this->bd->query($sql);
	}

	public function obtenerEstudiantes(){
		$sql ="SELECT estudiantes.idEstudiante,nombreEstudiante,apellidoEstudiante,identidad,nombreCurso,seccion FROM estudiantes
						INNER JOIN matricula
						ON estudiantes.idEstudiante = matricula.idEstudiante
						INNER JOIN cursos
						ON cursos.idCurso = matricula.idCurso
						INNER JOIN aniolectivo
						ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo
						WHERE anio = YEAR(CURDATE())";
		return $this->bd->query($sql);
	}
	public function contarEstudiantesPorClase($a){
		$sql ="SELECT COUNT(estudiantes.idEstudiante) as totalAlumnos FROM matricula
						INNER JOIN estudiantes
						ON matricula.idEstudiante = estudiantes.idEstudiante
						WHERE idCurso='$a'";
		return $this->bd->query($sql)->fetch_assoc();
	}

	public function obtenerEstudiantesPorClase($idClase){
		$sql = "SELECT parcialespormodalidad.nombreParcialPorModalidad,parcialespormodalidad.idParcialPorModalidad FROM parcialactual
				INNER JOIN parcialespormodalidad
						ON parcialactual.idParcialPorModalidad = parcialespormodalidad.idParcialPorModalidad
						INNER JOIN modalidades
						ON parcialespormodalidad.idModalidad = modalidades.idModalidad
						INNER JOIN cursos
						ON modalidades.idModalidad = cursos.idModalidad
						INNER JOIN clases
						ON clases.idCurso = cursos.idCurso
						WHERE clases.idClase = $idClase";
		$resp = $this->bd->query($sql)->fetch_assoc();
		$idParcialActual = $resp['idParcialPorModalidad'];

		$sql ="SELECT estudiantes.idEstudiante,CONCAT(nombreEstudiante,' ',apellidoEstudiante) AS nombreCompleto FROM estudiantes INNER JOIN matricula
		        ON matricula.idEstudiante = estudiantes.idEstudiante
		        INNER JOIN cursos
		        ON matricula.idCurso = cursos.idCurso
		        INNER JOIN clases
		        ON cursos.idCurso = clases.idCurso
		        WHERE idClase='$idClase'
		        ORDER BY genero,nombreEstudiante
		        ";
		return $this->bd->query($sql);

	}

	//Fin FUNCIONES PARA GESTION Estudiantes------------------------------------------------
//Inicio FUNCIONES GESTION DE Clases----------------------------

public function insertarClase($a,$b,$c,$d){

	$sql = "SELECT idAsignatura FROM clases WHERE idAsignatura ='$a'  AND idCurso='$c'";
	$resp = $this->bd->query($sql);
	$rows = mysqli_num_rows($resp);
	if ($rows > 0) {
		return "error";
	}else {
			$sql = "INSERT INTO clases (idAsignatura,idEmpleado,idCurso,horaclase)
							VALUES ('$a','$b','$c','$d')";
			$this->bd->query($sql);
			return "correcto";
	}
}

public function obtenerClases(){
	$sql = "SELECT * FROM clases
					INNER JOIN asignaturas
					ON clases.idAsignatura = asignaturas.idAsignatura
					INNER JOIN empleados
					ON clases.idEmpleado = empleados.idEmpleado
					INNER JOIN cursos
					ON clases.idCurso = cursos.idCurso
					INNER JOIN aniolectivo
					ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo
					WHERE anio = YEAR(CURDATE())";
	return $this->bd->query($sql);
}


public function obtenerClasesDeMaestro($a){
	$sql = "SELECT * FROM clases
					INNER JOIN asignaturas
					ON clases.idAsignatura = asignaturas.idAsignatura
					INNER JOIN empleados
					ON clases.idEmpleado = empleados.idEmpleado
					INNER JOIN cursos
					ON clases.idCurso = cursos.idCurso
					INNER JOIN aniolectivo
					ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo
					WHERE anio = YEAR(CURDATE()) AND clases.idEmpleado = '$a'";
	return $this->bd->query($sql);
}

public function obtenerClasePorId($a){
	$sql = "SELECT CONCAT(nombreCurso,' - ',seccion,' // ',nombreAsignatura) AS curso FROM clases
					INNER JOIN cursos
					ON clases.idCurso = cursos.idCurso
					INNER JOIN asignaturas
					ON clases.idAsignatura = asignaturas.idAsignatura
					WHERE clases.idClase ='$a'";
	return $this->bd->query($sql);
}

//fin FUNCIONES GESTION DE Clases





//PARCIALES

public function obtenerTareas($idClase,$parcial){
	$sql="SELECT * FROM tareas
				INNER JOIN clases
				ON tareas.idClase = clases.idClase
				INNER JOIN cursos
				ON clases.idCurso = cursos.idCurso
				INNER JOIN aniolectivo
				ON aniolectivo.idAnioLectivo = cursos.idCurso
				INNER JOIN parcialespormodalidad
				ON clases.idParcialPorModalidad = parcialespormodalidad.idParcialPorModalidad
				WHERE clases.idClase ='$idClase'
				AND clases.idParcialPorModalidad = '$parcial'
				AND anio = YEAR(CURDATE())";

	return $this->bd->query($sql);
}

public function revisarSiExisteTarea($idEstudiante,$idTarea){
	$sql ="SELECT idEstadoTarea FROM estadotareas
								WHERE idEstudiante = '$idEstudiante' AND
											idTarea = '$idTarea'";
	return $this->bd->query($sql);
}

public function obtenerTareaPorId($idTarea){
	$sql = "SELECT * FROM tareas WHERE idTarea = '$idTarea'";
	return $this->bd->query($sql);
}

public function obtenerEstudiantesPorTarea($idTarea,$idClase){

	$sql = "SELECT parcialespormodalidad.nombreParcialPorModalidad,parcialespormodalidad.idParcialPorModalidad FROM parcialactual
			INNER JOIN parcialespormodalidad
					ON parcialactual.idParcialPorModalidad = parcialespormodalidad.idParcialPorModalidad
					INNER JOIN modalidades
					ON parcialespormodalidad.idModalidad = modalidades.idModalidad
					INNER JOIN cursos
					ON modalidades.idModalidad = cursos.idModalidad
					INNER JOIN clases
					ON clases.idCurso = cursos.idCurso
					WHERE clases.idClase = $idClase";
	$resp = $this->bd->query($sql)->fetch_assoc();
	$idParcialActual = $resp['idParcialPorModalidad'];


	$sql ="SELECT estudiantes.idEstudiante,nombreEstudiante
			FROM estudiantes
        INNER JOIN estadotareas
        ON estadotareas.idEstudiante = estudiantes.idEstudiante
        INNER JOIN tareas
        ON estadotareas.idTarea = tareas.idTarea
        INNER JOIN clases
        ON clases.idClase = tareas.idClase
        WHERE tareas.idClase = $idClase AND
            tareas.idParcialPorModalidad = $idParcialActual";
		return $this->bd->query($sql);
}

public function insertarTarea($nombreTarea,$valorTarea,$fechaEntrega,$idClase){
	$sql = "SELECT parcialespormodalidad.nombreParcialPorModalidad,parcialespormodalidad.idParcialPorModalidad FROM parcialactual
			INNER JOIN parcialespormodalidad
	        ON parcialactual.idParcialPorModalidad = parcialespormodalidad.idParcialPorModalidad
	        INNER JOIN modalidades
	        ON parcialespormodalidad.idModalidad = modalidades.idModalidad
	        INNER JOIN cursos
	        ON modalidades.idModalidad = cursos.idModalidad
	        INNER JOIN clases
	        ON clases.idCurso = cursos.idCurso
	        WHERE clases.idClase = $idClase";
	$resp = $this->bd->query($sql)->fetch_assoc();
	$idParcialActual = $resp['idParcialPorModalidad'];



	$sql="INSERT INTO tareas (nombreTarea,valorTarea,fechaEntrega,idClase,idParcialPorModalidad)
							VALUES ('$nombreTarea','$valorTarea','$fechaEntrega','$idClase','$idParcialActual')";

	$this->bd->query($sql);
}

public function obtenerParcialesActuales(){
	$sql ="SELECT * FROM parcialespormodalidad
		INNER JOIN parcialactual
		on parcialespormodalidad.idParcialPorModalidad = parcialactual.idParcialPorModalidad
        INNER JOIN modalidades
        on parcialespormodalidad.idModalidad = modalidades.idModalidad";
	return $this->bd->query($sql);
}

public function obtenerParcialesDeModalidades($idModalidad){
	$sql ="SELECT * FROM parcialespormodalidad
				INNER JOIN modalidades
        on parcialespormodalidad.idModalidad = modalidades.idModalidad
				WHERE modalidades.idModalidad = '$idModalidad'";
	return $this->bd->query($sql);
}

	public function obtenerAnioLectivos(){
		$sql="SELECT * FROM aniolectivo";
		return $this->bd->query($sql);
	}


          public function RegistrarEmp(){

           $sql="SELECT nombreempleado FROM empleados WHERE nombreempleado ='".$_POST['nombre']."'";

           $respuesta=$this->bd->query($sql);
             if(mysqli_num_rows($respuesta)==0){
                 $sql_insert="INSERT INTO empleados VALUES( NULL,'".$_POST['nombre']."',
                   '".$_POST['apellido']."',
									 '".$_POST['identidad']."','".$_POST['fechaNacimiento']."','".$_POST['genero']."',
                   '".$_POST['imprema']."',
									 '".$_POST['idcargo']."','".$_POST['direccion']."','".$_POST['fechaInicioLaborar']."',
                   '".$_POST['celular']."',
									 '".$_POST['tituloMedia']."','".$_POST['tituloUniversidad']."')";
                $this->bd->query($sql_insert);
             echo "<script>
                    alert('Registro Exitosamente');
                    window.location='ejemplo.php';
             </script>" ;
               }
            else{
             echo "<script>
                    alert('El Empleado ya existe ');
                    window.location='ejemplo.php';
             </script>" ;
             }
            }


						public function RegistrarEst(){

						 $sql="SELECT nombreEstudiante FROM estudiantes WHERE nombreEstudiante ='".$_POST['nombre']."'";

						 $respuesta=$this->bd->query($sql);
							 if(mysqli_num_rows($respuesta)==0){
									 $sql_insert="INSERT INTO estudiantes VALUES(NULL,
                   '".$_POST['nombre']."',
                   '".$_POST['apellido']."',
									 '".$_POST['identidad']."',
                   '".$_POST['correo']."',
                   '".$_POST['fechanacimiento']."',
                   '".$_POST['genero']."',
										 '".$_POST['direccion']."',
                     '".$_POST['idencargado']."',
                     '".$_POST['telefono']."')";

									$this->bd->query($sql_insert);
							 echo "<script>
											alert('Registro Exitosamente');
											window.location='ejemploestudiante.php';
							 </script>" ;
								 }
							else{
							 echo "<script>
											alert('El Empleado ya existe ');
											window.location='ejemploestudiante.php';
							 </script>" ;
							 }
							}




								public function RegistrarMat(){

								 $sql="SELECT aniolectivo FROM matricula WHERE aniolectivo ='".$_POST['aniolectivo']."'";

								 $respuesta=$this->bd->query($sql);
									 if(mysqli_num_rows($respuesta)==0){
											 $sql_insert="INSERT INTO matricula VALUES(NULL,
												 '".$_POST['aniolectivo']."',
												 '".$_POST['idestudiante']."',
												 '".$_POST['idmodalidad']."',
												 '".$_POST['idcurso']."')";
											$this->bd->query($sql_insert);
									 echo "<script>
													alert('Registro Exitosamente');
													window.location='ejemplomatricula.php';
									 </script>" ;
										 }
									else{
									 echo "<script>
													alert('El Empleado ya existe ');
													window.location='ejemplomatricula.php';
									 </script>" ;
									 }
									}

									public function RegistrarCla(){

									 $sql="SELECT aniolectivo FROM clases WHERE aniolectivo ='".$_POST['aniolectivo']."'";

									 $respuesta=$this->bd->query($sql);
										 if(mysqli_num_rows($respuesta)==0){
												 $sql_insert="INSERT INTO clases VALUES(NULL,
													 '".$_POST['idasignatura']."',
													 '".$_POST['idempleado']."',
													 '".$_POST['idcurso']."',
													 '".$_POST['aniolectivo']."',
											  	 '".$_POST['horaclase']."')";
												$this->bd->query($sql_insert);
										 echo "<script>
														alert('Registro Exitosamente');
														window.location='ejemploclase.php';
										 </script>" ;
											 }
										else{
										 echo "<script>
														alert('El Empleado ya existe ');
														window.location='ejemploclase.php';
										 </script>" ;
										 }
										}




            /*esta funcion se utilizara para mostar la tabla de empleados registrados*/

						public function mostrarCla(){

	 	$resultado =$this->bd->query('SELECT * FROM clases');
	 	$deptos=$resultado->fetch_all(MYSQLI_ASSOC);
	 	return $deptos;
	 							}


						public function mostrarMatc(){

	 	$resultado =$this->bd->query('SELECT * FROM matricula');
	 	$deptos=$resultado->fetch_all(MYSQLI_ASSOC);
	 	return $deptos;
	 							}


						public function mostrarEnc(){

	 	$resultado =$this->bd->query('SELECT * FROM encargados');
	 	$deptos=$resultado->fetch_all(MYSQLI_ASSOC);
	 	return $deptos;
	 							}


           public function mostrarEst(){

    $resultado =$this->bd->query('SELECT * FROM estudiantes');
    $deptos=$resultado->fetch_all(MYSQLI_ASSOC);
    return $deptos;
                }

								public function mostrarEmpleados(){

		     $resultado =$this->bd->query('SELECT * FROM empleados');
		     $deptos=$resultado->fetch_all(MYSQLI_ASSOC);
		     return $deptos;
		                 }



                  /*esta funcion sirve para obtener el Id en la opcion de editar*/
                          public function obtener_empleados2($id){
          $empleados = "SELECT idEmpleado,nombreEmpleado,apellidoEmpleado,identidad,correo,fechanacimiento,genero,imprema,idcargo,direccion,fechainilabor,celular,idtitulo FROM empleados WHERE idempleado ='".$id."'";
          $resultado=$this->bd->query($empleados);
          $emp = $resultado->fetch_all(MYSQLI_ASSOC);

          return $emp;
          }

                     public function obtener_empleados($id){
          $empleados = "SELECT * FROM empleados WHERE idempleado ='".$id."'";
          $resultado=$this->bd->query($empleados);
          $emp = $resultado->fetch_all(MYSQLI_ASSOC);

          return $emp;
          }



                   /*funcion para actualizar datos de empleados*/
                  public function editar_empleado(){
          $sql = "UPDATE empleados SET nombreEmpleado = '".$_POST["nombre"]."',
          apellidoEmpleado ='".$_POST["apellido"]."',
          identidad ='".$_POST["identidad"]."',
          fechaNacimiento ='".$_POST["fechaNacimiento"]."',
          genero ='".$_POST["genero"]."',
          imprema ='".$_POST["imprema"]."',
          direccion ='".$_POST["direccion"]."',
          fechaInicioLaborar ='".$_POST["fechaInicioLaborar"]."',
          celular ='".$_POST["celular"]."',
          tituloMedia ='".$_POST["tituloMedia"]."',
          tituloUniversitario ='".$_POST["tituloUniversidad"]."'

          WHERE
          idempleado ='".$_POST["id"]."'";
          $this->bd->query($sql);
                             echo "<script>
                    alert('Registro Actualizado con Exito');
                    window.location = 'modificar_empleados.php';
                    </script>";
          }



         



          

           /*consulta para busqueda en la opcion de con tratos*/



           public function busqueda(){

    $resultado =$this->bd->query('SELECT* FROM empleados');
    $emple=$resultado->fetch_all(MYSQLI_ASSOC);
    return $emple;
                }




    public  function busqueda2 (){




//consuta a la base de datos
$query="SELECT NombreEmpleado FROM empleados WHERE NombreEmpleado = '".$_POST['buscar']."'";
$consulta= $this->bd->query($query);
if($consulta==true)
{
     $num=mysqli_num_rows($consulta);
     for($i=0; $i<$num; $i++)
     {
          $valor=mysqli_fetch_array($consulta);
          // aqui el resultado del buscador
          $valor['NombreEmpleado'];
     }
}

}





          public function obtenerdepartamentoporId($id){
          $departamentos = "SELECT  iddepartamento, nombredepartamento,codigodepartamento FROM departamentos WHERE iddepartamento ='".$id."'";
          $resultado=$this->bd->query($departamentos);
          $departa = $resultado->fetch_all(MYSQLI_ASSOC);

          return $departa;
          } //fin para obtener departamento por ID



       public function editardepartamento(){

			$sql = "UPDATE departamentos SET
			codigodepartamento = '".$_POST["codigo"]."',
			nombredepartamento = '".$_POST["departamento"]."'
			WHERE
			iddepartamento = '".$_POST["id"]."'
			";
			$this->bd->query($sql);

			echo "<script>
                    alert('Registro Actualizado con Exito');
                    window.location = 'index.php';
                    </script>";


		}//fin del editor departamento

//funcion para que funcione el eselect de cargos//
public function selec_cargo(){

	  $res = $this->bd->query("SELECT * FROM cargos");


    while($departamentos = mysqli_fetch_assoc($res)){
    	echo "<option value='".$departamentos['idCargo']."'>".$departamentos['nombreCargo']."</option>";
    }
  }

  //funcion para que funcione el eselect de encargados//
public function selec_encargado(){

    $res = $this->bd->query("SELECT * FROM encargados");


    while($departamentos = mysqli_fetch_assoc($res)){
      echo "<option value='".$departamentos['idEncargado']."'>".$departamentos['nombreEncargado']."</option>";
    }
  }


 public function buscarmunicipios(){

          $municipios = "SELECT  IdMunicipio, NombreMunicipio,CodigoMunicipio,nombreodepartamento FROM municipios WHERE IdMunicipio ='".$_POST['departamento']."'";
          $resultado=$this->bd->query($municipios);
          $muni = $resultado->fetch_all(MYSQLI_ASSOC);
  }



	public function notify($texto,$color){
		$notify = "$(function(){
			$.notify({
				message: '$texto'
			},{
				type: '$color'
			})
		})";

		return "<script>".$notify."</script>";

	}


	          /*aqui empieza las funciones que hay que agregar al proyecto*/
         /*esta funcion sirve para ver el id de los estudiantes*/


          public function obtener_estudiantes($id){
          $empleados = "SELECT * FROM estudiantes WHERE idEstudiante ='".$id."'";
          $resultado=$this->bd->query($empleados);
          $emp = $resultado->fetch_all(MYSQLI_ASSOC);

          return $emp;
          }

            /*funcion para actualizar datos de estudiantes*/
                  public function editar_estudiante(){
          $sql = "UPDATE estudiantes SET nombreEstudiante = '".$_POST["nombre"]."',
          apellidoEstudiante ='".$_POST["apellido"]."',
          identidad ='".$_POST["identidad"]."',
          correo ='".$_POST["correo"]."',
          genero ='".$_POST["genero"]."',
          fechaNacimiento ='".$_POST["fechaNacimiento"]."',
          genero ='".$_POST["genero"]."',
          direccion ='".$_POST["direccion"]."',
          telefono ='".$_POST["celular"]."'
          WHERE
          idestudiante ='".$_POST["id"]."'";
          $this->bd->query($sql);
                             echo "<script>
                    alert('Registro Actualizado con Exito');
                    window.location = 'listadoEstudiantes.php';
                    </script>";
          }
              // funcion para eliminar estudiantes//
  public function eliminar_estudiantes(){
   $consult ="DELETE FROM estudiantes WHERE idEstudiante='".$_GET["id"]."'";

   $this->bd->query($consult);

   echo "<script>
                    alert('Registro Eliminado con Exito');
                    window.location = 'listadoEstudiantes.php';
                    </script>";


  }


          /*esta funcion sirve para ver el id de los encargados*/


          public function obtener_encargados($id){
          $empleados = "SELECT * FROM encargados WHERE idEncargado ='".$id."'";
          $resultado=$this->bd->query($empleados);
          $emp = $resultado->fetch_all(MYSQLI_ASSOC);

          return $emp;
          }


/*funcion para actualizar datos de encargados*/
                  public function editar_encargados(){
          $sql = "UPDATE encargados SET nombreEncargado = '".$_POST["nombre"]."',
          apellidoEncargado ='".$_POST["apellido"]."',
          telefono ='".$_POST["telefono"]."',
          genero ='".$_POST["genero"]."',
          identidad ='".$_POST["identidad"]."',
          correo ='".$_POST["correo"]."',
          profesion ='".$_POST["profesion"]."',
          direccion ='".$_POST["direccion"]."'
          WHERE
          idEncargado ='".$_POST["id"]."'";
          $this->bd->query($sql);
                             echo "<script>
                    alert('Registro Actualizado con Exito');
                    window.location = 'modificarEncargados.php';
                    </script>";
          }

 // funcion para eliminar encargados//
  public function eliminar_encargados(){
   $consult ="DELETE FROM encargados WHERE idEncargado='".$_GET["id"]."'";

   $this->bd->query($consult);

   echo "<script>
                    alert('Registro Eliminado con Exito');
                    window.location = 'modificarEncargados.php';
                    </script>";


  }

  /*aqui termina las funciones que hice*/
//fin de la clase

//clase
}
 ?>
