
<?php 
    include __DIR__.'/_db_connect.php';  
    $page_name='data_edit';
    
    if(isset($_POST['password'])){
        //檢查密碼是否正確
        $check_sql=sprintf("SELECT 1 FROM `members` WHERE `id`='%s' AND `password`='%s'",
            intval($_SESSION['user']['id']),
            sha1($_POST['password'])
        );

        $c_result = $mysqli->query($check_sql);

        $bad_pass=true;     //預設密碼錯誤
        if($c_result->num_rows == 1){
            $bad_pass=false ;

            $mobile=trim($_POST['mobile']);
            $address=trim($_POST['address']);
            $birthday=trim($_POST['birthday']);
            $nickname=trim($_POST['nickname']);

            $sql="UPDATE `members` SET `mobile`=?,`address`=?,`birthday`=?,`nickname`=? WHERE `id`=?";
            $stmt=$mysqli->prepare($sql);

            $stmt->bind_param('ssssi',   //丟值進去
                $mobile,$address,$birthday,$nickname,$_SESSION['user']['id']);
            $stmt->execute();
            $msg_code=$stmt->affected_rows;
            if($msg_code==1){       //更改session
                $_SESSION['user']['mobile']=$mobile;
                $_SESSION['user']['address']=$address;
                $_SESSION['user']['birthday']=$birthday;
                $_SESSION['user']['nickname']=$nickname;
            }
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
        <?php if(isset($bad_pass)){
            if($bad_pass){
                echo '<div class="alert alert-danger" role="alert">
                    密碼錯誤!
                    </div>';
            }else{
                if($msg_code==1){
                    echo '<div class="alert alert-success" role="alert">
                        修改成功
                        </div>';
                }else{
                    echo '<div class="alert alert-info" role="alert">
                    沒有修改
                    </div>';
                }
            }
        } ?>
        
        <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">修改會員資料</h5>
                        <form method="post" action="" name="form1" onsubmit="return checkForm()">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" disabled="" placeholder="Enter email" value="<?= $_SESSION['user']['email'] ?>">
                                <small id="emailWarning" class="form-text text-muted warning">Email格式錯誤</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="nickname">暱稱</label>
                                <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Enter nickname" value="<?= $_SESSION['user']['nickname'] ?>">
                                <small id="nicknameWarning" class="form-text text-muted warning">姓名少於二字</small>
                            </div>
                            <div class="form-group">
                                <label for="mobile">電話</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile" value="<?= $_SESSION['user']['mobile'] ?>">
                                <small id="mobileWarning" class="form-text text-muted warning">電話格式錯誤</small>
                            </div>
                            <div class="form-group">
                                <label for="birthday">生日</label>
                                <input type="text" class="form-control datepicker" id="birthday" name="birthday" placeholder="Select birthday" value="<?= $_SESSION['user']['birthday'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">地址</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?= $_SESSION['user']['address'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="password"><i class="red_star">*</i> 確認密碼</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="">
                                <small id="passwordWarning" class="form-text text-muted warning">密碼少於六字</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">送出</button>
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
            
            return ifPass;
            
        }
    </script>
<?php include __DIR__.'/data_foot.php' ?>