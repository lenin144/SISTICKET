<?php  
	include "header.php";
	include "sidebar.php";
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow" style="font-weight: 900; text-shadow: 3px 3px 8px #3c515b, -3px -3px 8px #3c515b, 3px -3px 8px #3c515b, -3px 3px 8px #3c515b;"> 404</h2>
            
            <div class="error-content">
                <h3 style="color: white; font-weight: 900; text-shadow: 2px 2px 5px #3c515b, -2px -2px 5px #3c515b, 2px -2px 5px #3c515b, -2px 2px 5px #3c515b;">
                    <i class="fa fa-warning text-yellow"></i> Oops! Página no encontrada.
                </h3>
                
                <h3 style="color: white; font-weight: 900; text-shadow: 2px 2px 5px #3c515b, -2px -2px 5px #3c515b, 2px -2px 5px #3c515b, -2px 2px 5px #3c515b;">Hmmm!</h3>
                
                <p style="color: white; font-size: 1.2em; font-weight: 900; text-shadow: 1px 1px 4px #3c515b, -1px -1px 4px #3c515b, 1px -1px 4px #3c515b, -1px 1px 4px #3c515b;">
                    No encontramos lo que buscabas!</p>                
                <a href="?view=Panel de Control" class="btn btn-default"><span class="glyphicon glyphicon-hand-left"></span> Regresar</a>
                </div><!-- /.error-content -->
            </div><!-- /.error-page -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php  include "footer.php" ?>