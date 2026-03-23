<div class="col-lg-12">
<div class="container-sm <?php echo $bg?> mt-5 shadow-sm p-5 mb-4 "
     data-aos="fade-down"
     style=" position: relative; z-index: 1; border-radius: 1rem; ">

      <h1><i class="fa-duotone fa-robot"></i> ตั้งค่า Captcha</h1>
    </center>
    <hr>

    <?php
    $cap = dd_q("SELECT * FROM captcha_setting LIMIT 1");
    $captcha = $cap->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="col-lg-6 m-auto">
      <h3>การเปิดใช้งาน</h3>
      <div class="mb-2 <?php echo $bg?> shadow-sm p-4 mb-4 rounded">
        <p class="m-0">Cloudflare Turnstile</p>
        <label class="switch">
          <input type="checkbox" id="turnstile" <?= $captcha['enable_turnstile'] ? "checked" : "" ?>>
          <span class="slider round"></span>
        </label>

        <p class="mt-3 m-0">Google reCAPTCHA</p>
        <label class="switch">
          <input type="checkbox" id="recaptcha" <?= $captcha['enable_recaptcha'] ? "checked" : "" ?>>
          <span class="slider round"></span>
        </label>

        <p class="mt-3 m-0">hCaptcha</p>
        <label class="switch">
          <input type="checkbox" id="hcaptcha" <?= $captcha['enable_hcaptcha'] ? "checked" : "" ?>>
          <span class="slider round"></span>
        </label>
      </div>

      <h3>ตั้งค่า Key</h3>
      <div class="mb-2 <?php echo $bg?> shadow-sm p-4 mb-4 rounded">
        <p class="m-0">Cloudflare Turnstile Site Key</p>
        <input type="text" id="turnstile_key" class="form-control mb-2" value="<?= htmlspecialchars($captcha['turnstile_key']) ?>">

        <p class="m-0">Google reCAPTCHA Site Key</p>
        <input type="text" id="recaptcha_key" class="form-control mb-2" value="<?= htmlspecialchars($captcha['recaptcha_key']) ?>">

        <p class="m-0">hCaptcha Site Key</p>
        <input type="text" id="hcaptcha_key" class="form-control mb-2" value="<?= htmlspecialchars($captcha['hcaptcha_key']) ?>">
      </div>

      <center>
        <button class="btn text-white bg-main w-100" id="saveCaptcha"><i class="fa-duotone fa-save"></i> บันทึกข้อมูล</button>
      </center>
    </div>
  </div>
</div>

<style>
.switch {
  position: relative; display: inline-block;
  width: 60px; height: 34px;
}
.switch input { opacity: 0; width: 0; height: 0; }
.slider {
  position: absolute; cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc; transition: .4s;
  border-radius: 34px;
}
.slider:before {
  position: absolute; content: "";
  height: 26px; width: 26px;
  left: 4px; bottom: 4px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: var(--main);
}
input:checked + .slider:before {
  transform: translateX(26px);
}
</style>

<script>
$("#saveCaptcha").click(function(e) {
  e.preventDefault();
  let formData = new FormData();

  formData.append('enable_turnstile', $('#turnstile').is(':checked') ? "1" : "0");
  formData.append('enable_recaptcha', $('#recaptcha').is(':checked') ? "1" : "0");
  formData.append('enable_hcaptcha', $('#hcaptcha').is(':checked') ? "1" : "0");

  formData.append('turnstile_key', $("#turnstile_key").val());
  formData.append('recaptcha_key', $("#recaptcha_key").val());
  formData.append('hcaptcha_key', $("#hcaptcha_key").val());

  $.ajax({
    type: 'POST',
    url: 'services/backend/captcha_setting.php',
    data: formData,
    contentType: false,
    processData: false,
  }).done(function(res) {
    Swal.fire({
      icon: 'success',
      title: 'บันทึกสำเร็จ',
      text: res.message
    }).then(() => {
      window.location = "?page=captcha_manage";
    });
  }).fail(function(jqXHR) {
    let res = jqXHR.responseJSON || {message: "ไม่สามารถบันทึกข้อมูลได้"};
    Swal.fire({
      icon: 'error',
      title: 'เกิดข้อผิดพลาด',
      text: res.message
    });
  });
});
</script>
