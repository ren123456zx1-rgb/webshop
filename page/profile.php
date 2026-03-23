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
  color: #fff !important;
  border-radius: 50px;
  padding: 0.6rem 1.2rem;
  font-weight: 600;
  transition: all 0.3s ease;
}
.btn-main i {
    color: #fff !important;
  transition: all 0.3s ease;
}
.btn-main:hover , .btn-main:hover i {
  opacity: 0.85;
  transform: translateY(-2px);
  color: var(--main)!important;
}
    .active {
     background: var(--main)
    }
    .btn-select {
        border: 1px solid var(--main);
        padding: .3rem .5rem;
        border-radius: 1rem;
        text-decoration: none;
        color: var(--main);
        transition: .3s ease;
    }
    .btn-select:hover ,.btn-select.active{
            color: <?php if($bg == 'bg-light'){ echo '#fff';}else{ echo 'var(--font)'; } ?>;
   
     background: var(--main)
    }
    @media only screen and ( max-width: 768px) {
      .w-sm-100 {
        width: 100% !important;
      }
    }
    span {
      color: var(--main)
    }
</style>
<div class="container-fluid p-4">
  <div class="container-lg w-50 w-sm-100">
    <div class="col-12 aos-init aos-animate" data-aos="<?php echo $anim; ?>">
    
        <div class="bg-card <?php echo $bg ?>">
          <center>
          </center>
     <div class="profile-preview ">
              <img id="profilePreview" src="<?= htmlspecialchars($user['profile']); ?>" alt="Profile Image">
            </div>
            <h1 class="font-bold text-center" ><?= $user['username'] ?></h1>
            <h5 class="text-center">ยอดเงินคงเหลือ : <span> <?= $user['point'] ?> </span> บาท</h5>
         <?php if($user['email'] == '') { ?>
  <p class="text-center mt-2">คุณยังไม่เชื่อม Email</p>
<?php } else { ?>
 <div class="d-flex justify-content-center align-items-center gap-2 mt-2">
  <h5 class="m-0">
    Email : <span><?= htmlspecialchars($user['email']); ?></span>
  </h5>
  <button id="btnDeleteEmail" class="btn btn-danger btn-sm ms-2">
    <i class="fa-solid fa-trash"></i>
  </button>
</div>

<?php } ?>

            <div class="d-flex justify-content-between mt-4">
        <a class="btn-select <?php if($_GET['page'] == "profile"){ echo 'active';} ?>" href="profile">ตั้งค่าโปรไฟล์</a>
    <a class="btn-select <?php if($_GET['page'] == "history"){ echo 'active';} ?>" href="history">ประวิติ</a>

            </div>
</div>
</div>
</div>
</div>

<script>
$("#btnDeleteEmail").click(function() {
  Swal.fire({
    title: 'ลบอีเมล?',
    text: "คุณแน่ใจหรือไม่ว่าต้องการลบอีเมลออกจากบัญชีนี้? คุณจะไม่สามารถกู้คืนบัญชีได้ถ้าไม่เชื่อมอีเมล",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'ลบออกเลย',
    cancelButtonText: 'ยกเลิก',
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "services/delete_email.php",
        dataType: "json",
        success: function(res) {
          if(res.status === 'success'){
            Swal.fire('สำเร็จ', res.message, 'success')
              .then(() => location.reload());
          }else{
            Swal.fire('ผิดพลาด', res.message, 'error');
          }
        },
        error: function(xhr){
          Swal.fire('ข้อผิดพลาด', 'ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้', 'error');
        }
      });
    }
  });
});
</script>

    <?php
    if (isset($_GET['page']) && $_GET['page'] == "profile") {
            if (isset($_SESSION['id'])) {
                require_once('page/change.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "history") {
            if (isset($_SESSION['id'])) {
                require_once('page/history.php');
            } else {
                require_once('page/login.php');
            }
        }
    ?>