<?php
    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    // error_reporting(E_ALL);
    require '../../modelos/Producto.php';

    // consulta
    try {
        // var_dump($_GET);
        $_GET['prod_nombre'] = htmlspecialchars( $_GET['prod_nombre']);
        $_GET['prod_precio'] = filter_var( $_GET['prod_precio'] , FILTER_VALIDATE_FLOAT) ;
        $objProducto = new Producto($_GET);
        $productos = $objProducto->buscar();
        $resultado = [
            'mensaje' => 'Datos encontrados',
            'datos' => $productos,
            'codigo' => 1
        ];
        // var_dump($productos);
        
    } catch (Exception $e) {
        $resultado = [
            'mensaje' => 'OCURRIO UN ERROR EN LA EJECUCIÓN',
            'detalle' => $e->getMessage(),
            'codigo' => 0
        ];
    }       


    $alertas = ['danger', 'success', 'warning'];

    
    include_once '../../vistas/templates/header.php'; ?>

    <div class="row mb-4 justify-content-center">
        <div class="col-lg-6 alert alert-<?=$alertas[$resultado['codigo']] ?>" role="alert">
            <?= $resultado['mensaje'] ?>
        </div>
    </div>
    <div class="row mb-4 justify-content-center">
        <div class="col-lg-6">
            <a href="../../vistas/producto/buscar.php" class="btn btn-primary w-100">Volver al formulario de busqueda</a>
        </div>
    </div>
    <h1 class="text-center">Listado de productos</h1>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($resultado['codigo'] == 1 && count($productos) > 0) : ?>
                        <?php foreach ($productos as $key => $producto) : ?>
                            <tr>
                                <td><?= $key + 1?></td>
                                <td><?= $producto['prod_nombre'] ?></td>
                                <td><?= $producto['prod_precio'] ?></td>
                                <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square me-2"></i>Modificar</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i>Eliminar</a></li>
                                    </ul>
                                </div>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">No hay productos registrados</td>
                        </tr>  
                    <?php endif ?>
                </tbody>
                        
            </table>
        </div>        
    </div>        
<?php include_once '../../vistas/templates/footer.php'; ?>  