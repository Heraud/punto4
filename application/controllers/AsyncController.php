<?php
class AsyncController extends Zend_Controller_Action
{
	public function init()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
	}
	public function indexAction(){
		echo "Holas";
	}
    
    // Validad la existencia del docuemento del personal en la Base de datos 
    public function validperdocuAction(){       
        $per_docu = $this->getRequest()->getParam('per_docu');
        if (!is_numeric($per_docu)) {
            echo $this->view->result = 3;//La entrada es texto
        }else{
            $modelPersonal = new Application_Model_modelPersonal();
            $dataPersonal = $modelPersonal->getVeryDocPersonal($per_docu);
            $countPersonal = count($dataPersonal);
            if ($countPersonal>0) {
                echo $this->view->result = 1;//Encontrado
            }else{
                echo $this->view->result = 0;//No ha encontrado
            }
        }
    }
	
// *******************PROCESO DE VALIDACIÓN DE IGV*********************************    
	// Validad la existencia del IGV en la Base de Datos 
	public function validarigvAction(){		
		$varid = $this->getRequest()->getParam('ig_tasa');
		if (!is_numeric($varid)) {
			echo $this->view->result = 3;//La entrada es texto
		}else{
			$model = new Application_Model_modelIgv();
			$data = $model->getVeryIGV($varid);
			$count = count($data);
			if ($count>0) {
				echo $this->view->result = 1;//Encontrado
			}else{
				echo $this->view->result = 0;//No ha encontrado
			}
		}
	}

    // **********PROCESO DE VALIDACIÓN DE LA EXISTENCIA DE LA TASA IGV EN BD PARA EVITAR INSERTAR DOBLE AL MOMENTO DE ACTUALIZAR
    public function validarigvupdateAction(){
        $varid = $this->getRequest()->getParam('ig_tasa');
        $BanderaNamespace  = new Zend_Session_Namespace();
        //Nos preguntamos si la tasa enviado desde la vista es lo mismo que estámos queriendo modificar
        if ($BanderaNamespace->Ig_Tasa == $varid) {
            //Si es verdad lo enviamos un valor para luego en la vista mandar un mensaje de que no devuelva ninguna advvertencia
            echo $this->view->result = 4;//La entrar es la misma que el que se está editando y no se hace nada
        } else {
            // En caso contrario hacemos el mismo proceso de validación de las tasas
            if (!is_numeric($varid)) {
                echo $this->view->result = 3;//La entrada es texto
            }else{
                $model = new Application_Model_modelIgv();
                $data = $model->getVeryIGV($varid);
                $count = count($data);
                if ($count>0) {
                    echo $this->view->result = 1;//Encontrado
                }else{
                    echo $this->view->result = 0;//No ha encontrado
                }
            }
        }
    }
    // **PROCESO DE VALIDACIÓN DE LA EXISTENCIA DEL NRO DE BOLETA EN BD PARA EVITAR INSERTAR DOBLE AL MOMENTO DE ACTUALIZAR
    public function validarboletaupdateAction(){
        $varid = $this->getRequest()->getParam('bo_nro');
        $BanderaNamespace  = new Zend_Session_Namespace();

        //Nos preguntamos si nro enviado desde la vista es lo mismo que estámos queriendo modificar
        if ($BanderaNamespace->Bo_Nro == $varid) {
            //Si es verdad lo enviamos un valor para luego en la vista mandar un mensaje de que no devuelva ninguna advvertencia
            echo $this->view->result = 4;//La entrar es la misma que el que se está editando y no se hace nada
        } else {
            // En caso contrario hacemos el mismo proceso de validación de número
            if (!is_numeric($varid)) {
                echo $this->view->result = 3;//La entrada es texto
            }else{
                $model = new Application_Model_modelBoleta();
                $data = $model->getVeryBoleta($varid);
                $count = count($data);
                if ($count>0) {
                    echo $this->view->result = 1;//Encontrado
                }else{
                    echo $this->view->result = 0;//No ha encontrado
                }
            }
        }
    }

    // **PROCESO DE VALIDACIÓN DE LA EXISTENCIA DEL NRO DE FACTURA EN LA BD PARA EVITAR INSERTAR DOBLE, AL MOMENTO DE ACTUALIZAR
    public function validarfacturaupdateAction(){
        $varid = $this->getRequest()->getParam('fa_nro');
        $BanderaNamespace  = new Zend_Session_Namespace();

        //Nos preguntamos si el núemro enviado desde la vista es lo mismo que estámos queriendo modificar
        if ($BanderaNamespace->Fa_Nro == $varid) {
            //Si es verdad lo enviamos un valor para luego en la vista mandar un mensaje de que no devuelva ninguna advvertencia
            echo $this->view->result = 4;//La entrar es la misma que el que se está editando y no se hace nada
        } else {
            // En caso contrario hacemos el mismo proceso de validación de los números
            if (!is_numeric($varid)) {
                echo $this->view->result = 3;//La entrada es texto
            }else{
                $model = new Application_Model_modelFactura();
                $data = $model->getVeryFactura($varid);
                $count = count($data);
                if ($count>0) {
                    echo $this->view->result = 1;//Encontrado
                }else{
                    echo $this->view->result = 0;//No ha encontrado
                }
            }
        }
    }


	// Validad la existencia del nombre usuario del personal en la Base de Datos para la tabla Ususario. 	
	public function validuserbdAction()	{		
		$us_user = $this->getRequest()->getParam('us_user');
		$modelUsuario = new Application_Model_modelUsuario();
		// echo "string";exit();
		$dataUsusario = $modelUsuario->getVeryUserBD($us_user);
		$countUsuario = count($dataUsusario);
		if ($countUsuario>0) {
			echo $this->view->result = 1;//Encontrado
		}else{
			echo $this->view->result = 0;//No ha encontrado
		}	
	}	

	// Validar la existencia del docuemento del proveedor en la Base de Datos para la tabla proveedor. 	
	public function validproveedorAction(){		
		$parameter = $this->getRequest()->getParam('pro_docu');
		if (!is_numeric($parameter)) {
			echo $this->view->result = 3;//La entrada es texto
		}else{
			$model= new Application_Model_modelProveedor();
			$data = $model->getVeryProveedor($parameter);
			$count = count($data);
			if ($count>0) {
				echo $this->view->result = 1;//Encontrado
			}else{
				echo $this->view->result = 0;//No ha encontrado
			}	
		}
	}	

	// Validad la existencia del nombre del recurso en la tabla recurso. 	
	public function verificarrecursonombreAction(){		
		$parameter = $this->getRequest()->getParam('re_nombre');
		$model = new Application_Model_modelRecurso();
		$data = $model->getVerificarRecursoNombre($parameter);
		$count = count($data);
		if ($count>0) {
			echo $this->view->result = 1;//Encontrado
		}else{
			echo $this->view->result = 0;//No ha encontrado
		}	
	}

// *******************PROCESO DE COMPRA*********************************

	// Modal dialog para ingresar los datos para comprar un recurso
    public function dialogcomprarrecursoAction(){
    	
        $id = $this->getRequest()->getParam('id');

        $Model =  new Application_Model_modelRecurso();
        $rsModel =  $Model->getRow($id);

        $form = new Zend_Form();

        $idrecurso = $form->createElement('text', 'idrecurso');
        $idrecurso->setLabel('Id')
                ->setAttrib('readonly',true)
                ->setValue($rsModel['idrecurso']);

        $nombre = $form->createElement('text', 'nombre');
        $nombre->setLabel("Nombre(*):")
                ->setValue($rsModel['re_nombre']);

        $cantidad = $form->createElement('text', 'cantidad');
        $cantidad->setLabel("Cantidad(*):")
                ->setValue("");

        $precio = $form->createElement('text', 'precio');
        $precio->setLabel("PCompra(*):")
                ->setValue($rsModel['re_pcompra']);


        $form->addElement($idrecurso)
        ->addElement($nombre)        
        ->addElement($cantidad)
            ->addElement($precio);

        echo $this->view->form = $form;
        
    }
    // Carrito en donde se vá almacenar temporalmente los Items para luego cenderlo
    public function carritoAction(){

		$id = $this->getRequest()->getParam('idrecurso');
		$nombre = $this->getRequest()->getParam('nombre');
		$cantidad = $this->getRequest()->getParam('cantidad');
		$precio = $this->getRequest()->getParam('precio');
		$ptotal = $cantidad*(double)$precio;

        $sessionNamespace  = new Zend_Session_Namespace();
         if($nombre){
            if (!isset($sessionNamespace ->ArrayCarrito)) {

                $sessionNamespace->ArrayCarrito[$id]['id']=$id;
                $sessionNamespace->ArrayCarrito[$id]['nombre']=$nombre;
                $sessionNamespace->ArrayCarrito[$id]['cantidad']=$cantidad;
                $sessionNamespace->ArrayCarrito[$id]['precio']=$precio;
                $sessionNamespace->ArrayCarrito[$id]['ptotal']=$ptotal;
            } else {
                foreach ($sessionNamespace ->ArrayCarrito as $key => $value) {
                    if ($value['id']==$id) {
                        
                        $sessionNamespace->ArrayCarrito[$id]['cantidad']=$value['cantidad']+$cantidad;
                        $sessionNamespace->ArrayCarrito[$id]['ptotal']=$value['ptotal']+$ptotal;
                        $encontrado = 1;
                    } 
                }
                if (!@$encontrado) {

                    $sessionNamespace->ArrayCarrito[$id]['id']=$id;
                    $sessionNamespace->ArrayCarrito[$id]['nombre']=$nombre;
                    $sessionNamespace->ArrayCarrito[$id]['cantidad']=$cantidad;
                    $sessionNamespace->ArrayCarrito[$id]['precio']=$precio;
                    $sessionNamespace->ArrayCarrito[$id]['ptotal']=$ptotal;                        
                }                
            }
          
        $row=count($sessionNamespace->ArrayCarrito);
        $carrito = $sessionNamespace->ArrayCarrito; 
        include('ajax/carrito.php');

         }else{
            echo "No parece enviar ningún dato ;(";
         }
        
    }
    // Para eliminar un items de la lista agregada
    public function deleteitemAction(){
        if (!$this->_hasParam('id')) {
            $this->_redirect('compra/comprar');
        } else {
            $sessionNamespace  = new Zend_Session_Namespace();
            unset($sessionNamespace->ArrayCarrito[$this->_getParam('id')]);
            $carrito = $sessionNamespace->ArrayCarrito; 
            include('ajax/carrito.php');
        }
    }

    public function cancelarcompraAction(){
    		$sessionNamespace  = new Zend_Session_Namespace();
           	unset($sessionNamespace->ArrayCarrito);
           	$carrito = $sessionNamespace->ArrayCarrito; 
            if(count($sessionNamespace->ArrayCarrito)){
            	echo $this->view->result = "No se pudo eliminar la lista debido a un problema";
            }
            else{
            	include('ajax/carrito.php');          	
            }
            
    }
    public function guardarcompraAction(){
        // Variables que se envía de la vista
        $idproveedor = $this->getRequest()->getParam('idproveedor');
        $co_nrofact =  $this->getRequest()->getParam('co_nrofact');
        $co_fech = $this->getRequest()->getParam('co_fech');
        $co_importe = $this->getRequest()->getParam('co_importe');
        $co_encargado = $this->getRequest()->getParam('co_encargado');
        
        // Instanciando nuestra sesión de nuestro carrito.
        $sessionNamespace  = new Zend_Session_Namespace();

        if (isset($idproveedor) && isset($co_nrofact) && isset($co_fech)) {
            $modelCompra = new Application_Model_modelCompra();
            $dataCompra = array(
                    'co_nrofact' => $co_nrofact,
                    'co_fech' => $co_fech,
                    'co_importe'=>$co_importe,
                    'co_encargado'=>$co_encargado,
                    'co_estado'=>'Activo',
                    'idproveedor'=>$idproveedor,
                    'idpersonal'=>1
                );
            try {
                $idcompra = $modelCompra->insert($dataCompra);   
            } catch (Exception $e) {
                echo 'Error en Compra: ', $e->getMessage(), "\n";
            }
            if (isset($idcompra)) {
                $modelDetalleCompra = new Application_Model_modelDetalleCompra();
                foreach ($sessionNamespace->ArrayCarrito as $key => $value) {
                    $dataDetalleCompra = array(
                            'dc_canti' => $value['cantidad'],
                            'dc_punitario' => $value['precio'],
                            'dc_ptotal' => $value['ptotal'],
                            'dc_estado' => 'Activo',
                            'idcompra' => $idcompra,
                            'idrecurso' => $value['id']
                        );
                    try {
                        $iddetallecompra = $modelDetalleCompra->insert($dataDetalleCompra);
                    } catch (Exception $e) {
                        echo "Error en DetalleCompras:",$e->getMessage(),"\n";
                    }
                }

                //Nos preguntamos que si todo ha marchado a la perfección.
                if (isset($iddetallecompra)) {
                    unset($sessionNamespace->ArrayCarrito);
                    echo $this->view->result = 1;  //Se retorna 1 en el caso de que la compra se hizo correctamente.
                }else{

                    //Si no ocurrio algún error en la Detalle compra eliminamos la compra.
                    $whereCompra = $modelCompra->getAdapter()->quoteInto('idcompra = ?', $idcompra);
                    $modelCompra->delete($whereCompra);

                    // echo $this->view->result = 0;  //Se retorna 0 en el caso No se pudo generar el DetalleCompra.
                    echo "No se pudo generar el DetalleCompra ";
                }
            }else{
                echo "Error al insertar la compra";
            }

        } else {
            echo "Alguno de los datos ingresados no son válidos";
        }
        exit();

        $sessionNamespace = new Zend_Session_Namespace();


        echo $this->view->result = $idproveedor.' '.$co_nrofact.' '.$co_fech;
    } 

    // PARA DETALLAR LA COMPRA
    public function detailsshopAction(){
        if(!$this->_hasParam('id')){
            echo $this->view->result = "El parámetro no se encuentra";
        }else{
            $idcompra = $this->_getParam('id');

            //Recueprando datos para los datos de la compra
            $modelCompra = new Application_Model_modelCompra();
            $dataCompra = $modelCompra->getRowCustom($idcompra);


            //Recuperando datos para detallar la compra
            $modelDetalleCompra = new Application_Model_modelDetalleCompra();
            try {
                $dataDetalleCompra = $modelDetalleCompra->getDetailsShopping($idcompra);   
            } catch (Exception $e) {
                echo "Error:", $e->getMessage();exit();
            }
            if (count($dataDetalleCompra)>0) {
                try {
                    require('ajax/DetalleCompra.php');   
                } catch (Exception $e) {
                    echo "Error:", $e->getMessage();exit();
                }
            }
            else{
                echo "Ops! me parece que no hay datos para esta compra";
            }

        }
    }
    // PARA IMPRIMIR DETALLE COMPRA 
    public function printdetailsshopAction(){
        if(!$this->_hasParam('id')){
            echo $this->view->result = "El parámetro no se encuentra";
        }else{
            $idcompra = $this->_getParam('id');

            //Recueprando datos para los datos de la compra
            $modelCompra = new Application_Model_modelCompra();
            $dataCompra = $modelCompra->getRowCustom($idcompra);

            $modelDetalleCompra = new Application_Model_modelDetalleCompra();
            try {
                $dataDetalleCompra = $modelDetalleCompra->getDetailsShopping($idcompra);   
            } catch (Exception $e) {
                echo "Error:", $e->getMessage();exit();
            }
            if (count($dataDetalleCompra)>0) {
                try {
                    include('ajax/ImprimirDetalleCompra.php');   
                } catch (Exception $e) {
                    echo "Error:", $e->getMessage();exit();
                }
            }
            else{
                echo "Ops! me parece que no hay datos para esta compra";
            }

        }
    }



}