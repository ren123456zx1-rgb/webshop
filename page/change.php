<style>
.form-control {
  border: 0;
  border-bottom: 2px solid var(--main);
  background-color: transparent;
  color: var(--font, #000);
  border-radius: 0;
  box-shadow: none;
}
.form-control:focus {
  box-shadow: none;
  border-color: var(--main);
}
.profile-preview {
  width: 130px;
  height: 130px;
  border-radius: 50%;
  overflow: hidden;
  margin: 20px auto;
  border: 3px solid var(--main);
  box-shadow: 0 0 15px rgba(0,0,0,0.2);
}
.profile-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.bg-card {
  border-radius: 1rem;
  background: <?php if ($bg == 'bg-light'){ echo '#fff';}else{ echo '#111';} ?>;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  padding: 2rem;
}
.section-title {
  color: var(--main);
  font-weight: 700;
}
.btn-main {
  background: var(--main);
  border: none;
  color: #fff;
  border-radius: 50px;
  padding: 0.6rem 1.2rem;
  font-weight: 600;
  transition: all 0.3s ease;
}
.btn-main i {
    color: #fff;
  transition: all 0.3s ease;
}
.btn-main:hover , .btn-main:hover i {
  opacity: 0.85;
  transform: translateY(-2px);
  color: var(--main);
}
</style>


<div class="container-fluid p-4 ">
  <div class="container-lg">
    <div class="row g-4 align-items-start">
   <div class="col-12 col-lg-6 aos-init aos-animate" data-aos="<?php echo $anim; ?>">

        <div class="bg-card <?php echo $bg ?>">
          <center>
            <h3 class="section-title mb-3"><i class="fa-solid fa-image"></i> เปลี่ยนรูปโปรไฟล์</h3>
           
          </center>

          <div class="mb-3">
            <label class="form-label ms-1">ลิงก์รูปใหม่ (URL)</label>
            <input type="text" class="form-control" id="profileUrl" placeholder="https://...">
          </div>

          <center>
            <button id="btn_profile" class="btn-main">
              <i class="fa-solid fa-floppy-disk"></i> อัปเดตรูปโปรไฟล์
            </button>
          </center>
        </div>
      </div>
      <!-- =================== ซ้าย: เปลี่ยนรหัสผ่าน =================== -->
   <div class="col-12 col-lg-6 aos-init aos-animate" data-aos="<?php echo $anim; ?>">
        <div class="bg-card <?php echo $bg ?>">
          <center>
            <h3 class="section-title mb-3"><i class="fa-solid fa-lock"></i> เปลี่ยนรหัสผ่าน</h3>
          </center>

          <div class="mb-3">
            <label class="form-label ms-1">รหัสผ่านเก่า</label>
            <input type="password" class="form-control" id="o_pass" placeholder="รหัสผ่านเก่า">
          </div>

          <div class="mb-3">
            <label class="form-label ms-1">รหัสผ่านใหม่</label>
            <input type="password" class="form-control" id="pass" placeholder="รหัสผ่านใหม่">
          </div>

          <div class="mb-3">
            <label class="form-label ms-1">ยืนยันรหัสผ่านใหม่</label>
            <input type="password" class="form-control" id="pass2" placeholder="รหัสผ่านใหม่อีกครั้ง">
          </div>

          <center>
            <button id="btn_pass" class="btn-main">
              <i class="fa-solid fa-floppy-disk"></i> บันทึกรหัสใหม่
            </button>
          </center>
        </div>
      </div>

      <!-- =================== ขวา: เปลี่ยนรูปโปรไฟล์ =================== -->
   

    </div>
  </div>
</div>

<?php if($user['email'] == '') { ?>
<div class="container-sm p-3">
  <div class="bg-card <?= $bg ?>">
    <div class="mt-4 p-3">
      <center>
        <h3 class="section-title mb-3"><i class="fa-solid fa-envelope"></i> ยืนยันอีเมล</h3>
      </center>

      <!-- ช่องกรอกอีเมล -->
      <div class="mb-3 p-2" id="emailBox">
        <label class="form-label ms-1">อีเมลของคุณ</label>
        <input type="email" class="form-control" id="email" placeholder="example@mail.com">
      </div>

      <center>
        <button id="btn_send_otp" class="btn-main mb-3">
          <i class="fa-solid fa-paper-plane"></i> ส่งรหัส OTP
        </button>
      </center>

      <!-- 🔒 ช่องกรอก OTP (ซ่อนก่อน) -->
      <div id="otpBox" style="display:none;">
        <div class="mb-3">
          <label class="form-label ms-1">รหัส OTP</label>
          <input type="text" class="form-control" id="otp_code" placeholder="กรอกรหัส 6 หลัก">
        </div>

        <center>
          <button id="btn_verify_otp" class="btn-main">
            <i class="fa-solid fa-check"></i> ยืนยันอีเมล
          </button>
        </center>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<script>
/* ---------------- ส่ง OTP ไปอีเมล ---------------- */
$("#btn_send_otp").click(function(e){
  e.preventDefault();
  let email = $("#email").val().trim();
  if(!email) return Swal.fire("กรุณากรอกอีเมล","","warning");

  $.ajax({
    type: "POST",
    url: "services/send_otp.php",
    data: { email },
    dataType: "json",
    success: function(res){
      if(res.status === "success"){
        Swal.fire("ส่งสำเร็จ", res.message, "success");
        // ✅ ซ่อนช่องอีเมล และปุ่มส่ง
        $("#emailBox, #btn_send_otp").hide(300);
        // ✅ แสดงช่องกรอก OTP
        $("#otpBox").fadeIn(400);
      } else {
        Swal.fire("ผิดพลาด", res.message, "error");
      }
    },
    error: function(xhr){
      Swal.fire("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้", "error");
      console.log(xhr.responseText);
    }
  });
});


/* ---------------- ตรวจสอบ OTP ---------------- */
$("#btn_verify_otp").click(function(e){
  e.preventDefault();
  let otp = $("#otp_code").val().trim();
  let email = $("#email").val().trim();

  if(!otp) return Swal.fire("กรุณากรอกรหัส OTP","","warning");

  $.ajax({
    type: "POST",
    url: "services/verify_otp.php",
    data: { email, otp },
    dataType: "json",
    success: function(res){
      if(res.status === "success"){
        Swal.fire("สำเร็จ", res.message, "success").then(() => location.reload());
      } else {
        Swal.fire("ผิดพลาด", res.message, "error");
      }
    },
    error: function(xhr){
      Swal.fire("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้", "error");
      console.log(xhr.responseText);
    }
  });
});
</script>
<script>
/* ---------------- เปลี่ยนรูปโปรไฟล์ ---------------- */
$("#btn_profile").click(function(e){
  e.preventDefault();
  let link = $("#profileUrl").val().trim();

  if(!link){
    Swal.fire({ icon: 'warning', title: 'กรุณาใส่ลิงก์รูปภาพ' });
    return;
  }

  $("#profilePreview").attr("src", link); // แสดง preview ก่อน
  let formData = new FormData();
  formData.append("profile", link);

  $.ajax({
    type: "POST",
    url: "services/changeprofile_link.php",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json", // ✅ ให้ jQuery แปลง JSON ที่ dd_return ส่งกลับ
    success: function(res){
      if(res.status === "success"){
        Swal.fire({
          icon: "success",
          title: "สำเร็จ",
          text: res.message
        }).then(() => location.reload());
      } else {
        Swal.fire({
          icon: "error",
          title: "ผิดพลาด",
          text: res.message
        });
      }
    },
    error: function(xhr){
      Swal.fire({
        icon: "error",
        title: "เกิดข้อผิดพลาด",
        text: "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้"
      });
      console.log(xhr.responseText);
    }
  });
});


/* ---------------- เปลี่ยนรหัสผ่าน ---------------- */
$("#btn_pass").click(function(e){
  e.preventDefault();
  let formData = new FormData();
  formData.append("o_pass", $("#o_pass").val());
  formData.append("pass", $("#pass").val());
  formData.append("pass2", $("#pass2").val());

  $.ajax({
    type: "POST",
    url: "services/changepass.php",
    data: formData,
    contentType: false,
    processData: false,
    dataType: "json", // ✅ ให้ jQuery parse JSON ที่ dd_return ส่งกลับ
    success: function(res){
      if(res.status === "success"){
        Swal.fire({
          icon: "success",
          title: "สำเร็จ",
          text: res.message
        }).then(() => location.reload());
      } else {
        Swal.fire({
          icon: "error",
          title: "ผิดพลาด",
          text: res.message
        });
      }
    },
    error: function(xhr){
      console.log(xhr.responseText);
      Swal.fire({
        icon: "error",
        title: "เกิดข้อผิดพลาด",
        text: "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้"
      });
    }
  });
});

</script>
