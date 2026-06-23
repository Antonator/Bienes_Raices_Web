<?php 
    require 'includes/funciones.php';
    
    incluirTemplate('header');

?>

    <main class="contenedor seccion" contenido-centrado>
        <h1>Casa en venta frente al bosque</h1>
        <picture>
            <source src="build/img/destacada.webp" type="image/webp">
            <source src="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p>4</p>
                        </li>
                    </ul>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis fugiat sint assumenda, distinctio quis 
                        quibusdam voluptates maiores. Obcaecati neque officia harum, ad similique nihil hic deserunt quasi
                         quisquam sequi earum.
                         Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis fugiat sint assumenda, distinctio quis 
                        quibusdam voluptates maiores. Obcaecati neque officia harum, ad similique nihil hic deserunt quasi
                         quisquam sequi earum.
                         Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis fugiat sint assumenda, distinctio quis 
                        quibusdam voluptates maiores. Obcaecati neque officia harum, ad similique nihil hic deserunt quasi
                         quisquam sequi earum.
                    </p>

                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis fugiat sint assumenda, distinctio quis 
                        quibusdam voluptates maiores. Obcaecati neque officia harum, ad similique nihil hic deserunt quasi
                         quisquam sequi earum.
                         Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis fugiat sint assumenda, distinctio quis 
                        quibusdam voluptates maiores. Obcaecati neque officia harum, ad similique nihil hic deserunt quasi
                         quisquam sequi earum.
                    </p>
        </div>

    </main>

    <?php 
    require 'includes/funciones.php';
    
    incluirTemplate('footer');

    ?>

    <script src="build/js/bundle.min.js"></script>
</body>
</html>