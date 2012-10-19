    <table class="table table-striped table-bordered table-condensed">
    <thead>
       <tr>
            <th>Id</th>
            <th>Nombre del recurso</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>PTotal</th>
            <th>Acciones</th>
        </tr>
    </thead>        
    <?php if( count($carrito)) :?>
    <input type="hidden" id="oculto" value="<?php echo count($carrito); ?>">
    <?php $Total = 0 ?>
    <tbody id="menucarritoajax">
        <?php foreach ($carrito as $key => $value): ?>            
        <tr>
            <td><?php echo $value['id'];?></td>
            <td><?php echo $value['nombre'];?></td>
            <td><?php echo $value['cantidad'];?></td>
            <td><?php echo $value['precio'];?></td>
            <td><?php echo $value['ptotal'];?></td>

            <td>
                <a class="btn btn-mini btn-danger" href="/async/deleteitem/id/<?php echo $value['id'] ?>"><i class="icon-trash icon-white"></i> Eliminar</a>                     
            </td>
            <?php $Total= $Total+$value['ptotal']; ?> 
        </tr>          
    <?php endforeach;?>
    </tbody>        
    <?php else : ?>
    <tbody>
        <tr>
            <td colspan="6">No hay datos</td>
        </tr>
    </tbody>
    <?php endif;?> 
    <tfoot>
            <tr class="alert alert-success">
                <td colspan="4" style="">
                    <h4>Total de la compra(S/.)</h4>
                </td>
                <td>
                    <input type="hidden" id="ocultoTotal" value="<?php echo $Total; ?>">
                    <h4>
                    <?php if( count($carrito)) : echo number_format($Total, 2, ',', ''); ?>
                    <?php else: echo number_format(0, 2, ',', ' '); ?>                      
                    <?php endif;?>
                    </h4>
                </td>
                <td></td>
            </tr>      
    </tfoot>
    </table>

    <script type="text/javascript">
        $(document).ready(iniciarajax)
        function iniciarajax(){
             $("#menucarritoajax a").click(function(e){
                e.preventDefault();
                var url = $(this).attr("href");
                $.post(url,function(data){$("#carrito").html(data);});
            });
        }
    </script>