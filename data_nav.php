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
                <a class="nav-link <?= $page_name=='data_insert' ? 'active' : '' ?>" href="data_insert.php">購物車</a>
            </li>
        </ul>
        <ul class="navbar-nav nav-pills">
            <li class="nav-item">
                <a class="nav-link <?= $page_name=='data_singin' ? 'active' : '' ?>" href="data_singin.php">登入</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page_name=='data_register' ? 'active' : '' ?>" href="data_register.php">註冊</a>
            </li>
        </ul>
    </div>
</nav>