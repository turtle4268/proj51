<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Shinder's STORE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <ul class="navbar-nav nav-pills mr-auto">
            <li class="nav-item">
                <a class="nav-link <?= $page_name=='data_list' ? 'active' : '' ?>" href="data_list.php">商品列表</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page_name=='data_cart' ? 'active' : '' ?>" href="data_cart.php">購物車
                    <span class="badge badge-pill badge-success item-count">0</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav nav-pills">
            <?php if(isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page_name=='data_edit' ? 'active' : '' ?>" href="data_edit.php"><?= $_SESSION['user']['nickname'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_name=='data_logout' ? 'active' : '' ?>" href="data_logout.php">登出</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link <?= $page_name=='data_login' ? 'active' : '' ?>" href="data_login.php">登入</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_name=='data_register' ? 'active' : '' ?>" href="data_register.php">註冊</a>
                </li>
            <?php endif;?>
        </ul>
    </div>
</nav>
<script>
    var itemCount=$(".item-count");
    itemCount.hide();
    var countItems=function(obj){
        itemCount.hide();
        var sum=0;

        for(var s in obj){
            sum+= obj[s];
        }
        itemCount.text(sum);
        itemCount.fadeIn();
    };

    $.get('add_to_cart.php',function(data){
        countItems(data);
    },'json');
</script>