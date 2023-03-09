<?php
    require_once 'includes/header.php';
    require_once 'includes/modals/modal_laboratorio.php';
    require_once '../includes/conexion.php';

    $sql = "SELECT * FROM laboratorios";
    $query = $pdo->prepare(($sql));
    $query->execute();
    $row = $query->rowCount();
?>
<main class="app-content">
    <div class="app-title">
        <div>
        <h1><i class="fa fa-dashboard"></i> Lista de Laboratorios</h1>
        
        <button class="btn btn-success" type="button" onclick="location.href='Laboratorios.php'">Nuevo Laboratorio</button>
        </div>
        <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">lista de laboratorios</a></li>
        </ul>
    </div>
<head>
    <!-- Cargar el CSS de Boostrap-->
    <link
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="stylesheet" href="https://jmblog.github.io/color-themes-for-highlightjs/css/themes/hemisu-light.css">
</head>
<body>
    <main role="main" class="container my-auto">
    <div class="row">
    <div class="col-md-12 text-center border mt-3 p-4 bg-light">
      <h4>Mis Laboratorios</h4>
      
    </div>
  </div>
  <div class="row">
        <?php if($row >0 ){
          while($data = $query->fetch()){
        ?>
        <div class="col-md-4 text-center border mt-3 p-4 bg-light">
            <div class="card m-2 shadow" style="width: 18rem";>
              <img src="images/card-school.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h4 class="card-title text-center"><?=$data['titulo'] ?></h4>
                <h5 class="card-title"> Descripción <kbd class="bg-info"><?= $data['descripcion'] ?></kbd>
                <p>Objetivos: <?= $data['objetivos'] ?> </p>
              </div>
            </div>
        </div>
        <?php }  } ?>

      </div>  
    </main>
<?php
    require_once 'includes/footer.php';
?>
