<?php
require 'services/a_func.php'; 

$q = trim($_GET['q'] ?? '');
if ($q == '') exit;


$stmt = dd_q("SELECT id, name, price, img FROM box_product WHERE name LIKE ? LIMIT 10", ["%$q%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$results || count($results) == 0) {
    echo "<div class='list-group-item text-muted rounded search-muted'>ไม่พบสินค้า</div>";
    exit;
}

foreach ($results as $r) {
    echo "
    <a href='./buy?id=" . urlencode($r['id']) . "' 
       class='list-group-item list-group-item-action d-flex align-items-center search-item rounded mb-2 '
       data-name='" . htmlspecialchars($r['name']) . "'
       data-price='" . number_format($r['price']) . "'
       data-image='" . htmlspecialchars($r['img']) . "'>
      <img src='" . htmlspecialchars($r['img']) . "'  height='55' class='rounded me-3'>
      <div>
        <div class='fw-bold'>" . htmlspecialchars($r['name']) . "</div>
        <small class='text-muted'>" . number_format($r['price']) . " บาท</small>
      </div>
      <i class='fa fa-chevron-right ms-auto text-muted'></i>
    </a>";
}
?>
