<?php if ($action=="personal"):?>
    <table class="table table-striped table-bordered table-condensed" style="font-size:11px">
            <thead>
               <tr>
                    <th>Id</th>
                    <th>Documento</th>
                    <th>Nombre y Apellidos</th>
                    <th>Fecha de Registro</th>
                    <th>E-Mail</th>
                    <th>Teléfonos</th>
                    <th>Dirección</th>
                    <th>Sucursal</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>        
            <?php if( count( $paginator )) :?>
            <tbody>
                <?php foreach ($paginator as $value) : ?>        
                <tr>
                    <td><?php echo $value->idpersonal;?></td>
                    <td><?php echo $value->per_docu;?></td>
                    <td><?php echo $value->per_nombre;?></td>
                    <td><?php echo $value->per_fechregistro;?></td>
                    <td><?php echo $value->per_email;?></td>
                    <td><?php echo $value->per_telf;?></td>
                    <td><?php echo $value->per_direc;?></td>
                    <td><?php echo $value->su_nombre;?></td>
                    <td><?php echo $value->per_estado;?></td>
                    <td width="77">                      
                        <div class="btn-group">
                          <a class="btn btn-mini btn-primary" href="#">Acción</a>
                          <a class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                          <ul class="dropdown-menu" style="text-align:left;">
                            <li><a href="/personal/update/id/<?php echo $value->idpersonal; ?>"><i class="icon-pencil"></i> Editar</a></li>
                            <?php if ($value->per_estado == 'Suspendido'):?>
                                <li><a href="/personal/active/id/<?php echo $value->idpersonal; ?>"><i class="icon-trash"></i> Activar</a></li>   
                            <?php else: ?>
                                <li><a href="/personal/suspend/id/<?php echo $value->idpersonal; ?>"><i class="icon-trash"></i> Suspender</a></li>   
                            <?php endif ?>
                            <li><a href="/personal/delete/id/<?php echo $value->idpersonal; ?>"><i class="icon-trash"></i> Eliminar</a></li>
                          </ul>
                        </div>                      
                    </td>
                </tr>          
            <?php endforeach;?>
            </tbody>        
            <?php else : ?>
            <tbody>
                <tr>
                    <td colspan="10">No hay datos</td>
                </tr>
            </tbody>
            <?php endif;?> 
            <tfoot>
                <tr >
                    <td colspan="10">
                        <span class="label label-info"><?php echo $row." Resultados encontrados..."; ?></span> 
                    </td>
                </tr>      
            </tfoot>
    </table>
<?php endif; ?>

<?php if($action=="proveedor"): ?>
    <table class="table table-striped table-bordered table-condensed" style="font-size:11px">
            <thead>
               <tr>
                    <th>Id</th>
                    <th>Documento</th>
                    <th>Nombre y Apellidos</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>        
            <?php if( count( $paginator )) :?>
            <tbody>
                <?php foreach ($paginator as $value) : ?>         
                <tr>
                    <td><?php echo $value->idproveedor;?></td>
                    <td><?php echo $value->pro_docu;?></td>
                    <td><?php echo $value->pro_nombre;?></td>
                    <td><?php echo $value->pro_ciudad;?></td>
                    <td><?php echo $value->pro_direc;?></td>
                    <td><?php echo $value->pro_telf;?></td>
                    <td><?php echo $value->pro_email;?></td>
                    <td><?php echo $value->pro_fechingre;?></td>
                    <td><?php echo $value->pro_estado;?></td>
                    <td width="77">                      
                        <div class="btn-group">
                          <a class="btn btn-mini btn-primary" href="#">Acción</a>
                          <a class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                          <ul class="dropdown-menu" style="text-align:left;">
                            <li><a href="/proveedor/update/id/<?php echo $value->idproveedor; ?>"><i class="icon-pencil"></i> Editar</a></li>
                            <?php if ($value->pro_estado == 'Suspendido'):?>
                                <li><a href="/proveedor/active/id/<?php echo $value->idproveedor; ?>"><i class="icon-trash"></i> Activar</a></li>   
                            <?php else: ?>
                                <li><a href="/proveedor/suspend/id/<?php echo $value->idproveedor; ?>"><i class="icon-trash"></i> Suspender</a></li>   
                            <?php endif ?>
                            <li><a href="/proveedor/delete/id/<?php echo $value->idproveedor; ?>"><i class="icon-trash"></i> Eliminar</a></li>
                          </ul>
                        </div>                      
                    </td>
                </tr>          
            <?php endforeach;?>
            </tbody>        
            <?php else : ?>
            <tbody>
                <tr>
                    <td colspan="10">No hay datos</td>
                </tr>
            </tbody>
            <?php endif;?> 
            <tfoot>
                <tr >
                    <td colspan="10"> 
                        <span class="label label-info"><?php echo $row." Resultados encontrados..."; ?></span> 
                    </td>
                </tr>      
            </tfoot>
    </table>   
<?php endif;?>

<?php if($action=="recurso"): ?>
    <table class="table table-striped table-bordered table-condensed" style="font-size:11px;">
            <thead>
               <tr>
                    <th>Id</th>
                    <th>SKU</th>
                    <th>Nombre del recurso</th>
                    <th>Marca</th>
                    <th>Stock</th>
                    <th>Presentación</th>
                    <th>UMedida</th>
                    <th>P.Com</th>
                    <th>P.Ven</th>
                    <th>StockMin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>        
            <?php if( count( $paginator )) :?>
            <tbody >
                <?php foreach ($paginator as $value) : ?>            
                <tr>
                    <td><?php echo $value->idrecurso;?></td>
                    <td><?php echo $value->re_sku;?></td>
                    <td><?php echo $value->re_nombre;?></td>
                    <td><?php echo $value->re_marca;?></td>
                    <td><?php echo $value->re_stock;?></td>
                    <td><?php echo $value->re_presenta;?></td>
                    <td><?php echo $value->re_umedida;?></td>
                    <td><?php echo $value->re_pcompra;?></td>
                    <td><?php echo $value->re_pventa;?></td>
                    <td><?php echo $value->re_stockmin;?></td>
                    <td><?php echo $value->re_estado;?></td>                
                    <td width="77">
                        <div class="btn-group">
                              <!-- <a class="btn btn-mini btn-primary" href="#">Acción</a> -->
                              <button class="btn btn-mini btn-primary">Acción</button>
                              <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></button>
                              <ul class="dropdown-menu" style="text-align:left;">
                                <li><a href="/recurso/update/id/<?php echo $value->idrecurso; ?>"><i class="icon-pencil"></i> Editar</a></li>
                                <?php if ($value->re_estado == 'Suspendido'):?>
                                    <li><a href="/recurso/active/id/<?php echo $value->idrecurso; ?>"><i class="icon-trash"></i> Activar</a></li>   
                                <?php else: ?>
                                    <li><a href="/recurso/suspend/id/<?php echo $value->idrecurso; ?>"><i class="icon-trash"></i> Suspender</a></li>   
                                <?php endif ?>
                                <li id="acciones"><a href="/recurso/delete/id/<?php echo $value->idrecurso; ?>"><i class="icon-trash"></i> Eliminar</a></li>
                              </ul>
                        </div> 
                    </td>
                </tr>          
            <?php endforeach;?>
            </tbody>        
            <?php else : ?>
            <tbody>
                <tr>
                    <td colspan="12">No hay datos</td>
                </tr>
            </tbody>
            <?php endif;?> 
            <tfoot>
                <tr >
                    <td colspan="12">
                        <span class="label label-info"><?php echo $row." Resultados encontrados..."; ?></span> 
                    </td>
                </tr>      
            </tfoot>
        </table> 
    <script type="text/javascript">
        // Evento para poder pedir confirmación al moneto de eliminar un registro
            $("#acciones a").click(function(e){            
                if (confirm('Realmente quiere eliminarlo el registro??')){
                    return true;
                }
                else{
                    e.preventDefault();
                }
            });  
    </script>
<?php endif;?>

<?php if($action=="compra"): ?>    
    <table class="table table-striped table-bordered table-condensed" style="font-size:11px">
                <thead>
                   <tr>
                        <th>Id</th>
                        <th>Nro. Fact.</th>
                        <th>Fech. Compra</th>
                        <th>Importe</th>
                        <th>Encargado</th>
                        <th>Proveedor</th>
                        <th>Personal</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>        
                <?php if( count( $paginator )) :?>
                <tbody>
                    <?php foreach ($paginator as $value) : ?>      
                    <tr>
                        <td><?php echo $value->idcompra;?></td>
                        <td><?php echo $value->co_nrofact;?></td>
                        <td><?php echo $value->co_fech;?></td>
                        <td><?php echo $value->co_importe;?></td>
                        <td><?php echo $value->co_encargado;?></td>
                        <td><?php echo $value->pro_nombre;?></td>
                        <td><?php echo $value->per_nombre;?></td>
                        <td><?php echo $value->co_estado;?></td>
                        <td width="77">                      
                            <div class="btn-group">
                              <a class="btn btn-mini btn-primary" href="#">Acción</a>
                              <a class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                              <ul class="dropdown-menu" style="text-align:left;">
                                <li><a href="/compra/update/id/<?php echo $value->idcompra; ?>"><i class="icon-pencil"></i> Editar</a></li>
                                <li id="acciones"><a href="/compra/delete/id/<?php echo $value->idcompra; ?>"  rel="popover" data-content="Si elimina, se perderán todos los registros relacionados con este registro" data-original-title="Atención"><i class="icon-trash"></i> Eliminar</a></li>
                                <li id="detalles"><a href="/async/detailsshop/id/<?php echo $value->idcompra; ?>"><i class="icon-list"></i> Detallar</a></li>  
                                <li><a href="#" onClick="abrirVentana('http://punto4.local/async/printdetailsshop/id/<?php echo $value->idcompra; ?>')"><i class="icon-print"></i> Imprimir Detalle</a></li>  
                              </ul>
                            </div>                      
                        </td>
                    </tr>          
                <?php endforeach;?>
                </tbody>        
                <?php else : ?>
                <tbody>
                    <tr>
                        <td colspan="9">No hay datos</td>
                    </tr>
                </tbody>
                <?php endif;?> 
                <tfoot>
                    <tr >
                        <td colspan="9">
                           <span class="label label-info"><?php echo $row." Resultados encontrados..."; ?></span>  
                        </td>
                    </tr>      
                </tfoot>
    </table>


    <script type="text/javascript">
        $(function(){
        // Evento para poder pedir confirmación al moneto de eliminar un registro
            $("#acciones a").click(function(e){            
                if (confirm('Realmente quiere eliminarlo el registro?')){
                    return true;
                }
                else{
                    e.preventDefault();
                }
            });
            $("#detalles a").click(function(e){
                var page = $(this).attr("href");
                $.post(page,{},function(response){
                        var notice = response;
                        $("#ContenidoDetalles").html(notice);
                    });
                $( "#dialog-form").dialog( "open" );
                $(".ui-dialog-titlebar-close").hide();
                e.preventDefault();            
                
            });

        });        
    </script>    
<?php endif;?> 



<?php if($action=="comprar_recurso_add"): ?> 
    <table class="table table-striped table-bordered table-condensed" style="font-size:11px;">
            <thead>
               <tr>
                    <th>Id</th>
                    <th>SKU</th>
                    <th>Nombre del recurso</th>
                    <th>Marca</th>
                    <th>Stock</th>
                    <th>Presentación</th>
                    <th>UMedida</th>
                    <th>P.Com</th>
                    <th>P.Ven</th>
                    <th>StockMin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>        
            <?php if( count( $paginator )) :?>
            <tbody id="menu-compra">
                <?php foreach ($paginator as $value) : ?>            
                <tr>
                    <td><?php echo $value->idrecurso;?></td>
                    <td><?php echo $value->re_sku;?></td>
                    <td><?php echo $value->re_nombre;?></td>
                    <td><?php echo $value->re_marca;?></td>
                    <td><?php echo $value->re_stock;?></td>
                    <td><?php echo $value->re_presenta;?></td>
                    <td><?php echo $value->re_umedida;?></td>
                    <td><?php echo $value->re_pcompra;?></td>
                    <td><?php echo $value->re_pventa;?></td>
                    <td><?php echo $value->re_stockmin;?></td>
                    <td><?php echo $value->re_estado;?></td>                
                    <td width="77">
                        <a class="btn btn-mini btn-success" href="/async/dialogcomprarrecurso/?id=<?php echo $value->idrecurso ?>"><i class="icon-shopping-cart icon-white"></i> Agregar</a>                    
                    </td>
                </tr>          
            <?php endforeach;?>
            </tbody>        
            <?php else : ?>
            <tbody>
                <tr>
                    <td colspan="12">No hay datos</td>
                </tr>
            </tbody>
            <?php endif;?> 
            <tfoot>
                <tr >
                    <td colspan="12">
                        <span class="label label-info"><?php echo $row." Resultados encontrados..."; ?></span> 
                    </td>
                </tr>      
            </tfoot>
    </table>
    <script type="text/javascript">
        $(document).ready(inicializarEventos);
        function inicializarEventos()
        {
          //Para agregar Items al carrito
          $("#menu-compra a").click(function(e){
                e.preventDefault();
                var pagina=$(this).attr("href");
                $.post(pagina,function(data){$("#frmDialog").html(data);});
                $("#dialog-form").dialog("open");
            });              
            //Lueog de esto se vá al sección de comprar.phtml para proceder con la acción inserter
        }
    </script>
<?php endif;?>

<?php if($action=="boleta"): ?> 
     <table class="table table-striped table-bordered table-condensed">
            <thead>
               <tr>
                    <th>Id</th>
                    <th>NroBoleta</th>
                    <th>Fecha</th>
                    <th>Importe</th>
                    <th>Emisor</th>
                    <th>Acciones</th>
                </tr>
            </thead>        
            <?php if( count( $paginator )) :?>
            <tbody>
                <?php foreach ($paginator as $value) : ?>      
                <tr>
                    <td><?php echo $value->idboleta;?></td>
                    <td><?php echo $value->bo_nro;?></td>
                    <td><?php echo $value->bo_fech;?></td>
                    <td><?php echo $value->bo_importe;?></td>
                    <td><?php echo $value->bo_emisor;?></td>
                    <td width="88">                      
                        <div class="btn-group">
                          <a class="btn btn-mini btn-primary" href="#">Acción</a>
                          <a class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                          <ul class="dropdown-menu" style="text-align:left;">
                            <li id="update"><a href="/boleta/update/id/<?php echo $value->idboleta; ?>"  rel="popover" data-content="Si modifica este registro todos los registros vendidos con esta boleta se modificaran automáticamente." data-original-title="Atención"><i class="icon-pencil"></i> Editar</a></li>
                            <li id="delete">
                                <a href="/boleta/delete/id/<?php echo $value->idboleta; ?>"  rel="popover" data-content="Si elimina, se perderán totalmente todos los registros relacionados con esta boleta" data-original-title="Atención">
                                    <i class="icon-trash"></i> Eliminar
                                </a>
                            </li>
                          </ul>
                        </div>                       
                    </td>
                </tr>          
            <?php endforeach;?>
            </tbody>        
            <?php else : ?>
            <tbody>
                <tr>
                    <td colspan="5">No hay datos</td>
                </tr>
            </tbody>
            <?php endif;?> 
            <tfoot>
                <tr >
                    <td colspan="5">
                        <span class="label label-info"><?php echo $row." Resultados encontrados..."; ?></span>   
                    </td>
                </tr>      
            </tfoot>
    </table>
        <script type="text/javascript">
            $(function(){
                $("#update a").click(function(e){
                    e.preventDefault();
                    var url = $(this).attr('href');
                    if (confirm('Esto puede cambiar los registros que dependen de este. Realmente quiere editarlo?')) {
                        window.location.replace(url);
                    } else{
                        return true;
                    };
                })
                $("#delete a").click(function(e){
                    e.preventDefault();
                    var url = $(this).attr('href');
                    if (confirm('Si lo elimina se eliminarán todos los registros relacionados. Realmente quiere eliminar?')) {
                        window.location.replace(url);
                    } else{
                        return true;
                    };
                })
            });
        </script>
<?php endif;?>

<?php if($action=="factura"): ?> 
     <table class="table table-striped table-bordered table-condensed">
            <thead>
               <tr>
                    <th>Id</th>
                    <th>NroFactura</th>
                    <th>Fecha</th>
                    <th>SubTotal</th>
                    <th>Importe</th>
                    <th>Emisor</th>
                    <th>IGV</th>
                    <th>Acciones</th>
                </tr>
            </thead>        
            <?php if( count($paginator)) :?>
            <tbody>
                <?php foreach ($paginator as $value) : ?>          
                <tr>
                    <td><?php echo $value->idfactura;?></td>
                    <td><?php echo $value->fa_nro;?></td>
                    <td><?php echo $value->fa_fech;?></td>
                    <td><?php echo $value->fa_subtotal;?></td>
                    <td><?php echo $value->fa_total;?></td>
                    <td><?php echo $value->fa_emisor;?></td>
                    <td><?php echo $value->ig_tasa;?>%</td>
                    <td width="88">                      
                        <div class="btn-group">
                          <a class="btn btn-mini btn-primary" href="#">Acción</a>
                          <a class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                          <ul class="dropdown-menu" style="text-align:left;">
                            <li id="update"><a href="/factura/update/id/<?php echo $value->idfactura; ?>"  rel="popover" data-content="Si modifica este registro todos los registros vendidos con esta factura se modificaran automáticamente." data-original-title="Atención"><i class="icon-pencil"></i> Editar</a></li>
                            <li id="delete">
                                <a href="/factura/delete/id/<?php echo $value->idfactura; ?>"  rel="popover" data-content="Si elimina, se perderán totalmente todos los registros relacionados con esta factura" data-original-title="Atención">
                                    <i class="icon-trash"></i> Eliminar
                                </a>
                            </li>
                          </ul>
                        </div>                      
                    </td>
                </tr>          
            <?php endforeach;?>
            </tbody>        
            <?php else : ?>
            <tbody>
                <tr>
                    <td colspan="8">No hay datos</td>
                </tr>
            </tbody>
            <?php endif;?> 
            <tfoot>
                <tr >
                    <td colspan="8">
                       <span class="label label-info"><?php echo $row." Resultados encontrados..."; ?></span>   
                    </td>
                </tr>      
            </tfoot>
    </table>
        <script type="text/javascript">
            $(function(){
                $("#update a").click(function(e){
                    e.preventDefault();
                    var url = $(this).attr('href');
                    if (confirm('Esto puede cambiar los registros que dependen de este. Realmente quiere editarlo?')) {
                        window.location.replace(url);
                    } else{
                        return true;
                    };
                })
                $("#delete a").click(function(e){
                    e.preventDefault();
                    var url = $(this).attr('href');
                    if (confirm('Si lo elimina se eliminarán todos los registros relacionados. Realmente quiere eliminar?')) {
                        window.location.replace(url);
                    } else{
                        return true;
                    };
                })
            });
        </script>
<?php endif;?>