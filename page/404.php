<?php
// --- กำหนด path หรือ URL ของภาพที่ต้องการสุ่ม ---
$images = [
    "https://pa1.aminoapps.com/6353/31bd43fc3a0539d8b4e90ca6ff405b45ce48de5c_hq.gif",
    "https://media.tenor.com/2QgTA5XJoyUAAAAM/yuru-yuri-anime.gif",
    "https://64.media.tumblr.com/215f234f360db32b14183c355230afb5/1147edaf807d4746-eb/s500x750/bfe1196327e0e2419a8453f243f91fcad2cb2a00.gif",
    "https://64.media.tumblr.com/215f234f360db32b14183c355230afb5/1147edaf807d4746-eb/s500x750/bfe1196327e0e2419a8453f243f91fcad2cb2a00.gif",
    "https://gifdb.com/images/high/scared-anime-girl-4tueaajp4p3d0lva.gif"
];

// --- สุ่มภาพ ---
$randomImage = $images[array_rand($images)];
?>
  <div class="container-fluid p-4 mt-2 px-4">
  <div class="row justify-content-center"> <!-- ✅ ทำให้ col อยู่กลาง -->
    <div class="col-12 col-lg-6">
      <div class="d-flex justify-content-center">
        <div class="container-sm text-center <?= $bg ?> p-3" style="border-radius: 1rem;">

          <div class="mx-auto mt-3" 
               style="width:100%; max-width:350px; max-height:250px; border-radius:.5rem; overflow:hidden;">
            <img 
              src="<?= $randomImage ?>" 
              alt="Error Image"
              class="img-fluid w-100"
              style="object-fit:contain; object-position:center; width:100%; height:100%;">
          </div>
<div>
          <h2 class="mt-3 glitch-pro" data-text="Error 404">Error 404</h2>
          <p class="text-muted mb-0">ไม่พบหน้าที่คุณกำลังค้นหา</p></div>

         <div class="mt-3"> <a href="/home" class="btn-main p-2 mt-5"><i class="fa-duotone fa-home"></i> กลับหน้าหลัก</a></div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  @media only screen and (min-width:768px) {
      .w-lg-50 {
        width: 50% !important;
    }
  }
  .btn-main {
    text-decoration: none;
    transition: all .6s ease;
  }
  .btn-main:hover {
    border: none;
    background: var(--main-opa-50)
  }
  /* ==== GLITCH-PRO CYBER STYLE ==== */
.glitch-pro {
  position: relative;
  display: inline-block;
  font-family: "Fira Code", monospace;
  font-weight: 800;
  font-size: 2.2rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: var(--main);
  animation: glowPulse 2s ease-in-out infinite;
  overflow: hidden;
}

.glitch-pro::before,
.glitch-pro::after {
  content: attr(data-text);
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  mix-blend-mode: lighten;
  color: var(--main);
  clip-path: inset(0 0 0 0);
}

.glitch-pro::before {
  color: #03a5a0ff;          /* ฟ้า */
  transform: translate(-2px, 1px);
  animation: glitchShift1 1.5s infinite;
}

.glitch-pro::after {
  color: #a855f7;          /* ม่วง */
  transform: translate(2px, -1px);
  animation: glitchShift2 1.5s infinite;
}

/* เอฟเฟกต์เส้นแตกกระพริบ */
@keyframes glitchShift1 {
  0% { clip-path: inset(80% 0 0 0); }
  10% { clip-path: inset(10% 0 85% 0); transform: translate(-2px, 2px); }
  20% { clip-path: inset(40% 0 43% 0); transform: translate(2px, -1px); }
  30% { clip-path: inset(20% 0 65% 0); transform: translate(-3px, 1px); }
  100% { clip-path: inset(0 0 0 0); transform: translate(0,0); }
}

@keyframes glitchShift2 {
  0% { clip-path: inset(10% 0 85% 0); }
  15% { clip-path: inset(50% 0 30% 0); transform: translate(2px, -2px); }
  30% { clip-path: inset(80% 0 5% 0); transform: translate(-1px, 2px); }
  100% { clip-path: inset(0 0 0 0); transform: translate(0,0); }
}

/* เอฟเฟกต์ไฟนีออนกระพริบเบา ๆ */
@keyframes glowPulse {
  0%,100% { }
  50% { }
}

</style>