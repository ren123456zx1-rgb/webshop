# 🎨 Particle Effects Collection

## 📦 ไฟล์ที่มี

### 1. 🫧 Floating Bubbles (`floating-bubbles.php`)
ฟองอากาศลอยขึ้นแบบนุ่มนวล เหมาะกับธีมสีฟ้า/น้ำเงิน

**คุณสมบัติ:**
- ฟองอากาศ 3D สมจริงด้วย gradient และ shadow
- ระบบลมที่เปลี่ยนทิศทางแบบสุ่ม
- การเคลื่อนที่แบบ drift และ sway
- แสงสะท้อนบนฟองแบบสมจริง
- ขนาดและความเร็วที่หลากหลาย

### 2. ❄️ Snowfall (`snowfall.php`)
หิมะตกแบบสมจริง เหมาะกับธีมฤดูหนาว

**คุณสมบัติ:**
- เกล็ดหิมะ 7 รูปแบบ (❄ ❅ ❆ ✻ ✼ ❉ ✺)
- ระบบลมแบบสมจริง พร้อมลมกระโชก (wind gusts)
- เกล็ดหิมะหมุนและแกว่งไปมา
- Depth of field (เกล็ดหิมะที่ไกล = blur)
- ฟิสิกส์การตกที่สมจริง (เกล็ดใหญ่ตกเร็วกว่า)
- เอฟเฟกต์เรืองแสงรอบเกล็ดหิมะ

## 🚀 วิธีใช้งาน

### วิธีที่ 1: Include ในหน้า PHP
```php
<?php include('particles/floating-bubbles.php'); ?>
```
หรือ
```php
<?php include('particles/snowfall.php'); ?>
```

### วิธีที่ 2: เพิ่มใน index.php
เพิ่มโค้ดนี้ก่อน `</body>`:
```php
<?php 
// เลือกแบบที่ต้องการ
if($particle['type'] == 'bubbles') {
    include('particles/floating-bubbles.php');
} elseif($particle['type'] == 'snow') {
    include('particles/snowfall.php');
}
?>
```

### วิธีที่ 3: ใช้ใน Backend
ในหน้า particle_manage ให้เพิ่มตัวเลือก:
- `bubbles` = Floating Bubbles
- `snow` = Snowfall

## ⚙️ การปรับแต่ง

### Floating Bubbles
```javascript
const bubbleCount = 25;  // จำนวนฟอง (แนะนำ 20-30)
```

### Snowfall
```javascript
const snowflakeCount = 50;  // จำนวนเกล็ดหิมะ (แนะนำ 40-60)
```

## 🎨 การปรับสี

### Floating Bubbles
แก้ไขใน CSS:
```css
background: radial-gradient(circle at 30% 30%, 
    rgba(255, 255, 255, 0.8),      /* สีหลัก */
    rgba(173, 216, 230, 0.4) 40%,  /* สีฟ้าอ่อน */
    rgba(135, 206, 250, 0.2) 70%,  /* สีฟ้า */
    rgba(100, 149, 237, 0.1));     /* สีฟ้าเข้ม */
```

### Snowfall
แก้ไขใน CSS:
```css
color: #fff;  /* สีเกล็ดหิมะ */
text-shadow: 
    0 0 5px rgba(255, 255, 255, 0.8),     /* เรืองแสงขาว */
    0 0 10px rgba(200, 230, 255, 0.6),    /* เรืองแสงฟ้า */
    0 0 15px rgba(150, 200, 255, 0.4);    /* เรืองแสงฟ้าอ่อน */
```

## 📱 Performance

- ใช้ `pointer-events: none` เพื่อไม่ให้กระทบการคลิก
- ลบ particle ที่หมดอายุอัตโนมัติ
- จำกัดจำนวน particle สูงสุด
- ใช้ CSS animation แทน JavaScript เพื่อประสิทธิภาพที่ดี

## 🎯 Tips

1. **Floating Bubbles** เหมาะกับ:
   - เว็บไซต์ธีมน้ำ/ทะเล
   - เว็บไซต์เด็ก
   - เว็บไซต์สปา/รีสอร์ท

2. **Snowfall** เหมาะกับ:
   - โปรโมชั่นช่วงคริสต์มาส
   - เว็บไซต์ธีมฤดูหนาว
   - อีเวนต์พิเศษ

3. **ไม่ควรใช้ทั้ง 2 แบบพร้อมกัน** เพราะจะทำให้หน้าจอรกและกินทรัพยากรมาก

## 🔧 Troubleshooting

**ปัญหา: Particle ไม่แสดง**
- ตรวจสอบว่า z-index ไม่ถูกบัง
- ตรวจสอบว่า container มี `overflow: hidden`

**ปัญหา: Lag/ช้า**
- ลดจำนวน particle
- ลด blur effect
- ปิด shadow บางส่วน

**ปัญหา: Particle หายนอกหน้าจอ**
- ตรวจสอบค่า drift และ wind strength
- ปรับ boundary checking ใน JavaScript
