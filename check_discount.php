<?php
require 'services/a_func.php';

$code = trim($_POST['code'] ?? '');
$product_id = intval($_POST['product_id'] ?? 0);

if ($code == '' || $product_id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'ข้อมูลไม่ถูกต้อง']);
    exit;
}

// ✅ ค้นหาโค้ดในฐานข้อมูล
$stmt = dd_q("SELECT * FROM discount_codes WHERE code = ? LIMIT 1", [$code]);

if ($stmt->rowCount() == 0) {
    echo json_encode(['status' => 'error', 'message' => 'ไม่พบโค้ดส่วนลดนี้']);
    exit;
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

// ✅ ตรวจสอบสถานะโค้ด
if ($row['status'] !== 'active') {
    echo json_encode(['status' => 'error', 'message' => 'โค้ดนี้ปิดใช้งานชั่วคราว']);
    exit;
}

// ✅ ตรวจสอบจำนวนการใช้งาน (max_uses)
if ($row['max_uses'] > 0 && $row['used_count'] >= $row['max_uses']) {
    echo json_encode(['status' => 'error', 'message' => 'โค้ดนี้ถูกใช้ครบจำนวนแล้ว']);
    exit;
}

// ✅ ตรวจสอบว่าสินค้านี้ใช้ได้ไหม
$allowed_products = explode(',', $row['products']); // เก็บ ID เป็น array เช่น ["1", "2", "3"]

if (!in_array($product_id, $allowed_products)) {
    echo json_encode(['status' => 'error', 'message' => 'โค้ดนี้ไม่สามารถใช้กับสินค้านี้ได้']);
    exit;
}

// ✅ ถ้าผ่านทุกเงื่อนไข
$type = $row['discount_type'];
$value = floatval($row['discount_value']);
$msg = ($type === 'percent') ? "ส่วนลด $value%" : "ส่วนลด $value บาท";

echo json_encode([
    'status' => 'success',
    'message' => $msg,
    'type' => $type,
    'value' => $value
]);
