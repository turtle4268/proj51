
<?php 
    include __DIR__.'/_db_connect.php';  
    $page_name='data_register';
     
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

        <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">註冊會員</h5>
                        <form method="post" action="" name="form1" onsubmit="return checkForm()">
                            <div class="form-group">
                                <label for="email"><i class="red_star">*</i> Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="">
                                <small id="emailWarning" class="form-text text-muted warning">Email格式錯誤</small>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="red_star">*</i> 密碼</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="">
                                <small id="passwordWarning" class="form-text text-muted warning">密碼少於六字</small>
                            </div>
                            <div class="form-group">
                                <label for="nickname"><i class="red_star">*</i> 暱稱</label>
                                <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Enter nickname" value="">
                                <small id="nicknameWarning" class="form-text text-muted warning">姓名少於二字</small>
                            </div>
                            <div class="form-group">
                                <label for="phone">電話</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="">
                                <small id="phoneWarning" class="form-text text-muted warning">電話格式錯誤</small>
                            </div>
                            <div class="form-group">
                                <label for="birthday">生日</label>
                                <input type="text" class="form-control datepicker" id="birthday" name="birthday" placeholder="Select birthday" value="">
                            </div>
                            <div class="form-group">
                                <label for="address">地址</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="">
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
            var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var email = document.form1.email.value;
            var password = document.form1.password.value;
            var nickname = document.form1.nickname.value;
            var phone = document.form1.phone.value;
            phone=phone.trim();
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
            /*if(! /^09\d{8}$/.test(phone) ){
                $('#phoneWarning').show();
                ifPass=false ;
            }  */
            return ifPass;
            
        }
    </script>
<?php include __DIR__.'/data_foot.php' ?>