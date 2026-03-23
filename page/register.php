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
      <h4>Welcome To <?= $config['name']?></h4>
      <p>มีบัญชีอยู่แล้ว ?<br>เข้าสู่ระบบได้เลย!</p>
      <a href="/login" class="btn">เข้าสู่ระบบ</a>
    </div>
    
    <!-- ฝั่งขวา -->
    <div class="login-right">
      <h3>สร้างบัญชีใหม่</h3>
   <div class="mb-3">
  <label>ชื่อผู้ใช้</label>
  <input type="text" id="user" class="form-control" placeholder="Username">
</div>

<div class="mb-3">
  <label>อีเมล <span class="text-danger">* ถ้ามี แต่ถ้าไม่มีจะกู้บัญชีไม่ได้ แต่สามารถเชื่อมได้ในภายหลัง *</span></label>
  <input type="email" id="email" class="form-control" placeholder="example@mail.com (ไม่บังคับ)">
</div>

<div class="mb-3">
  <label>รหัสผ่าน</label>
  <input type="password" id="pass" class="form-control" placeholder="Password">
</div>
<div class="mb-3">
  <label>ยืนยันรหัสผ่าน</label>
  <input type="password" id="pass2" class="form-control" placeholder="Confirm Password">
</div>
      <div class="my-3 text-center">
        <div id="captcha-wrapper"></div>
      </div>
      <button class="btn btn-login w-100" id="btn_regis">สมัครสมาชิก</button>
    </div>


  </div>
</div>

<script>
let captchaActive = "none";
let captchaLoaded = false;
let captchaTimeout;

const enableTurnstile = <?= $captcha['enable_turnstile'] ?>;
const enableRecaptcha = <?= $captcha['enable_recaptcha'] ?>;
const enableHcaptcha = <?= $captcha['enable_hcaptcha'] ?>;

const turnstileKey = "<?= $captcha['turnstile_key'] ?>";
const recaptchaKey = "<?= $captcha['recaptcha_key'] ?>";
const hcaptchaKey = "<?= $captcha['hcaptcha_key'] ?>";

/* โหลด script ทีละตัว */
function loadScript(src, id, callback) {
  if (document.getElementById(id)) return callback();
  const s = document.createElement("script");
  s.src = src;
  s.id = id;
  s.async = true;
  s.defer = true;
  s.onload = callback;
  document.head.appendChild(s);
}

/* สลับ captcha */
function switchCaptcha(type) {
  clearTimeout(captchaTimeout);
  captchaLoaded = false;
  captchaActive = type;
  const wrapper = document.getElementById("captcha-wrapper");
  wrapper.innerHTML = "";

  if (type === "turnstile") {
    wrapper.innerHTML = `<div class="cf-turnstile" data-sitekey="${turnstileKey}" data-theme="light"></div>`;
    loadScript("https://challenges.cloudflare.com/turnstile/v0/api.js", "turnstile-js", () => captchaLoaded = true);
  } 
  else if (type === "recaptcha") {
    wrapper.innerHTML = `<div class="g-recaptcha" data-sitekey="${recaptchaKey}" data-theme="light"></div>`;
    loadScript("https://www.google.com/recaptcha/api.js", "recaptcha-js", () => captchaLoaded = true);
  } 
  else if (type === "hcaptcha") {
    wrapper.innerHTML = `<div class="h-captcha" data-sitekey="${hcaptchaKey}" data-theme="light"></div>`;
    loadScript("https://js.hcaptcha.com/1/api.js", "hcaptcha-js", () => captchaLoaded = true);
  }
}

/* เริ่มต้นเลือกตัวที่เปิด */
if (enableTurnstile) switchCaptcha("turnstile");
else if (enableRecaptcha) switchCaptcha("recaptcha");
else if (enableHcaptcha) switchCaptcha("hcaptcha");

/* fallback: ถ้าโหลดไม่ทัน จะข้ามไปตัวต่อไป */
captchaTimeout = setTimeout(() => {
  if (!captchaLoaded) {
    if (enableRecaptcha) switchCaptcha("recaptcha");
    else if (enableHcaptcha) switchCaptcha("hcaptcha");
    else console.error("❌ ไม่มี captcha ตัวไหนเปิดใช้งาน");
  }
}, 5000);
</script>

<script>
$("#btn_regis").click(function(e) {
  e.preventDefault();

  var formData = new FormData();
  formData.append('user', $("#user").val());
  formData.append('email', $("#email").val()); // ✅ เพิ่มตรงนี้
  formData.append('pass', $("#pass").val());
  formData.append('pass2', $("#pass2").val());

  $('#btn_regis').attr('disabled', true).text('กำลังสมัคร...');
  $.ajax({
    type: 'POST',
    url: 'services/register.php',
    data: formData,
    contentType: false,
    processData: false,
    dataType: 'json',
  }).done(function(res) {
    if (res.status == "success") {
      Swal.fire({ icon: 'success', title: 'สำเร็จ', text: res.message })
        .then(() => location.reload());
    } else {
      Swal.fire({ icon: 'error', title: 'ผิดพลาด', text: res.message });
      $('#btn_regis').removeAttr('disabled').text('สมัครสมาชิก');
    }
  }).fail(() => {
    Swal.fire({ icon: 'error', title: 'เกิดข้อผิดพลาด', text: 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้' });
    $('#btn_regis').removeAttr('disabled').text('สมัครสมาชิก');
  });
});

</script>
