<?php
$token = $_GET['token'] ?? '';
if(!$token){
    echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'ไม่พบข้อมูลรีเซ็ตรหัสผ่าน',
          text: 'กรุณากลับไปหน้าแรก',
          confirmButtonText: 'ตกลง'
        }).then(() => {
          window.location.href = '/home';
        });
    </script>";
    exit;
}
?>


<div class="container my-5">
  <div class="col-md-6 m-auto  p-4 bg-card <?= $bg ?> shadow-sm" style="border-radius: 1rem">
    <h3 class="text-center text-main mb-3"><i class="fa-solid fa-lock"></i> ตั้งรหัสผ่านใหม่</h3>
    <input type="hidden" id="token" value="<?= htmlspecialchars($token) ?>">
    <div class="mb-3">
      <label>รหัสผ่านใหม่</label>
      <input type="password" id="new_pass" class="form-control" placeholder="กรอกรหัสผ่านใหม่">
    </div>
    <div class="mb-3">
      <label>ยืนยันรหัสผ่าน</label>
      <input type="password" id="new_pass2" class="form-control" placeholder="กรอกอีกครั้ง">
    </div>
    <button id="btn_reset" class="btn bg-main w-100 text-white">รีเซ็ตรหัสผ่าน</button>
  </div>
</div>

<script>
$("#btn_reset").click(function(){
  $.post("services/forgot_reset.php", {
    token: $("#token").val(),
    pass: $("#new_pass").val(),
    pass2: $("#new_pass2").val()
  }, function(res){
    if(res.status === "success"){
      Swal.fire({icon:"success",title:"สำเร็จ",text:res.message})
      .then(()=>location.href="/login");
    }else{
      Swal.fire({icon:"error",title:"ผิดพลาด",text:res.message});
    }
  }, "json");
});
</script>
