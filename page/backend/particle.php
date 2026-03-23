<?php
// ดึงค่าปัจจุบันจากฐานข้อมูล
$q = dd_q("SELECT * FROM particle LIMIT 1");
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
    <h1><i class="fa-duotone fa-burst"></i>&nbsp;จัดการ Particle</h1>
  </center>
  <hr>

  <div class="col-lg-6 m-auto">
    <div class="mb-3">
      <p class="m-0">เปิดใช้งาน Particle <span class="text-danger">*</span></p>
      <label class="switch">
        <input type="checkbox" id="status" <?= $row['status'] == 1 ? 'checked' : '' ?>>
        <span class="slider round"></span>
      </label>
    </div>
<div class="mb-3">
  <p class="m-0">เลือกหมายเลข Particle <span class="text-danger">*</span></p>
  <select id="particle" class="form-select">
    <option value="1" <?= $row['particle'] == 1 ? 'selected' : '' ?>>Halloween</option>
    <option value="2" <?= $row['particle'] == 2 ? 'selected' : '' ?>>ใบไม้พลิ</option>
    <option value="3" <?= $row['particle'] == 3 ? 'selected' : '' ?>>คริสต์มาส</option>
  
  </select>
</div>
    

    <center>
      <button class="btn text-white bg-main w-100" id="save-particle">บันทึกข้อมูล</button>
    </center>
  </div>
</div>

<script>
$("#save-particle").click(function(e) {
  e.preventDefault();

  const status = $("#status").is(":checked") ? 1 : 0;
  const particle = $("#particle").val();

  if (particle === "") {
    Swal.fire("กรุณาใส่หมายเลข Particle", "", "warning");
    return;
  }

  const formData = new FormData();
  formData.append("status", status);
  formData.append("particle", particle);

  $.ajax({
    type: "POST",
    url: "services/backend/update_particle.php",
    data: formData,
    contentType: false,
    processData: false
  }).done(function(res) {
    Swal.fire({
      icon: "success",
      title: "บันทึกสำเร็จ",
      text: res.message
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
