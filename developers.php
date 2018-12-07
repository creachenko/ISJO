<?php
session_start();
include 'class/funciones.php';
if (isset($_SESSION["ses_id"])) {
  $obj=new funcionesBD();
}else{
  echo '<script>
  alert("Tienes que loguearte");
  window.location= "index.php";
  </script>';
};


include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Asignar Clases
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-briefcase" aria-hidden="true" ></i> Developers
            </li>
        </ol>
    </div>
</div>
<div class="container">
  <div class="col-md-12">
    <link href="css/profiles.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container">


      <div class="jumbotron">
        <h1 class="display-4">
          Desarrolladores</h1>
        <p class="lead">Espacio informatico de los perfiles de cada programador que aplicaron sus habilidades logicas y de ingenio para construir esta plataforma.</p>
        <hr class="my-4">
        <p>Int. San Jorge de Olancho.</p>
      </div>
        <div class="col-lg-4 col-sm-4">

                <div class="card hovercard">
                    <div class="cardheader">

                    </div>
                    <div class="avatar">
                        <img src="img/matute.jpg"/>
                    </div>
                    <div class="info">
                        <div class="title">
                            <div class="_blank">Calos H. Matute</div>
                        </div>
                        <div class="desc">Ing. Sistemas</div>
                        <div class="desc">Catacamas</div>
                        <div class="desc">Olancho</div>
                    </div>
                    <div class="bottom">
                        <a class="btn btn-primary btn-sm" rel="publisher"
                           href="https://www.facebook.com/carlos.matute.3557?ref=bookmarks">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </div>
                </div>

            </div>





            <div class="col-lg-4 col-sm-4">

                    <div class="card hovercard">
                        <div class="cardheader">

                        </div>
                        <div class="avatar">
                            <img alt="" src="img/cruz.jpg">
                        </div>
                        <div class="info">
                            <div class="title">
                                <div class="_blank">Luis S. Cruz</div>
                            </div>
                            <div class="desc">Ing. Sistemas</div>
                            <div class="desc">Catacamas</div>
                            <div class="desc">Olancho</div>
                        </div>
                        <div class="bottom">
                            <a class="btn btn-primary btn-sm" rel="publisher"
                               href="https://www.facebook.com/creachenko">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </div>
                    </div>

                </div>





                <div class="col-lg-4 col-sm-4">

                        <div class="card hovercard">
                            <div class="cardheader">

                            </div>
                            <div class="avatar">
                                <img alt="" src="img/acosta.jpg">
                            </div>
                            <div class="info">
                                <div class="title">
                                    <div class="_blank">Sury G. Acosta</div>
                                </div>
                                <div class="desc">Ing. Sistemas</div>
                                <div class="desc">Catacamas</div>
                                <div class="desc">Olancho</div>
                            </div>
                            <div class="bottom">
                                <a class="btn btn-primary btn-sm" rel="publisher"
                                   href="https://www.facebook.com/gaby.mena.10">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </div>
                        </div>

                    </div>




                    <div class="col-lg-4 col-sm-4">

                            <div class="card hovercard">
                                <div class="cardheader">

                                </div>
                                <div class="avatar">
                                    <img alt="" src="img/ramos.jpg">
                                </div>
                                <div class="info">
                                    <div class="title">
                                        <div class="_blank">Hector J. Ramos</div>
                                    </div>
                                    <div class="desc">Ing. Sistemas</div>
                                    <div class="desc">Catacamas</div>
                                    <div class="desc">Olancho</div>
                                </div>
                                <div class="bottom">
                                    <a class="btn btn-primary btn-sm" rel="publisher"
                                       href="https://www.facebook.com/joel.calix.52">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </div>
                            </div>

                        </div>





                        <div class="col-lg-4 col-sm-4">

                                <div class="card hovercard">
                                    <div class="cardheader">

                                    </div>
                                    <div class="avatar">
                                        <img alt="" src="img/salgado.jpg">
                                    </div>
                                    <div class="info">
                                        <div class="title">
                                            <div class="_blank">Jorge A. Salgado</div>
                                        </div>
                                        <div class="desc">Ing. Sistemas</div>
                                        <div class="desc">Catacamas</div>
                                        <div class="desc">Olancho</div>
                                    </div>
                                    <div class="bottom">
                                        <a class="btn btn-primary btn-sm" rel="publisher"
                                           href="https://www.facebook.com/salgadopaz">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>





                            <div class="col-lg-4 col-sm-4">

                                    <div class="card hovercard">
                                        <div class="cardheader">

                                        </div>
                                        <div class="avatar">
                                            <img alt="" src="img/funez.jpg">
                                        </div>
                                        <div class="info">
                                            <div class="title">
                                                <div class="_blank">Luis F. Funez</div>
                                            </div>
                                            <div class="desc">Ing. Sistemas</div>
                                            <div class="desc">Catacamas</div>
                                            <div class="desc">Olancho</div>
                                        </div>
                                        <div class="bottom">
                                            <a class="btn btn-primary btn-sm" rel="publisher"
                                               href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>




                                <div class="col-lg-4 col-sm-4">

                                        <div class="card hovercard">
                                            <div class="cardheader">

                                            </div>
                                            <div class="avatar">
                                                <img alt="" src="img/carcamo.jpg">
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    <div class="_blank">Nolvia A. Carcamo</div>
                                                </div>
                                                <div class="desc">Ing. Sistemas</div>
                                                <div class="desc">Catacamas</div>
                                                <div class="desc">Olancho</div>
                                            </div>
                                            <div class="bottom">
                                                <a class="btn btn-primary btn-sm" rel="publisher"
                                                   href="https://www.facebook.com/ChelyCarcamo">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>





                                    <div class="col-lg-4 col-sm-4">

                                            <div class="card hovercard">
                                                <div class="cardheader">

                                                </div>
                                                <div class="avatar">
                                                    <img alt="" src="img/zavala.jpg">
                                                </div>
                                                <div class="info">
                                                    <div class="title">
                                                        <div class="_blank">Maryuri A. Zavala</div>
                                                    </div>
                                                    <div class="desc">Ing. Sistemas</div>
                                                    <div class="desc">Catacamas</div>
                                                    <div class="desc">Olancho</div>
                                                </div>
                                                <div class="bottom">
                                                    <a class="btn btn-primary btn-sm" rel="publisher"
                                                       href="https://www.facebook.com/maryuri.zavala">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>





                                        <div class="col-lg-4 col-sm-4">

                                                <div class="card hovercard">
                                                    <div class="cardheader">

                                                    </div>
                                                    <div class="avatar">
                                                        <img alt="" src="img/gomez.jpg">
                                                    </div>
                                                    <div class="info">
                                                        <div class="title">
                                                            <div class="_blank">Yessica G. Gomez</div>
                                                        </div>
                                                        <div class="desc">Ing. Sistemas</div>
                                                        <div class="desc">Catacamas</div>
                                                        <div class="desc">Olancho</div>
                                                    </div>
                                                    <div class="bottom">
                                                        <a class="btn btn-primary btn-sm" rel="publisher"
                                                           href="https://www.facebook.com/yessica.gomez.9809">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>




                                            <div class="col-lg-4 col-sm-4">

                                                    <div class="card hovercard">
                                                        <div class="cardheader">

                                                        </div>
                                                        <div class="avatar">
                                                            <img alt="" src="img/flobo.jpg">
                                                        </div>
                                                        <div class="info">
                                                            <div class="title">
                                                                <div class="_blank">Francis V. Lobo</div>
                                                            </div>
                                                            <div class="desc">Ing. Sistemas</div>
                                                            <div class="desc">Catacamas</div>
                                                            <div class="desc">Olancho</div>
                                                        </div>
                                                        <div class="bottom">
                                                            <a class="btn btn-primary btn-sm" rel="publisher"
                                                               href="https://www.facebook.com/viviana.lobo1">
                                                                <i class="fa fa-facebook"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>





                                                <div class="col-lg-4 col-sm-4">

                                                        <div class="card hovercard">
                                                            <div class="cardheader">

                                                            </div>
                                                            <div class="avatar">
                                                                <img alt="" src="img/jlobo.jpg">
                                                            </div>
                                                            <div class="info">
                                                                <div class="title">
                                                                    <div class="_blank">Francisco J. Lobo</div>
                                                                </div>
                                                                <div class="desc">Ing. Sistemas</div>
                                                                <div class="desc">Catacamas</div>
                                                                <div class="desc">Olancho</div>
                                                            </div>
                                                            <div class="bottom">
                                                                <a class="btn btn-primary btn-sm" rel="publisher"
                                                                   href="https://www.facebook.com/carlos.matute.3557?ref=bookmarks">
                                                                    <i class="fa fa-facebook"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </div>





                                                    <div class="col-lg-4 col-sm-4">

                                                            <div class="card hovercard">
                                                                <div class="cardheader">

                                                                </div>
                                                                <div class="avatar">
                                                                    <img alt="" src="img/escobar.jpg">
                                                                </div>
                                                                <div class="info">
                                                                    <div class="title">
                                                                        <div class="_blank">Victor Escobar</div>
                                                                    </div>
                                                                    <div class="desc">Ing. Sistemas</div>
                                                                    <div class="desc">Catacamas</div>
                                                                    <div class="desc">Olancho</div>
                                                                </div>
                                                                <div class="bottom">
                                                                    <a class="btn btn-primary btn-sm" rel="publisher"
                                                                       href="https://www.facebook.com/victor.escobar.50951">
                                                                        <i class="fa fa-facebook"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>


    </div>
  </div>
</div>
