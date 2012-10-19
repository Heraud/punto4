<?php foreach($dataCompra as $val): ?>
    <h5>Proveedor: <?php echo $val->pro_nombre; ?></h5> 
<?php endforeach; ?>
<table class="table table-striped table-bordered table-condensed" style="font-size:11px;">
    <thead>
       <tr>
            <th>Id</th>
            <th>Nombre del recurso</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>PTotal</th>
        </tr>
    </thead>        
    <?php if( count($dataDetalleCompra)) :?>
    <?php $Total = 0 ?>
    <tbody id="menudataDetalleCompraajax">
        <?php foreach ($dataDetalleCompra as $key => $value): ?>            
        <tr>
            <td><?php echo $value['idrecurso'];?></td>
            <td><?php echo $value['re_nombre'];?></td>
            <td><?php echo $value['dc_canti'];?></td>
            <td><?php echo $value['dc_punitario'];?></td>
            <td><?php echo $value['dc_ptotal'];?></td>

            <?php $Total= $Total+$value['dc_ptotal']; ?> 
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
                    <?php if( count($dataDetalleCompra)) : echo number_format($Total, 2, ',', ''); ?>
                    <?php else: echo number_format(0, 2, ',', ' '); ?>                      
                    <?php endif;?>
                    </h4>
                </td>
            </tr>      
    </tfoot>
    </table>