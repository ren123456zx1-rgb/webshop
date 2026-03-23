<div class="container-sm <?php echo $bg?> mt-5 shadow-sm p-4 mb-4 rounded" data-aos="fade-down">
  <center>
    <h1><i class="fa-duotone fa-fire"></i>&nbsp;ตั้งค่าสินค้าแนะนำ</h1>
  </center>
  <hr>
  <div class="col-lg-6 m-auto">
    <?php
    // ดึงข้อมูลทั้งหมดจากตาราง recom เพียงครั้งเดียว
    $recom = dd_q("SELECT * FROM recom")->fetch(PDO::FETCH_ASSOC);
    // ดึงรายการสินค้าทั้งหมดเพียงครั้งเดียว
    $products = dd_q("SELECT id,name FROM box_product ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

    // Loop 1–10
    for ($i = 1; $i <= 10; $i++) :
      $selected_id = $recom["recom_$i"];
      $selected_name = "โปรดทำการเลือกสินค้าแนะนำ";
      if ($selected_id != "0") {
        $pd = dd_q("SELECT name FROM box_product WHERE id = ?", [$selected_id])->fetch(PDO::FETCH_ASSOC);
        $selected_name = $pd['name'] ?? $selected_name;
      }
    ?>
      <div class="mb-3 mt-3">
        <p class="m-0">สินค้าแนะนำ #<?= $i ?> <span class="text-danger">*</span></p>
        <select class="form-select" id="pop_<?= $i ?>">
          <!-- 🟢 เพิ่มตัวเลือก "ไม่แนะนำสินค้า" -->
          <option value="0" style="color:#999">— ไม่แนะนำสินค้า —</option>

          <!-- แสดงสินค้าที่เลือกไว้ -->
          <?php if ($selected_id != "0"): ?>
            <option value="<?= $selected_id ?>" selected style="color:#000">
              <?= htmlspecialchars($selected_name) ?>
            </option>
          <?php endif; ?>

          <!-- แสดงสินค้าทั้งหมด -->
          <?php foreach ($products as $row): 
            if ($row['id'] == $selected_id) continue; ?>
            <option value="<?= $row['id'] ?>" style="color:#000"><?= htmlspecialchars($row['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endfor; ?>
    
    <div class="mb-2">
      <button class="btn btn-success w-100" id="btn_regis">บันทึกข้อมูล</button>
    </div>
  </div>
</div>

<script type="text/javascript">
$("#btn_regis").click(function(e) {
  e.preventDefault();
  let formData = new FormData();
  for (let i = 1; i <= 10; i++) {
    formData.append('pop_' + i, $("#pop_" + i).val());
  }
  $('#btn_regis').attr('disabled', 'disabled');
  $.ajax({
    type: 'POST',
    url: 'services/backend/recom_update.php',
    data: formData,
    contentType: false,
    processData: false,
  }).done(function(res) {
    Swal.fire({ icon: 'success', title: 'สำเร็จ', text: res.message }).then(() => {
      window.location = "/<?php echo $_GET['page']; ?>";
    });
  }).fail(function(jqXHR) {
    const res = jqXHR.responseJSON;
    Swal.fire({ icon: 'error', title: 'เกิดข้อผิดพลาด', text: res.message });
    $('#btn_regis').removeAttr('disabled');
  });
});
</script>
