<style>
    .shops {
        padding: 20px;
        border-radius: 1vh;
    }

    .shops-body {
        position: relative;
        color: #fff;
        font-weight: 600;
        height: 100%;
    }

    .shops-body>.shops-img {
        width: 100%;
        height: 100%;
        border-radius: 1vh;
        transition: all .5s ease;
    }

    .shops-body>.shops-img:hover {
        transform: scale(1.035);
    }

    .shops-body>.shops-text-center {
        position: absolute;
        top: 80%;
        left: 20%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all .5s ease;
    }

    .shops-body:hover>.shops-text-center {
        left: 50%;
        opacity: 1;
        font-size: 20px;
        padding: 0 20px;
        border-radius: 2vh;
        background-color: ;
    }
</style>
<style>
   .img-anim {
        position: relative;
        text-align: center;
        overflow: hidden;
        border-radius: 1vh;
    }

    .img-anim img {
        width: 100%;
        height: auto;
        margin-left: auto;
    }

    .img-anim>img {
        background-size: cover;
        background-position: center;
        transition: all 0.3s ease;
    }

    .img-anim>div.bg {
        position: absolute;
        z-index: 2;
        opacity: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(1, 1, 1, 0.3);
        transition: all 0.3s ease;
    }

    .img-anim>div.text {
        position: absolute;
        z-index: 3;
        top: 120%;
        left: 50%;
        opacity: 0;
        color: #fff;
        font-size: 20px;
        border-bottom: 3px solid transparent;
        border-image: linear-gradient(to right, var(--main), var(--main));
        border-image-slice: 1;
        transform: translate(-50%, -50%);
        transition: all 0.3s ease;
    }

    .img-anim:hover>img {
        transform: scale(1.1);
    }

    .img-anim:hover>div {
        opacity: 1;
    }

    .img-anim:hover>div.text {
        top: 80%;
        opacity: 1;
    }

    .content {
        height: auto;
        border: 3px solid rgba(0, 0, 0, .3);
        transition: all .5s ease;
    }

    .content:hover {
        border: 3.5px solid var(--main);
    }
    .font-bold {
        font-weight: 700;
    }
    .font-semibold {
        font-weight: 600;
    }  
    .border-hov {
        border: 1px solid #ccc;
        transition: 0.3s ease-in-out;
    }
</style>

<div class="container-fluid  mt-4 p-0 " data-aos="<?php echo $anim; ?>" data-aos-duration="600">
        <div class="container p-4 pt-0 pb-0 m-cent">
            <div id="carouselExampleControls" class="carousel slide border-spe" data-bs-ride="carousel" style="border-radius: 1vh;">
                <div class="carousel-inner" style="border-radius: 1vh;">
                    <?php
                    $active = false;
                    $find = dd_q("SELECT * FROM carousel");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <div class="carousel-item <?php if (!$active) {
                                                        echo "active";
                                                        $active = true;
                                                    } ?>">
                            <img src="<?php echo $row['link'] ?>" class="d-block w-100" alt="..." style="border-radius: 1vh;">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
<div class="container mt-0 p-0 " data-aos="<?php echo $anim; ?>" data-aos-duration="800">

    <div class="container m-cent p-2 pt-2 pb-0 " style="border-radius: 1vh;" data-aos="<?php echo $anim; ?>" data-aos-duration="800">

        <?php
        $boxlog = dd_q("SELECT * FROM users");
        $m_count = $boxlog->rowCount() + $static['m_count'];

     $boxlog = dd_q("SELECT SUM(amount) AS amount FROM topup_his");
$row = $boxlog->fetch(PDO::FETCH_ASSOC);
$c_count = $row['amount'] + $static['c_count'];


        $boxlog = dd_q("SELECT * FROM box_stock");
        $s_count = $boxlog->rowCount() + $static['s_count'];

        $boxlog = dd_q("SELECT * FROM boxlog");
        $b_count = $boxlog->rowCount() + $static['b_count'];
        
        ?>

    <style>
.stat-card {
  position: relative;
  background: rgba(20, 20, 20, 0.9);
  border-radius: 1vh;
  padding: 1.5rem;
  height: 100%;
  overflow: hidden;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.stat-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 18px rgba(0, 0, 0, 0.3);
}

/* ✅ icon BG (element แยกออกจากกัน) */
.stat-bg-icon {
  position: absolute;
  bottom: -10px;
  right: -10px;
  rotate: -15deg;
  font-size: 6rem;
  color: var(--main-opa-50);
  z-index: 0;
  pointer-events: none;
  transition: all 0.5s ease-in-out;
}
.stat-card:hover .stat-bg-icon {
  color: var(--main-opa-50);
  transform: scale(1.05) rotateY(360deg);
}

/* ✅ ข้อความ */
.stat-title {
  font-size: 1.2rem;
  color: var(--font);
  font-weight: 600;
  margin-bottom: 0.25rem;
  z-index: 1;
}

.stat-value {
  font-size: 1.6rem;
  color: var(--main);
  font-weight: 700;
  z-index: 1;
}

/* ✅ layout responsive */
@media (max-width: 992px) {
  .stat-col {
    flex: 0 0 50%;
    max-width: 50%;
  }
}

@media (max-width: 576px) {
  .stat-bg-icon {
    font-size: 4rem;
  }
  .stat-title {
    font-size: 1rem;
  }
  .stat-value {
    font-size: 1.3rem;
  }
}
/* 💡 ปรับให้กล่องทั้งหมด scale ลงในมือถือ */
@media (max-width: 768px) {
  .stat-card {
    transform: scale(0.85);   /* ลดขนาดโดยรวม 85% */
    transform-origin: top center;
  }

  .stat-card .stat-title {
    font-size: 1rem;          /* ลด font ตาม */
  }

  .stat-card .stat-value {
    font-size: 1rem;
  }

  .stat-card .fa-3x .icst {
    font-size: 2.2rem;
  }

  .stat-bg-icon {
    font-size: 4rem;
    right: 5px;
    bottom: -8px;
  }
}

/* ✅ ปรับในมือถือ */
@media (max-width: 768px) {

  /* กล่องทั้งหมดให้เล็กลงหน่อย */
  .stat-card {
    padding: 0.9rem 1rem;
    border-radius: 0.8vh;
    transform: scale(0.9);
    transform-origin: top center;
  }

  /* ข้อความ */
  .stat-title {
    font-size: 0.9rem;
    line-height: 1.1rem;
    word-break: keep-all ;
  }

  .stat-value {
    font-size: .7rem;
    line-height: 1.3rem;
  }

  /* ไอคอนหลัก */
  .stat-card i.fa-3x .icst {
    font-size: 1.9rem !important;
  }

  /* ไอคอนจางด้านหลัง */
  .stat-bg-icon {
    font-size: 3.3rem;
    right: 5px;
    bottom: -6px;
  }

  /* ลดช่องห่างระหว่างกล่อง */
  .row.g-3 {
    row-gap: 0rem !important;
  }
}

/* ✅ เพิ่มความสมูทตอนย่อ */
.stats-wrapper, .stat-card {
  transition: all 0.3s ease;
}

/* ปรับ layout เฉพาะมือถือ */
@media (max-width: 768px) {
  /* ลด padding และความสูงของการ์ด */
  .stat-card {
    padding: 0.6rem 0.8rem !important;
    border-radius: 0.6vh !important;
    transform: scale(0.9);
    transform-origin: top center;
    margin-bottom: 0.5rem !important;
  }

  /* ลดขนาด font ทั้งหมดในกล่อง */
  .stat-title {
    font-size: 0.85rem !important;
    line-height: 1rem !important;
  }

  .stat-value {
    font-size: 1rem !important;
    line-height: 1.2rem !important;
  }

  /* ย่อขนาด icon หลักให้เหมาะกับจอมือถือ */
  .stat-card i.fa-3x .icst {
    font-size: 1.7rem !important;
  }

  /* ปรับขนาด overlay icon พื้นหลังให้เล็กลงด้วย */
  .stat-bg-icon {
    font-size: 3rem !important;
    right: 4px;
    bottom: -6px;
    opacity: 0.1;
  }

  /* ปรับระยะห่างระหว่างคอลัมน์ให้แน่นขึ้น */
  .row.g-3 {
    --bs-gutter-x: 0rem;
    --bs-gutter-y: 0rem;
  }

  /* ให้ทุกกล่องสูงใกล้เคียงกัน */
  .stat-card {
    min-height: 90px !important;
  }
}

/* ให้การเปลี่ยนขนาดนุ่มนวล */
.stat-card {
  transition: all 0.25s ease;
}
.stat-card .icst {
    transition: transform 0.35s ease;
    transform: translateX(-18px) scale(2.3) rotate(-35deg) ;
}
.stat-card:hover .icst {
    transform: scale(1.5);
}

@media (max-width: 768px) {
  .stat-card .icst {
    transform: translateX(-15px) scale(1.2) rotate(-35deg) ;
  }
  .stat-card:hover .icst {
    transform: scale(1) translateX(-5px);
  }
  .stat-bg-icon {
    right: -20px;
    transform: scale(2) rotate(-42px) rotateY(360deg);
  }
  .stat-card:hover .stat-bg-icon {
    transform: scale(2.2) rotate(-42px) rotateY(360deg);
  }
}
</style>

<div class="container-fluid mt-3 mb-3">
  <div class="row g-3">

    <!-- สมาชิก -->
    <div class="col-lg-3 col-md-6 stat-col">
      <div class="stat-card <?php echo $bg?>">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index:1;">
          <i class="fa-duotone fa-user fa-3x icst text-main"></i>
          <div class="text-end">
            <div class="stat-title">สมาชิกทั้งหมด</div>
            <div class="stat-value"><?php echo $m_count; ?> คน</div>
          </div>
        </div>
        <i class="fa-duotone fa-user stat-bg-icon"></i>
      </div>
    </div>

    <!-- หมวดหมู่ -->
    <div class="col-lg-3 col-md-6 stat-col">
      <div class="stat-card <?php echo $bg?>">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index:1;">
          <i class="fa-duotone fa-dollar fa-3x icst text-main"></i>
          <div class="text-end">
            <div class="stat-title">เติมเงินรวม</div>
            <div class="stat-value" ><?php echo $c_count; ?> บาท</div>
          </div>
        </div>
        <i class="fa-duotone fa-dollar stat-bg-icon"></i>
      </div>
    </div>

    <!-- พร้อมจำหน่าย -->
    <div class="col-lg-3 col-md-6 stat-col">
      <div class="stat-card <?php echo $bg?>">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index:1;">
          <i class="fa-duotone fa-box-taped fa-3x icst text-main"></i>
          <div class="text-end">
            <div class="stat-title">พร้อมจำหน่าย</div>
            <div class="stat-value"><?php echo $s_count; ?> ชิ้น</div>
          </div>
        </div>
        <i class="fa-duotone fa-box-taped stat-bg-icon"></i>
      </div>
    </div>

    <!-- จำหน่ายไปแล้ว -->
    <div class="col-lg-3 col-md-6 stat-col">
      <div class="stat-card <?php echo $bg?>">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index:1;">
          <i class="fa-duotone fa-box-open fa-3x icst text-main"></i>
          <div class="text-end">
            <div class="stat-title">จำหน่ายไปแล้ว</div>
            <div class="stat-value"><?php echo $b_count; ?> ครั้ง</div>
          </div>
        </div>
        <i class="fa-duotone fa-box-open stat-bg-icon"></i>
      </div>
    </div>

  </div>
</div>


    <div class="container-sm ps-4 pe-4 mb-3">
        <div class="w-100 <?php echo $bg?> shadow ps-0 pe-1 pe-lg-4 align-contant-center" style="border-radius: 1vh;">
            <div class="row p-2">
                <div class="col-6 col-lg-2 text-main">
                    <div class="p-2" style="border-radius: 1vh;background-color: var(--main);font-size: 20px;">
                        <p class="text-center text-white m-0 font-semibold"><i class="fa-duotone fa-bullhorn font-semibold" style="color: #ffffff;"></i>&nbsp;ประกาศ</p>
                    </div>
                </div>
                <div class="col-6 col-lg-10 p-0 font-semibold text-main" style="margin-top: 2.5px;">
                    <marquee class="mt-2"><?= $config['ann'] ?></marquee>
                </div>
            </div>
        </div>
    </div>
    <style>
      .hbtn {
        transition: transform 0.3s ease;
      }
      .hbtn:hover {
        transform: translateY(-10px);
      }
    </style>
    <?php 
$help = dd_q("SELECT * FROM helpbtn");
$helps = $help->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container-sm ps-4 pe-4 mb-3">
    <div class="row justify-content-center g-35 w-100"> <!-- เพิ่ม g-4 ให้ระยะห่างสวย -->
<style>
  .g-35 { 
    --bs-gutter-x: 0.5rem;
    --bs-gutter-y: .5rem;
  }
</style>
        <?php foreach($helps as $row): ?>
        <?php if($row['status'] == "1"): ?>

        <!-- มือถือ = 2 คอลัมน์ / คอม = 4 คอลัมน์ -->
        <div class="col-6 col-lg-3 d-flex justify-content-center">

          <a href="<?= (strpos($row['link'], 'http') === 0) ? $row['link'] : 'https://'.$row['link'] ?>" 
             style="text-decoration:none; display:inline-block;">

            <div class="text-center">

              <img class="hbtn"
                   src="<?= $row['img'] ?: 'default.png' ?>"
                   style="
                        width:100%;
                        max-width:300px;   
                        height:auto;
                        border-radius:.5rem;
                        box-shadow:0 4px 8px #00000025;
                   "
                   alt="">

            </div>

          </a>

        </div>

        <?php endif; ?>
        <?php endforeach; ?>

    </div>
</div>

<?php
function timeAgoTH($datetime) {
  $time = strtotime($datetime);
  $diff = time() - $time;
  if ($diff < 60) return "เมื่อสักครู่";
  $m = floor($diff / 60);
  if ($m < 60) return "$m นาทีที่แล้ว";
  $h = floor($diff / 3600);
  if ($h < 24) return "$h ชั่วโมงที่แล้ว";
  $d = floor($diff / 86400);
  if ($d < 7) return "$d วันที่แล้ว";
  $w = floor($diff / 604800);
  if ($w < 4) return "$w สัปดาห์ที่แล้ว";
  $mo = floor($diff / 2600640);
  if ($mo < 12) return "$mo เดือนที่แล้ว";
  return floor($diff / 31207680) . " ปีที่แล้ว";
}

$q = dd_q("
  SELECT b.*, COALESCE(p.img, c.img) AS img 
  FROM boxlog b 
  LEFT JOIN box_product p ON p.name = b.category 
  LEFT JOIN category c ON c.c_name = b.category 
  ORDER BY b.id DESC 
  LIMIT 6
");
?>

<div class="container mt-4 ">
  <div class="<?= $bg ?>  shadow-sm p-3" style="border-radius:1rem">
    <h5 class="mb-3 d-flex align-items-center gap-2" style="color: var(--font)">
      <i class="fa-duotone fa-bags-shopping"></i>
      <span>รายการสั่งซื้อ (ล่าสุด)</span>
    </h5>

    <div class="order-wrapper">
      <div id="order-scroll" class="scroll-container">
        <?php while ($r = $q->fetch(PDO::FETCH_ASSOC)): ?>
          <div class="order-item">
            <div class="order-left">
              <img src="<?= $r['img'] ?: 'https://via.placeholder.com/100x100?text=No+Img' ?>" class="order-img" loading="lazy">
            </div>
            <div class="order-right">
              <div class="order-name">
                <?= htmlspecialchars($r['category']) ?>
              </div>
              <div class="order-date"><?= timeAgoTH($r['date']) ?></div>
              <div class="badge-success mt-1">
                <i class="fa-duotone fa-circle-check"></i> ขายแล้ว
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<style>
.order-wrapper {
  position: relative;
}

/* ขอบเฟดซ้าย-ขวา (เอาออกได้ถ้าไม่ชอบ) */
.order-wrapper::before,
.order-wrapper::after {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  width: 32px;
  pointer-events: none;
  z-index: 2;
}
.order-wrapper::before {
  left: 0;
  background: linear-gradient(to right, <?= $bg == 'bg-light' ? '#f8f9fa' : '#000000' ?> 0%, transparent 100%);
}
.order-wrapper::after {
  right: 0;
  background: linear-gradient(to left, <?= $bg == 'bg-light' ? '#f8f9fa' : '#000000' ?> 0%, transparent 100%);
}

/* แถวสไลด์ */
.scroll-container {
  display: flex;
  gap: 10px;
  overflow-x: hidden;      /* เราเลื่อนด้วย JS */
  -ms-overflow-style: none;
  scrollbar-width: none;
  padding: 5px 0 10px;
}
.scroll-container::-webkit-scrollbar { display: none; }

.badge-success {
  background-color: #06c167d9;
  border: 1px solid #06c167d9;
  color: #fff;
  padding: 2px 6px;
  border-radius: 999px;
  font-size: 12px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.badge-success i {
  color: #FFF;
}

/* การ์ดแต่ละใบ */
.order-item {
  flex: 0 0 180px;  /* กว้างประมาณ 180px => มือถือเห็นได้ 2 ใบ */
  max-width: 180px;
  min-width: 160px;

  display: flex;
  align-items: center;
  border-radius: 10px;
  min-height: 90px;
  color: #fff;
  background: <?= $bg == 'bg-light' ? '#e5e5e7' : '#141414'; ?>;
  overflow: hidden;
  transition: transform 0.15s ease;
  /* ไม่มีเงา */
}

.order-item:hover {
  transform: translateY(-2px);
}

.order-left {
  flex-shrink: 0;
}
.order-img {
  width: 80px;
  height: 80px;
  border-radius: 10px 0 0 10px;
  object-fit: cover;
}

.order-right {
  flex: 1;
  margin-left: 8px;
  padding-right: 8px;
}

.order-name {
  font-weight: 600;
  color: var(--main);
  font-size: 0.9rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.order-date {
  color: #b8b8b8ff;
  font-size: 0.8rem;
  margin-top: 3px;
}

/* 📱 จอเล็กมาก: แคบลงนิด ให้พอใส่ 2 ใบ */
@media (max-width: 576px) {
  .order-item {
    flex: 0 0 160px;
    max-width: 160px;
    min-width: 150px;
  }
  .order-img {
    width: 72px;
    height: 72px;
  }
}

/* 🖥 จอใหญ่: กว้างขึ้นหน่อย */
@media (min-width: 992px) {
  .order-item {
    flex: 0 0 200px;
    max-width: 200px;
  }
  .order-img {
    width: 88px;
    height: 88px;
  }
}
</style>

<script>
(() => {
  const scroll = document.getElementById('order-scroll');
  if (!scroll) return;

  // ถ้ามีน้อยกว่า 2 การ์ด ก็ไม่ต้องเลื่อน
  const items = scroll.querySelectorAll('.order-item');
  if (items.length < 2) return;

  // จำความกว้างก่อน duplicate
  const originalWidth = scroll.scrollWidth;

  // ทำซ้ำเนื้อหาเพื่อให้เลื่อนได้วน
  scroll.innerHTML += scroll.innerHTML;

  let speed = 0.8;         // px ต่อ frame (ลองค่าประมาณนี้จะเห็นชัด)
  let isPaused = false;

  const loop = () => {
    if (!isPaused) {
      scroll.scrollLeft += speed;

      // รีเซ็ตเมื่อเดินทางครบความกว้างชุดแรก
      if (scroll.scrollLeft >= originalWidth) {
        scroll.scrollLeft = 0;
      }
    }
    requestAnimationFrame(loop);
  };

  // รันเลย (ไม่ผูกกับ DOMContentLoaded เผื่อไฟล์ถูก include ทีหลัง)
  requestAnimationFrame(loop);

  // หยุดเมื่อ hover (PC)
  scroll.addEventListener('mouseenter', () => { isPaused = true; });
  scroll.addEventListener('mouseleave', () => { isPaused = false; });

  // หยุดเมื่อแตะลาก (มือถือ)
  scroll.addEventListener('touchstart', () => { isPaused = true; }, { passive: true });
  scroll.addEventListener('touchend', () => { isPaused = false; }, { passive: true });
})();
</script>






    <!-- หมวดหมู่แนะนำ -->
   

        <center>
            <div class="col-12 col-lg-12  p-2 mb-2" style="border-radius: 1vh;">
                <div class="d-flex justify-content-between">
                    <div class="text-center text-lg-start">
                        <h2 class=" mt-2 mb-0 font-bold"><b>หมวดหมู่แนะนำ</b></h2>
                        <h5 class=" mb-0" style="color: var(--font)">Category Recommended</h5>
                    </div>
                    <a class="btn nav-link align-self-center bg-main mt-4 font-semibold" href="/shop" style="height: fit-content;border-radius: 1vh;"><b style="color: #ffffff;">เลือกดูทั้งหมด</b></a>
                </div>
            </div>
        </center>
            
            <style>
                .cc {
                    width: 100%;
                    max-width: 250px;
                }

                @media only screen and (max-width: 1000px) {
                    .cc {
                        width: 100%;
                        max-width: 100vh;
                    }
                }
            </style>
            
            <div class="row justify-content-center justify-content-lg-start">
                        
                <?php
                // $check = dd_q("SELECT * FROM crecom WHERE recom_1 != 0 AND recom_2 != 0 AND recom_3 != 0 AND recom_4 != 0"); #44444
                $check = dd_q("SELECT * FROM crecom WHERE recom_1 != 0 AND recom_2 != 0");
                if ($check->rowCount() == 1) {
                    $data = $check->fetch(PDO::FETCH_ASSOC);
                    for ($i = 1; $i <= 2; $i++) {
                        $recom = "recom_" . $i;
                        $find = dd_q("SELECT * FROM category WHERE c_id = ? ", [$data[$recom]]);
                        $row = $find->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="col-12 col-lg-6  mb-3">
                    <a href="/shop?category=<?= htmlspecialchars($row['c_name']) ?>">
                        <div class="img-anim content w-100">
                            <img class="bg" src="<?= htmlspecialchars($row['img']) ?>">
                            <div class="text font-bold">
                                <?= htmlspecialchars($row['des']) ?>
                            </div>
                        </div>
                    </a>
                </div>
                    <?php
                    }
                } else {
                    ?>
                    <?php
                    $find = dd_q("SELECT * FROM category ORDER BY RAND() LIMIT 4");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-12 col-lg-6  mb-3">
                        <a href="/shop?category=<?= htmlspecialchars($row['c_name']) ?>">
                            <div class="img-anim content w-100">
                                <img class="bg" src="<?= htmlspecialchars($row['img']) ?>">
                                <div class="text font-bold">
                                    <?= htmlspecialchars($row['des']) ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }
                } ?>
            </div>

            <center>
                <div class="col-12 col-lg-12  p-2 mb-2" style="border-radius: 1vh;">
                    <div class="d-flex justify-content-between">
                        <div class="text-center text-lg-start">
                            <h2 class=" mt-2 mb-0 font-bold"><b>สินค้าแนะนำ</b></h2>
                            <h5 class=" mb-0" style="color: var(--font)">Product Recommended</h5>
                        </div>
                        <a class="btn nav-link align-self-center bg-main mt-4 font-semibold" href="/shop" style="height: fit-content;border-radius: 1vh;"><b style="color: #ffffff;">เลือกดูทั้งหมด</b></a>
                    </div>
                </div>
            </center>
    
        

            <style>
                .cc {
                    width: 100%;
                    max-width: 250px;
                }

                @media only screen and (max-width: 1000px) {
                    .cc {
                        width: 100%;
                        max-width: 100vh;
                    }
                }

                .card-anim-main {
                    border: 1px solid #ffffff00;
                    transition: all .5s ease;
                }

                .border-hov {
                    border: 1px solid #ccc;
                    transition: 0.3s ease-in-out;
                }

                .card-anim:hover .card-anim-main {
                    border: 1px solid var(--main);
                }
                .hot-badge {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 65px;
    height: 65px;
    background: url('https://img5.pic.in.th/file/secure-sv1/Hot-.webp') no-repeat center;
    background-size: contain;
    z-index: 5;
    animation: pulse 1.5s infinite ease-in-out;
    pointer-events: none;
}
     .new-badge {
    position: absolute;
    top: -9.9px;
    right: -5.9px;
    width: 65px;
    height: 65px;
    background: url('https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_22_.._2568_05_42_16-removebg-preview-2-1.png') no-repeat center;
    background-size: contain;
    z-index: 5;
    animation: pulse 1.5s infinite ease-in-out;
    pointer-events: none;
}

            </style><style>
  .mb {
    display: none;
  }
  .pc {
    display: flex;
  }

  @media only screen and (max-width: 768px) {
    .card-product h5 {
      font-size: .9rem;
    }
    .card-product p {
      font-size: .6rem;
      margin-bottom: .3rem !important;
    }
    .mb {
      display: block;
    }
    .pc {
      display: none !important;
    }
    .card-product .btn-main {
      font-size: .55rem !important;
    }
  }

  .card-product {
    border-radius: 1rem;
    height: fit-content;
  }

  .normal-mouse {
    cursor: default;
  }

  a {
    text-decoration: none;
  }

  .product-img {
    height: 100%;
    width: 100%;
  }

  .fade-mask {
    -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 40%);
    mask-image: linear-gradient(to top, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 40%);
    -webkit-mask-repeat: no-repeat;
    mask-repeat: no-repeat;
    -webkit-mask-size: 100% 100%;
    mask-size: 100% 100%;
  }

  .btn-buy {
    color: var(--main);
    background: var(--main-30);
    border: 1px solid var(--main);
    transition: all .5s ease;
  }
  .btn-buy.active {
    color: white;
    background-color: var(--main);
    border: 1px solid var(--main);
  }
  .btn-buy.active i {
    color: white !important;
  }
  .btn-buy i {
    color: var(--main);
    transition: all .5s ease;
  }
  .btn-buy:hover i {
    color: white;
  }
  .btn-buy:hover {
    color: white;
    background-color: var(--main);
    border: 1px solid var(--main);
  }

  @media only screen and (max-width: 500px) {
    .pd-sm-font {
      font-size: 13px !important;
    }
    .pd-h-font {
      font-size: 16px;
    }
  }.soldout-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 1vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.3rem;
    font-weight: bold;
    z-index: 5;
}

.soldout-overlay img {
    width: 100%;
    opacity: 0.5;
}
.product-img {
    position: relative; /* สำคัญมาก ให้ overlay ซ้อนบนรูปได้ */
}
.soldout-gray {
    filter: grayscale(100%) brightness(70%);
    transition: 0.3s ease;
}

</style>

<?php
// ฟังก์ชันใช้ render การ์ดสินค้า 1 ใบ
function render_product_card($row, $count, $anim, $bg) { ?>
  <div class="col-6 col-md-6 col-lg-3 mb-4 justify-content-center"
       data-aos="<?= $anim; ?>" data-aos-duration="800">

    <div class="card-product <?= $bg; ?>">
      <div class="">
        <?php if ($row['badge'] == '1'): ?>
          <div class="hot-badge"></div>
        <?php endif; ?>

        <?php if ($row['badge'] == '2'): ?>
          <div class="new-badge"></div>
        <?php endif; ?>

        <a href="/buy?id=<?= $row['id'] ?>">
          <div class="product-img">
            <center>
        <img
  class="img-fluid fade-mask <?= ($count <= 0 ? 'soldout-gray' : '') ?>"
  src="<?= htmlspecialchars($row["img"]); ?>"
  alt="product"
  onerror="this.onerror=null;this.src='https://img5.pic.in.th/file/secure-sv1/ChatGPT-Image-14-..-2568-22_11_46.jpeg';"
  style="
    width: 100%;
    max-width: 100%;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    border-radius: 12px;
  "
>


            </center>
              <?php if ($count <= 0): ?>
        <div class="soldout-overlay">
            <!-- แบบข้อความธรรมดา -->
            <!-- SOLD OUT -->

            <!-- หรือใช้รูปแทน -->
            <img src="https://img5.pic.in.th/file/secure-sv1/soldout2921683eab1b756d.png" alt="หมดสินค้า">
        </div>
    <?php endif; ?>
          </div>

          <div class="p-3 pt-3 pb-1">
            <h5 class="text-strongest mb-1" style="word-wrap: break-word;">
              <?= htmlspecialchars($row["name"]); ?>
            </h5>

            <!-- โชว์แบบ PC -->
            <div class="d-flex justify-content-between mb-2 pc">
              <div class="d-flex">
                <p class="text-main align-self-center m-0 h6 me-1">
                  <strong>คงเหลือ <?= $count; ?> ชิ้น</strong>
                </p>
              </div>
              <p class="text-white main-badge bg-main align-self-center m-0">
                <strong style="color: #ffffff;">
                  <?= number_format($row['price']); ?> บาท
                </strong>
              </p>
            </div>

            <!-- โชว์แบบ Mobile -->
            <div class="mb text-center">
              <p class="text-main align-self-center m-0 h6 me-1">
                <strong>คงเหลือ <?= $count; ?> ชิ้น</strong>
              </p>
              <p class="text-main align-self-center m-0">
                <strong style="color: var(--main);">
                  <?= number_format($row['price']); ?> บาท
                </strong>
              </p>
            </div>

            <center>
              <a class="btn-buy btn w-100 pd-sm-font mb-2 font-semibold"
                 href="/buy?id=<?= $row['id'] ?>"
                 style="border-radius: 10px;">
                <i class="fa-duotone fa-basket-shopping"></i> ซื้อเลย
              </a>
            </center>
          </div>
        </a>
      </div>
    </div>
  </div>
<?php } ?>

<div class="row justify-content-center justify-content-lg-start normal-mouse">
<?php
// 1) ดึงข้อมูล recom แถวแรก
$check = dd_q("SELECT * FROM recom LIMIT 1");

$recomIds = [];

if ($check->rowCount() > 0) {
    $data = $check->fetch(PDO::FETCH_ASSOC);

    for ($i = 1; $i <= 10; $i++) {
        $key = "recom_" . $i;
        if (!empty($data[$key]) && $data[$key] != 0) {
            $recomIds[] = $data[$key];   // เก็บเฉพาะ id ที่ไม่เป็น 0
        }
    }
}

// 2) แสดงสินค้าที่เป็น recom ก่อน
if (!empty($recomIds)) {
    $placeholders = implode(',', array_fill(0, count($recomIds), '?'));

    // ถ้าอยากให้เรียงตามลำดับ recom_1,2,3,... ให้ใช้ ORDER BY FIELD ด้วย
    $orderField = implode(',', $recomIds);
    $recomQuery = dd_q(
        "SELECT * FROM box_product WHERE id IN ($placeholders) ORDER BY FIELD(id, $orderField)",
        $recomIds
    );

    while ($row = $recomQuery->fetch(PDO::FETCH_ASSOC)) {
        $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$row["id"]]);
        $count = $stock->rowCount() ?: 0;

        render_product_card($row, $count, $anim, $bg);
    }
}

// 3) สุ่มสินค้าที่เหลือ (ไม่ซ้ำกับ recom)
$params = [];
$whereNotIn = '';

if (!empty($recomIds)) {
    $whereNotIn = 'WHERE id NOT IN (' . implode(',', array_fill(0, count($recomIds), '?')) . ')';
    $params = $recomIds;
}

$find = dd_q("SELECT * FROM box_product $whereNotIn ORDER BY RAND() LIMIT 8", $params);

while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
    $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$row["id"]]);
    $count = $stock->rowCount() ?: 0;

    render_product_card($row, $count, $anim, $bg);
}
?>
</div>



            <!--<center>
                <div class="col-12 col-lg-12  p-2 mb-2" style="border-radius: 1vh;">
                    <div class="d-flex justify-content-between">
                        <div class="text-center text-lg-start">
                            <h2 class=" mt-2 mb-0 font-bold"><b>สุ่มรางวัล</b></h2>
                            <h5 class=" mb-0" style="color: var(--font)">Random Prizes</h5>
                        </div>
                        <a class="btn nav-link align-self-center bg-main mt-4 font-semibold" href="/random_wheel" style="height: fit-content;border-radius: 1vh;"><b style="color: #ffffff;">เลือกดูทั้งหมด</b></a>
                    </div>
                </div>
            </center>

            <div class="row justify-content-center justify-content-lg-start">

                <?php
                    $find = dd_q("SELECT * FROM wheel ORDER BY RAND() LIMIT 2");
                    while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <div class="col-12 col-lg-6 mb-3">
                    <a href="/play&wheel=<?= $row['id']; ?>">
                        <div class="container-fluid p-0 <?php echo $bg?> border-hov p-3 mb-2 shadow" style="border-radius: 1vh;">
                            <div class="img-anim content w-100">
                                <img class="bg" src="<?= htmlspecialchars($row['img']) ?>">
                                <div class="text">
                                    <?= htmlspecialchars($row['name']) ?>
                                </div>
                            </div>
                            <center>
                                <a class="btn-main btn w-100 pd-sm-font mb-0 mt-2 font-semibold" href="/play&wheel=<?= $row['id']; ?>" style="border-radius: 10px;">เริ่มสุ่ม <?= htmlspecialchars($row['name']) ?> เลย</a>
                            </center>
                        </div>
                    </a>
                </div>

                <?php }?>

            </div>-->

        </div>
    </div>

   
    <!-- </div>
</div> -->

    <script src="services/js/countup.js"></script>
</div>
</div>
</div>
</div>