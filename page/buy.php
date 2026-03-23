    <?php
    if ($_GET['id'] != '') {
        $pdshop = dd_q("SELECT * FROM box_product WHERE id = ? LIMIT 1", [$_GET['id']]);
        if ($pdshop->rowCount() != 0) {
            $row_1 = $pdshop->fetch(PDO::FETCH_ASSOC);
            $count = dd_q("SELECT * FROM box_stock WHERE p_id = ?", [$row_1['id']])->rowCount();
    ?>
            <div class="container mt-3 mb-3 round">
                <div class="container-sm">
                    <div class="<?= $bg ?> shadow p-3 rounded" style="border-radius: 1rem !important;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb d-flex justify-content-start mt-3 px-3">
                                <li class="breadcrumb-item"><a href="/shop" style="text-decoration:none;color:#6C757D;"><i class="fa-duotone fa-solid fa-bags-shopping"></i> สินค้าทั้งหมด</a></li>
                                <li class="breadcrumb-item"><a href="/shop?category=<?= htmlspecialchars($row_1['c_type']) ?>" style="text-decoration:none;color:#6C757D;"><i class="fa-duotone fa-solid fa-layer-group"></i> <?= htmlspecialchars($row_1['c_type']) ?></a></li>
                                <li class="breadcrumb-item" aria-current="page" style="color:var(--main)"><i class="fa-duotone fa-solid fa-box-isometric-tape" style="color:var(--main)"></i> <?= htmlspecialchars($row_1['name']) ?></li>
                            </ol>
                        </nav>
                        <div class="row">
                            <div class="col-12 col-lg-6 p-3">
                                <div class="d-flex justify-content-center">
                                    <img src="<?= htmlspecialchars($row_1['img']) ?>" onerror="this.onerror=null;this.src='https://img5.pic.in.th/file/secure-sv1/ChatGPT-Image-14-..-2568-22_11_46.jpeg';" style="width:100%;" class="rounded">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 p-3">
                                <div class="<?= $bg ?> shadow p-3 rounded">
                                    <h3 style="color:#000;"><b><?= htmlspecialchars($row_1['name']) ?></b></h3>
                                    <h4 class="text-main" id="productPrice"><?= $row_1['price'] ?> บาท</h4>

                                    <style>
                                    .badge {
                                        background-color: var(--main-opa-50);
                                        border: 1px solid var(--main-opa-50);
                                        color: var(--main);
                                        padding: 5px 10px;
                                        border-radius: 5px;
                                        font-size: 14px;
                                        margin-bottom: 10px;
                                        margin-left: 15px;
                                    }
                                    .des {
                                        font-size: 16px;
                                        margin-top: 5px;
                                        margin-bottom: 15px;
                                        background-color: #00000025;
                                        padding: 10px;
                                        margin-left: 15px;
                                        border-radius: 5px;
                                        width: 95%;
                                    }
                                    .form-control:focus {
                                        box-shadow: none;
                                        border-color: var(--main);
                                    }
                                    </style>

                                    <div class="row mt-2">
                                        <div class="col-auto badge">รายละเอียดสินค้า</div>
                                        <h5 class="des" style="white-space:pre-wrap;"><?= htmlspecialchars($row_1['des']) ?></h5>

                                        <div class="col-auto badge">จำนวนสินค้าที่จะซื้อ</div>
                                        <div class="d-flex mb-2">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="btn bg-main border-0 text-white font-bold">
                                                <h5 class="m-0">-</h5>
                                            </button>
                                            <input type="number" id="b_count" class="form-control ms-2 me-2 text-center h-100" min="1" max="200" value="1">
                                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="btn bg-main border-0 text-white font-bold">
                                                <h5 class="m-0">+</h5>
                                            </button>
                                        </div>

                                        <div class="col-auto badge">โค้ดส่วนลด</div>
                                        <div class="input-group mb-3">
                                            <input type="text" id="discountCode" class="form-control" placeholder="กรอกโค้ดส่วนลด">
                                            <button class="btn btn-main" id="applyDiscount">ใช้โค้ด</button>
                                        </div>
                                        <div id="discountResult" class="mt-2 fw-bold"></div>

                                        <div class="d-flex justify-content-between pe-3 ps-3 mt-2">
                                            <span>สินค้าคงเหลือ <?= $count ?> ชิ้น</span>
                                        </div>
                                    </div>

                            <button class="btn w-100 mt-2 text-white" id="shop-btn" onclick="buybox()" data-id="<?= $row_1['id'] ?>" data-name="<?= $row_1['name'] ?>" data-price="<?= $row_1['price'] ?>" style="background-color: var(--main);">สั่งซื้อ</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- 🔽 แสดงคอมเมนต์ -->
            <style>
              .btn-main-1 {
                background: var(--main);
                color: var(--font);
                border-radius: .5rem;
                transition: .3s ease;
              }
              .btn-main-1:hover {
                transform: translateY(-3px);
              }
              .rounded-5 {
                border-radius: 1rem
              }
              #rating-stars i {
  transition: transform .2s ease, color .2s ease;
}
#rating-stars i:hover {
  transform: scale(1.3);
  color: #ffcc00;
}
#comment-list {
  box-shadow: 0 0 5px 2px #cccccc70;
  border-radius: 1rem;
}
            </style>
<div class="container mt-3 mb-3 round" data-aos="<?= $anim ?>">
  <div class="container-sm <?= $bg ?> p-3 rounded-5" >
    <div class="mt-4">
     <div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="m-0 px-3 text-muted justify-content-start">
    <i class="fa-duotone fa-comments"></i> รีวิวสินค้า
  </h3>
    <!-- 🔘 ปุ่มกรองรีวิว -->
<div class="text-end mb-3 justify-content-end">
 
  <button class="btn btn-main-1 justify-content-end" data-bs-toggle="modal" data-bs-target="#commentModal">
    <i class="fa-duotone fa-plus"></i> รีวิวเลย
  </button>
 <button id="filterButton" class="btn btn-outline-main">
    <i class="fa-duotone fa-filter"></i>
  </button>
</div>

</div>

      <!-- 🔽 แสดงรายการคอมเมนต์ -->
      <div id="comment-list" class=" p-3"
           style="background:<?= ($bg=='bg-light') ? '#f8f8f8' : '#111'; ?>;min-height:100px;">
       </div>

      <!-- 🔘 ปุ่มเปิด Modal -->
      <div class="text-center mt-3">
     
      </div>
    </div>
  </div>
</div>

<!-- 💬 Modal เขียนคอมเมนต์ -->
<!-- 💬 Modal เขียนรีวิว -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content <?= $bg ?>">
      <div class="modal-header border-0">
        <h5 class="modal-title"><i class="fa-duotone fa-star"></i> รีวิวสินค้า</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">

   <!-- <i class="fa-duotone fa-star"></i> ระบบเลือกดาว -->
<div id="rating-stars" class="mb-3" style="font-size: 2rem; color: gold; cursor: pointer;">
  <i class="fa-regular fa-star" data-value="1"></i>
  <i class="fa-regular fa-star" data-value="2"></i>
  <i class="fa-regular fa-star" data-value="3"></i>
  <i class="fa-regular fa-star" data-value="4"></i>
  <i class="fa-regular fa-star" data-value="5"></i>
</div>
<input type="hidden" id="selected-rating" value="0">


        <input type="hidden" id="selected-rating" value="0">
        <textarea id="comment-text" class="form-control" rows="4" placeholder="พิมพ์ความคิดเห็นของคุณ..."></textarea>
      </div>
      <div class="modal-footer border-0">
        <button class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button class="btn btn-main" id="send-comment"><i class="fa-duotone fa-paper-plane"></i> ส่งรีวิว</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title"><i class="fa-duotone fa-filter"></i> กรองรีวิวตามดาว</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-2 text-muted">เลือกจำนวนดาวที่ต้องการดู</p>
        <div class="d-flex flex-wrap justify-content-center gap-2">
          <button class="btn btn-sm btn-outline-light filter-btn" data-stars="0">ทั้งหมด</button>
          <button class="btn btn-sm btn-outline-warning filter-btn" data-stars="5"><i class="fa-duotone fa-star"></i> 5 ดาว</button>
          <button class="btn btn-sm btn-outline-warning filter-btn" data-stars="4"><i class="fa-duotone fa-star"></i> 4 ดาว</button>
          <button class="btn btn-sm btn-outline-warning filter-btn" data-stars="3"><i class="fa-duotone fa-star"></i> 3 ดาว</button>
          <button class="btn btn-sm btn-outline-warning filter-btn" data-stars="2"><i class="fa-duotone fa-star"></i> 2 ดาว</button>
          <button class="btn btn-sm btn-outline-warning filter-btn" data-stars="1"><i class="fa-duotone fa-star"></i> 1 ดาว</button>
          <button class="btn btn-sm btn-outline-secondary filter-btn" data-stars="-1"><i class="fa-duotone fa-x"></i>  0 ดาว</button>
        </div>
      </div>
      <div class="modal-footer border-0">
        <button class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

<style>
  .tool-btn {
  transform: scale(0.8);
  transition: all 0.4s ease;
  background: transparent;
  border: none;
}
.comment-item:hover .tool-btn{
  transform: scale(1.1);
}

.comment-item:hover .btn-warning .tool-btn{
  background: #ff9900ff;
  color:#fff;
}
.btn-outline-main {
  border: 1px solid var(--main);
  color: var(--main);
  transition: all 0.25s ease;
}
.btn-outline-main:hover {
  background: var(--main);
  color: var(--font);
  transform: translateY(-2px);
}
.filter-btn {
  transition: transform 0.2s ease;
}
.filter-btn:hover {
  transform: scale(1.15);
}

</style>

    <?php
        } else {
            echo "<script>window.location.href='/shop';</script>";
        }
    } else {
        echo "<script>window.location.href='/shop';</script>";
    }
    ?>

<script>
let discountData = null;
const pid = <?= $row_1['id'] ?>;

// =======================================================
// 🔹 ตรวจสอบโค้ดส่วนลด
// =======================================================
document.getElementById('applyDiscount').addEventListener('click', () => {
  const code = document.getElementById('discountCode').value.trim();
  const price = parseFloat(<?= $row_1['price'] ?>);
  const resultBox = document.getElementById('discountResult');
  const priceBox = document.getElementById('productPrice');

  if (!code) {
    Swal.fire({
      icon: 'warning',
      title: 'โปรดกรอกโค้ดส่วนลด',
      confirmButtonColor: 'var(--main)'
    });
    return;
  }

  fetch('check_discount.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `code=${encodeURIComponent(code)}&product_id=${pid}`
  })
  .then(res => res.json())
  .then(data => {
    resultBox.classList.remove('text-danger', 'text-success');
    if (data.status === 'success') {
      discountData = data;

      let finalPrice = price;
      if (data.type === 'percent') {
        finalPrice = price - (price * (data.value / 100));
      } else {
        finalPrice = Math.max(price - data.value, 0);
      }

      resultBox.classList.add('text-success');
      resultBox.innerHTML = `ใช้โค้ดแล้ว! ลด ${data.value} ${data.type === 'percent' ? '%' : 'บาท'} <br>ราคาหลังส่วนลด: <b>${finalPrice.toFixed(2)} บาท</b>`;
      priceBox.textContent = finalPrice.toFixed(2) + ' บาท';

      Swal.fire({
        icon: 'success',
        title: 'ใช้โค้ดส่วนลดสำเร็จ',
        text: `ลดราคา ${data.value}${data.type === 'percent' ? '%' : ' บาท'}`,
        confirmButtonColor: 'var(--main)'
      });
    } else {
      discountData = null;
      resultBox.classList.add('text-danger');
      resultBox.textContent = data.message;
      priceBox.textContent = price.toFixed(2) + ' บาท';

      Swal.fire({
        icon: 'error',
        title: 'ไม่สามารถใช้โค้ดนี้ได้',
        text: data.message,
        confirmButtonColor: 'var(--main)'
      });
    }
  })
  .catch(err => {
    console.error('Error:', err);
    Swal.fire({
      icon: 'error',
      title: 'เกิดข้อผิดพลาด',
      text: 'ไม่สามารถตรวจสอบโค้ดได้',
      confirmButtonColor: 'var(--main)'
    });
  });
});

// =======================================================
// <i class="fa-duotone fa-star"></i> ระบบเลือกดาว (ครึ่งดาวได้)
// =======================================================
let selectedRating = 0;
let lastClickedStar = 0;

// <i class="fa-duotone fa-star"></i> ระบบเลือกดาว (คลิกซ้ำเพื่อให้ครึ่งดาว)
document.querySelectorAll('#rating-stars i').forEach(star => {
  star.addEventListener('click', () => {
    const value = parseInt(star.dataset.value);
    if (selectedRating === value) selectedRating = value - 0.5;
    else if (selectedRating === value - 0.5) selectedRating = value;
    else selectedRating = value;
    document.getElementById('selected-rating').value = selectedRating;
    updateStarVisual(selectedRating);
  });
});

function updateStarVisual(rating) {
  const stars = document.querySelectorAll('#rating-stars i');
  stars.forEach(star => {
    const val = parseInt(star.dataset.value);
    if (rating >= val) star.className = 'fa-solid fa-star text-warning';
    else if (rating >= val - 0.5) star.className = 'fa-solid fa-star-half-stroke text-warning';
    else star.className = 'fa-regular fa-star text-muted';
  });
}

// =======================================================
// 🟡 แสดงดาวในแต่ละรีวิว
// =======================================================
function renderStars(rating) {
  let html = '';
  for (let i = 1; i <= 5; i++) {
    if (rating >= i) html += '<i class="fa-solid fa-star text-warning"></i>';
    else if (rating >= i - 0.5) html += '<i class="fa-solid fa-star-half-stroke text-warning"></i>';
    else html += '<i class="fa-regular fa-star text-muted"></i>';
  }
  return html;
}

// =======================================================
// 📥 โหลดคอมเมนต์ทั้งหมด
// =======================================================
function loadComments() {
  fetch('services/call/fetch_comment.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `product_id=${pid}`
  })
  .then(res => res.json())
  .then(data => {
    const box = document.getElementById('comment-list');
    if (!data.data || data.data.length === 0) {
      box.innerHTML = '<div class="text-muted text-center">ยังไม่มีรีวิว</div>';
      return;
    }

    box.innerHTML = '';
    data.data.forEach(c => {
      const starsHTML = renderStars(parseFloat(c.rating || 0));
      const tools = c.is_owner ? `
        <div class="comment-tools position-absolute top-0 end-0 mt-2 me-2">
          <button class="btn btn-sm btn-warning me-1 tool-btn" onclick="editComment(${c.id})">
            <i class="fa-duotone fa-pen"></i>
          </button>
          <button class="btn btn-sm btn-danger tool-btn" onclick="deleteComment(${c.id})">
            <i class="fa-duotone fa-trash"></i>
          </button>
        </div>` : '';

      box.innerHTML += `
        <div class="comment-item position-relative mb-3 p-3 rounded" style="background:rgba(255,255,255,0.05)">
          <div class="d-flex align-items-start">
            <img src="${c.user_img}" class="rounded-circle me-3" width="40" height="40" style="object-fit:cover;">
            <div class="flex-grow-1">
              <b style="color:var(--main)">${c.username}</b>
              <small class="text-muted ms-2">${c.created_at}</small>
              <div>${starsHTML}</div>
              <div style="color:var(--font)">${c.comment}</div>
            </div>
          </div>
          ${tools}
        </div>`;
    });

    addFilterButton(); // ⬅️ เรียกสร้างปุ่ม Filter
  })
  .catch(() => {
    document.getElementById('comment-list').innerHTML =
      '<div class="text-danger text-center">เกิดข้อผิดพลาดในการโหลดข้อมูล</div>';
  });
}

// =======================================================
// 📨 ส่งคอมเมนต์พร้อมดาว (รองรับ 0 ดาวพร้อมยืนยัน)
// =======================================================
document.getElementById('send-comment').addEventListener('click', () => {
  const text = document.getElementById('comment-text').value.trim();
  const rating = parseFloat(document.getElementById('selected-rating').value || 0);

  if (!text) {
    Swal.fire({
      icon: 'warning',
      title: 'กรุณาใส่ข้อความรีวิว',
      confirmButtonColor: 'var(--main)'
    });
    return;
  }

  if (rating === 0) {
    Swal.fire({
      icon: 'question',
      title: 'ยืนยันจะรีวิว 0 ดาวใช่ไหม?',
      text: 'คุณกำลังจะให้คะแนนต่ำสุด',
      showCancelButton: true,
      confirmButtonText: 'ใช่, ยืนยัน',
      cancelButtonText: 'ยกเลิก',
      confirmButtonColor: 'var(--main)',
      cancelButtonColor: '#aaa'
    }).then(result => {
      if (result.isConfirmed) sendReview(text, rating);
    });
  } else {
    sendReview(text, rating);
  }
});

function sendReview(text, rating) {
  fetch('services/save_comment.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `product_id=${pid}&comment=${encodeURIComponent(text)}&rating=${rating}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.message.includes('สำเร็จ')) {
      document.getElementById('comment-text').value = '';
      selectedRating = 0;
      updateStarVisual(0);
      bootstrap.Modal.getInstance(document.getElementById('commentModal')).hide();
      loadComments();
      Swal.fire({
        icon: 'success',
        title: 'รีวิวสำเร็จ ✅',
        text: 'ขอบคุณสำหรับความคิดเห็นของคุณ!',
        confirmButtonColor: 'var(--main)'
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'ไม่สามารถส่งรีวิวได้',
        text: data.message,
        confirmButtonColor: 'var(--main)'
      });
    }
  })
  .catch(() => {
    Swal.fire({
      icon: 'error',
      title: 'เกิดข้อผิดพลาด',
      text: 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้',
      confirmButtonColor: 'var(--main)'
    });
  });
}

// =======================================================
// 🔘 ปุ่ม Filter รีวิว (เปิด Modal)
// =======================================================
function addFilterButton() {
  const btn = document.getElementById("filterButton");
  if (!btn) return;
  btn.onclick = () => new bootstrap.Modal(document.getElementById("filterModal")).show();
}



document.addEventListener("click", e => {
  if (e.target.classList.contains("filter-btn")) {
    const stars = parseInt(e.target.dataset.stars);
    const box = document.getElementById("comment-list");

    fetch('services/call/fetch_comment.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `product_id=${pid}`
    })
    .then(res => res.json())
    .then(data => {
      if (!data.data || data.data.length === 0) {
        box.innerHTML = '<div class="text-muted text-center">ยังไม่มีรีวิว</div>';
        return;
      }

      let filtered = data.data;
      if (stars > 0) filtered = data.data.filter(c => Math.floor(c.rating) === stars);
      if (stars === -1) filtered = data.data.filter(c => c.rating === 0);

      if (filtered.length === 0) {
        box.innerHTML = '<div class="text-center text-muted py-3">ไม่มีรีวิวจำนวนดาวนี้</div>';
      } else {
        box.innerHTML = '';
       filtered.forEach(c => {
  const starsHTML = renderStars(parseFloat(c.rating || 0));
  const tools = c.is_owner ? `
    <div class="comment-tools position-absolute top-0 end-0 mt-2 me-2">
      <button class="btn btn-sm btn-warning me-1 tool-btn" onclick="editComment(${c.id})">
        <i class="fa-duotone fa-pen"></i>
      </button>
      <button class="btn btn-sm btn-danger tool-btn" onclick="deleteComment(${c.id})">
        <i class="fa-duotone fa-trash"></i>
      </button>
    </div>` : '';

  box.innerHTML += `
    <div class="comment-item position-relative mb-3 p-3 rounded" style="background:rgba(255,255,255,0.05)">
      <div class="d-flex align-items-start">
        <img src="${c.user_img}" class="rounded-circle me-3" width="40" height="40" style="object-fit:cover;">
        <div class="flex-grow-1">
          <b style="color:var(--main)">${c.username}</b>
          <small class="text-muted ms-2">${c.created_at}</small>
          <div>${starsHTML}</div>
          <div style="color:var(--font)">${c.comment}</div>
        </div>
      </div>
      ${tools}
    </div>`;
});

      }

      bootstrap.Modal.getInstance(document.getElementById("filterModal")).hide();
    });
  }
});

loadComments();
// =======================================================
// ✏️ ฟังก์ชันแก้ไขรีวิว
// =======================================================
function editComment(id) {
  fetch('services/call/fetch_single_comment.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `id=${id}`,
    credentials: 'include'
  })
  .then(res => res.json())
  .then(data => {
    if (!data || !data.comment) {
      Swal.fire({
        icon: 'error',
        title: 'ไม่พบรีวิวนี้',
        confirmButtonColor: 'var(--main)'
      });
      return;
    }

    Swal.fire({
      title: 'แก้ไขรีวิวของคุณ',
      html: `
        <div id="edit-stars" style="font-size:1.8rem;color:gold;margin-bottom:8px;">
          ${renderStars(data.rating)}
        </div>
        <textarea id="edit-text" class="form-control" rows="4">${data.comment}</textarea>
      `,
      showCancelButton: true,
      confirmButtonText: 'บันทึก',
      cancelButtonText: 'ยกเลิก',
      confirmButtonColor: 'var(--main)',
      didOpen: () => {
        // ✅ DOM ของ SweetAlert สร้างเสร็จแล้ว
        const stars = Swal.getPopup().querySelectorAll('#edit-stars i');
        let currentRating = parseFloat(data.rating) || 0;
        let lastClicked = 0;

        const updateStars = () => {
          stars.forEach((s, i) => {
            const val = i + 1;
            if (currentRating >= val)   
              s.className = 'fa-solid fa-star text-warning';
            else if (currentRating >= val - 0.5)
              s.className = 'fa-solid fa-star-half-stroke text-warning';
            else
              s.className = 'fa-regular fa-star text-muted';
          });
        };
        updateStars();

        stars.forEach((s, i) => {
          s.style.cursor = 'pointer';
          s.addEventListener('click', () => {
            const clickedVal = i + 1;
            // ✅ ถ้าคลิกดาวเดิมอีกครั้ง → ครึ่งดาว
            if (lastClicked === clickedVal && currentRating === clickedVal) {
              currentRating = clickedVal - 0.5;
            } 
            else if (lastClicked === clickedVal && currentRating === clickedVal - 0.5) {
              currentRating = clickedVal; // คลิกซ้ำอีกที กลับเต็มดาว
            }
            else {
              currentRating = clickedVal;
            }
            lastClicked = clickedVal;
            updateStars();
            Swal.getPopup().dataset.rating = currentRating;
          });
        });

        Swal.getPopup().dataset.rating = currentRating;
      },
      preConfirm: () => {
        const popup = Swal.getPopup();
        return {
          text: popup.querySelector('#edit-text').value.trim(),
          rating: parseFloat(popup.dataset.rating || 0)
        };
      }
    }).then(result => {
      if (result.isConfirmed) {
        const { text, rating } = result.value;

        if (!text) {
          Swal.fire({
            icon: 'warning',
            title: 'กรุณาใส่ข้อความ',
            confirmButtonColor: 'var(--main)'
          });
          return;
        }

        fetch('services/edit_comment.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `id=${id}&comment=${encodeURIComponent(text)}&rating=${rating}`,
          credentials: 'include'
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: 'อัปเดตรีวิวสำเร็จ',
              confirmButtonColor: 'var(--main)'
            });
            loadComments();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'ไม่สามารถอัปเดตรีวิวได้',
              text: data.message || '',
              confirmButtonColor: 'var(--main)'
            });
          }
        });
      }
    });
  });
}



// =======================================================
// 🗑️ ฟังก์ชันลบรีวิว
// =======================================================
function deleteComment(id) {
  Swal.fire({
    icon: 'warning',
    title: 'ต้องการลบรีวิวนี้หรือไม่?',
    text: 'หลังจากลบแล้วจะไม่สามารถกู้คืนได้',
    showCancelButton: true,
    confirmButtonText: 'ลบเลย',
    cancelButtonText: 'ยกเลิก',
    confirmButtonColor: '#e74c3c',
    cancelButtonColor: '#aaa'
  }).then(result => {
    if (result.isConfirmed) {
      fetch('services/delete_comment.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'ลบรีวิวสำเร็จ',
            confirmButtonColor: 'var(--main)'
          });
          loadComments();
        } else {
          Swal.fire({
            icon: 'error',
            title: 'ไม่สามารถลบได้',
            text: data.message,
            confirmButtonColor: 'var(--main)'
          });
        }
      })
      .catch(() => {
        Swal.fire({
          icon: 'error',
          title: 'เกิดข้อผิดพลาด',
          text: 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้',
          confirmButtonColor: 'var(--main)'
        });
      });
    }
  });
}

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
<!-- 🔽 สินค้าอื่นๆ -->
<div class="container mt-5 mb-5">
  <div class="container-sm text-center text-lg-start "  data-aos="<?= $anim ?>">
    <div class="p-1 <?= $bg ?> align-center my-3" style="border-radius:1rem">
    <h4 class="p-2 text-main"><i class="fa-duotone fa-gift"></i> สินค้าอื่นๆ ที่คุณอาจสนใจ</h4>
</div>
    <div class="row">
      <?php
      $other = dd_q("SELECT * FROM box_product WHERE id != ? ORDER BY RAND() LIMIT 3", [$row_1['id']]);
      while ($row = $other->fetch(PDO::FETCH_ASSOC)) {
        $stock = dd_q("SELECT * FROM box_stock WHERE p_id = ?", [$row["id"]])->rowCount();
        if ($stock == NULL) $stock = 0;
      ?>
        <div class="col-6 col-lg-3 mb-4 justify-content-center" data-aos="<?= $anim ?>" data-aos-duration="800">
          <div class="card-product <?= $bg ?>">
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
                    <img class="img-fluid fade-mask"
                         src="<?= htmlspecialchars($row["img"]); ?>"
                         style="border-radius: 1vh; width: 100%; max-width: 100vh;">
                  </center>
                </div>

                <div class="p-3 pt-3 pb-1">
                  <h5 class="text-strongest mb-1" style="word-wrap: break-word;">
                    <?= htmlspecialchars($row["name"]); ?>
                  </h5>

                  <div class="d-flex justify-content-between mb-2 pc">
                    <div class="d-flex">
                      <p class="text-main align-self-center m-0 h6 me-1">
                        <strong>คงเหลือ <?= $stock ?> ชิ้น</strong>
                      </p>
                    </div>
                    <p class="text-white main-badge bg-main align-self-center m-0">
                      <strong><?= number_format($row['price']); ?> บาท</strong>
                    </p>
                  </div>

                  <div class="mb text-center">
                    <p class="text-main align-self-center m-0 h6 me-1">
                      <strong>คงเหลือ <?= $stock ?> ชิ้น</strong>
                    </p>
                    <p class="text-main align-self-center m-0">
                      <strong style="color: var(--main)">
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
    </div>
  </div>
</div>

<!-- ✅ ใช้สไตล์เดียวกับหน้าร้าน -->
<style>
.mb { display: none; }
.pc { display: flex; }
@media only screen and (max-width: 768px) {
  .card-product h5 { font-size: .9rem; }
  .card-product p { font-size: .6rem; margin-bottom: .3rem !important; }
  .mb { display: block; }
  .pc { display: none !important; }
  .card-product .btn-main { font-size:.55rem !important; }
}
.card-product { border-radius: 1rem; height: fit-content; }
.normal-mouse { cursor: default; }
a { text-decoration: none; }
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
.btn-buy:hover {
  color: white;
  background-color: var(--main);
  border: 1px solid var(--main);
}
.btn-buy i {
  color: var(--main);
  transition: .4s ease
}
.btn-buy:hover i {
  color: white;
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


@media only screen and (max-width: 768px) {
.btn-buy {
  font-size: .6rem
}

}
</style>
