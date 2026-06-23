<?php 
    //conexion de BD
    require '../../includes/config/database.php';

    $db = conectarDB();

    //Consulta para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    
    echo "<pre>";
    var_dump($_SERVER["REQUEST_METHOD"]);
    echo "</pre>";
    
    //Arreglo con mensajes de errores
    $errores = [];

    //variables para que se guarden los valores que el usuario va escribiendo
    //y así, en caso de que haya un error o que le falte llenar un campo
    //del formulario, el usuario no tenga que volver a escribir los datos
    //funciona en conjunto con el atributo "value" en la etiqueta de los inputs el form HTML
    $titulo = "";
    $precio = "";
    $descripcion = "";
    $habitaciones = "";
    $wc = "";
    $estacionamiento = "";
    $vendedorId = "";

    //Ejecucion de INSERCIONES de los inputs del formulario 
    if($_SERVER["REQUEST_METHOD"] === "POST"){


        //ARCHIVOS  
        
        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";
        
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
        
        
        
        //SANITIZAR ENTRADA DE DATOS:
        //ESCAPAR DATOS PARA EVITAR INYECCIONES SQL O CROSS-SIDE-SCRIPTING
        //DEHABILITA LOS SCRIPTS MALICIOSO Y LO GUARDA COMO ENTIDAD EN LA BD
        //DE TAL MANERA QUE NO SEA EJECUTABLE
        $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
        $precio = mysqli_real_escape_string($db, $_POST["precio"]);
        $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
        $wc = mysqli_real_escape_string($db, $_POST["wc"]);
        $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
        $vendedorId = mysqli_real_escape_string($db, $_POST["vendedor"]);
        $creado = date('Y/m/d');

        //Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        if(!$titulo){
            $errores[] = "Debes añadir un título";
        }

        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }

        if(strlen($descripcion) < 50){
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$habitaciones){
            $errores[] = "El numero de habitaciones es obligatorio";
        }

        if(!$wc){
            $errores[] = "El numero de baños es obligatorio";
        }

        if(!$estacionamiento){
            $errores[] = "El numero de lugares de estacionamientos es obligatorio";
        }

        if(!$vendedorId){
            $errores[] = "Elige un vendedor";
        }

        if(!$imagen['name'] || $imagen['error']){
            $errores[] = "La imagen es obligatoria";
        }

        //validar img por tamaño
        //convertir bytes a kb
        $medida = 1000 * 1000;
        if($imagen['size'] > $medida){
            $errores[] = 'La imagen cargada es demasiado pesada';
        }

        /*
        echo "<pre>";
        var_dump($errores);
        echo "</pre>";
        */

        //Revisar que el arreglo de errores está vacío
        //Si está vacio es que no hay errores y se puede hacer la insercion sin problemas
        if(empty($errores)){

            /* SUBIDA DE ARCHIVOS */

            /* CREAR CARPETA */
            $carpetaImagenes = '../../imagenes/';

            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            //Generar nombre unico de imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            /* SUBIR LA IMAGEN */
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            //INSERTAR EN LA BD
            $query = "INSERT INTO propiedades (
            titulo, 
            precio, 
            imagen,
            descripcion, 
            habitaciones, 
            wc, 
            estacionamiento, 
            creado,
            vendedores_id)
            VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";

            //echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //redireccionar al usuario si es que se insertaron los datos con exito
                //para que los usuarios no se confundan y no dupliquen entradas
                header('Location: /admin');
            }

        }

    }

    require '../../includes/funciones.php';
    
    incluirTemplate('header');

?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <!--Si hay errores, se recorre que errores se detectaron 
        y se muestran mensajes que describen al usuario cual
        es el error-->
        <?php forEach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
            
        <?php endforeach; ?>

        <form method="POST" action="/admin/propiedades/crear.php" class="formulario" enctype="multipart/form-data">
        <!--GET: EXPONE DATOS INGRESADOS EN FORMULARIO EN LA URL-->
        <!--POST: MANEJA LOS DATOS DE MANERA INTERNA EN EL ARCHIVO, SIN EXPONER NADA EN LA URL-->
        <!--GET SE UTILIZA CUANDO REQUIERO LEER DATOS DE LA URL O PASAR DATOS DE UNA PANTALLA A OTRA-->
        <!--POST SE UTILIZA CUANDO REQUIERO MANEJAR DATOS DE FORMA SEGURA (LOGINS POR EJEMPLO)-->
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Título</label>
                <!--Importante el uso de value para almacenar lo que va ingresando el usuario en el input-->
                <input value="<?php echo $titulo; ?>" type="text" name="titulo" placeholder="Título de la propiedad" id="titulo">
                <!--name permite leer lo que el usuario escriba en el form-->
                
                <label for="precio">Precio</label>
                <input value="<?php echo $precio; ?>" type="number" name="precio" placeholder="Precio de la propiedad" id="precio">

                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea> 
                <!--textarea no cuenta con el atributo value, por lo que se pone entre las etiquetas el valor ingresado
                por el usuario-->
            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>

                <label for="habitaciones">Habitaciones</label>
                <input value="<?php echo $habitaciones; ?>" type="number" name="habitaciones" placeholder="Ej: 3" id="habitaciones" min="1" max="9">

                <label for="wc">Baños</label>
                <input value="<?php echo $wc; ?>" type="number" name="wc" placeholder="Ej: 3" id="wc" min="1" max="9">

                <label for="estacionamiento">Estacionamiento</label>
                <input value="<?php echo $vendedorId; ?>" type="number" name="estacionamiento" placeholder="Ej: 3" id="estacionamiento" min="1" max="9">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor" id="">
                    <option value="">>Selecciona<</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                        <option <?php echo $vendedorId === $vendedor["id"] ? 'selected' : ''; ?> value="<?php echo $vendedor["id"] ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido'] ?></option>
                        <!-- ?php echo $vendedorId === $vendedor["id"] ? 'selected' : ''
                         este codigo mantiene la selección del vendedor cuando ocurre un error
                         del usuario al llenar el formulario.
                         Itera sobre el vendedorId y si es igual al id de la Base de Datos se agrega 
                         la propiedad de selected-->    
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear propiedad" class="boton-verde">

        </form>

    </main>

    

<?php 
   
    incluirTemplate('footer');

?>