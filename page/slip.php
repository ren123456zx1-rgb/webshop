<style>
    .font-bold { font-weight: 700; }
    .font-semibold { font-weight: 600; }
</style>

<?php $bank = dd_q("SELECT * FROM bank WHERE 1")->fetch(PDO::FETCH_ASSOC); ?>

<div class="container-fluid p-4">
  <div class="container-sm ps-4 pe-4">

    <div class="row">
      <!-- 🔹 ซ้าย : ปุ่ม 3 ปุ่ม -->
      <div class="col-12 col-lg-3 mb-3">

        <div class="mb-2">
          <a href="/angpao" style="text-decoration: none;">
            <div class="container-sm <?= $bg ?> shadow p-3" style="border-radius:1vh">
              <div class="d-flex justify-content-between">
                <img src="https://www.truemoney.com/wp-content/uploads/2022/01/truemoneywallet-sendgift-hongbao-20220125-icon-1.png" style="max-height: 50px;" alt="">
                <div class="ms-1" style="text-align: right;">
                  <h4 class="font-semibold text-dark mb-0">ซองอั่งเปา</h4>
                  <p class="text-muted mb-0">กรอกลิงค์เลย</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="mb-2">
          <a href="/slip" style="text-decoration: none;">
            <div class="container-sm <?= $bg ?> shadow p-3" style="border-radius:1vh;">
              <div class="d-flex justify-content-between">
                <img src="https://cdn.discordapp.com/attachments/1097917702875660358/1102660427453825074/slipscanpay.png" style="max-height: 50px;" alt="">
                <div class="ms-1" style="text-align: right;">
                  <h4 class="font-semibold text-dark mb-0 text-main">โอนด้วยธนาคาร</h4>
                  <p class="text-muted mb-0">เช็คสลิปเลย</p>
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="mb-2">
          <a href="/redeem" style="text-decoration: none;">
            <div class="container-sm <?= $bg ?> shadow p-3" style="border-radius:1vh">
              <div class="d-flex justify-content-between">
                <img src="assets/icon/unboxing.png" style="max-height: 50px;" alt="">
                <div class="ms-1" style="text-align: right;">
                  <h4 class="font-semibold text-dark mb-0">โค้ด</h4>
                  <p class="text-muted mb-0">กรอกโค้ดเลย</p>
                </div>
              </div>
            </div>
          </a>
        </div>

      </div>
      <!-- 🔹 จบฝั่งซ้าย -->

      <!-- 🔹 ขวา : กล่องเช็คสลิป -->
      <div class="col-12 col-lg-9">
        <div class="container-fluid <?= $bg ?> p-4" style="border-radius:1vh">
          <div class="col-lg-7 m-auto">
            <h1 class="text-strongest" data-aos="fade-right" data-aos-duration="500">
              <i class="fa-duotone fa-coins"></i> &nbsp;Slip Verification (เช็คสลิป)
            </h1>
            <div data-aos="fade-right" data-aos-duration="600">
              <hr class="mt-1 mb-2">
              <h5 class="m-0"><i class="fa-regular fa-plus-circle"></i>&nbsp;ระบบเติมเงินด้วยระบบเช็คสลิป</h5>
            </div>

            <center>
              <div class="col-lg-4" data-aos="fade-down" data-aos="700">
                <img src="https://cdn.discordapp.com/attachments/1097917702875660358/1102660427453825074/slipscanpay.png" class="img-fluid">
              </div>
            </center>

            <!-- 🔹 แสดงข้อมูลบัญชี -->
            <div data-aos="fade-left" data-aos-duration="750">
              <center>
                <div class="col-12 col-lg-8 text-start">
                  <h5 class="text-storg text-center">
                    ชื่อบัญชี : <?= $bank["fname"] . " " . $bank["lname"] ?>
                  </h5>
                  <h5 class="text-storg text-center">
                    ธนาคาร : <?= $bank["tname"] ?>
                  </h5>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control text-center" id="bankno"
                           value="<?= $bank["bnum"] ?>" readonly>
                    <button class="btn bg-main text-white" type="button"
                            onclick="copyToClipboard('#bankno')">
                      คัดลอกเลขที่บัญชี
                    </button>
                  </div>

                  <!-- 🔹 ช่องกรอกจำนวนเงิน -->
                  <label for="amount" class="form-label mt-2">จำนวนเงินที่โอน (บาท)</label>
                  <input type="number"
                         class="form-control text-center mb-3"
                         id="amount"
                         min="1"
                         step="0.01"
                         placeholder="กรอกจำนวนเงินที่โอนตามสลิป">

                  <label for="upload" class="form-label mt-2">แนบรูปภาพสลิป</label>
                  <input type="file" class="form-control" id="upload" aria-label="Upload">
                  <img id="imageScanner" style="display: none;" src="#" alt="qr-code-scanner-online">
                </div>
              </center>
            </div>
          </div>
        </div>
      </div>
      <!-- 🔹 จบฝั่งขวา -->

    </div>

  </div>
</div>

<!-- 🔹 JS Decode Slip QR -->
<script src="https://cdn.jsdelivr.net/npm/jsqr@1.1.0/dist/jsQR.js"></script>
<script>
function copyToClipboard(element) {
  var temp = document.createElement("input");
  document.body.appendChild(temp);
  temp.value = document.querySelector(element).value;
  temp.select();
  document.execCommand("copy");
  document.body.removeChild(temp);
  Swal.fire({
    title: 'คัดลอกสำเร็จ',
    icon: 'success',
    timer: 1500,
    timerProgressBar: true
  });
}

function File2Base64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });
}

async function imageDataFromSource(source) {
  const image = Object.assign(new Image(), { src: source });
  await new Promise((resolve) => image.addEventListener('load', () => resolve()));
  const canvas = Object.assign(document.createElement('canvas'), { width: image.width, height: image.height });
  const context = canvas.getContext('2d');
  context.drawImage(image, 0, 0);
  return context.getImageData(0, 0, image.width, image.height);
}

$(function() {
  $('#upload').change(async function() {
    const amountInput = document.getElementById('amount');
    const amount = parseFloat(amountInput.value);

    // ✅ ต้องกรอกจำนวนเงินก่อน
    if (!amount || amount <= 0) {
      Swal.fire({
        icon: 'warning',
        title: 'กรุณากรอกจำนวนเงิน',
        text: 'ระบุจำนวนเงินที่โอนให้ตรงกับสลิปก่อนแนบรูป',
      });
      // reset file input
      $(this).val('');
      return;
    }

    Swal.fire({
      icon: 'warning',
      title: 'โปรดรอสักครู่',
      text: "ระบบกำลังอ่านสลิป โปรดอย่าปิดหน้านี้",
      showConfirmButton: false,
      allowOutsideClick: false,
    });

    const input = this;
    const ext = input.value.split('.').pop().toLowerCase();
    if (input.files && input.files[0] && ['png', 'jpeg', 'jpg'].includes(ext)) {
      try {
        const URLBase64 = await File2Base64(input.files[0]);
        const ImageData = await imageDataFromSource(URLBase64);
        const code = jsQR(ImageData.data, ImageData.width, ImageData.height);

        if (code && code.data) {
          // 🔹 code.data = QR/RefNbr ที่อ่านได้จากสลิป
          const payload = JSON.stringify({ qrcode_data: code.data });

     $.ajax({
    type: 'POST',
    url: `services/slip.php`,
    data: JSON.stringify({
        qrcode_data: code.data,
        amount: amount
    }),
    contentType: 'application/json',
    processData: false,
    success: function(res) {
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            text: res.message
        }).then(() => {
            window.location.reload();
        });
    },
    error: function(xhr) {
        const res = xhr.responseJSON || { message: "ไม่สามารถตรวจสอบสลิปได้" };
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: res.message
        }).then(() => {
            window.location.reload();
        });
    }
});


        } else {
          Swal.fire({ icon: 'error', title: 'สลิปไม่มี QR Code', text: 'กรุณาอัปโหลดใหม่' });
        }

      } catch (err) {
        Swal.fire({ icon: 'error', title: 'Error', text: err.message || 'เกิดข้อผิดพลาดในการอ่านภาพ' });
      }

    } else {
      Swal.fire({ icon: 'error', title: 'เกิดข้อผิดพลาด', text: 'อนุญาตเฉพาะไฟล์ PNG, JPEG, JPG เท่านั้น' });
    }
  });
});
</script>
