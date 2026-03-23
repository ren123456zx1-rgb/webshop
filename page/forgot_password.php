<style>
/* ✅ Layout หลัก */
.login-container {
  display: flex;
  flex-wrap: wrap;
  background: <?php if($bg == "bg-light"){ echo "#f9f9f9";}else{ echo "#121212";} ?>;
  border-radius: 1.5vh;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0,0,0,0.3);
  max-width: 900px;
  margin: auto;
}

/* ฝั่งซ้าย */
.login-left {
  flex: 1 1 45%;
  background: var(--main);
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 3rem 2rem;
  text-align: center;
}
.login-left img {
  width: 120px;
  height: auto;
  margin-bottom: 1rem;
}
.login-left h4 {
  font-weight: 700;
  margin-bottom: 0.5rem;
}
.login-left p {
  color: #ffffffcc;
  font-size: 1rem;
  opacity: 0.9;
}
.login-left .btn {
  margin-top: 1rem;
  border: 2px solid #fff;
  background: transparent;
  color: #fff;
  border-radius: 2vh;
  transition: 0.3s;
}
.login-left .btn:hover {
  background: #fff;
  color: var(--main);
}

/* ฝั่งขวา */
.login-right {
  flex: 1 1 55%;
  background: <?php if($bg == "bg-light"){ echo "#ffffff";}else{ echo "#1a1a1a";} ?>;
  padding: 3rem 2rem;
  color: var(--font);
}
.login-right h3 {
  color: var(--main);
  font-weight: 700;
  margin-bottom: 1.5rem;
  text-align: center;
}
.form-control {
  border: 1px solid var(--main);
  border-radius: 2.4vh;
  background: <?php if($bg == "bg-light"){ echo "#f0f0f0";}else{ echo "#222";} ?>;
  margin-top: 0.5rem;
  color: var(--font);
}
.form-control:focus {
  border-color: var(--main);
  box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.1);
  background: <?php if($bg == "bg-light"){ echo "#fff";}else{ echo "#333";} ?>;
  color: var(--font);
}
.btn-login {
  background: var(--main);
  color: #fff;
  border: none;
  border-radius: 0.8vh;
  padding: 0.7rem 0;
  font-weight: 600;
  transition: 0.3s;
}
.btn-login:hover {
  color: #fff;
  transform: scale(1.02);
}
.login-left h4 {
    color: <?php if($bg == 'bg-light') { echo '#fff'; }else{ echo '#111'; } ?>
}

/* Responsive */
@media (max-width: 991px) {
  .login-container {
    flex-direction: column;
  }
  .login-left, .login-right {
    width: 100%;
  }
  
  .login-left {
    display: none;
  }
}
</style>

<div class="container my-5" data-aos="fade-down">
  <div class="login-container">
    
    <!-- ฝั่งซ้าย -->
    <div class="login-left">
      <img src="<?= $config['logo'] ?>" alt="Logo">
      <h4>Forgot Password?</h4>
      <p>ระบบจะส่งลิงก์รีเซ็ตรหัสผ่านไปยังอีเมลของคุณ<br>คลิกลิงก์เพื่อตั้งรหัสผ่านใหม่ได้เลย!</p>
      <a href="/login" class="btn">กลับไปหน้าเข้าสู่ระบบ</a>
    </div>
    
    <!-- ฝั่งขวา -->
    <div class="login-right">
      <h3><i class="fa-solid fa-envelope"></i> ลืมรหัสผ่าน</h3>
      <div class="mb-3">
        <label>อีเมลที่ใช้สมัคร</label>
        <input type="email" id="email" class="form-control" placeholder="example@gmail.com">
      </div>
      <button class="btn btn-login w-100" id="btn_send">ส่งลิงก์รีเซ็ตรหัสผ่าน</button>
      <div class="text-end mt-2">
        <a href="/login" class="text-main">กลับไปเข้าสู่ระบบ</a>
      </div>
    </div>

  </div>
</div>

<script>
$("#btn_send").click(function(e) {
  e.preventDefault();
  let email = $("#email").val().trim();

  if (!email) {
    Swal.fire({
      icon: 'warning',
      title: 'กรุณากรอกอีเมล',
      text: 'โปรดกรอกอีเมลที่คุณใช้สมัครสมาชิก'
    });
    return;
  }

  $('#btn_send').attr('disabled', true).text('กำลังส่ง...');
  $.ajax({
    type: 'POST',
    url: 'services/forgot_send.php',
    data: { email },
    dataType: 'json',
  })
  .done(function(res) {
    if(res.status === "success") {
      Swal.fire({
        icon: 'success',
        title: 'ส่งสำเร็จ!',
        text: res.message
      }).then(() => window.location.href = "/login");
    } else {
      Swal.fire({
        icon: 'error',
        title: 'ผิดพลาด',
        text: res.message
      });
    }
  })
  .fail(() => {
    Swal.fire({
      icon: 'error',
      title: 'เกิดข้อผิดพลาด',
      text: 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้'
    });
  })
  .always(() => {
    $('#btn_send').removeAttr('disabled').text('ส่งลิงก์รีเซ็ตรหัสผ่าน');
  });
});
</script>
