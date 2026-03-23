<?php
// ดึงค่าปัจจุบันจากฐานข้อมูล
$q = dd_q("SELECT * FROM loading LIMIT 1");
$row = $q->fetch(PDO::FETCH_ASSOC);
?>

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input { opacity: 0; width: 0; height: 0; }
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 34px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px; width: 26px;
  left: 4px; bottom: 4px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider { background-color: #2196F3; }
input:checked + .slider:before { transform: translateX(26px); }
</style>

<div class="container-sm <?php echo $bg?> mt-5 shadow-sm p-4 mb-4 rounded" data-aos="fade-down">
  <center>
    <h1><i class="fa-duotone fa-burst"></i>&nbsp;จัดการ loading</h1>
  </center>
  <hr>

  <div class="col-lg-6 m-auto">
   
<div class="mb-3">
  <p class="m-0">เลือกหมายเลข loading <span class="text-danger">*</span></p>
  <select id="type" class="form-select">
    <option value="0" <?= $row['type'] == 0 ? 'selected' : '' ?>>ปิด</option>
    <option value="1" <?= $row['type'] == 1 ? 'selected' : '' ?>>แมวหมุน</option>
    <option value="2" <?= $row['type'] == 2 ? 'selected' : '' ?>>โหลดหมุน</option>
    <option value="3" <?= $row['type'] == 3 ? 'selected' : '' ?>>3 จุด</option>
    <option value="4" <?= $row['type'] == 4 ? 'selected' : '' ?>>ปิกาจู</option>
    <option value="5" <?= $row['type'] == 5 ? 'selected' : '' ?>>Discord 1</option>
    <option value="6" <?= $row['type'] == 6 ? 'selected' : '' ?>>Discord 2</option>

  </select>
</div>
    

    <center>
      <button class="btn text-white bg-main w-100" id="save-loading">บันทึกข้อมูล</button>
    </center>
  </div>
</div>

<script>
$("#save-loading").click(function(e) {
  e.preventDefault();

  const type = $("#type").val();

  if (type === "") {
    Swal.fire("Error 512", "", "warning");
    return;
  }

  const formData = new FormData();
  formData.append("type", type);

  $.ajax({
    type: "POST",
    url: "services/backend/update_loading.php",
    data: formData,
    contentType: false,
    processData: false
  }).done(function(res) {
    Swal.fire({
      icon: "success",
      title: "บันทึกสำเร็จ",
      text: res.message
    }).then(() => {
    location.reload();   // รีหน้า 1 รอบ
  });
  }).fail(function(jqXHR) {
    Swal.fire({
      icon: "error",
      title: "เกิดข้อผิดพลาด",
      text: jqXHR.responseJSON ? jqXHR.responseJSON.message : "ไม่สามารถอัปเดตได้"
    });
  });
});
</script>
