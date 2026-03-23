<style>
/* ===== CARD PRODUCT STYLES ===== */
.card-anim-main{
  transition: transform .3s ease, box-shadow .3s ease;
  position: relative;
}
.card-anim-main:hover{
  transform: translateY(-4px);
  box-shadow: 0 12px 30px rgba(0,0,0,.15);
}

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
  .card-product .btn-buy {
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

/* ===== IMAGE ===== */
.product-img{
  position: relative;
  height: 100%;
  width: 100%;
}

.product-img img{
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* fade bottom */
.fade-mask{
  -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 40%);
  mask-image: linear-gradient(to top, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 40%);
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
}

/* sold out */
.soldout-gray{
  filter: grayscale(100%) brightness(70%);
  transition: 0.3s ease;
}
.soldout-overlay{
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
.soldout-overlay img{
  width: 100%;
  opacity: 0.5;
}

/* ===== BADGE ===== */
.hot-badge{
  position:absolute;
  top:-20px;
  right:-20px;
  width:65px;
  height:65px;
  background:url('https://img5.pic.in.th/file/secure-sv1/Hot-.webp') no-repeat center;
  background-size:contain;
  z-index:5;
  animation:pulse 1.5s infinite ease-in-out;
  pointer-events:none;
}
.new-badge{
  position:absolute;
  top:-9.9px;
  right:-5.9px;
  width:65px;
  height:65px;
  background:url('https://img5.pic.in.th/file/secure-sv1/ChatGPT_Image_22_.._2568_05_42_16-removebg-preview-2-1.png') no-repeat center;
  background-size:contain;
  z-index:5;
  animation:pulse 1.5s infinite ease-in-out;
  pointer-events:none;
}

/* ===== BUTTON ===== */
.btn-main{
  color:var(--main);
  background:var(--main-30);
  border:1px solid var(--main);
  transition:.3s;
}
.btn-main:hover{
  color:#fff;
  background:var(--main);
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
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
}
</style>

<div class="container-fluid p-2 ">
    <div class="container-sm  m-cent  p-2 pt-4 ">
        <div class="container-sm ">
            <div class="container-fluid">
                <div class="container-fluid" data-aos="<?php echo $anim; ?>">
                
                    <?php if (!isset($_GET['category'])) : ?>

                    <center>
  <div class="col-12 col-lg-12 p-2 py-3 mb-2 <?= $bg ?>" style="border-radius: 1vh;">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center px-3 py-2">

      <!-- Breadcrumb ซ้าย -->
      <div class="text-center text-lg-start mb-2 mb-lg-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb d-flex justify-content-start m-0">
            <li class="breadcrumb-item text-main">
              <i class="fa-duotone fa-solid fa-bags-shopping text-main"></i> สินค้าทั้งหมด
            </li>
          </ol>
        </nav>
      </div>

      <!-- ปุ่มฟิลเตอร์ขวา -->

    </div>
  </div>
</center>


                    <?php else : ?>

                        <center>
                            <div class="col-12 col-lg-12 <?php echo $bg?> shadow p-2" style="border-radius: 1vh;">
                                <div class="d-flex justify-content-between">
                                    <div class="text-center text-lg-start">
                                          <nav aria-label="breadcrumb">
                        <ol class="breadcrumb d-flex justify-content-start mt-3 px-3">
                            <li class="breadcrumb-item"><a href="/shop" style="text-decoration:none;color:#6C757D;"><i class="fa-duotone fa-solid fa-bags-shopping"></i> สินค้าทั้งหมด</a></li>
                            <li class="breadcrumb-item text-main"><i class="fa-duotone fa-solid fa-layer-group text-main"></i> <?= htmlspecialchars($_GET['category']); ?></li>
                                   </ol>
                    </nav></div>    <div class="text-center text-lg-end">
        <button class="btn btn-outline-main" data-bs-toggle="modal" data-bs-target="#filterModal">
          <i class="fa-duotone fa-filter"></i> กรองสินค้า
        </button>
      </div>

                                 </div>
                            </div>
                        </center>
                                            
                    <?php endif ?>
                    <hr>
                    <div class="row justify-content-center justify-content-lg-start normal-mouse">
                        <?php if (!isset($_GET['category'])) {
                            $cfind = dd_q("SELECT * FROM category ");
                            $check = $cfind->rowCount();
                            if ($check  == NULL) {
                                echo '<h6 class=" text-center">ไม่มีหมวดหมู่ในตอนนี้</h6>';
                            } elseif ($_GET['category'] == NULL) {
                                header('Location: ' . $_SERVER['HTTP_REFERER']);
                            }
                            while ($row = $cfind->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <style>
                            .font-bold {
                                font-weight: 700;
                            }
                            .font-semibold {
                                font-weight: 600;
                            }  
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

                        </style>    
                                <div class="col-12 col-lg-6  mb-3">
                                    <a href="/shop?category=<?= htmlspecialchars($row['c_name']) ?>">
                                        <div class="img-anim content w-100">
                                            <img class="bg" src="<?= htmlspecialchars($row['img']) ?>">
                                            <div class="text font-semibold">
                                                <?= htmlspecialchars($row['des']) ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            <?php } ?>
                            <?php
                        } else {
                           $find = dd_q("
  SELECT p.*, 
         COALESCE(AVG(c.rating), 0) AS avg_rating
  FROM box_product p
  LEFT JOIN product_comments c ON c.product_id = p.id
  WHERE p.c_type = ?
  GROUP BY p.id
  ORDER BY p.id DESC
", [$_GET['category']]);
  while ($row = $find->fetch(PDO::FETCH_ASSOC)) {
                                $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ? ", [$row["id"]]);
                                $count = $stock->rowCount();
                                if ($count  == NULL) {
                                    $count = 0;
                                }
                            ?>
  
                            <div class="col-6 col-md-6 col-lg-3 mb-4 justify-content-center" data-aos="<?php echo $anim; ?>" data-aos-duration="800">
                                <div class="card-product <?php echo $bg?>">
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
                                                        src="<?php echo htmlspecialchars($row["img"]); ?>"
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
                                                        <img src="https://img5.pic.in.th/file/secure-sv1/soldout2921683eab1b756d.png" alt="หมดสินค้า">
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="p-3 pt-3 pb-1">
                                                <h5 class="text-strongest mb-1" style="word-wrap: break-word;">
                                                    <?php echo htmlspecialchars($row["name"]); ?>
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

                        <?php             }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content <?= $bg ?>">
      <div class="modal-header border-0">
        <h5 class="modal-title"><i class="fa-duotone fa-filter"></i> กรองสินค้า</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="filterForm">
          <div class="mb-3">
            <label class="form-label fw-bold">เรียงตาม</label>
            <select class="form-select" name="filter">
              <option value="">-- เรียงตาม --</option>
              <option value="price_asc">ราคาต่ำสุด</option>
              <option value="price_desc">ราคาสูงสุด</option>
              <option value="sold_desc">ยอดขายสูงสุด</option>
              <option value="sold_asc">ยอดขายต่ำสุด</option>
              <option value="rating_desc">รีวิวดีที่สุด</option>
              <option value="rating_asc">รีวิวแย่สุด</option>
            </select>
          </div>

          <div class="row g-2">
            <div class="col-6">
              <label class="form-label fw-bold">ราคาต่ำสุด</label>
              <input type="number" name="min_price" class="form-control" placeholder="เช่น 100">
            </div>
            <div class="col-6">
              <label class="form-label fw-bold">ราคาสูงสุด</label>
              <input type="number" name="max_price" class="form-control" placeholder="เช่น 500">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer border-0">
        <button class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button class="btn btn-main" id="applyFilter"><i class="fa-duotone fa-check"></i> ใช้ตัวกรอง</button>
      </div>
    </div>
  </div>
</div>
<script>
document.getElementById('applyFilter').addEventListener('click', () => {
  const form = document.getElementById('filterForm');
  const data = new FormData(form);
  const params = new URLSearchParams();
  data.forEach((v, k) => params.append(k, v));
  params.append('category', '<?= $_GET['category'] ?? '' ?>');

  fetch('services/filter_products.php', {
    method: 'POST',
    body: params
  })
  .then(res => res.text())
  .then(html => {
    document.querySelector('.row.justify-content-center').innerHTML = html;
    bootstrap.Modal.getInstance(document.getElementById('filterModal')).hide();
  })
  .catch(err => {
    Swal.fire({
      icon: 'error',
      title: 'เกิดข้อผิดพลาด',
      text: 'ไม่สามารถกรองสินค้าได้',
      confirmButtonColor: 'var(--main)'
    });
  });
});
</script>
<style>
.fa-star, .fa-star-half-stroke {
  margin: 0 1px;
  transition: transform .2s ease;
}
.fa-star:hover, .fa-star-half-stroke:hover {
  transform: scale(1.2);
}
</style>
