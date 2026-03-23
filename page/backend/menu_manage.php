<style>
  .nav-link, li, .bg-light {
    box-shadow: none;
  }
  
  .nav-link , .nav-link i {
    transition: .3s ease-in-out;
  }
  .nav-link:hover , .nav-link:hover i {
color: var(--main)
  }
</style>
<nav class="navbar navbar-expand-lg mt-0 shadow-sm mb-0 w-100 <?php echo $bg;?> <?php echo $navbar;?> " style="z-index: 55; padding: 10px; 10px;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon <?php echo $navbar;?> <?php echo $bg;?>"><i class="fa-regular fa-bars fa-fade"></i></span>
    </button>
    <div class="collapse navbar-collapse <?php echo $bg;?> <?php echo $navbar;?>" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto <?php echo $bg;?> <?php echo $navbar;?>">
<li class="nav-item active">
    <a class="nav-link" href="/backend">
        <i class="fa-duotone fa-gauge-max"></i> แดชบอร์ด
    </a>
</li>

<li class="nav-item dropdown <?php echo $bg;?> <?php echo $navbar;?>">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-duotone fa-cogs"></i> ตั้งค่าระบบ
  </a>
  <ul class="dropdown-menu <?php echo $dropdown;?>">
    <li><a class="dropdown-item" href="/website"><i class="fa-duotone fa-browser"></i> จัดการเว็บไซต์</a></li>
    <li><a class="dropdown-item" href="/contact_manage"><i class="fa-duotone fa-headset"></i> จัดการการติดต่อ</a></li>
    <li><a class="dropdown-item" href="/manage_howto"><i class="fa-duotone fa-book-open-reader"></i> จัดการวิธีใช้</a></li>
    <li><a class="dropdown-item" href="/manage_theme"><i class="fa-duotone fa-palette"></i> จัดการ Theme</a></li>
    <li><a class="dropdown-item" href="/ads_manage"><i class="fa-duotone fa-bullhorn"></i> จัดการโฆษณา</a></li>
    <li><a class="dropdown-item" href="/captcha_manage"><i class="fa-duotone fa-solid fa-robot"></i> จัดการ Captcha</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="/particle_manage"><i class="fa-duotone fa-sparkle"></i> จัดการ Particle</a></li>
    <li><a class="dropdown-item" href="/loading_manage"><i class="fa-duotone fa-solid fa-loader fa-spin"></i> จัดการ หน้าโหลด</a></li>
    
    <li><hr class="dropdown-divider"></li>
    <li><h6 class="dropdown-header text-muted"><i class="fa-duotone fa-coins"></i> จัดการเติมเงิน</h6></li>
    <li><a class="dropdown-item" href="/topup_manage"><i class="fa-duotone fa-money-bill"></i> วอลเลต</a></li>
    <li><a class="dropdown-item" href="/slip_manage"><i class="fa-duotone fa-file-invoice"></i> ธนาคาร</a></li>
    <li><a class="dropdown-item" href="/code_manage"><i class="fa-duotone fa-gift-card"></i> โค้ดเติมเงิน</a></li>
    <li><a class="dropdown-item" href="/discount_manage"><i class="fa-duotone fa-gift-card"></i> โค้ดส่วนลด สินค้า</a></li>
    

    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="/helpbutton"><i class="fa-duotone fa-circle-info"></i> ปุ่มช่วยเหลือ</a></li>
  </ul>
</li>


<li class="nav-item">
    <a class="nav-link" href="/carousel_manage">
        <i class="fa-duotone fa-images"></i> จัดการรูปภาพสไลด์
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/user_edit">
        <i class="fa-duotone fa-users-gear"></i> จัดการผู้ใช้
    </a>
</li>
<li class="nav-item dropdown <?php echo $bg;?> <?php echo $navbar;?>">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-duotone fa-store"></i> จัดการสินค้า
  </a>
  <ul class="dropdown-menu <?php echo $dropdown;?>">
        <li><a class="dropdown-item" href="/category_manage"><i class="fa-duotone fa-layer-group "></i> จัดการหมวดหมู่</a></li>
        <li><a class="dropdown-item" href="/product_manage"><i class="fa-duotone fa-cart-shopping"></i> จัดการสินค้าปกติ</a></li>
        <li><a class="dropdown-item" href="/wheel_cate"><i class="fa-duotone fa-circle-notch"></i> จัดการวงล้อ</a></li>
        <li><a class="dropdown-item" href="/wheel_category_manage"><i class="fa-duotone fa-circle-notch"></i> จัดการหมวดหมู่วงล้อ</a></li>
         </ul>
</li>

<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-duotone fa-thumbs-up"></i> จัดการแนะนำ
  </a>
  <ul class="dropdown-menu <?php echo $dropdown;?>">
        <li><a class="dropdown-item" href="/crecom_manage"><i class="fa-duotone fa-layer-group "></i> หมวดหมู่แนะนำ</a></li>
        <li><a class="dropdown-item" href="/recom_manage"><i class="fa-duotone fa-cart-shopping"></i> สินค้าแนะนำ</a></li>
           </ul>
  
</li>


<li class="nav-item">
    <a class="nav-link" href="/history_log">
        <i class="fa-duotone fa-clock-rotate-left"></i> ประวัติทั้งหมด
    </a>
</li>



<li class="nav-item">
    <a class="nav-link" href="/order">
        <i class="fa-duotone fa-receipt"></i> Order
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="/apibyshop">
        <i class="fa-duotone fa-code-branch"></i> Api Byshop
    </a>
</li>
        
        </ul>
    </div>
    </div>
</nav>
</div>
<div class="col-lg-12">
    <?php
    if (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend") {
        require_once('page/backend/dashboard.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "user_edit") {
        require_once('page/backend/user_edit.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "discount_manage") {
        require_once('page/backend/manage_discount.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "topup_manage") {
        require_once('page/backend/topup_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "category_manage") {
        require_once('page/backend/category.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel_category_manage") {
        require_once('page/backend/wheel_category.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "slip_manage") {
        require_once('page/backend/slip_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel_cate") {
        require_once('page/backend/wheel_cate.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel") {
        require_once('page/backend/wheel.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "product_manage") {
        require_once('page/backend/product.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "stock_manage" && $_GET['id'] != "") {
        require_once('page/backend/stock.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel_manage") {
        require_once('page/backend/wheel.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "stock_wheel" && $_GET['id'] != "") {
        require_once('page/backend/stock_wheel.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "code_manage") {
        require_once('page/backend/code_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_buy_history") {
        require_once('page/backend/buy_history.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_topup_history") {
        require_once('page/backend/topup_history.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_app_history") {
        require_once('page/backend/byshop_his.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "website") {
        require_once('page/backend/website.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "manage_howto") {
        require_once('page/backend/howto.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "manage_theme") {
        require_once('page/backend/theme.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "carousel_manage") {
        require_once('page/backend/carousel_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "recom_manage") {
        require_once('page/backend/recom_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "crecom_manage") {
        require_once('page/backend/crecom_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order") {
        require_once('page/backend/order.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_success") {
        require_once('page/backend/order_success.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_unsuccess") {
        require_once('page/backend/order_unsuccess.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_temp") {
        require_once('page/backend/order_temp.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "apibyshop") {
        require_once('page/backend/apibyshop.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "poster_manage") {
        require_once('page/backend/poster.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "ads_manage") {
        require_once('page/backend/ads_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "discount_manage") {
        require_once('page/backend/manage_discount.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "captcha_manage") {
        require_once('page/backend/captcha_manage.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_product") {
        require_once('page/backend/order_product.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "helpbutton") {
        require_once('page/backend/helpbtn.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "contact_manage") {
        require_once('page/backend/contact.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "particle_manage") {
        require_once('page/backend/particle.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "loading_manage") {
        require_once('page/backend/loading.php');
    } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "discord_manage") {
        require_once('page/backend/discord.php');
    }
    
    
    ?>
</div>
</div>
</div>
</div>