<div class="container-sm <?php echo $bg?>  mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
  <center>
      <h1><i class="fa-duotone fa-shopping-basket"></i>&nbsp;จัดการสินค้า</h1>
  </center>
  <hr>
  <div class="d-flex justify-content-center">
      <button class="ms-2 me-2 mt-3 mb-0 btn btn-success col-12 col-lg-5 text-white" id="open_insert">
          เพิ่มสินค้าใหม่
      </button>
  </div>

  <div class="table-responsive mt-3">
      <table id="table" class="table mt-2">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>ภาพสินค้า</th>
                  <th>ชื่อสินค้า</th>
                  <th>ราคา</th>
                  <th>ชนิดการสุ่ม</th>
                  <th>Badge</th>
                  <th>ลิ้งค์โหลด</th>
                  <th>หมวดหมู่</th>
                  <th>สต็อก</th>
                  <th>แก้ไข</th>
                  <th>ลบ</th>
              </tr>
          </thead>
          <tbody>
              <?php
              $get_user = dd_q("SELECT * FROM box_product ORDER BY id DESC");
              while ($row = $get_user->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                  <td><?= $row['id'] ?></td>
                  <td><img src="<?= htmlspecialchars($row['img']) ?>" width="80"></td>
                  <td><?= htmlspecialchars($row['name']) ?></td>
                  <td><?= number_format($row['price']) ?></td>
                  <td>
                      <?php
                      if ($row['type'] == "1") echo "ได้ของรางวัลแน่นอน";
                      elseif ($row['type'] == "0") echo "สุ่มรางวัล";
                      elseif ($row['type'] == "2") echo "ลิ้งค์โหลดถาวร";
                      else echo "ไม่ทราบประเภท";
                      ?>
                  </td>
                  <td>
                      <?php
                      if ($row['badge'] == "1") echo "<span class='badge bg-danger'>🔥 HOT</span>";
                      elseif ($row['badge'] == "2") echo "<span class='badge bg-primary'>🆕 NEW</span>";
                      else echo "<span class='badge bg-secondary'>-</span>";
                      ?>
                  </td>
                  <td><?= htmlspecialchars($row['link_download']) ?></td>
                  <td><?= htmlspecialchars($row['c_type']) ?></td>
                  <td><a class="btn btn-warning w-100" href="/stock_manage?id=<?= $row['id'] ?>"><i class="fa-solid fa-box"></i>&nbsp;สต็อก</a></td>
                  <td><button class="btn btn-warning w-100" onclick="get_detail(<?= $row['id'] ?>)"><i class="fa-solid fa-pencil"></i>&nbsp;แก้ไข</button></td>
                  <td><button class="btn btn-danger w-100" onclick="del('<?= $row['id'] ?>','<?= htmlspecialchars($row['username'] ?? '-') ?>')"><i class="fa-solid fa-trash"></i>&nbsp;ลบ</button></td>
              </tr>
              <?php } ?>
          </tbody>
      </table>
  </div>
</div>

<!-- ✅ Modal เพิ่มสินค้า -->
<div class="modal fade" id="product_insert" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark"><i class="fa-duotone fa-plus"></i>&nbsp;เพิ่มสินค้าใหม่</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-10 m-auto">
          <div class="mb-2">
            <p class="mb-1 text-dark">ชื่อสินค้า <span class="text-danger">*</span></p>
            <input type="text" id="p_name" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ลิงค์รูปภาพ <span class="text-danger">*</span></p>
            <input type="text" id="p_img" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">รายละเอียด</p>
            <textarea id="p_des" class="form-control"></textarea>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ราคาสินค้า <span class="text-danger">*</span></p>
            <input type="number" id="p_price" class="form-control" value="0">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ประเภทสินค้า</p>
            <select class="form-select text-dark" id="p_type_product">
              <option value="0">สุ่มรางวัล</option>
              <option value="1">ได้ของรางวัลแน่นอน</option>
              <option value="2">แบบลิ้งค์โหลดถาวร</option>
            </select>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">Badge สินค้า</p>
            <select class="form-select text-dark" id="p_badge">
              <option value="0">ไม่มี</option>
              <option value="1">🔥 HOT</option>
              <option value="2">🆕 NEW</option>
            </select>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ลิ้งค์โหลด</p>
            <input type="text" id="p_link" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">หมวดหมู่สินค้า</p>
            <select class="form-select text-dark" id="p_type_category">
              <option value="0">เลือกหมวดหมู่</option>
              <?php
              $getrow = dd_q("SELECT * FROM category ORDER BY c_id DESC");
              while ($row = $getrow->fetch(PDO::FETCH_ASSOC)) {
                  echo "<option value='{$row['c_name']}'>{$row['c_name']}</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button class="btn btn-primary ps-4 pe-4" id="insert_btn">เพิ่มสินค้า</button>
      </div>
    </div>
  </div>
</div>

<!-- ✅ Modal แก้ไขสินค้า -->
<div class="modal fade" id="product_detail" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark"><i class="fa-duotone fa-pencil"></i>&nbsp;แก้ไขสินค้า</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-10 m-auto">
          <div class="mb-2">
            <p class="mb-1 text-dark">ชื่อสินค้า</p>
            <input type="text" id="name" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ลิงค์รูปภาพ</p>
            <input type="text" id="img" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">รายละเอียด</p>
            <textarea id="des" class="form-control"></textarea>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ราคาสินค้า</p>
            <input type="number" id="price" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ประเภทสินค้า</p>
            <select class="form-select text-dark" id="type_product">
              <option value="0">สุ่มรางวัล</option>
              <option value="1">ได้ของรางวัลแน่นอน</option>
              <option value="2">แบบลิ้งค์โหลดถาวร</option>
            </select>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">Badge สินค้า</p>
            <select class="form-select text-dark" id="badge">
              <option value="0">ไม่มี</option>
              <option value="1">🔥 HOT</option>
              <option value="2">🆕 NEW</option>
            </select>
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">ลิ้งค์โหลด</p>
            <input type="text" id="link" class="form-control">
          </div>
          <div class="mb-2">
            <p class="mb-1 text-dark">หมวดหมู่สินค้า</p>
            <select class="form-select text-dark" id="type_category">
              <?php
              $cat = dd_q("SELECT * FROM category ORDER BY c_id DESC");
              while ($r = $cat->fetch(PDO::FETCH_ASSOC)) {
                  echo "<option value='{$r['c_name']}'>{$r['c_name']}</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button class="btn btn-primary" id="save_btn" data-id="">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<script>
// ✅ เปิด modal เพิ่มสินค้า
$("#open_insert").click(() => new bootstrap.Modal('#product_insert').show());

// ✅ เพิ่มสินค้าใหม่
$("#insert_btn").click(() => {
  var formData = new FormData();
  formData.append('img', $("#p_img").val());
  formData.append('price', $("#p_price").val());
  formData.append('des', $("#p_des").val());
  formData.append('name', $("#p_name").val());
  formData.append('type', $("#p_type_product").val());
  formData.append('link', $("#p_link").val());
  formData.append('c_type', $("#p_type_category").val());
  formData.append('badge', $("#p_badge").val());
  $.ajax({
    type: 'POST',
    url: 'services/backend/product_insert.php',
    data: formData,
    contentType: false,
    processData: false,
  }).done(res => {
    Swal.fire({icon: 'success', title: 'สำเร็จ', text: res.message}).then(() => location.reload());
  }).fail(jqXHR => {
    Swal.fire({icon: 'error', title: 'เกิดข้อผิดพลาด', text: jqXHR.responseJSON.message});
  });
});

// ✅ โหลดข้อมูลแก้ไข
function get_detail(id){
  var fd = new FormData();
  fd.append('id', id);
  $.ajax({
    type: 'POST',
    url: 'services/backend/call/product_detail.php',
    data: fd, contentType: false, processData: false,
  }).done(res => {
    $("#name").val(res.name);
    $("#img").val(res.img);
    $("#price").val(res.price);
    $("#des").val(res.des);
    $("#type_product").val(res.type);
    $("#badge").val(res.badge);
    $("#link").val(res.link);
    $("#type_category").val(res.c_type);
    $("#save_btn").attr("data-id", id);
    new bootstrap.Modal('#product_detail').show();
  });
}

// ✅ บันทึกการแก้ไข
$("#save_btn").click(() => {
  var fd = new FormData();
  fd.append('id', $("#save_btn").attr("data-id"));
  fd.append('img', $("#img").val());
  fd.append('price', $("#price").val());
  fd.append('des', $("#des").val());
  fd.append('name', $("#name").val());
  fd.append('type', $("#type_product").val());
  fd.append('link', $("#link").val());
  fd.append('c_type', $("#type_category").val());
  fd.append('badge', $("#badge").val());
  $.ajax({
    type: 'POST',
    url: 'services/backend/product_update.php',
    data: fd,
    contentType: false,
    processData: false,
  }).done(res => Swal.fire({icon: 'success', title: 'สำเร็จ', text: res.message}).then(()=>location.reload()))
  .fail(jqXHR => Swal.fire({icon: 'error', title: 'เกิดข้อผิดพลาด', text: jqXHR.responseJSON.message}));
});

// ✅ ลบสินค้า
function del(id, username){
  Swal.fire({
    title: 'ยืนยันที่จะลบ?', text: "คุณแน่ใจที่จะลบสินค้า " + username,
    icon: 'warning', showCancelButton: true, confirmButtonText: 'ลบเลย'
  }).then(r=>{
    if(r.isConfirmed){
      var fd = new FormData(); fd.append('id', id);
      $.ajax({
        type: 'POST', url: 'services/backend/product_del.php', data: fd,
        contentType: false, processData: false,
      }).done(res=>{
        Swal.fire({icon:'success',title:'สำเร็จ',text:res.message}).then(()=>location.reload());
      });
    }
  });
}

$(document).ready(()=>$('#table').DataTable());
</script>
