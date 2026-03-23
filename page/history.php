
<style>
.history-card {
  border-radius: 1rem;
  padding: 1.2rem 1.5rem;
  background: <?php echo ($bg == 'bg-light') ? '#ffffff' : '#1a1a1a'; ?>;
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  transition: all 0.25s ease;
  display: flex;
  align-items: center;
  gap: 1rem;
  cursor: pointer;
  text-decoration: none;
}
.history-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.25);
}
.history-icon i{
  font-size: 2.2rem;
  color: var(--main);
  min-width: 55px;
  text-align: center;
}
.history-text {
  color: var(--font);
  text-align: left;
}
.history-text h5 {
  margin: 0;
  font-weight: 600;
  color: var(--font);
}
.history-text p {
  margin: 0;
  color: #aaa;
  font-size: 0.95rem;
}
</style>

<div class="container-sm p-4 py-3 mt-4" data-aos="<?php echo $anim; ?>" style="border-radius:1rem;">
  <center>
    <div class="col-12 col-lg-10 <?php echo $bg ?> p-3 mb-4" style="border-radius: 1rem;">
      <h3 class="text-main m-0"><i class="fa-regular fa-clock-rotate-left"></i>&nbsp; ประวัติการสั่งซื้อ</h3>
    </div>
  </center>

  <div class="container">
    <div class="row justify-content-center g-4">

      <!-- ✅ สินค้าทั่วไป -->
      <div class="col-12 col-md-8 col-lg-6">
        <a href="/history_product" class="history-card">
          <div class="history-icon">
            <i class="fa-solid fa-box"></i>
          </div>
          <div class="history-text">
            <h5>สินค้าทั่วไป</h5>
            <p>ดูประวัติการสั่งซื้อสินค้าปกติทั้งหมดของคุณ</p>
          </div>
        </a>
      </div>

      <!-- ✅ โปรแกรม -->
      <div class="col-12 col-md-8 col-lg-6">
        <a href="/history_program" class="history-card">
          <div class="history-icon">
            <i class="fa-solid fa-link"></i>
          </div>
          <div class="history-text">
            <h5>โปรแกรม</h5>
            <p>ตรวจสอบโปรแกรมและลิงก์ดาวน์โหลดที่คุณเคยซื้อไว้</p>
          </div>
        </a>
      </div>

       <div class="col-12 col-md-8 col-lg-6">
        <a href="/history_minigame" class="history-card">
          <div class="history-icon">
            <i class="fa-solid fa-dice"></i>
          </div>
          <div class="history-text">
            <h5>มินิเกม</h5>
            <p>ดูประวัติการเล่นมินิเกมทั้งหมดของคุณ</p>
          </div>
        </a>
      </div>

    </div>
  </div>
</div>

<style>
  footer {
    margin-top: 10rem;
  }
  @media (min-width: 1200px) {
    footer {
      margin-top: 15rem;
    }
  }
</style>
