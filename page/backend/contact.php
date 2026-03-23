<div class="container-sm <?php echo $bg?> mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
  <center>
    <h1><i class="fa-duotone fa-address-book"></i>&nbsp;จัดการข้อมูลติดต่อ (Contact)</h1>
  </center>
  <hr>
  <div class="d-flex justify-content-center">
    <button class="ms-2 me-2 mt-3 mb-0 btn btn-success col-12 col-lg-5 text-white" id="open_insert">
      เพิ่มข้อมูลใหม่
    </button>
  </div>

  <div class="table-responsive mt-3">
    <table id="table" class="table mt-2">
      <thead>
        <tr>
          <th>ID</th>
          <th>ภาพ</th>
          <th>ชื่อ</th>
          <th>คำอธิบาย</th>
          <th>ลิงก์</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $get_contact = dd_q("SELECT * FROM contact ORDER BY id DESC");
        while ($row = $get_contact->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><img src="<?= htmlspecialchars($row['img']) ?>" width="80"></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['des']) ?></td>
          <td><a href="<?= htmlspecialchars($row['link']) ?>" target="_blank"><?= htmlspecialchars($row['link']) ?></a></td>
          <td><button class="btn btn-warning w-100" onclick="get_detail(<?= $row['id'] ?>)"><i class="fa-solid fa-pencil"></i>&nbsp;แก้ไข</button></td>
          <td><button class="btn btn-danger w-100" onclick="del('<?= $row['id'] ?>')"><i class="fa-solid fa-trash"></i>&nbsp;ลบ</button></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal เพิ่ม -->
<div class="modal fade" id="contact_insert" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark"><i class="fa-duotone fa-plus"></i>&nbsp;เพิ่มข้อมูลติดต่อใหม่</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-10 m-auto">
          <div class="mb-2">
            <label class="text-dark">ชื่อ</label>
            <input type="text" id="c_name" class="form-control">
          </div>
          <div class="mb-2">
            <label class="text-dark">ลิงก์</label>
            <input type="text" id="c_link" class="form-control">
          </div>
          <div class="mb-2">
            <label class="text-dark">รูปภาพ (URL)</label>
            <input type="text" id="c_img" class="form-control">
          </div>
          <div class="mb-2">
            <label class="text-dark">รายละเอียด</label>
            <textarea id="c_des" class="form-control"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button class="btn btn-primary" id="insert_btn">เพิ่มข้อมูล</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal แก้ไข -->
<div class="modal fade" id="contact_detail" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark"><i class="fa-duotone fa-pencil"></i>&nbsp;แก้ไขข้อมูลติดต่อ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-10 m-auto">
          <div class="mb-2">
            <label class="text-dark">ชื่อ</label>
            <input type="text" id="name" class="form-control">
          </div>
          <div class="mb-2">
            <label class="text-dark">ลิงก์</label>
            <input type="text" id="link" class="form-control">
          </div>
          <div class="mb-2">
            <label class="text-dark">รูปภาพ</label>
            <input type="text" id="img" class="form-control">
          </div>
          <div class="mb-2">
            <label class="text-dark">รายละเอียด</label>
            <textarea id="des" class="form-control"></textarea>
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
$("#open_insert").click(() => new bootstrap.Modal('#contact_insert').show());

// ✅ เพิ่มข้อมูล
$("#insert_btn").click(() => {
  var fd = new FormData();
  fd.append('img', $("#c_img").val());
  fd.append('name', $("#c_name").val());
  fd.append('link', $("#c_link").val());
  fd.append('des', $("#c_des").val());
  $.ajax({
    type: 'POST',
    url: 'services/backend/contact_insert.php',
    data: fd, contentType: false, processData: false,
  }).done(res => {
    Swal.fire({icon: 'success', title: 'สำเร็จ', text: res.message}).then(()=>location.reload());
  }).fail(jqXHR => {
    Swal.fire({icon: 'error', title: 'ผิดพลาด', text: jqXHR.responseJSON.message});
  });
});

// ✅ โหลดข้อมูลมาแก้ไข
function get_detail(id){
  var fd = new FormData();
  fd.append('id', id);
  $.ajax({
    type: 'POST',
    url: 'services/backend/call/contact_detail.php',
    data: fd, contentType: false, processData: false,
  }).done(res => {
    $("#name").val(res.name);
    $("#img").val(res.img);
    $("#link").val(res.link);
    $("#des").val(res.des);
    $("#save_btn").attr("data-id", id);
    new bootstrap.Modal('#contact_detail').show();
  });
}

// ✅ บันทึกการแก้ไข
$("#save_btn").click(() => {
  var fd = new FormData();
  fd.append('id', $("#save_btn").attr("data-id"));
  fd.append('img', $("#img").val());
  fd.append('name', $("#name").val());
  fd.append('link', $("#link").val());
  fd.append('des', $("#des").val());
  $.ajax({
    type: 'POST',
    url: 'services/backend/contact_update.php',
    data: fd, contentType: false, processData: false,
  }).done(res => Swal.fire({icon:'success',title:'สำเร็จ',text:res.message}).then(()=>location.reload()))
  .fail(jqXHR => Swal.fire({icon:'error',title:'ผิดพลาด',text:jqXHR.responseJSON.message}));
});

// ✅ ลบข้อมูล
function del(id){
  Swal.fire({
    title: 'ยืนยันการลบ?', icon: 'warning',
    showCancelButton: true, confirmButtonText: 'ลบเลย'
  }).then(r=>{
    if(r.isConfirmed){
      var fd = new FormData(); fd.append('id', id);
      $.ajax({
        type: 'POST',
        url: 'services/backend/contact_del.php',
        data: fd, contentType: false, processData: false,
      }).done(res=>{
        Swal.fire({icon:'success',title:'สำเร็จ',text:res.message}).then(()=>location.reload());
      });
    }
  });
}

$(document).ready(()=>$('#table').DataTable());
</script>
