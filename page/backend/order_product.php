<div class="container-sm <?php echo $bg?> mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
  <center>
      <h1><i class="fa-duotone fa-layer-group"></i>&nbsp;จัดการสินค้าแบบหลายตัวเลือก</h1>
  </center>
  <hr>
  <div class="d-flex justify-content-center">
      <button class="ms-2 me-2 mt-3 mb-0 btn btn-success col-12 col-lg-5 text-white" id="open_insert_multi">
          เพิ่มสินค้าใหม่ (หลายตัวเลือก)
      </button>
  </div>

  <div class="table-responsive mt-3">
      <table id="table_multi" class="table mt-2">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>ภาพหลัก</th>
                  <th>ชื่อสินค้า</th>
                  <th>ฟอร์มกรอก</th>
                  <th>สถานะ</th>
                  <th>จัดการตัวเลือก</th>
                  <th>แก้ไข</th>
                  <th>ลบ</th>
              </tr>
          </thead>
          <tbody>
              <?php
              $get_multi = dd_q("SELECT * FROM product_multi ORDER BY id DESC");
              while ($row = $get_multi->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                  <td><?= $row['id'] ?></td>
                  <td>
                    <?php if(!empty($row['base_image'])): ?>
                      <img src="<?= htmlspecialchars($row['base_image']) ?>" width="80">
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td><?= htmlspecialchars($row['name']) ?></td>
                  <td>
                    <?php
                      if ($row['enable_form']) {
                          echo "<span class='badge bg-success'>เปิดฟอร์ม</span>";
                      } else {
                          echo "<span class='badge bg-secondary'>ไม่มีฟอร์ม</span>";
                      }
                    ?>
                  </td>
                  <td>
                    <?php
                      if ($row['status']) {
                          echo "<span class='badge bg-success'>ใช้งาน</span>";
                      } else {
                          echo "<span class='badge bg-danger'>ปิด</span>";
                      }
                    ?>
                  </td>
                  <td>
                    <a class="btn btn-warning w-100"
                       href="/multi_variant_manage.php?product_id=<?= $row['id'] ?>">
                       <i class="fa-solid fa-list"></i>&nbsp;ตัวเลือก
                    </a>
                  </td>
                  <td>
                    <button class="btn btn-primary w-100"
                            onclick="get_multi_detail(<?= $row['id'] ?>)">
                      <i class="fa-solid fa-pencil"></i>&nbsp;แก้ไข
                    </button>
                  </td>
                  <td>
                    <button class="btn btn-danger w-100"
                            onclick="del_multi('<?= $row['id'] ?>','<?= htmlspecialchars($row['name']) ?>')">
                      <i class="fa-solid fa-trash"></i>&nbsp;ลบ
                    </button>
                  </td>
              </tr>
              <?php } ?>
          </tbody>
      </table>
  </div>
</div>

<!-- 🔹 Modal เพิ่มสินค้าแบบหลายตัวเลือก -->
<div class="modal fade" id="multi_insert" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">
          <i class="fa-duotone fa-plus"></i>&nbsp;เพิ่มสินค้าใหม่ (หลายตัวเลือก)
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-10 m-auto">
          <div class="mb-2">
            <p class="mb-1 text-dark">ชื่อสินค้า <span class="text-danger">*</span></p>
            <input type="text" id="m_name" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ลิงค์รูปภาพหลัก</p>
            <input type="text" id="m_img" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">รายละเอียด</p>
            <textarea id="m_des" class="form-control"></textarea>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">เปิดฟอร์มกรอกข้อมูลเพิ่มเติม?</p>
            <select class="form-select text-dark" id="m_enable_form">
              <option value="0">ไม่ต้องกรอก</option>
              <option value="1">ให้ลูกค้ากรอกข้อมูล</option>
            </select>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">
              ตั้งค่าช่องกรอก (JSON) <small class="text-muted">เว้นว่างได้ถ้าไม่ใช้</small>
            </p>
            <textarea id="m_form_fields" class="form-control" rows="4"
              placeholder='[{"label":"ชื่อ","name":"fullname","required":true}]'></textarea>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">สถานะสินค้า</p>
            <select class="form-select text-dark" id="m_status">
              <option value="1">เปิดใช้งาน</option>
              <option value="0">ปิดไว้ก่อน</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button class="btn btn-primary ps-4 pe-4" id="multi_insert_btn">เพิ่มสินค้า</button>
      </div>
    </div>
  </div>
</div>

<!-- 🔹 Modal แก้ไขสินค้าแบบหลายตัวเลือก -->
<div class="modal fade" id="multi_detail" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">
          <i class="fa-duotone fa-pencil"></i>&nbsp;แก้ไขสินค้า (หลายตัวเลือก)
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-10 m-auto">
          <div class="mb-2">
            <p class="mb-1 text-dark">ชื่อสินค้า</p>
            <input type="text" id="e_name" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ลิงค์รูปภาพหลัก</p>
            <input type="text" id="e_img" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">รายละเอียด</p>
            <textarea id="e_des" class="form-control"></textarea>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">เปิดฟอร์มกรอกข้อมูลเพิ่มเติม?</p>
            <select class="form-select text-dark" id="e_enable_form">
              <option value="0">ไม่ต้องกรอก</option>
              <option value="1">ให้ลูกค้ากรอกข้อมูล</option>
            </select>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ตั้งค่าช่องกรอก (JSON)</p>
            <textarea id="e_form_fields" class="form-control" rows="4"></textarea>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">สถานะสินค้า</p>
            <select class="form-select text-dark" id="e_status">
              <option value="1">เปิดใช้งาน</option>
              <option value="0">ปิดไว้ก่อน</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button class="btn btn-primary" id="multi_save_btn" data-id="">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<script>
// เปิด modal เพิ่มสินค้า
$("#open_insert_multi").click(() => {
  new bootstrap.Modal('#multi_insert').show();
});

// เพิ่มสินค้าใหม่ (หลายตัวเลือก)
$("#multi_insert_btn").click(() => {
  let fd = new FormData();
  fd.append('name', $("#m_name").val());
  fd.append('base_image', $("#m_img").val());
  fd.append('description', $("#m_des").val());
  fd.append('enable_form', $("#m_enable_form").val());
  fd.append('form_fields', $("#m_form_fields").val());
  fd.append('status', $("#m_status").val());

  $.ajax({
    type: 'POST',
    url: 'services/backend/multi_product_insert.php',
    data: fd,
    contentType: false,
    processData: false,
  }).done(res => {
    Swal.fire({icon:'success', title:'สำเร็จ', text:res.message})
      .then(()=>location.reload());
  }).fail(jqXHR => {
    Swal.fire({icon:'error', title:'ผิดพลาด', text:jqXHR.responseJSON?.message || 'ไม่สามารถเพิ่มสินค้าได้'});
  });
});

// โหลดข้อมูลสินค้า เพื่อแก้ไข
function get_multi_detail(id){
  let fd = new FormData();
  fd.append('id', id);

  $.ajax({
    type: 'POST',
    url: 'services/backend/call/multi_product_detail.php',
    data: fd,
    contentType: false,
    processData: false,
  }).done(res => {
    $("#e_name").val(res.name);
    $("#e_img").val(res.base_image);
    $("#e_des").val(res.description);
    $("#e_enable_form").val(res.enable_form);
    $("#e_form_fields").val(res.form_fields);
    $("#e_status").val(res.status);
    $("#multi_save_btn").attr("data-id", id);
    new bootstrap.Modal('#multi_detail').show();
  });
}


// บันทึกการแก้ไขสินค้า
$("#multi_save_btn").click(() => {
  let id = $("#multi_save_btn").attr("data-id");
  let fd = new FormData();
  fd.append('id', id);
  fd.append('name', $("#e_name").val());
  fd.append('base_image', $("#e_img").val());
  fd.append('description', $("#e_des").val());
  fd.append('enable_form', $("#e_enable_form").val());
  fd.append('form_fields', $("#e_form_fields").val());
  fd.append('status', $("#e_status").val());

  $.ajax({
    type: 'POST',
    url: 'services/backend/multi_product_update.php',
    data: fd,
    contentType: false,
    processData: false,
  }).done(res => {
    Swal.fire({icon:'success', title:'สำเร็จ', text:res.message})
      .then(()=>location.reload());
  }).fail(jqXHR => {
    Swal.fire({icon:'error', title:'ผิดพลาด', text:jqXHR.responseJSON?.message || 'ไม่สามารถบันทึกได้'});
  });
});

// ลบสินค้า
function del_multi(id, name){
  Swal.fire({
    title: 'ยืนยันที่จะลบ?',
    text: "คุณแน่ใจที่จะลบสินค้า " + name,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'ลบเลย'
  }).then(r => {
    if(r.isConfirmed){
      let fd = new FormData();
      fd.append('id', id);
      $.ajax({
        type: 'POST',
        url: 'services/backend/multi_product_del.php',
        data: fd,
        contentType: false,
        processData: false,
      }).done(res => {
        Swal.fire({icon:'success', title:'สำเร็จ', text:res.message})
          .then(()=>location.reload());
      });
    }
  });
}

$(document).ready(()=>{
  $('#table_multi').DataTable();
});
</script>
