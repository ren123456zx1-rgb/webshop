<div class="container-sm p-4 py-3 mt-4" data-aos="<?php echo $anim; ?>" style="border-radius:1rem">
  <center>
    <div class="col-12 col-lg-6 <?php echo $bg ?> p-3 mb-2" style="border-radius: 1rem;">
      <div class="text-center">
        <h3 class="text-main m-0">
          <i class="fa-duotone fa-headset text-main"></i>&nbsp; ช่องทางการติดต่อ
        </h3>
      </div>

</div>
      <?php
      $get_contact = dd_q("SELECT * FROM contact ORDER BY id DESC");
      if ($get_contact->rowCount() > 0) {
        while ($row = $get_contact->fetch(PDO::FETCH_ASSOC)) {
      ?>
       <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" 
             >
        <div class="col-12 col-lg-10 contact-item d-flex align-items-center justify-content-start py-3 px-3 mt-3 shadow-sm" 
             style="border-radius:1rem; background: <?php echo ($bg=='bg-light') ? '#fff' : '#1a1a1a'; ?>;">
          <div class="contact-img me-3 p-1" style="border-radius:1rem; box-shadow: 0 0 2px 2px #aaaaaa60">
            <img src="<?= htmlspecialchars($row['img']) ?>" 
                 alt="<?= htmlspecialchars($row['name']) ?>" 
                 class="rounded" 
                 style="width:70px; height:70px; object-fit:cover;">
          </div>
          <div class="contact-info text-start flex-fill center ">
            <h5 class="fw-bold m-0 mt-3 text-main"><?= htmlspecialchars($row['name']) ?></h5>
            <?php if (!empty($row['des'])): ?>
              <p class="m-0 text-secondary small"><?= nl2br(htmlspecialchars($row['des'])) ?></p>
            <?php endif; ?>
            <?php if (!empty($row['link'])): ?>
                
               <p class=" link"><i class="fa-solid fa-link"></i>&nbsp;<?= $row['link'] ?></p>
              
            <?php endif; ?>
          </div>
        </div>
        </a>
        <style>
            a {
                text-decoration: none;
            }
            .contact-item {
                overflow: hidden;
            }
        </style>
      <?php
        }
      } else {
        echo '<p class="text-muted text-center">ยังไม่มีข้อมูลช่องทางการติดต่อในขณะนี้</p>';
      }
      ?>
    </div>
  </center>

<style>
footer {
  margin-top: 10rem;
}
@media only screen and (min-width: 1200px) {
  footer { margin-top: 20rem; }
}
.contact-item {
  transition: all 0.25s ease;
}
.contact-item:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}
.contact-info h5 {
  font-size: 1.05rem;
}
</style>
