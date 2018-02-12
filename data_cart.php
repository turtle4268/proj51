
<?php 
    include __DIR__.'/_db_connect.php';  
    $page_name='data_cart';
    if(!empty($_SESSION['cart'])){
        $keys=array_keys($_SESSION['cart']);
        $sql=sprintf("SELECT * FROM products WHERE sid IN (%s)",implode(',',$keys));
        $result=$mysqli->query($sql);

        $cartdata=[];
        while($row=$result->fetch_assoc()){
            $row['qty']=$_SESSION['cart'][$row['sid']];
            $cartdata[$row['sid']]=$row;
        }
    }
?>
<?php include __DIR__.'/data_head.php' ?>
    <div class="container">
        <?php include __DIR__.'/data_nav.php' ; ?>
        <pre>
            <?php /* 
                print_r($_SESSION['cart']);
                print_r($result->fetch_all(MYSQLI_ASSOC)); */
            ?>
            <?php if(empty($cartdata)): ?>
                購物車裡沒有資料
            <?php else: ?>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">封面</th>
                            <th scope="col">書名</th>
                            <th scope="col">價格</th>
                            <th scope="col">數量</th>
                            <th scope="col">小計</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($_SESSION['cart'] as $sid =>$qty): ?>
                    <tr>
                        <th><img src="./imgs/small/<?= $cartdata[$sid]['book_id'] ?>.jpg" alt=""></th>
                        <td><?= $cartdata[$sid]['bookname'] ?></td>
                        <td><?= $cartdata[$sid]['price'] ?></td>
                        <td><?= $qty ?></td>
                        <td><?= $cartdata[$sid]['price'] * $qty ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
        </pre>
    </div>
<?php include __DIR__.'/data_foot.php' ?>