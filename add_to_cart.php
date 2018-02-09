<?php 
    if(!isset($_SESSION)){
        session_start();
    }  
    if(empty($_SESSION['cart'])){   //開啟購物車session
        $_SESSION['cart']=[];
    }

    $sid=isset($_GET['sid'])?intval($_GET['sid']):0;
    $qty=isset($_GET['qty'])?intval($_GET['qty']):0;    //數量

    if(!empty($sid)){
        if(empty($qty)){        //刪除
            unset($_SESSION['cart'][$sid]);
        }else{      //加入or更新
            $_SESSION['cart'][$sid]=$qty;
        }
    }

    echo json_encode($_SESSION['cart']);
?>