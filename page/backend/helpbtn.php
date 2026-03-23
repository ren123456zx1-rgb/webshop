<?php
// ดึงข้อมูล helpbtn ทั้งหมด (4 ปุ่ม)
$sql = dd_q("SELECT * FROM helpbtn ORDER BY id ASC");
$helps = $sql->fetchAll(PDO::FETCH_ASSOC);
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
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px; width: 26px;
  left: 4px; bottom: 4px;
  background-color: white;
  transition: .4s;
}
input:checked + .slider { background-color: #2196F3; }
input:checked + .slider:before { transform: translateX(26px); }
.slider.round { border-radius: 34px; }
.slider.round:before { border-radius: 50%; }
</style>

<div class="container-sm mt-5 shadow-sm p-4 mb-4 rounded <?= $bg ?> ">
    <center>
        <h1><i class="fa-duotone fa-browser"></i> ตั้งค่า ปุ่มช่วยเหลือ</h1>
    </center>
    <hr>

    <div class="col-lg-10 m-auto">

        <div class="row">

        <?php foreach ($helps as $row): ?>

            <div class="col-lg-6 col-md-6 mb-4">
                <div class="shadow-sm p-4 rounded">

                    <h4 class="mb-3">ปุ่มที่ <?= $row['id'] ?></h4>

                    <!-- Status -->
                    <p class="m-0">Status เปิด/ปิด *</p>
                    <label class="switch">
                        <input type="checkbox" id="pc_<?= $row['id'] ?>"
                               <?= $row['status']=="1" ? "checked" : "" ?>>
                        <span class="slider round"></span>
                    </label>

                    <!-- IMG -->
                    <p class="m-0 mt-3">รูปภาพ (URL) *</p>
                    <input type="text"
                           id="img_<?= $row['id'] ?>"
                           class="form-control"
                           value="<?= $row['img'] ?>">

                    <!-- LINK -->
                    <p class="m-0 mt-3">ลิงก์ปลายทาง *</p>
                    <input type="text"
                           id="link_<?= $row['id'] ?>"
                           class="form-control"
                           value="<?= $row['link'] ?>">

                </div>
            </div>

        <?php endforeach; ?>

        </div>

        <button class="btn bg-main text-white w-100 py-2" id="saveAll">
            บันทึกทั้งหมด
        </button>

    </div>
</div>

<script>
$("#saveAll").click(function (e) {
    e.preventDefault();

    let formData = new FormData();

    <?php foreach ($helps as $row): ?>
        formData.append("items[<?= $row['id'] ?>][id]", "<?= $row['id'] ?>");
        formData.append("items[<?= $row['id'] ?>][status]", $("#pc_<?= $row['id'] ?>").is(":checked") ? "1" : "0");
        formData.append("items[<?= $row['id'] ?>][img]", $("#img_<?= $row['id'] ?>").val());
        formData.append("items[<?= $row['id'] ?>][link]", $("#link_<?= $row['id'] ?>").val());
    <?php endforeach; ?>

 $.ajax({
    type: "POST",
    url: "services/backend/helpbtn.php",
    data: formData,
    contentType: false,
    processData: false,
}).done(function (res) {
    Swal.fire({
        icon: 'success',
        title: 'สำเร็จ',
        text: res.message
    });

    // 🎉 รีโหลดหลัง 1.5 วินาที
    setTimeout(function(){
        window.location.reload();
    }, 1500);

}).fail(function (jqXHR) {
    let res = jqXHR.responseJSON;
    Swal.fire({
        icon: 'error',
        title: 'เกิดข้อผิดพลาด',
        text: res.message
    });

    // 🎉 รีโหลดหลัง 1.5 วินาที
    setTimeout(function(){
        window.location.reload();
    }, 1500);
});
});
</script>
