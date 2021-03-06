
<?php 
    include __DIR__.'/_db_connect.php';  
    $page_name='data_list';

    $q_string=[];
    $per_page=6;
    $page=isset($_GET['page'])?intval($_GET['page']):1;
    $cate=isset($_GET['cate'])?intval($_GET['cate']):0;     //分類

    $where=" WHERE 1 ";     //分類內清單
    if(!empty($cate)){
        $where.="AND `category_sid`=$cate ";
        $q_string['cate']=$cate ;   //丟分類項進去
        //http_build_query($q_string)     產生cate=n&page=n的字串
    }
    $t_sql = "SELECT COUNT(1) FROM `products` $where";

    $t_result = $mysqli->query($t_sql);
    $t_rows = $t_result->fetch_row()[0];    //讀取筆數

    $t_pages = ceil($t_rows/$per_page); //總頁數


    $c_sql = sprintf("SELECT * FROM `products` $where LIMIT %s, %s", ($page-1)*$per_page, $per_page);
    $c_result = $mysqli->query($c_sql);

    $m_sql = "SELECT * FROM categories WHERE parent_sid=0 ORDER BY sid DESC";
    $m_result = $mysqli->query($m_sql);     //分類清單
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
                <div class="btn-group-vertical btn-block">
                <a class="btn btn-<?= $cate==0 ? '' : 'outline-' ?>primary" href="data_list.php">所有商品</a>
                <?php while($row=$m_result->fetch_assoc()): ?>
                    <a class="btn btn-<?= $cate==$row['sid'] ? '' : 'outline-' ?>primary" href="?cate=<?= $row['sid'] ?>"><?= $row['name'] ?></a>
                <?php endwhile; ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <?php $q_string['page']=1; ?>
                                <a class="page-link" href="?<?= http_build_query($q_string) ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">&lt;&lt;</span>
                                </a>
                            </li>
                            <?php for($i=1; $i<=$t_pages; $i++): 
                                $q_string['page']=$i;    
                            ?>
                            <li class="page-item <?= $i==$page ? 'active' : '' ?>"><a class="page-link" href="?<?= http_build_query($q_string) ?>"><?= $i ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item">
                                <?php $q_string['page']=$t_pages; ?>
                                <a class="page-link" href="?<?= http_build_query($q_string) ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">&gt;&gt;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="row">
                    <?php while($row=$c_result->fetch_assoc()): ?>
                    <?php for($i=0;$i<12;$i++){     ////TEST
                        if($i%2){

                        }else{
                            
                        }
                    } ?>
                   <div class="col-md-4">
                        <div class="card" data-sid="<?= $row['sid'] ?>">
                            <img class="product-img" src="imgs/small/<?= $row['book_id'] ?>.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['bookname'] ?></h5>
                                <p class="card-text"><i class="fas fa-male"></i> <?= $row['author'] ?><br>
                                    <i class="fas fa-dollar-sign"></i> <?= $row['price'] ?></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control qty">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary add-cart"><i class="fas fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

    </div>
    <script>
        $("button.add-cart").click(function(){
            var card=$(this).closest(".card");
            var combo=card.find("select");
            var sid=card.data('sid');
            var qty=combo.val();

            //alert(sid+" : "+qty);

            $.get('add_to_cart.php',{sid:sid,qty:qty},function(data){
                console.log(data);
                //alert("商品已加入購物車");
                countItems(data);
            },"json");
        });
    </script>
<?php include __DIR__.'/data_foot.php' ?>