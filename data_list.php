
<?php 
    include __DIR__.'/_db_connect.php';  
    $page_name='data_list';

    $per_page=4;
    $page=isset($_GET['page'])?intval($_GET['page']):1;

    $t_sql = "SELECT COUNT(1) FROM `products`";
    $t_result = $mysqli->query($t_sql);
    $t_rows = $t_result->fetch_row()[0];    //讀取筆數

    $t_pages = ceil($t_rows/$per_page); //總頁數


    $c_sql = sprintf("SELECT * FROM `products` LIMIT %s, %s", ($page-1)*$per_page, $per_page);
    $c_result = $mysqli->query($c_sql);
     
?>
<?php include __DIR__.'/data_head.php' ?>
    <style>
        .product-img {
            width: 100px;
            height:135px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <div class="container">
        <?php include __DIR__.'/data_nav.php' ; ?>
        <div class="row">
            <div class="col-md-3">
                <ul>
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="?page=1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">&lt;&lt;</span>
                                </a>
                            </li>
                            <?php for($i=1; $i<=$t_pages; $i++): ?>
                            <li class="page-item <?= $i==$page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $t_pages ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">&gt;&gt;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="row">
                    <?php while($row=$c_result->fetch_assoc()): ?>
                   <div class="col-md-3">
                        <div class="card">
                            <img class="product-img" src="imgs/small/<?= $row['book_id'] ?>.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['bookname'] ?></h5>
                                <p class="card-text"><i class="fas fa-male"></i> <?= $row['author'] ?><br>
                                    <i class="far fa-money-bill-alt"></i> <?= $row['price'] ?></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="" id="" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <a href="#" class="btn btn-primary"><i class="fas fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

    </div>
<?php include __DIR__.'/data_foot.php' ?>