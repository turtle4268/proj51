
<?php 
    include __DIR__.'/_db_connect.php';  
    $page_name='data_login';

    $email="";
    
    if(isset($_POST['email'])){

        $email=trim($_POST['email']);
        $sql=sprintf("SELECT `id`, `email`, `mobile`, `address`, `birthday`, `nickname` FROM `members` WHERE `email`='%s' AND `password`='%s'",
            $mysqli->escape_string($email),
            sha1($_POST['password'])
        );
        $result=$mysqli->query($sql);
        $logined=false;
         
        if($result->num_rows ==1){
            $logined=true ;
            $row=$result->fetch_assoc();
            $_SESSION['user']=$row;
        }
    }
     
?>
<?php include __DIR__.'/data_head.php' ?>
    <style>
        small.warning{
            display:none ;
            color: red !important;
        }
        .red_star{
            color:#F00 ;
        }
    </style>
    <div class="container">
        <?php include __DIR__.'/data_nav.php' ; ?>
        <?php if(isset($logined)){
            if($logined){
                echo '<div class="alert alert-success" role="alert">登入成功</div>';
                echo '3秒後跳轉回首頁';
            } else{
                echo '<div class="alert alert-danger" role="alert">帳號或密碼錯誤</div>';
            }
        } ?>
        <?php if(!isset($logined) or $logined==false): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">登入</h5>
                        <form method="post" action="" name="form1" onsubmit="return checkForm()">
                            <div class="form-group">
                                <label for="email"><i class="red_star">*</i> Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= $email ?>">
                                <small id="emailWarning" class="form-text text-muted warning">Email格式錯誤</small>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="red_star">*</i> 密碼</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="">
                                <small id="passwordWarning" class="form-text text-muted warning">密碼少於六字</small>
                            </div>
                            
                            <?php if(!(isset($logined) and $logined)): ?>
                            <button type="submit" class="btn btn-primary">登入</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>  
    </div>
    <script>
        
        function checkForm() {
            var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var email = document.form1.email.value;
            var password = document.form1.password.value;
            var ifPass=true ;
            if( password.length<6 ){
                $('#passwordWarning').show();
                ifPass=false ;
            }
            if(! pattern.test(email) ){
                $('#emailWarning').show();
                ifPass=false ;
            }

            return ifPass;
        }
        <?php if(isset($logined)and $logined): ?>
        setTimeout(function(){
            location.href='./data_index.php';
        }, 3000);
        <?php endif; ?>
    </script>
<?php include __DIR__.'/data_foot.php' ?>