<?php
header("Content-Type: text/html; charset=UTF-8");
?>

<div class="container-sm <?= $bg ?> mt-5 shadow-sm p-5 mb-4" style="border-radius:0.7rem" data-aos="fade-down">
  <center>
    <h1><i class="fa-duotone fa-tags"></i> จัดการโค้ดส่วนลด</h1>
  </center>
  <hr>
  <div class="d-flex justify-content-center">
    <button class="btn btn-success col-12 col-lg-5 text-white" id="open_insert">
      <i class="fa-duotone fa-plus"></i> เพิ่มโค้ดใหม่
    </button>
  </div>

  <div class="table-responsive mt-3">
    <table id="table" class="table mt-2">
      <thead>
        <tr>
          <th>ID</th>
          <th>โค้ด</th>
          <th>มูลค่าส่วนลด</th>
          <th>จำนวนใช้ไป</th>
          <th>จำกัดใช้</th>
          <th>สถานะ</th>
          <th>จัดการ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stmt = dd_q("SELECT * FROM discount_codes ORDER BY id DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['code']) ?></td>
          <td><?= $row['discount_value'] ?> <?= $row['discount_type'] == 'percent' ? '%' : 'บาท' ?></td>
          <td><?= $row['used_count'] ?></td>
          <td><?= $row['max_uses'] == 0 ? 'ไม่จำกัด' : $row['max_uses'] ?></td>
          <td><?= $row['status'] == 'active' ? '<span class="text-success">เปิด</span>' : '<span class="text-danger">ปิด</span>' ?></td>
          <td>
            <button class="btn btn-warning btn-sm" onclick="get_detail(<?= $row['id'] ?>)">แก้ไข</button>
            <button class="btn btn-danger btn-sm" onclick="del_code(<?= $row['id'] ?>)">ลบ</button>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal เพิ่ม/แก้ไขโค้ด -->
<div class="modal fade" id="discount_modal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark"><i class="fa-duotone fa-percent"></i> เพิ่ม / แก้ไขโค้ดส่วนลด</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-dark">
        <div class="row">
          <div class="col-lg-6 text-dark">
            <label class="text-dark">ชื่อโค้ด</label>
            <input type="text" id="code" class="form-control mb-2 text-dark">
            <label class="text-dark">ประเภทส่วนลด</label>
            <select id="discount_type" class="form-select mb-2 text-dark">
              <option value="percent">เปอร์เซ็นต์ (%)</option>
              <option value="fixed">จำนวนเงิน (บาท)</option>
            </select>
            <label class="text-dark">มูลค่าที่ลด</label>
            <input type="number" id="discount_value" class="form-control mb-2 text-dark">
          </div>
          <div class="col-lg-6">
            <label class="text-dark">จำกัดจำนวนใช้ (0 = ไม่จำกัด)</label>
            <input type="number" id="max_uses" class="form-control mb-2 text-dark">
            <label class="text-dark">สถานะ</label>
            <select id="status" class="form-select mb-2 text-dark">
              <option value="active">เปิดใช้งาน</option>
              <option value="inactive">ปิดชั่วคราว</option>
            </select>
          </div>
        </div>

        <hr>
        <h5>เลือกสินค้าที่ใช้โค้ดนี้ได้</h5>
        <div class="scrollable-box p-2 border rounded text-dark" style="max-height:250px; overflow-y:auto;">

        <?php
        $products = dd_q("SELECT id, name FROM box_product ORDER BY id DESC");

        if ($products && $products->rowCount() > 0) {
          while ($p = $products->fetch(PDO::FETCH_ASSOC)) {
            $id = htmlspecialchars((string)$p['id'], ENT_QUOTES, 'UTF-8');
            $name = htmlspecialchars((string)$p['name'], ENT_QUOTES, 'UTF-8');

            echo <<<HTML
              <div class="text-dark">
                <input type="checkbox" class="product-check" data-id="$id">
                $name ($id)
              </div>
            HTML;
          }
        } else {
          echo "<p class='text-muted'>ไม่มีสินค้า</p>";
        }
        ?>

        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button class="btn btn-primary" id="save_discount">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const openInsertBtn = document.getElementById("open_insert");
  const saveBtn = document.getElementById("save_discount");
  const modalEl = document.getElementById("discount_modal");

  if (!openInsertBtn || !saveBtn || !modalEl) return;

  // ✅ เปิด Modal
  openInsertBtn.addEventListener("click", () => {
    const modal = new bootstrap.Modal(modalEl);
    modal.show();

    modalEl.querySelectorAll("input, select").forEach(el => el.value = "");
    modalEl.querySelectorAll(".product-check").forEach(el => el.checked = false);
  });

  // ✅ เติมค่า value จาก data-id เมื่อ modal แสดง
  modalEl.addEventListener('shown.bs.modal', () => {
    modalEl.querySelectorAll(".product-check").forEach(el => {
      const id = el.dataset.id || "";
      el.value = id;
    });
  });

  // ✅ debug เมื่อผู้ใช้ติ๊กสินค้า
  modalEl.addEventListener("change", e => {
    if (e.target.classList.contains("product-check")) {
      console.log("ติ๊กสินค้า:", e.target.value, e.target.checked);
    }
  });

  // ✅ บันทึกข้อมูล
  saveBtn.addEventListener("click", () => {
    const selected = Array.from(modalEl.querySelectorAll(".product-check:checked"))
                         .map(el => el.value);
    console.log("✅ สินค้าที่เลือก:", selected);

    const formData = new FormData();
    formData.append('code', document.getElementById("code").value);
    formData.append('discount_type', document.getElementById("discount_type").value);
    formData.append('discount_value', document.getElementById("discount_value").value);
    formData.append('max_uses', document.getElementById("max_uses").value);
    formData.append('status', document.getElementById("status").value);
    formData.append('products', JSON.stringify(selected));

    fetch('services/backend/discount_insert.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      Swal.fire({
        icon: 'success',
        title: 'สำเร็จ',
        text: data.message
      }).then(() => location.reload());
    })
    .catch(err => {
      console.error("เกิดข้อผิดพลาด:", err);
      Swal.fire({ icon:'error', title:'เกิดข้อผิดพลาด', text:'ไม่สามารถบันทึกได้' });
    });
  });
});

// ✅ ดึงข้อมูลโค้ดมาแก้ไข
function get_detail(id) {
  fetch(`services/backend/discount_get.php?id=${id}`)
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        const modalEl = document.getElementById("discount_modal");
        const modal = new bootstrap.Modal(modalEl);
        modal.show();

        document.getElementById("code").value = data.data.code;
        document.getElementById("discount_type").value = data.data.discount_type;
        document.getElementById("discount_value").value = data.data.discount_value;
        document.getElementById("max_uses").value = data.data.max_uses;
        document.getElementById("status").value = data.data.status;

        // ✅ ติ๊กสินค้าที่ใช้โค้ดนี้ได้
        modalEl.querySelectorAll(".product-check").forEach(el => {
          el.checked = data.data.products.includes(el.dataset.id);
        });

        // ✅ เก็บ id สำหรับอัปเดต
        modalEl.dataset.editId = id;
      } else {
        Swal.fire('ผิดพลาด', data.message, 'error');
      }
    })
    .catch(err => {
      console.error(err);
      Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถโหลดข้อมูลได้', 'error');
    });
}

// ✅ ลบโค้ดส่วนลด
function del_code(id) {
  Swal.fire({
    title: 'ยืนยันการลบ?',
    text: 'คุณต้องการลบโค้ดส่วนลดนี้หรือไม่?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'ลบเลย',
    cancelButtonText: 'ยกเลิก'
  }).then(result => {
    if (result.isConfirmed) {
      fetch('services/backend/discount_delete.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          Swal.fire('สำเร็จ', data.message, 'success').then(() => location.reload());
        } else {
          Swal.fire('ผิดพลาด', data.message, 'error');
        }
      })
      .catch(err => {
        console.error(err);
        Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถลบได้', 'error');
      });
    }
  });
}

</script>

<style>
  #discount_modal .modal-content {
    background-color: #ffffff;
    color: #000000;
  }

  #discount_modal label,
  #discount_modal h5,
  #discount_modal p,
  #discount_modal input,
  #discount_modal select,
  #discount_modal option {
    color: #000 !important;
  }

  option {
    background-color: #fff;
    color: #000;
  }

  #discount_modal input,
  #discount_modal select {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
  }

  #discount_modal .scrollable-box {
    background-color: #fafafa;
    color: #000;
  }
</style>
