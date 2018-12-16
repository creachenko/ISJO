<html lang="en">
  <head>
  <meta charset="UTF-8">
  <title><?php if (!empty($page_title))
         echo remove_junk($page_title);
          elseif(!empty($user))
         echo ucfirst($user['name']);
          else echo "Sistema San Jorge de Olancho";?>
  </title>

  <link rel="stylesheet" href="css/bootstrap.css"/>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
  <link rel="stylesheet" href="libs/css/main.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<style media="screen">
  .textoVertical {
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  }
</style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Colapsar Navegacion</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Instituto San Jorge de Olancho</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Inicio</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
