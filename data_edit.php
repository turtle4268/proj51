
<?php 
    include __DIR__.'/_db_connect.php';  
    $page_name='data_register';

    $email="";
    $nickname="";
    $mobile="";
    $birthday="";
    $address="";
    
    if(isset($_POST['email'])){

        $email=trim($_POST['email']);
        $mobile=trim($_POST['mobile']);
        $address=trim($_POST['address']);
        $birthday=trim($_POST['birthday']);
        $nickname=trim($_POST['nickname']);

        $sql=sprintf("INSERT INTO `members`(
            `email`, `password`, `mobile`, 
            `address`, `birthday`, `hash`, 
            `nickname`, `create_at`) 
        VALUES (?, ?, ?, 
                ?, ?, ?, 
                ?, NOW())");
        $stmt=$mysqli->prepare($sql);

        $password=sha1($_POST['password']);
        $hash=sha1($email. $nickname. rand());
        $stmt->bind_param('sssssss',   //丟值進去
            $email,$password,$mobile,$address,$birthday,$hash,$nickname);
        $stmt->execute();
        $msg_code=$stmt->affected_rows;
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
        <?php if(isset($msg_code)){
            switch($msg_code){
                case 1:
                $name=$phone=$email=$address=$birthday="";
                    echo '<div class="alert alert-success" role="alert">
                        註冊成功
                        </div>';
                    break; 
                case -1:
                    echo '<div class="alert alert-danger" role="alert">
                        此Email已被註冊
                        </div>';
                    break;
                default:
                    echo '<div class="alert alert-danger" role="alert">
                    ERROR!
                    </div>';
            } 
        } ?>
        <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">註冊會員</h5>
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
                            <div class="form-group">
                                <label for="nickname"><i class="red_star">*</i> 暱稱</label>
                                <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Enter nickname" value="<?= $nickname ?>">
                                <small id="nicknameWarning" class="form-text text-muted warning">姓名少於二字</small>
                            </div>
                            <div class="form-group">
                                <label for="mobile">電話</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile" value="<?= $mobile ?>">
                                <small id="mobileWarning" class="form-text text-muted warning">電話格式錯誤</small>
                            </div>
                            <div class="form-group">
                                <label for="birthday">生日</label>
                                <input type="text" class="form-control datepicker" id="birthday" name="birthday" placeholder="Select birthday" value="<?= $birthday ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">地址</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?= $address ?>">
                            </div>
                            
                            <?php if(!isset($msg_code) or $msg_code!= 1): ?>
                            <button type="submit" class="btn btn-primary">送出</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <script>
         $( ".datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        function checkForm() {
            var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var email = document.form1.email.value;
            var password = document.form1.password.value;
            var nickname = document.form1.nickname.value;
            var mobile = document.form1.mobile.value;
            mobile=mobile.trim();
            var ifPass=true ;
            if( nickname.length<2 ){
                $('#nicknameWarning').show();
                ifPass=false ;
            }
            if( password.length<6 ){
                $('#passwordWarning').show();
                ifPass=false ;
            }
            if(! pattern.test(email) ){
                $('#emailWarning').show();
                ifPass=false ;
            }
            /*if(! /^09\d{8}$/.test(mobile) ){
                $('#mobileWarning').show();
                ifPass=false ;
            }  */
            return ifPass;
            
        }
    </script>
<?php include __DIR__.'/data_foot.php' ?>