<?php
require __DIR__ . '/__db_connect.php';

$sql = "SELECT * FROM categories ORDER BY parent_sid";

$result = $mysqli->query($sql);


$menu = [];

while($row = $result->fetch_assoc()){

    // 若是第一層分類
    if($row['parent_sid']==0) {
        $menu[$row['sid']] = $row;
    } else {
        // $menu[$row['parent_sid']]['sub'][] = $row;
        $menu[$row['parent_sid']]['sub'][$row['sid']] = $row;
    }

}

echo "<pre>";
print_r($menu);
echo "</pre>";