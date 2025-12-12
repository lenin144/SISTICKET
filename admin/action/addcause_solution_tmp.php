<?php
    /*-------------------------
    Autor: Autor Dev
    Web: www.google.com
    E-Mail: waptoing7@gmail.com
    ---------------------------*/
    include 'myLibAbisoftINC.php';
    $cart = new Cart;
    // include database configuration file
    include "../config/config.php";//Contiene funcion que conecta a la base de datos


    if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
        //determinar de donde vienen los datos:
        if (isset($_REQUEST['opt'])) {
            if ($_REQUEST['opt'] == 'add') {
                $urlLocation = "../?view=nuevo_cause_solution";
            }else if($_REQUEST['opt'] == 'edit'){
                $urlLocation = "../?view=editar_cause_solution&id=".$_REQUEST['idEdit'];
            }
        }
        if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
            $productID = $_REQUEST['id'];
            // echo  $_REQUEST['id'];
            $query = mysqli_query($con,"SELECT tipos_requerimientos.id as id, tipos_requerimientos.name AS categoria, area.name as area FROM `tipos_requerimientos` inner join area on tipos_requerimientos.area_id=area.id WHERE tipos_requerimientos.id = ".$productID);
            $row = mysqli_fetch_assoc($query);
            $itemData = array(
                'id' => $row['id'],
                'categoria' => $row['categoria'],
                'area' => $row['area']
            );
            
            $insertItem = $cart->insert($itemData);
            $redirectLoc = $insertItem?$urlLocation:$urlLocation;
            header("Location: ".$redirectLoc);
        }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
            $deleteItem = $cart->remove($_REQUEST['id']);
            header("Location: $urlLocation");
        }
    }else{
        header("Location: ../?view=cause_solution");
    }