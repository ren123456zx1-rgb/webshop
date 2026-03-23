<?php
session_start();
// debug error
error_reporting(0);
require_once("services/a_func.php");
if (isset($_SESSION['id'])) {
    $q1 = dd_q("SELECT * FROM users WHERE id = ? LIMIT 1", [$_SESSION['id']]);
    if ($q1->rowCount() == 1) {
        $user = $q1->fetch(PDO::FETCH_ASSOC);
    } else {
        session_destroy();
        $_GET['page'] = "login";
    }
}

$config = dd_q("SELECT * FROM setting")->fetch(PDO::FETCH_ASSOC);
$howtolink = dd_q("SELECT * FROM howto")->fetch(PDO::FETCH_ASSOC);
$get_static = dd_q("SELECT * FROM static");
$static = $get_static->fetch(PDO::FETCH_ASSOC);


$cap = dd_q("SELECT * FROM captcha_setting LIMIT 1");
$captcha = $cap->fetch(PDO::FETCH_ASSOC);

$get_particle = dd_q("SELECT * FROM particle LIMIT 1");
$particle = $get_particle->fetch(PDO::FETCH_ASSOC);

$get_loading = dd_q("SELECT * FROM loading LIMIT 1");
$loading = $get_loading->fetch(PDO::FETCH_ASSOC);


$ic_home = "none";
$ic_shop = "none";
$ic_topup = "none";
$ic_user = "none";
$ic_adduser = "none";

$ic_cat = "";
$ic_inst = "";
$ic_soldout = "";
$ic_tele = "";

$ic_cart = "";
$ic_wheel = "";

$ic_backend = "";
$ic_coin = "";
$ic_edit = "";
$ic_his = "";
$ic_logout = "";
$ic_howto = "";

$ic_service = "";
$ic_contact = "";

$tst = dd_q("SELECT * FROM theme_setting")->fetch(PDO::FETCH_ASSOC);
if ($tst["icon"] == "classic") {
    $ic_home = "assets/icon/house.png";
    $ic_shop = "assets/icon/store.png";
    $ic_topup = "assets/icon/credit.png";
    $ic_user = "assets/icon/profile.png";
    $ic_adduser = "assets/icon/add-user.png";

    $ic_cat = "assets/icon/application.png";
    $ic_inst = "assets/icon/in-stock.png";
    $ic_soldout = "assets/icon/out-of-stock.png";
    $ic_tele = "https://cdn-icons-png.flaticon.com/512/8306/8306906.png";

    $ic_cart = "assets/icon/shopping-cart.png";
    $ic_wheel = "assets/icon/wheel.png";

    $ic_backend = "assets/icon/manager.png";
    $ic_coin = "assets/icon/assets/icon/dollar.png";
    $ic_edit = "assets/icon/user-ed.png";
    $ic_his = "assets/icon/history.png";
    $ic_logout = "assets/icon/enter.png";
    $ic_howto = "https://cdn.discordapp.com/attachments/1172513665367425214/1172866969070993418/icons8-question-100_2.png?ex=6561e07c&is=654f6b7c&hm=a1a05f1f67cfed74c71e56b7d3cf2d1c87059882e186bf6c485bf2a7b0ad39ce&";
    $ic_service = "assets/icon/call-center.png";
    $ic_contact = "https://cdn.discordapp.com/attachments/1172513665367425214/1174515761121853440/icons8-phone-100.png?ex=6567e00a&is=65556b0a&hm=de93f33e46e5c9fe5deff0074df4f83005dc4c5cf5a8d0229f3625e1294f6b13&";
}
if ($tst["icon"] == "normal") {
    $ic_home = "https://cdn.discordapp.com/attachments/1172513665367425214/1172517648018452530/icons8-home-48_2.png?ex=65609b27&is=654e2627&hm=2bc260265a8fad58060b6620c0b11722a0d4156057df15c7b939fbd006f794d8&";
    $ic_shop = "https://cdn.discordapp.com/attachments/1172513665367425214/1172528161775423558/icons8-shopping-bag-48_1.png?ex=6560a4f2&is=654e2ff2&hm=44ae31a4b75f9dcda6d5401dcdf9aaaed22325ae311bfb0db1a044194515e578&";
    $ic_topup = "https://cdn.discordapp.com/attachments/1172513665367425214/1172527125912358932/icons8-wallet-48_2.png?ex=6560a3fb&is=654e2efb&hm=f26dda9ccad4b336d34e4d2d1f06bce3ec1f1c03a8c0ccb12a7c9e72d625b2c3&";
    $ic_user = "https://cdn.discordapp.com/attachments/1172513665367425214/1172530612159139910/icons8-user-48_2.png?ex=6560a73a&is=654e323a&hm=cbb8b806ff38501f17933d7dc7852e45f28844921dcc422424bea1ed3c262b83&";
    $ic_adduser = "https://cdn.discordapp.com/attachments/1172513665367425214/1172533185263968276/icons8-add-user-48_2.png?ex=6560a99f&is=654e349f&hm=06d22d3ec00199678c6f9e3e8e0c4b658034e4735a4c23cd8e894d529133ccdb&";
    
    $ic_cat = "https://cdn.discordapp.com/attachments/1172513665367425214/1172535857190817873/icons8-android-app-drawer-48.png?ex=6560ac1d&is=654e371d&hm=b9b1180c68da6aabf6b488a38f40bfe1bb56033995a8a407f01d171e0c9198e3&";
    $ic_inst = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537299762946188/icons8-box-48_2.png?ex=6560ad74&is=654e3874&hm=1b46cfef40351f122e1bdcc78fe890ed107cba543919263e2dcbbb3cde97ea50&";
    $ic_soldout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537269664612392/icons8-out-of-stock-48_2.png?ex=6560ad6d&is=654e386d&hm=748e03c2eefb124824e654a69b9cbb682378f63008d3af030511a14afa657773&";
    $ic_tele = "https://cdn.discordapp.com/attachments/1172513665367425214/1172538841387761734/icons8-megaphone-48_2.png?ex=6560aee4&is=654e39e4&hm=dbdff622ac599e271005d4145ddbf501d401109ce82f0a5c10c37dc31693eef8&";

    $ic_cart = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745892139368528/icons8-shop-100_2.png?ex=65616fb9&is=654efab9&hm=b701e91125e96264012477ae8b79fc478d270c48515e677d0c4b3e234df49024&";
    $ic_wheel = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745378257448981/icons8-lucky-wheel-100_2.png?ex=65616f3e&is=654efa3e&hm=8a2b6941a0536ecb9e7e3710949ab818a96f42a400d401cc02878a12fc8cab8c&";

    $ic_backend = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752890805370920/icons8-store-setting-100_2.png?ex=6561763d&is=654f013d&hm=b0e4059ad58e0aab5f6f5e203391b5e265aad5afd341761e62ab55683f33792d&";
    $ic_coin = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752329297113098/icons8-coin-100.png?ex=656175b7&is=654f00b7&hm=62867fa19dc3b6d14487eed67730687fbcd9978cb9cac6bdea1bd783c25ddafd&";
    $ic_edit = "https://cdn.discordapp.com/attachments/1172513665367425214/1172750738758324284/icons8-edit-100.png?ex=6561743c&is=654eff3c&hm=bd28e14fb75c5a2b56f5e06e8f456da2bb9e95adfa8b43930b7e37d3af8fcd0b&";
    $ic_his = "https://cdn.discordapp.com/attachments/1172513665367425214/1172751681201655828/icons8-history-100_3.png?ex=6561751d&is=654f001d&hm=ac087898e2d849661180c239f413567fea8fc0d4c3e2cde586278658d03f2ad0&";
    $ic_logout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172753283081830450/icons8-logout-100.png?ex=6561769b&is=654f019b&hm=393e992c448dcebe372585a5c699d4ae3eaae22febd4df83ccd13e33ea4f7aea&";
    $ic_howto = "https://cdn.discordapp.com/attachments/1172513665367425214/1172866969070993418/icons8-question-100_2.png?ex=6561e07c&is=654f6b7c&hm=a1a05f1f67cfed74c71e56b7d3cf2d1c87059882e186bf6c485bf2a7b0ad39ce&";
    $ic_service = "https://cdn.discordapp.com/attachments/1172513665367425214/1173755251904479232/icons8-service-100_2.png?ex=65651bc3&is=6552a6c3&hm=bc7c95e60d84e8629d6aa7efb50d855092869d094401bb34e3736ed422513463&";
    $ic_contact = "https://cdn.discordapp.com/attachments/1172513665367425214/1174515761121853440/icons8-phone-100.png?ex=6567e00a&is=65556b0a&hm=de93f33e46e5c9fe5deff0074df4f83005dc4c5cf5a8d0229f3625e1294f6b13&";
}
if ($tst["icon"] == "light") {
    $ic_home = "https://cdn.discordapp.com/attachments/1172513665367425214/1172513715619373056/icons8-home-48.png?ex=6560977e&is=654e227e&hm=f46ea50ac5abf7e78c6316699337c4121000876a9339d9ddafe8c098efd52821&";
    $ic_shop = "https://cdn.discordapp.com/attachments/1172513665367425214/1172528162035482815/icons8-shopping-bag-48.png?ex=6560a4f2&is=654e2ff2&hm=70380698837e820d8b28677bdc6d295c7691705d10adb0aa0ce6780ffe157827&";
    $ic_topup = "https://cdn.discordapp.com/attachments/1172513665367425214/1172527126231142440/icons8-wallet-48_1.png?ex=6560a3fb&is=654e2efb&hm=f530a4433630b2f62ff8ce0f36697963b84feb7b0383cf49d0553286e9ca4fa9&";
    $ic_user = "https://cdn.discordapp.com/attachments/1172513665367425214/1172530612595327057/icons8-user-48_1.png?ex=6560a73a&is=654e323a&hm=4660d531676f8ab752be9a62952324376f77430c0e4e94a3176ff80f5a90736e&";
    $ic_adduser = "https://cdn.discordapp.com/attachments/1172513665367425214/1172533185771487302/icons8-add-user-48_1.png?ex=6560a9a0&is=654e34a0&hm=6c39c096284a670b486b7b58d064dc0427210250e39d6c092a71a89611073cd4&";
    
    $ic_cat = "https://cdn.discordapp.com/attachments/1172513665367425214/1172535857761230848/icons8-application-48_1.png?ex=6560ac1d&is=654e371d&hm=00581e833cf370b77114daeb43fe72b5fc4f53829c8a76e1c19dd9498d5962ea&";
    $ic_inst = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537300002013195/icons8-box-48_1.png?ex=6560ad75&is=654e3875&hm=3e226c26308eb2c53db65fdd6c7f150f082fc89abac8ef593ae50dc89445818c&";
    $ic_soldout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537269920469012/icons8-out-of-stock-48_1.png?ex=6560ad6d&is=654e386d&hm=fe829ffa9fa1255f2dbc93c843ff52570704562900e05642c9e4260a656bfc2f&";
    $ic_tele = "https://cdn.discordapp.com/attachments/1172513665367425214/1172538841639436318/icons8-megaphone-48_1.png?ex=6560aee4&is=654e39e4&hm=3839f945dbf4045c2eb5d7849daf303ca4373d7b514be4544e69e55997c03c92&";

    $ic_cart = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745892537839697/icons8-shop-100_1.png?ex=65616fb9&is=654efab9&hm=60f993d517dde60255adeac54dbe3117a0860acc3e19a3c69a00bfb5d37c183f&";
    $ic_wheel = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745378928525362/icons8-lucky-wheel-100.png?ex=65616f3e&is=654efa3e&hm=3048fe4e4763a016ba0bfa91505da6b6a6e8f55cf127461e4412e060e3fded8b&";

    $ic_backend = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752891027665026/icons8-store-setting-100_1.png?ex=6561763d&is=654f013d&hm=444564cd254b8111225623367c51ea5fde5f9b2dd17e6dc4abfeb121105ce3e4&";
    $ic_coin = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752328688939018/icons8-coin-100_2.png?ex=656175b7&is=654f00b7&hm=2902b09af77af78d6733c731c7a1edec17cc3b90beb3ec42cc8f45d8bfedbb6a&";
    $ic_edit = "https://cdn.discordapp.com/attachments/1172513665367425214/1172750738145955850/icons8-edit-100_2.png?ex=6561743c&is=654eff3c&hm=c868c4c4a6d03ac2990ea96bc40850c5738243d7b8df1dfc66d7e4db73912e59&";
    $ic_his = "https://cdn.discordapp.com/attachments/1172513665367425214/1172751477501087774/icons8-history-100_2.png?ex=656174ec&is=654effec&hm=7d2b21445c3e5826ee7889d7b318f9f0a73763b9c107758541bcf54ba3b9771c&";
    $ic_logout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172753282599485480/icons8-logout-100_2.png?ex=6561769b&is=654f019b&hm=fb6df88f72d3f8a5a446c3c2b9ae32e884827fb0093693f27d229c346e3a2d1f&";
    $ic_howto = "https://cdn.discordapp.com/attachments/1172513665367425214/1172866969297506344/icons8-question-100_1.png?ex=6561e07c&is=654f6b7c&hm=dd78f86ecc4e91d62a715d0426063f699e0ad641b7085d02253692adb6274aa5&";
    $ic_service = "https://cdn.discordapp.com/attachments/1172513665367425214/1173755252122603620/icons8-service-100_1.png?ex=65651bc3&is=6552a6c3&hm=2a417b4244e4a74f70b69983ca94aff54ffb4aee6e9d1a02b0d80bb83c65f84f&";
    $ic_contact = "https://cdn.discordapp.com/attachments/1172513665367425214/1174515760605962410/icons8-phone-100_2.png?ex=6567e00a&is=65556b0a&hm=3658b2b52c91bd9cf6edc1f31d1c89fdbbaf28aa51f2cd8ce6cee622d9a954d4&";
}
if ($tst["icon"] == "dark") {
    $ic_home = "https://cdn.discordapp.com/attachments/1172513665367425214/1172514005420613712/icons8-home-48_1.png?ex=656097c3&is=654e22c3&hm=d1b99ac9c2ce64976f1614ee1d62ad57f6e211c9a3c2c77b893287ad2cda84b0&";
    $ic_shop = "https://cdn.discordapp.com/attachments/1172513665367425214/1172528161360199781/icons8-shopping-bag-48_2.png?ex=6560a4f2&is=654e2ff2&hm=14e2ea7a25af8e79560205fd1facbffc6068842bf682ffe73796b938237ad5e1&";
    $ic_topup = "https://cdn.discordapp.com/attachments/1172513665367425214/1172527126675730432/icons8-wallet-48.png?ex=6560a3fb&is=654e2efb&hm=6c89f3309a9a93e30d2fdb83452ead3a2e81978b23970affb6941fd53ffa6261&";
    $ic_user = "https://cdn.discordapp.com/attachments/1172513665367425214/1172530613039931462/icons8-user-48.png?ex=6560a73a&is=654e323a&hm=95d1b3885bbdedebccc2e0d8a4879f2354e081d584b1c43dfa1d8240996103fc&";
    $ic_adduser = "https://cdn.discordapp.com/attachments/1172513665367425214/1172533186123800597/icons8-add-user-48.png?ex=6560a9a0&is=654e34a0&hm=e742cc07b9958b91a60a69fcbeb4200d1d320278c8899ab58da024e9ffb086df&";
    
    $ic_cat = "https://cdn.discordapp.com/attachments/1172513665367425214/1172535858218418228/icons8-application-48.png?ex=6560ac1d&is=654e371d&hm=7ae6a81f491638eb8bb232adcf0f668a3e3dfcfe4b0c17566352a8fd7b148912&";
    $ic_inst = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537300295635004/icons8-box-48.png?ex=6560ad75&is=654e3875&hm=40e79706d59636d0c2b78eaf79f68df9454e2a26421c37b6fbc605f50927f128&";
    $ic_soldout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172537270138585148/icons8-out-of-stock-48.png?ex=6560ad6d&is=654e386d&hm=17faf4f5f49c2e442706427c8b987a8d64be2ef8bfb89a9e3aa903219e6ad505&";
    $ic_tele = "https://cdn.discordapp.com/attachments/1172513665367425214/1172538841987551232/icons8-megaphone-48.png?ex=6560aee4&is=654e39e4&hm=3b252e09e81ec1bed50a81ef2ff7c1d0647d6e31666a0f59081cc75184d9da1b&";

    $ic_cart = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745892965662811/icons8-shop-100.png?ex=65616fb9&is=654efab9&hm=b41e6b319d22a9b768c1ca3d0eab00247bcecfa7c6db5cc725466f7fed3ec8d2&";
    $ic_wheel = "https://cdn.discordapp.com/attachments/1172513665367425214/1172745378483949588/icons8-lucky-wheel-100_1.png?ex=65616f3e&is=654efa3e&hm=278a3a62b258564c86a60fab1ca685869680ba1c7e8db4284b8536791985ade4&";

    $ic_backend = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752891275132958/icons8-store-setting-100.png?ex=6561763d&is=654f013d&hm=9463ab0e144acae858cccf60c5a898c420df3b4ccde6a4065b916ef892d77afb&";
    $ic_coin = "https://cdn.discordapp.com/attachments/1172513665367425214/1172752328957362258/icons8-coin-100_1.png?ex=656175b7&is=654f00b7&hm=9a4e337db5c9eb95189b304fa015ca436ed2bc13a26148670dbdf2b537dcf100&";
    $ic_edit = "https://cdn.discordapp.com/attachments/1172513665367425214/1172750738494066808/icons8-edit-100_1.png?ex=6561743c&is=654eff3c&hm=4e4075e79dde41266aa5ce9d3deb712c03490dd2b8f40e13cfe3fd997b911de6&";
    $ic_his = "https://cdn.discordapp.com/attachments/1172513665367425214/1172751477731754094/icons8-history-100_1.png?ex=656174ec&is=654effec&hm=b7fc9706d318a63bc0ee531f78f98504c0f4e541ad9a4c1cb0884675c88f33d0&";
    $ic_logout = "https://cdn.discordapp.com/attachments/1172513665367425214/1172753282846957568/icons8-logout-100_1.png?ex=6561769b&is=654f019b&hm=71ca9543dcddc3457ce6ee296906635e8dbfb105618921e6d7fae0017cbf17c4&";
    $ic_howto = "https://cdn.discordapp.com/attachments/1172513665367425214/1172866969515601972/icons8-question-100.png?ex=6561e07c&is=654f6b7c&hm=9359f64670177661b6589a16acd35ccf48fb627416bd6b1a9cf668254c11e14d&";
    $ic_service = "https://cdn.discordapp.com/attachments/1172513665367425214/1173755252332306533/icons8-service-100.png?ex=65651bc3&is=6552a6c3&hm=65866e5d954594173292796f87b291d0ab7f06c825d8a73b725b49eefaaa3377&";
    $ic_contact = "https://cdn.discordapp.com/attachments/1172513665367425214/1174515760874393691/icons8-phone-100_1.png?ex=6567e00a&is=65556b0a&hm=e0175cb2a9690b6c89ac72267ecc4575b96dbd587a739d3b93593c3e706326d8&";
}


$bgh = $tst["uic"];
if ($tst["ui"] == "custom") {
    $bg = "bg-custom";
}
if ($tst["ui"] == "trans") {
    $bg = "bg-glass";
}
if ($tst["ui"] == "light") {
    $bg = "bg-light";
}
if ($tst["ui"] == "dark") {
    $bg = "bg-dark";
}

$an = $tst["anim"];

switch ($an) {
    case "zin":  $anim = "zoom-in"; break;
    case "zot":  $anim = "zoom-out"; break;
    case "fl":   $anim = "fade-left"; break;
    case "fr":   $anim = "fade-right"; break;
    case "fu":   $anim = "fade-up"; break;
    case "fd":   $anim = "fade-down"; break;
    case "fz":   $anim = "fade-zoom-in"; break;
    case "fs":   $anim = "fade-up-right"; break;
    case "fsl":  $anim = "fade-up-left"; break;
    case "fru":  $anim = "flip-up"; break;
    case "frd":  $anim = "flip-down"; break;
    case "frl":  $anim = "flip-left"; break;
    case "frr":  $anim = "flip-right"; break;
    case "slideu": $anim = "slide-up"; break;
    case "slided": $anim = "slide-down"; break;
    case "slidel": $anim = "slide-left"; break;
    case "slider": $anim = "slide-right"; break;
    case "zoom-in-up":  $anim = "zoom-in-up"; break;
    case "zoom-in-down":$anim = "zoom-in-down"; break;
    case "zoom-in-left":$anim = "zoom-in-left"; break;
    case "zoom-in-right":$anim = "zoom-in-right"; break;
    case "zoom-out-up":  $anim = "zoom-out-up"; break;
    case "zoom-out-down":$anim = "zoom-out-down"; break;
    case "zoom-out-left":$anim = "zoom-out-left"; break;
    case "zoom-out-right":$anim = "zoom-out-right"; break;
    default: $anim = "fade-up"; 
}



$sv = dd_q("SELECT * FROM service_setting")->fetch(PDO::FETCH_ASSOC);
$sv_status = $sv["status"];
$sv_img = $sv["img"];
$sv_mes = $sv["mes"];




if (isset($_GET['page'])) {
    // $config["pri_color"]   = "#FF2B2B";
    // $config["sec_color"]  = "#9A0D0D";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta property="og:title" content="<?php echo $config['name']; ?> - ยินดีต้อนรับ">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?= $_SERVER['SERVER_NAME'] ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta property="og:image" content="<?php echo $config['logo']; ?>">
        <meta property="og:description" content="<?php echo $config['des']; ?>">

        <title><?php echo $config['name']; ?></title>
        <link rel="shortcut icon" href="<?php echo $config['logo']; ?>" type="image/png" sizes="16x16">

        <link rel="stylesheet" href="services/styles/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <!-- <link rel="stylesheet" href="services/gshake/css/box.css"> -->
        <link href="https://kit-pro.fontawesome.com/releases/v7.1.0/css/pro.min.css" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@600&family=Kanit&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/2.8.0/chart.bundle.min.js"></script>

        <style>
            :root {
                --main: <?php echo $config["main_color"]; ?>;
                --sub: <?php echo $config["sec_color"]; ?>;
                --font: <?= $config["font_color"]; ?>;
                --sub-opa-50: <?php echo $config["sec_color"]; ?>50;
                --sub-opa-25: <?php echo $config["sec_color"]; ?>25;
                --main-opa-50: <?php echo $config["main_color"]; ?>50;
                --main-opa-25: <?php echo $config["main_color"]; ?>25;
            }
            th, td {
                color: var(--font);
            }
            .table-striped>tbody>tr:nth-of-type(odd)>* {
                color: var(--font);
            }
            .btn-main {
                background: var(--main-opa-25);
                color: var(--main) !important;
                border-radius: 12px;
                transition: all 0.3s;
            }
            
            .btn-main i {
                color: var(--main) !important;
                transition: all 0.3s;
            }
            .btn-main:hover i {
                
                color: var(--main) !important;
            }
            .btn-main:hover {
                background: var(--main-opa-25);
                border: 1px solid var(--main);
                color: var(--main);
            }
        </style>
        <link rel="stylesheet" href="services/styles/styles.css">
        <style>
            *,
            html,
            body,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            span,
            small,
            p,
            button,
            .btn,
            .nav-link,
            .text-dark,
            .text-white,
            .text-secondary,
            .underline-active {
                color: var(--font);
            }
            .<?php echo $bg?>{
              background: linear-gradient(135deg, rgba(255, 255,255 , 0.1)  ,  rgba(255, 255,255 , 0)  );
              backdrop-filter: blur(30px);
              -webkit-backdrop-filter: blur(30px);
              box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37);
          }
            ::-webkit-scrollbar {
    width: 3px
}
            .owl-items {
                max-width: 220px;
                max-height: 220px;

            }


            .owl-items img {
                border-radius: 25px !important;
                animation: glow 2s infinite ease-in-out;
            }

            body {
                background-image: url('<?= $config['bg2'] ?>');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                background-size: cover;
                overflow-x: hidden;
            }

            
.text-main i{
    color: var(--main) !important;
}
            ::-webkit-scrollbar-track {
                background: #000
            }

            ::-webkit-scrollbar-thumb {
                border-radius: 25px;
                background: -webkit-linear-gradient(transparent,var(--main))
            }

            .bg-custom {
                background-color: <?php echo $bgh;?>;
            }
            .font-bold {
                font-weight: 700;
            }
            .font-semibold {
                font-weight: 600;
            }  
.btn-check:focus+.btn, .btn:focus {
    outline: 0;
    box-shadow: none;
}
            </style>

                <!--width: 100%;
                height: 100%;
                background-color: #ffffff;
                background-image: radial-gradient(rgba(12, 12, 12, 0.171) 2px, transparent 0);
                background-size: 30px 30px;
                background-position: -5px -5px;-->

    </head>

    <style>
      .dropdown-item, .dropdown-item i {
transition: .4s ease; 
color: <?php if($bg == 'bg-light') { echo '#111'; }else { echo '#aaa';} ?>
      
      }
      .dropdown-item:hover, .dropdown-item:hover i {
        color: var(--main);
      }
      .dropdown-item:active , .dropdown-item:active i{
        background: var(--main) !important;
      color: <?php if($bg == 'bg-light'){ echo '#f1f1f1'; }else{ echo '#1a1a1a'; } ?>;
   }
      .dropdown-menu {
        }
    </style>
    <style>
        #MainNav .nav-link ,
        #MainNav .nav-link i {
            color: var(--font);
            transition: .3s ease-in-out;
        }
        #MainNav .nav-link:hover , #MainNav .nav-link:hover i{
            color: var(--main);
        }
        .nav-link:focus , .nav-link:focus i {
               color: var(--main);
        }
    </style>

<!-- ////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////// LODING ///////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////// -->

<?php if($loading['type'] == '0') { ?>
  <script>
window.addEventListener("load", () => {
  AOS.init({
    once: false,
    duration: 800
  });
  
});
</script>
<style>
  #MainNav {
  animation-delay: 2s !important;
  }
  
#MainNav a,#MainNav button,#MainNav ul,#MainNav img {
  animation-delay: 3s !important;
}
</style>
<?php } ?>
<?php if($loading['type'] == '1') { ?>

<!-- 🔹 ตัวโหลดแมว -->
<div class="center">
  <div class="loading-cat">
      <div class="body"></div>
      <div class="head">
          <div class="face"></div>
      </div>
      <div class="foot">
          <div class="tummy-end"></div>
          <div class="bottom"></div>
          <div class="legs left"></div>
          <div class="legs right"></div>
      </div>
      <div class="hands left"></div>
      <div class="hands right"></div>
  </div>
</div>

<style>
 

  body {
    margin: 0;
    padding: 0;
    overflow: hidden; /* ปิด scroll ตอนโหลด */
  }

  .center {
    position: fixed;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: var(--main);
    z-index: 9999;
    transition: opacity 1s ease;
  }

  /* 🔹 ส่วนของ loading-cat ทั้งหมด */
  .loading-cat {
    position: relative;
    display: inline-block;
    width: 480px;
    height: 360px;
    animation: 2.74s linear infinite loading-cat;
  }

  .loading-cat .head, .loading-cat .foot, .loading-cat .body {
    position: absolute;
    top: 0; right: 0; bottom: 0; left: 0;
    margin: auto;
    border-radius: 50%;
    width: 240px; height: 240px;
  }

  .loading-cat .body {
    background-image: radial-gradient(transparent 0%, transparent 35%, #383c4b 35%, #383c4b 39%, #eda65d 39%, #eda65d 46%, #f2c089 46%, #f2c089 60%, #eda65d 60%, #eda65d 67%, #383c4b 67%, #383c4b 100%);
    animation: 2.74s linear infinite body;
  }

  .loading-cat .foot {
    animation: 2.74s linear infinite foot;
  }

  .loading-cat .head:before, .loading-cat .foot:before {
    background-image: radial-gradient(transparent 0%, transparent 35%, #383c4b 35%, #383c4b 39%, #eda65d 39%, #eda65d 67%, #383c4b 67%, #383c4b 100%);
  }

  .loading-cat .head:before {
    content: "";
    width: 100%; height: 100%;
    position: absolute;
    border-radius: 50%;
    clip-path: polygon(100% 20%, 50% 50%, 70% -10%);
  }

  .loading-cat .head:after {
    content: "";
    width: 66px; height: 40px;
    position: absolute; top: 13px; right: 63px;
    background-image: linear-gradient( var(--main) 65%, transparent 65%), radial-gradient(var(--main) 51%, #383c4b 55%, #383c4b 68%, transparent 70%);
    transform: rotate(-66deg);
  }

  .loading-cat .head .face {
    width: 80px; height: 60px;
    left: 145px; top: 29px;
    position: absolute;
    transform: rotate(-47deg);
    background: radial-gradient(circle, #f2c089 0%, #f2c089 23%, transparent 23%) -3px 17px no-repeat,
                radial-gradient(circle, #383c4b 0%, #383c4b 6%, transparent 6%) 12px -12px no-repeat,
                radial-gradient(circle, #383c4b 0%, #383c4b 6%, transparent 6%) -12px -12px no-repeat,
                radial-gradient(#eda65d 0%, #eda65d 15%, transparent 15%) 0 -11px no-repeat,
                radial-gradient(circle, transparent 5%, #383c4b 5%, #383c4b 10%, transparent 10%) -3px -5px no-repeat,
                radial-gradient(circle, transparent 5%, #383c4b 5%, #383c4b 10%, transparent 10%) 3px -5px no-repeat,
                radial-gradient(circle, #eda65d 45%, transparent 45%) 0 -3px,
                linear-gradient(transparent 35%, #383c4b 35%, #383c4b 41%, transparent 41%, transparent 44%, #383c4b 44%, #383c4b 50%, transparent 50%, transparent 53%, #383c4b 53%, #383c4b 59%, transparent 59%);
  }

  .loading-cat .foot:before, .loading-cat .foot:after {
    content: "";
    width: 100%; height: 100%;
    position: absolute;
  }

  .loading-cat .foot:before {
    border-radius: 50%;
    clip-path: polygon(50% 50%, 0% 50%, 0% 25%);
  }

  .loading-cat .foot .tummy-end {
    width: 24px; height: 24px;
    position: absolute;
    border-radius: 50%;
    background-color: #f2c089;
    left: 19px; top: 105px;
  }

  .loading-cat .foot .bottom {
    width: 48px; height: 15px;
    position: absolute;
    top: 78px; left: 12px;
    border: 0 solid #383c4b;
    border-top-width: 6.5px;
    border-radius: 50%;
    transform: rotate(21deg);
    background: #eda65d;
  }

  .loading-cat .hands, .loading-cat .legs, .loading-cat .foot:after {
    width: 10px; height: 25px;
    position: absolute;
    border: 6.5px solid #383c4b;
    background-color: #eda65d;
  }

  .loading-cat .hands {
    border-top: 0;
    border-radius: 0 0 13px 13px;
  }

  .loading-cat .hands.left { top: 149px; right: 166px; transform: rotate(-20deg); }
  .loading-cat .hands.right { top: 128px; right: 133px; transform: rotate(-25deg); }


 
    @media only screen and (max-width: 375px) {
      .loading-cat .hands.left { top: 139px; right: 116px; transform: rotate(-20deg); }
  .loading-cat .hands.right { top: 118px; right: 83px; transform: rotate(-25deg); }
  }
    @media only screen and (max-width: 360px) {
     .loading-cat .hands.left { top: 139px; right: 109px; transform: rotate(-20deg); }
  .loading-cat .hands.right { top: 118px; right: 78px; transform: rotate(-25deg); }
 }
    @media only screen and (max-width: 320px) {
      .loading-cat .hands.left { top: 129px; right: 96px; transform: rotate(-20deg); }
  .loading-cat .hands.right { top: 108px; right: 63px; transform: rotate(-25deg); }
  }
  .loading-cat .legs { border-bottom: 0; border-radius: 13px 13px 0 0; }
  .loading-cat .legs.left { top: 65px; left: 49px; transform: rotate(25deg); }
  .loading-cat .legs.right { top: 53px; left: 12px; transform: rotate(22deg); }

  .loading-cat .foot:after {
    width: 8px; height: 40px;
    top: 42px; left: 36px;
    z-index: -1;
    transform: rotate(25deg);
    background-color: #c6823b;
    border-bottom: 0;
    border-radius: 12px 12px 0 0;
  }

  /* 🔹 Animation keyframes */
 @keyframes body {
    0% {
      clip-path: polygon(50% 50%, 0% 50%, 0% 100%, 100% 100%, 100% 20%);
      -webkit-clip-path: polygon(50% 50%, 0% 50%, 0% 100%, 100% 100%, 100% 20%);
    }
    10% {
      clip-path: polygon(50% 50%, 30% 120%, 50% 100%, 100% 100%, 100% 20%);
      -webkit-clip-path: polygon(50% 50%, 30% 120%, 50% 100%, 100% 100%, 100% 20%);
    }
    20% {
      clip-path: polygon(50% 50%, 100% 90%, 120% 90%, 100% 100%, 100% 20%);
      -webkit-clip-path: polygon(50% 50%, 100% 90%, 120% 90%, 100% 100%, 100% 20%);
    }
    40% {
      clip-path: polygon(50% 50%, 100% 45%, 120% 45%, 120% 50%, 100% 20%);
      -webkit-clip-path: polygon(50% 50%, 100% 45%, 120% 45%, 120% 50%, 100% 20%);
    }
    50% {
      clip-path: polygon(50% 50%, 100% 45%, 120% 45%, 120% 50%, 100% 20%);
      -webkit-clip-path: polygon(50% 50%, 100% 45%, 120% 45%, 120% 50%, 100% 20%);
    }
    65% {
      clip-path: polygon(50% 50%, 100% 65%, 120% 65%, 120% 50%, 100% 20%);
      -webkit-clip-path: polygon(50% 50%, 100% 65%, 120% 65%, 120% 50%, 100% 20%);
    }
    80% {
      clip-path: polygon(50% 50%, 75% 130%, 120% 65%, 120% 50%, 100% 20%);
      -webkit-clip-path: polygon(50% 50%, 75% 130%, 120% 65%, 120% 50%, 100% 20%);
    }
    90% {
      clip-path: polygon(50% 50%, -20% 110%, 50% 120%, 100% 100%, 100% 20%);
      -webkit-clip-path: polygon(50% 50%, -20% 110%, 50% 120%, 100% 100%, 100% 20%);
    }
    100% {
      clip-path: polygon(50% 50%, 0% 50%, 0% 100%, 100% 100%, 100% 20%);
      -webkit-clip-path: polygon(50% 50%, 0% 50%, 0% 100%, 100% 100%, 100% 20%);
    }
  }
  @keyframes loading-cat {
    0% {
      transform: rotate(0deg);
    }
    10% {
      transform: rotate(-80deg);
    }
    20% {
      transform: rotate(-180deg);
    }
    40% {
      transform: rotate(-245deg);
    }
    50% {
      transform: rotate(-250deg);
    }
    68% {
      transform: rotate(-300deg);
    }
    90% {
      transform: rotate(-560deg);
    }
    100% {
      transform: rotate(-720deg);
    }
  }
  @keyframes foot {
    0% {
      transform: rotate(-10deg);
    }
    10% {
      transform: rotate(-100deg);
    }
    20% {
      transform: rotate(-145deg);
    }
    35% {
      transform: rotate(-190deg);
    }
    50% {
      transform: rotate(-195deg);
    }
    70% {
      transform: rotate(-165deg);
    }
    100% {
      transform: rotate(-10deg);
    }
  }
</style>

<script>
  window.addEventListener("load", () => {
    setTimeout(() => {
      const loader = document.querySelector('.center');
      loader.style.opacity = "0";
      setTimeout(() => {
        loader.style.display = "none";
        document.body.style.overflow = "auto";
          AOS.init({
        once: false,        // เล่นแอนิเมชันครั้งเดียวพอ
        duration: 800      // หรือปรับตามที่ใช้
        // อื่น ๆ ตามที่คุณตั้งไว้
      });
      }, 1000);
    }, 2000);
  });
</script>

<!-- //////////////////////////////// -->

<?php } ?>
<?php if($loading['type'] == '2') { ?>
<div class="loader">
  <div class="dot-spinner">
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
  </div>
</div>

<style>
/* ==============================
   Dot Spinner Loader (Smooth + Responsive)
   ============================== */
:root {
  --uib-size: 5rem;        /* ขนาด loader */
  --uib-speed: 1s;         /* ความเร็วการหมุน */
  --uib-color: #ffffff; /* สีหลัก */
  --bg-color: #000;        /* พื้นหลัง */
}

body {
  margin: 0;
  overflow: hidden;
}

/* กล่องกลางโหลด */
.loader {
  position: fixed;
  inset: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  background: var(--main);
  opacity: 1;
  transition: opacity 1s ease;
}

/* จุดหมุนหลัก */
.dot-spinner {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  height: var(--uib-size);
  width: var(--uib-size);
  transform: scale(clamp(0.7, 2vw, 1.2));
}

.dot-spinner__dot {
  position: absolute;
  top: 0; left: 0;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  height: 100%;
  width: 100%;
}

.dot-spinner__dot::before {
  content: '';
  height: 20%;
  width: 20%;
  border-radius: 50%;
  background-color: var(--uib-color);
  transform: scale(0);
  opacity: 0.5;
  animation: pulse0112 calc(var(--uib-speed) * 1.1) ease-in-out infinite;
  box-shadow: 0 0 15px rgba(255, 140, 0, 0.3);
}

@keyframes pulse0112 {
  0%,100% { transform: scale(0); opacity: 0.4; }
  50% { transform: scale(1); opacity: 1; }
}

/* หมุนแต่ละจุด */
.dot-spinner__dot:nth-child(1) { transform: rotate(0deg); }
.dot-spinner__dot:nth-child(2) { transform: rotate(45deg); }
.dot-spinner__dot:nth-child(3) { transform: rotate(90deg); }
.dot-spinner__dot:nth-child(4) { transform: rotate(135deg); }
.dot-spinner__dot:nth-child(5) { transform: rotate(180deg); }
.dot-spinner__dot:nth-child(6) { transform: rotate(225deg); }
.dot-spinner__dot:nth-child(7) { transform: rotate(270deg); }
.dot-spinner__dot:nth-child(8) { transform: rotate(315deg); }

.dot-spinner__dot:nth-child(2)::before { animation-delay: calc(var(--uib-speed) * -0.875); }
.dot-spinner__dot:nth-child(3)::before { animation-delay: calc(var(--uib-speed) * -0.75); }
.dot-spinner__dot:nth-child(4)::before { animation-delay: calc(var(--uib-speed) * -0.625); }
.dot-spinner__dot:nth-child(5)::before { animation-delay: calc(var(--uib-speed) * -0.5); }
.dot-spinner__dot:nth-child(6)::before { animation-delay: calc(var(--uib-speed) * -0.375); }
.dot-spinner__dot:nth-child(7)::before { animation-delay: calc(var(--uib-speed) * -0.25); }
.dot-spinner__dot:nth-child(8)::before { animation-delay: calc(var(--uib-speed) * -0.125); }

/* เมื่อโหลดเสร็จจะเฟดหาย */
.fade-out {
  opacity: 0;
  pointer-events: none;
}

/* Responsive */
@media (max-width: 480px) {
  :root { --uib-size: 4rem; }
}
</style>

<script>
window.addEventListener("load", () => {
  // ให้ loader แสดงประมาณ 2.8 วิ แล้วค่อยหาย
  setTimeout(() => {
    document.querySelector(".loader").classList.add("fade-out");
    // ปลด scroll หลังจากเฟดหาย
    setTimeout(() => {
      document.body.style.overflow = "auto";
         AOS.init({
        once: false,        // เล่นแอนิเมชันครั้งเดียวพอ
        duration: 800      // หรือปรับตามที่ใช้
        // อื่น ๆ ตามที่คุณตั้งไว้
      });
    }, 800);
  }, 2800);
});
</script>

<?php } ?>

<?php if($loading['type'] == '3'){ ?>
<style>
  /* From Uiverse.io by abrahamcalsin */ 
.jelly-triangle {
  --uib-size: 2.8rem;
  --uib-speed: 1.75s;
  --uib-color: #ffffffff;
  position: relative;
  height: var(--uib-size);
  width: var(--uib-size);
  filter: url('#uib-jelly-triangle-ooze');
}

.jelly-triangle__dot,
.jelly-triangle::before,
.jelly-triangle::after {
  content: '';
  position: absolute;
  width: 33%;
  height: 33%;
  background: var(--uib-color);
  border-radius: 100%;
  box-shadow: 0 0 4px 5px #ffffff25;
}

.jelly-triangle__dot {
  top: 6%;
  left: 30%;
  animation: grow7132 var(--uib-speed) ease infinite;
}

.jelly-triangle::before {
  bottom: 6%;
  right: 0;
  animation: grow7132 var(--uib-speed) ease calc(var(--uib-speed) * -0.666)
    infinite;
}

.jelly-triangle::after {
  bottom: 6%;
  left: 0;
  animation: grow7132 var(--uib-speed) ease calc(var(--uib-speed) * -0.333)
    infinite;
}

.jelly-triangle__traveler {
  position: absolute;
  top: 6%;
  left: 30%;
  width: 33%;
  height: 33%;
  background: var(--uib-color);
  border-radius: 100%;
  animation: triangulate6214 var(--uib-speed) ease infinite;
}

.jelly-maker {
  width: 0;
  height: 0;
  position: absolute;
}

@keyframes triangulate6214 {
  0%,
  100% {
    transform: none;
  }

  33.333% {
    transform: translate(120%, 175%);
  }

  66.666% {
    transform: translate(-95%, 175%);
  }
}

@keyframes grow7132 {
  0%,
  100% {
    transform: scale(1.5);
  }

  20%,
  70% {
    transform: none;
  }
}
/* กล่องกลางโหลด */
.loader {
  position: fixed;
  inset: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  background: var(--main);
  opacity: 1;
  transition: opacity 1s ease;
}
/* ✅ เพิ่มส่วนนี้ไว้ท้ายสุด */
.fade-out {
  opacity: 0;
  pointer-events: none;
  transition: opacity 1s ease;
}

</style>
<div class="loader">
  <!-- From Uiverse.io by abrahamcalsin --> 
<div class="jelly-triangle">
    <div class="jelly-triangle__dot"></div>
    <div class="jelly-triangle__traveler"></div>
</div>

<svg width="0" height="0" class="jelly-maker">
    <defs>
        <filter id="uib-jelly-triangle-ooze">
            <feGaussianBlur in="SourceGraphic" stdDeviation="7.3" result="blur"></feGaussianBlur>
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="ooze"></feColorMatrix>
            <feBlend in="SourceGraphic" in2="ooze"></feBlend>
        </filter>
    </defs>
</svg>
</div>


<script>
window.addEventListener("load", () => {
  // ให้ loader แสดงประมาณ 2.8 วิ แล้วค่อยหาย
  setTimeout(() => {
    document.querySelector(".loader").classList.add("fade-out");
    // ปลด scroll หลังจากเฟดหาย
    setTimeout(() => 
    {document.body.style.overflow = "auto";
         AOS.init({
        once: false,        // เล่นแอนิเมชันครั้งเดียวพอ
        duration: 800      // หรือปรับตามที่ใช้
        // อื่น ๆ ตามที่คุณตั้งไว้
      });
    }, 800);
  }, 2800);
});
</script>
  <?php } ?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if($loading['type'] == '4'){ ?>
<div class="loader">
  <img src="https://i0.wp.com/lordlibidan.com/wp-content/uploads/2019/03/Running-Pikachu-GIF.gif?resize=480%2C342&ssl=1"
       alt="Running Pikachu"
       class="pikachu">
</div>

<style>
/* ============================
   Pikachu Run Loader (Fixed)
   ============================ */
body {
  margin: 0;
  padding: 0;
  overflow: hidden; /* ปิด scroll ตอนโหลด */
}

.loader {
  position: fixed;
  inset: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background: var(--main, #000);
  z-index: 9999;
  transition: opacity 1s ease;
}

/* ✅ แยกการ bounce กับ run ออกจากกัน */
.pikachu {
  width: clamp(120px, 28vw, 240px);
  height: auto;
  position: relative;
  animation: bounceY 0.8s infinite ease-in-out;
  transition: transform 1s ease, opacity 1s ease;
}

/* เด้งขึ้นลงเฉพาะแกน Y */
@keyframes bounceY {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

/* วิ่งออกทางขวา */
.run-away {
  animation: runX 1s ease forwards;
  opacity: 0;
}

@keyframes runX {
  0%   { transform: translateX(0) translateY(0); opacity: 1; }
  80%  { transform: translateX(80vw) translateY(-5px); opacity: 0.9; }
  100% { transform: translateX(120vw) translateY(-5px); opacity: 0; }
}

/* loader จางหาย */
.fade-out {
  opacity: 0;
  pointer-events: none;
}
</style>

<script>
window.addEventListener("load", () => {
  const pikachu = document.querySelector(".pikachu");
  const loader = document.querySelector(".loader");

  setTimeout(() => {
    // เริ่มให้พิคาชูวิ่งออกไป
    pikachu.classList.add("run-away");

    // หลังจากวิ่ง 1 วิ ให้ loader เฟดออก
    setTimeout(() => {
      loader.classList.add("fade-out");
      document.body.style.overflow = "auto";
         AOS.init({
        once: false,        // เล่นแอนิเมชันครั้งเดียวพอ
        duration: 800      // หรือปรับตามที่ใช้
        // อื่น ๆ ตามที่คุณตั้งไว้
      });
    }, 500);
  }, 2000); // แสดง loader ค้างไว้ 2 วิ ก่อนเริ่มวิ่ง
});
</script>
<?php } ?>

<?php if($loading['type'] == '5'){ ?>
<div class="loader">
  <div class="squares"></div>
</div>

<style>
/* ============================
   Animated Square Loader
   ============================ */
body {
  margin: 0;
  padding: 0;
  overflow: hidden; /* ปิด scroll ตอนโหลด */
}

.loader {
  position: fixed;
  inset: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #2c2f33;
  z-index: 9999;
  transition: opacity 1s ease;
}

/* ============================
   Square animation
   ============================ */
.squares {
  position: relative;
  width: clamp(40px, 10vw, 60px);
  height: clamp(40px, 10vw, 60px);
  animation: scale ease 1.4s infinite;
}

.squares::before,
.squares::after {
  content: '';
  position: absolute;
  width: 15px;
  height: 15px;
  background: #7289da;
}

.squares::before {
  top: -10px;
  left: -10px;
  animation: topMove ease 3s infinite;
}

.squares::after {
  bottom: -10px;
  right: -10px;
  animation: bottomMove ease 3s infinite;
}

/* ===== Keyframes ===== */
@keyframes topMove {
  0% { top: -10px; left: -10px; }
  20% { top: 100%; left: -10px; }
  40% { top: 100%; left: 100%; transform: rotate(180deg); }
  60% { top: -10px; left: 100%; }
  80% { top: -10px; transform: rotate(360deg); }
  100% { left: -10px; }
}

@keyframes bottomMove {
  0% { bottom: -10px; right: -10px; }
  20% { bottom: 100%; right: -10px; }
  40% { bottom: 100%; right: 100%; transform: rotate(180deg); }
  60% { bottom: -10px; right: 100%; }
  80% { bottom: -10px; transform: rotate(360deg); }
  100% { right: -10px; }
}

@keyframes scale {
  0%,100% { transform: scale(1); }
  50% { transform: scale(0.7); }
}

/* loader หาย */
.fade-out {
  opacity: 0;
  pointer-events: none;
}

/* Responsive */
@media (max-width: 500px) {
  .squares {
    width: 40px;
    height: 40px;
  }
  .squares::before,
  .squares::after {
    width: 12px;
    height: 12px;
  }
}
</style>

<script>
window.addEventListener("load", () => {
  const loader = document.querySelector(".loader");
  setTimeout(() => {
    loader.classList.add("fade-out");
    document.body.style.overflow = "auto";
          AOS.init({
          once: false,        // เล่นแอนิเมชันครั้งเดียวพอ
          duration: 800      // หรือปรับตามที่ใช้
          // อื่น ๆ ตามที่คุณตั้งไว้
        });
  }, 2800); // loader แสดงประมาณ 2.8 วิ แล้วค่อยหาย
});
</script>
<?php } ?>

<?php if($loading['type'] == '6'){ ?>
<div class="loader">
  <img src="https://media.tenor.com/PrsyXh3xJ2EAAAAj/discord-loading.gif"
       alt="Discord Loading"
       class="discord-loader">
</div>

<style>
/* ============================
   Discord Loader
   ============================ */
body {
  margin: 0;
  padding: 0;
  overflow: hidden; /* ปิด scroll ตอนโหลด */
}

.loader {
  position: fixed;
  inset: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background: var(--main, #23272A); /* พื้นหลังสี Discord */
  z-index: 9999;
  transition: opacity 1s ease;
}

/* ✅ GIF loader */
.discord-loader {
  width: clamp(80px, 20vw, 160px);
  height: auto;
  filter: drop-shadow(0 0 20px rgba(114,137,218,0.6));
  transition: transform 1s ease, opacity 1s ease;
}

/* วิ่งออกขวา + เฟด */
.run-away {
  animation: slideOut 1.2s ease forwards;
}

@keyframes slideOut {
  0%   { transform: translateX(0) scale(1); opacity: 1; }
  60%  { transform: translateX(40vw) scale(0.9); opacity: 0.8; }
  100% { transform: translateX(100vw) scale(0.7); opacity: 0; }
}

/* loader จางหาย */
.fade-out {
  opacity: 0;
  pointer-events: none;
  transition: opacity 1s ease;
}

/* Responsive tweaks */
@media (max-width: 500px) {
  .discord-loader { width: 100px; }
}
</style>

<script>
window.addEventListener("load", () => {
  const loader = document.querySelector(".loader");
  const discord = document.querySelector(".discord-loader");

  setTimeout(() => {
    // เริ่มให้ Discord วิ่งออกไป

    // หลังจากวิ่งออก 1 วิ ค่อยเฟดหาย
    setTimeout(() => {
      loader.classList.add("fade-out");
      document.body.style.overflow = "auto";
          AOS.init({
          once: false,        // เล่นแอนิเมชันครั้งเดียวพอ
          duration: 800      // หรือปรับตามที่คุณตั้งไว้
          // อื่น ๆ ตามที่คุณตั้งไว้
        });
    }, 1000);
  }, 2000); // แสดง loader ค้างไว้ 2 วิ ก่อนเริ่มหาย
});
</script>
<?php } ?>



  <!-- ///////////////////////////////////////////////////////////////////////////////////////////// -->
  <!-- ///////////////////////////////////////////////////////////////////////////////////////////// -->

  <?php if ($particle['status'] == 1 && $particle['particle'] == 1): ?>
<style>
.spider {
  position: fixed;
  width: 30px;
  height: 30px;
  background: url('https://cdn-icons-png.flaticon.com/128/357/357556.png') no-repeat center;
  background-size: contain;
  z-index: 4;
  pointer-events: none;
  animation: swing 2s infinite ease-in-out;
  transform-origin: top center;
}

@keyframes swing {
  0%, 100% { transform: rotate(0deg); }
  50% { transform: rotate(6deg); }
}

.web-line {
  position: fixed;
  width: 1.5px;
  background: rgba(255,255,255,0.3);
  z-index: 3;
  pointer-events: none;
  transform-origin: top center;
}

/* 🦇 ค้างคาว */
.bat {
  position: fixed;
  width: 80px;
  height: 80px;
  background: url('https://cdn.pixabay.com/animation/2025/10/02/19/22/19-22-28-195_512.gif') no-repeat center;
  background-size: contain;
  z-index: 4;
  pointer-events: none;
  transform-origin: center center;
}
</style>

<div class="corner left">
  <div class="pumpkin">
    <div class="front left"></div>
    <div class="front right"></div>
    <div class="stalk"></div>
    <div class="eye left"></div>
    <div class="eye right"></div>
    <div class="nose"></div>
    <div class="mouth"></div>
    <div class="candle eye left"></div>
    <div class="candle eye right"></div>
    <div class="candle nose"></div>
    <div class="candle mouth"></div>
  </div>
</div>

<div class="corner right">
  <div class="pumpkin">
    <div class="front left"></div>
    <div class="front right"></div>
    <div class="stalk"></div>
    <div class="eye left"></div>
    <div class="eye right"></div>
    <div class="nose"></div>
    <div class="mouth"></div>
    <div class="candle eye left"></div>
    <div class="candle eye right"></div>
    <div class="candle nose"></div>
    <div class="candle mouth"></div>
  </div>
</div>
<style>

.corner {
  position: fixed;
  bottom: 0;
  z-index: 99;
  text-align: center;
  width: 260px;
  pointer-events: none;
}

.corner p {
  font-family: 'Eater', cursive;
  font-size: 24px;
  color: #ff7b00;
  margin-top: -10px;
  text-shadow: 0 0 10px #ff7b00;
}

.corner .pumpkin {
  transform: scale(0.6);
  margin: 0 auto;
}

.corner.left {
  left: -14vh;
  bottom:-10vh;
  transform: rotate(45deg);
  animation: floatLeft 4s ease-in-out infinite;
}

.corner.right {
  right: -14vh;
  bottom:-10vh;
  animation: floatRight 4s ease-in-out infinite;
}
/* ปกติ (desktop) */
@keyframes floatLeft {
  0%, 100% { transform: translateY(0) scale(0.8) rotate(15deg); }
  50% { transform: translateY(-10px) scale(1) rotate(25deg); }
}

@keyframes floatRight {
  0%, 100% { transform: translateY(0) scale(0.8) rotate(-15deg); }
  50% { transform: translateY(-10px) scale(1) rotate(-25deg); }
}

/* ปรับ animation สำหรับมือถือ */
@media (max-width: 768px) {
  .corner.left {
  left: -19vh;
  bottom:-15vh;
    animation: floatLeftMobile 3s ease-in-out infinite;
  }
  .corner.right {
  right: -19vh;
  bottom:-15vh;
    animation: floatRightMobile 3s ease-in-out infinite;
  }
}

@keyframes floatLeftMobile {
  0%, 100% { transform: translateY(0) scale(0.4) rotate(15deg); }
  50% { transform: translateY(-10px) scale(0.6) rotate(25deg); }
}

@keyframes floatRightMobile {
  0%, 100% { transform: translateY(0) scale(0.4) rotate(-15deg); }
  50% { transform: translateY(-10px) scale(0.6) rotate(-25deg); }
}

/* ------------------- Pumpkin ------------------- */
.pumpkin {
  position: relative;
  height: 200px;
  width: 240px;
  background: #E37100;
  border-radius: 45% 45% 40% 40% / 43% 43% 50% 50%;
  box-shadow: inset 0 -20px 20px 0 rgba(0,0,0,0.4);
}
.pumpkin * { position: absolute; }

.pumpkin .front.left {
  height: 94%; width: 50%; bottom: 0; left: 0;
  border-radius: 65% 35% 10% 85% / 45% 20% 10% 60%;
  box-shadow: inset 5px 5px 10px -5px rgba(0,0,0,0.3);
}
.pumpkin .front.right {
  height: 94%; width: 50%; bottom: 0; right: 0;
  border-radius: 35% 65% 85% 10% / 20% 45% 60% 10%;
  box-shadow: inset -5px 5px 10px -5px rgba(0,0,0,0.3);
}

.pumpkin .stalk {
  top: -5px; left: calc(50% - 15px);
  height: 30px; width: 30px;
  background: #35260F;
  border-radius: 10% 10% 50% 50% / 90% 90% 20% 20%;
  transform: rotate(5deg);
}
.pumpkin .eye {
  top: 65px; height: 35px; width: 70px;
  background: #5A2504;
}
.pumpkin .eye.left {
  left: 38px;
  transform: rotate(25deg);
  border-radius: 10% 10% 40% 60% / 0% 30% 50% 95%;
}
.pumpkin .eye.right {
  right: 38px;
  transform: rotate(-25deg);
  border-radius: 10% 10% 60% 40% / 30% 0% 95% 50%;
}
.pumpkin .nose {
  top: 105px; left: calc(50% - 13px);
  height: 26px; width: 26px;
  background: #AD4B07;
  clip-path: polygon(0% 100%, 50% 0%, 100% 100%);
}
.pumpkin .mouth {
  top: 65px; left: calc(50% - 80px);
  height: 110px; width: 160px;
  background: #5A2504;
  clip-path: polygon(0% 58%, 7% 65%, 19% 70%, 22% 71%, 28% 82%, 33% 74%, 38% 74%, 50% 75%, 62% 74%, 67% 74%, 72% 82%, 78% 71%, 81% 70%, 93% 65%, 100% 58%, 94% 75%, 86% 89%, 79% 94%, 70% 98%, 60% 100%, 56% 100%, 50% 88%, 44% 100%, 40% 100%, 30% 98%, 21% 95%, 14% 89%, 6% 75%);
}
.pumpkin .candle {
  position: absolute;
  background: rgba(255,255,0,0.4);
  box-shadow: 0 0 50px 2px rgba(255,255,0,0.8);
  animation: candle 3s linear infinite;
}
@keyframes candle {
  0%,100% { opacity: 0.2; }
  50% { opacity: 0.5; }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const numSpiders = 7;
  for (let i = 0; i < numSpiders; i++) spawnSpider(i);

  const maxBats = 3;
  for (let i = 0; i < maxBats; i++) setTimeout(() => spawnBat(i), Math.random() * 4000);
});

// ==== 🕷️ Spider เหมือนเดิม ====
function spawnSpider(i) {
  const spider = document.createElement("div");
  spider.classList.add("spider");
  spider.id = "spider_" + i;

  const line = document.createElement("div");
  line.classList.add("web-line");
  line.id = "line_" + i;

  document.body.appendChild(line);
  document.body.appendChild(spider);

  dropSpider(i);
}

function dropSpider(i) {
  const spider = document.getElementById("spider_" + i);
  const line = document.getElementById("line_" + i);

  const screenH = window.innerHeight;
  const x = Math.random() * (window.innerWidth - 60);
  const drop = Math.random() * (screenH * 0.4) + 150;
  const speed = 3 + Math.random() * 3;
  const delay = Math.random() * 5 * 1000;

  spider.style.top = "-60px";
  spider.style.left = `${x}px`;
  line.style.top = "0";
  line.style.left = `${x + 15}px`;
  line.style.height = "0px";

  setTimeout(() => {
    const fallLine = line.animate([{ height: "0px" }, { height: `${drop}px` }], {
      duration: speed * 1000,
      fill: "forwards",
      easing: "ease-in-out"
    });

    const fallSpider = spider.animate(
      [{ transform: "translateY(0px)" }, { transform: `translateY(${drop + 50}px)` }],
      {
        duration: speed * 1000,
        fill: "forwards",
        easing: "ease-in-out"
      }
    );

    fallSpider.onfinish = () => {
      const riseLine = line.animate([{ height: `${drop}px` }, { height: "0px" }], {
        duration: speed * 1000,
        fill: "forwards",
        easing: "ease-in-out"
      });

      const riseSpider = spider.animate(
        [{ transform: `translateY(${drop + 50}px)` }, { transform: "translateY(0px)" }],
        {
          duration: speed * 1000,
          fill: "forwards",
          easing: "ease-in-out"
        }
      );

      riseSpider.onfinish = () => {
        setTimeout(() => dropSpider(i), 1000 + Math.random() * 2000);
      };
    };
  }, delay);
}

// ==== 🦇 Bat บินเอียงจริง ====
function spawnBat(i) {
  const bat = document.createElement("div");
  bat.classList.add("bat");
  bat.id = "bat_" + i;
  document.body.appendChild(bat);
  moveBat(i);
}

function moveBat(i) {
  const bat = document.getElementById("bat_" + i);
  const screenW = window.innerWidth;
  const screenH = window.innerHeight;

  const flyFromLeft = Math.random() > 0.5; // true = จากซ้ายไปขวา
  const yStart = Math.random() * (screenH * 0.6) + 50;
  const yEnd = yStart + (Math.random() * 200 - 100); // เฉียงขึ้น/ลงเล็กน้อย
  const duration = 8 + Math.random() * 4;
  const startX = flyFromLeft ? -120 : screenW + 120;
  const endX = flyFromLeft ? screenW + 120 : -120;

  // ✅ สุ่มมุมเอียงระหว่าง 0 ถึง 45 องศา
  const randomTilt = Math.random() * 45;
  const fixedAngle = flyFromLeft ? randomTilt : -randomTilt;

  bat.style.top = `${yStart}px`;
  bat.style.left = `${startX}px`;

  // ตั้งค่าการเอียงเริ่มต้น (พร้อมหันตามทิศ)
  bat.style.transform = `rotate(${fixedAngle}deg) scaleX(${flyFromLeft ? 1 : -1})`;

  // ความเร็วในการเคลื่อนที่
  const frameRate = 1000 / 60;
  const xSpeed = (endX - startX) / (duration * 1000 / frameRate);
  const ySpeed = (yEnd - yStart) / (duration * 1000 / frameRate);

  let x = startX;
  let y = yStart;

  function flyFrame() {
    x += xSpeed;
    y += ySpeed;

    // ให้ค้างคาวเอียงคงที่ตามมุมสุ่มที่กำหนดไว้
    bat.style.transform = `rotate(${fixedAngle}deg) scaleX(${flyFromLeft ? 1 : -1})`;
    bat.style.left = `${x}px`;
    bat.style.top = `${y}px`;

    // ถ้าเลยขอบจอ → ลบและสุ่มใหม่
    if ((flyFromLeft && x > screenW + 150) || (!flyFromLeft && x < -150)) {
      bat.remove();
      setTimeout(() => spawnBat(i), 2000 + Math.random() * 3000);
      return;
    }

    requestAnimationFrame(flyFrame);
  }

  requestAnimationFrame(flyFrame);
}

</script>
<?php endif; ?>
<?php if ($particle['status'] == 1 && $particle['particle'] == 2): ?>
<style>
.leaf {
  position: fixed;
  top: -100px;
  width: 40px;
  height: 40px;
  background-size: contain;
  background-repeat: no-repeat;
  pointer-events: none;
  z-index: 4;
  transform-style: preserve-3d;
  opacity: 0.9;
  animation: leafFall linear infinite;
}

@keyframes leafFall {
  0% {
    transform: translate3d(0, 0, 0) rotateX(0deg) rotateY(0deg) rotateZ(0deg);
    opacity: 0;
  }
  10% {
    opacity: 1;
  }
  100% {
    transform: translate3d(var(--moveX), 100vh, var(--depth))
               rotateX(var(--rotX))
               rotateY(var(--rotY))
               rotateZ(var(--rotZ));
    opacity: 0;
  }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const leafImages = [
    "https://cdn-icons-png.flaticon.com/128/8524/8524294.png",
    "https://cdn-icons-png.flaticon.com/128/3380/3380659.png",
    "https://cdn-icons-png.flaticon.com/128/16148/16148712.png",
    "https://cdn-icons-png.flaticon.com/128/3413/3413309.png"
  ];

  const leafCount = 25; // จำนวนใบไม้
  for (let i = 0; i < leafCount; i++) createLeaf(leafImages);

  // 🌬️ สร้าง "ลมพัด" เป็นช่วง ๆ
  setInterval(() => {
    const windPower = (Math.random() - 0.5) * 800; // ลมแรงสุ่ม
    document.documentElement.style.setProperty("--wind", `${windPower}px`);
  }, 4000);
});

function createLeaf(images) {
  const leaf = document.createElement("div");
  leaf.classList.add("leaf");
  leaf.style.left = Math.random() * 100 + "vw";
  leaf.style.backgroundImage = `url('${images[Math.floor(Math.random() * images.length)]}')`;

  // 🌪️ สุ่มค่าพารามิเตอร์
  const windBase = parseFloat(getComputedStyle(document.documentElement).getPropertyValue("--wind")) || 0;
  const drift = (Math.random() - 0.5) * 400; // ลมพัดเฉียงซ้ายขวาเพิ่ม
  const wind = windBase + drift; // รวมแรงลม
  const rotX = Math.random() * 720 - 360;
  const rotY = Math.random() * 720 - 360;
  const rotZ = Math.random() * 360 - 180;
  const depth = Math.random() * 200 - 100;
  const duration = 10 + Math.random() * 10; // ความเร็วตก

  // 💨 สุ่มทิศทางปลิวออกจอซ้าย/ขวาได้
  const outOfScreen = (Math.random() > 0.5 ? 1 : -1) * (200 + Math.random() * 400);
  leaf.style.setProperty("--moveX", `${wind + outOfScreen}px`);
  leaf.style.setProperty("--rotX", `${rotX}deg`);
  leaf.style.setProperty("--rotY", `${rotY}deg`);
  leaf.style.setProperty("--rotZ", `${rotZ}deg`);
  leaf.style.setProperty("--depth", `${depth}px`);
  leaf.style.animationDuration = `${duration}s`;
  leaf.style.animationDelay = `${Math.random() * 5}s`;

  document.body.appendChild(leaf);

  leaf.addEventListener("animationend", () => {
    leaf.remove();
    createLeaf(images);
  });
}
</script>
<?php endif; ?>
<?php if ($particle['status'] == 1 && $particle['particle'] == 3): ?>

<style>
/* ================= SNOW ================= */
canvas#snowCanvas {
  position: fixed;
  inset: 0;
  pointer-events: none;
  z-index: 4;
}

/* ================= SANTA ================= */
#santa-layer {
  position: fixed;
  inset: 0;
  pointer-events: none;
  z-index: 5;
  overflow: hidden;
}

/* เดินข้ามจอ */
.santa-move {
  position: absolute;
  will-change: transform;
}

/* ลอยขึ้นลง */
.santa-float {
  animation: float 3.5s ease-in-out infinite;
}

/* ตัวภาพ */
.santa {
  width: 140px;
  display: block;
}

/* ===== Animations ===== */
@keyframes float {
  0%   { transform: translateY(0) rotate(-6deg); }
  50%  { transform: translateY(-18px) rotate(6deg); }
  100% { transform: translateY(0) rotate(-6deg); }
}

@keyframes moveLTR {
  from { transform: translateX(-200px); }
  to   { transform: translateX(calc(100vw + 200px)); }
}

@keyframes moveRTL {
  from { transform: translateX(calc(100vw + 200px)); }
  to   { transform: translateX(-200px); }
}
</style>

<canvas id="snowCanvas"></canvas>
<div id="santa-layer"></div>

<script>
/* ================= SNOW LITE ================= */
(() => {
  const c = document.getElementById("snowCanvas");
  const ctx = c.getContext("2d");
  let w, h;

  function resize() {
    w = c.width = innerWidth;
    h = c.height = innerHeight;
  }
  resize();
  addEventListener("resize", resize);

  const COUNT = Math.min(80, Math.floor(w / 14));
  const snow = [];
  let wind = 0, target = 0;

  setInterval(() => target = (Math.random() - .5) * .6, 4000);

 class Flake {
  constructor(){ this.reset(true); }

  reset(s){
    this.x = Math.random() * w;
    this.y = s ? Math.random() * h : -10;

    this.r = Math.random() * 2.8 + 1.4;
    this.v = Math.random() * 0.9 + 0.6;

    this.baseAlpha = Math.random() * 0.6 + 0.4; // เก็บค่าเดิม
    this.a = this.baseAlpha;

    this.t = Math.random() * Math.PI * 2;

    this.rot = Math.random() * Math.PI * 2;
    this.rotSpeed = (Math.random() - 0.5) * 0.01;
  }

  update(){
    wind += (target - wind) * 0.001;

    this.t += 0.01;
    this.rot += this.rotSpeed;

    this.x += Math.sin(this.t) * 0.7 + wind;
    this.y += this.v;

    /* ===== fade out near bottom ===== */
    const fadeStart = h * 0.8;   // เริ่มเฟดที่ 80%
    const fadeEnd   = h * 0.98;  // หายเกือบสุดจอ

    if (this.y > fadeStart) {
      const p = Math.min(1, (this.y - fadeStart) / (fadeEnd - fadeStart));
      this.a = this.baseAlpha * (1 - p);
    } else {
      this.a = this.baseAlpha;
    }

    if (this.y > h + 20 || this.x < -40 || this.x > w + 40) {
      this.reset();
    }
  }

  draw(){
    if (this.a <= 0) return;

    ctx.save();
    ctx.globalAlpha = this.a;

    ctx.translate(this.x, this.y);
    ctx.rotate(this.rot);

    ctx.beginPath();
    ctx.ellipse(
      0,
      0,
      this.r * 0.7,
      this.r,
      0,
      0,
      Math.PI * 2
    );

    ctx.fillStyle = "#fff";
    ctx.fill();
    ctx.restore();
  }
}

  for(let i=0;i<COUNT;i++) snow.push(new Flake());
  (function loop(){
    ctx.clearRect(0,0,w,h);
    snow.forEach(f=>{f.update();f.draw();});
    requestAnimationFrame(loop);
  })();
})();

/* ================= SANTA (FIXED) ================= */
(() => {
  const layer = document.getElementById("santa-layer");
  const IMG = "https://img2.pic.in.th/pic/Untitled-file-1.gif";

  function spawnSanta() {
    const move = document.createElement("div");
    const float = document.createElement("div");
    const img = document.createElement("img");

    move.className = "santa-move";
    float.className = "santa-float";
    img.className = "santa";
    img.src = IMG;

    const fromLeft = Math.random() < 0.5;
    const y = innerHeight * (0.25 + Math.random() * 0.4);
    const duration = 12000;

    move.style.top = y + "px";
    move.style.animation =
      `${fromLeft ? "moveLTR" : "moveRTL"} ${duration}ms linear forwards`;

    /*
      ภาพต้นฉบับหันขวา
      → ไปซ้าย (RTL) : ไม่กลับ
      → ไปขวา (LTR) : กลับ
    */
    img.style.transform = fromLeft ? "scaleX(1)" : "scaleX(-1)";

    float.appendChild(img);
    move.appendChild(float);
    layer.appendChild(move);

    setTimeout(() => move.remove(), duration + 500);
  }

  spawnSanta();
  setInterval(spawnSanta, 18000);
})();
</script>

<?php endif; ?>





    <body>
   <!-- <div id="snow" count="50"></div> -->
        <nav id="MainNav" class="navbar m-4 mt-2 p-2 glass navbar-expand-lg navbar-light sticky-top shadow-sm mt-0 mb-0 p-0 mb-3" >
            
      

   <style>
.container-s1 {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 0rem;
  border-radius: 20px;
  width: <?php echo isset($_SESSION['id']) ? '30%' : '20%'; ?>;
}

#MainNav {/* 20px = 10 ซ้าย + 10 ขวา */   /* กันการยุบตัว */
  transform: scaleX(0);
  transform-origin: center;  /* ยืดจากกลาง */
  animation: nav 1.8s ease forwards;
  animation-delay: 4s;
       /* หรือ fixed */
  top: 0;
}

@keyframes nav {
  0% {
    height: 0;
    transform: scaleX(0);
  }
  100% {
    height: 100%;
    transform: scaleX(1);
  }
}

#MainNav a,#MainNav button,#MainNav ul,#MainNav img {
  opacity: 0;
animation: navlink 1s ease forwards;
animation-delay: 5s;
}
@keyframes navlink {
  0% {opacity: 0;}
  100% {opacity: 1;}
}
@media screen and (max-width: 768px) {

#MainNav a,#MainNav button,#MainNav ul,#MainNav img {
  animation: none;
  opacity: 1;
}
.logo {
  opacity: 0;
animation: navlink 1s ease forwards;
animation-delay: 5s;
}
}
.container-s1 img {
  height: 50px;
  width: auto;
  transition: transform 0.3s ease;
}

.container-s1 img:hover {
  transform: scale(1.05);
}

/* ปุ่มค้นหา */
#openSearch {
  background: white;
  color: #8b2eff;
  border: 2px solid #b772ff;
  border-radius: 50px;
  font-weight: 600;
  padding: 8px 18px;
  transition: 0.3s;
}

#openSearch i {
  margin-right: 6px;
  transition: 0.3s;
}

#openSearch:hover {
  background: #b772ff;
  color: white;
}

#openSearch:hover i {
  color: white;
}
/* ✅ มือถือ */
@media (max-width: 768px) {
  .container-s1 {
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 1rem;
    border-radius: 1.5rem;
  }

  #openSearch {
    width: 100%;
    margin-top: 10px;
    padding: 10px;
    font-size: 1rem;
  }

  .container-s1 img {
    height: 55px;
  }
}
</style>

<div class="container-s1">
  <a class="navbar-brand" href="./home">
    <img class="logo" src="<?= $config['logo'] ?>" alt="Logo">
  </a>
  <button id="openSearch" class="btn">
    <i class="fa-duotone fa-magnifying-glass"></i> ค้นหาสินค้า
  </button>
</div>

</div>
</div>
<style>
    .container-s1 {
    padding-right: var(--bs-gutter-x, .75rem);
    padding-left: var(--bs-gutter-x, .75rem);
    margin-right: auto;
    margin-left: auto
    }
    .modal-content , .search-box {
        border-radius: 1rem;
    }
</style>
                <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-duotone fa-bars fa-fade"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php
                    // if(isset($_SESSION['id'])){
                    ?>
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">

                        <style>
                            .bg-main-opa-50 {
                                background: var(--main-opa-50);
                            }
                            .font-medium {
                                font-weight: 500;
                            }
                            .nav-link.active , .underline-active.active i{
                                color: var(--main) !important
                            }
                            .underline-active.active::after {
  width: 100%;
}
                        </style>

                      <a class="nav-link font-bold align-self-center underline-active me-2 <?php echo ($_GET['page'] == 'home' || !isset($_GET['page'])) ? 'active' : ''; ?>" 
   href="/home" >
   <i class="fa-duotone fa-home"></i>&nbsp;หน้าหลัก
</a>

<a class="nav-link font-bold align-self-center underline-active me-2 <?php echo ($_GET['page'] == 'shop') ? 'active' : ''; ?> <?php echo ($_GET['page'] == 'buy') ? 'active' : ''; ?>" 
   href="./shop" >
   <i class="fa-duotone fa-store"></i>&nbsp;ร้านค้า
</a>

<a class="nav-link font-bold align-self-center underline-active me-2 <?php echo ($_GET['page'] == 'random_wheel') ? 'active' : ''; ?>" 
   href="./random_wheel" >
   <i class="fa-duotone fa-dice"></i>&nbsp;มินิเกม
</a>

 
                      

                        <?php if ($byshop_status == "on") : ?>
                            <a class="nav-link font-bold align-self-center underline-active me-2 <?php echo ($_GET['page'] == 'app' || !isset($_GET['page'])) ? 'active' : ''; ?>" aria-current="page" href="./app" >
                                <img src="https://www.nicepng.com/png/full/12-127235_netflix-logo-png.png" width="10" class="mb-1">&nbsp;แอพพรีเมี่ยม
                            </a>
                        <?php endif; ?>

                        <a class="nav-link font-bold align-self-center underline-active me-2 <?php echo (in_array($_GET['page'] ?? '', ['angpao', 'slip', 'redeem'])) ? 'active' : ''; ?>" aria-current="page" href="./angpao" ><i class="fa-duotone fa-wallet"></i>&nbsp;เติมเงิน</a>
                        <?php if($howtolink['status'] == "1"){ ?>
                        <a class="nav-link font-bold align-self-center underline-active me-2 <?php echo ($_GET['page'] == 'howto') ? 'active' : ''; ?>" aria-current="page" href="./howto" ><i class="fa-duotone fa-question"></i>&nbsp;วิธีใช้</a>
                        <?php } ?>
                        <a class="nav-link font-bold align-self-center underline-active me-2 <?php echo ($_GET['page'] == 'contact') ? 'active' : ''; ?>" aria-current="page" href="./contact" ><i class="fa-duotone fa-headset"></i>&nbsp;ติดต่อ</a>
                        
<button id="openSearchmb" class=" mobile-search-btn  text-center">
  <i class="fa-duotone fa-magnifying-glass"></i> ค้นหาสินค้า
</button>
                    </ul>
                    <?php
                    if (!isset($_SESSION['id'])) {
                    ?>
                        <ul class="navbar-nav ms-auto  mb-2 mb-lg-0 ml-2 " style="margin-right: 1rem;">
                            <li class="nav-item ms-3 mb-2 align-self-center mx-2 ">
                                <a class="nav-link font-bold" aria-current="page" href="login"><i class="fa-duotone fa-sign-in" style="font-weight: 700; "></i>&nbsp;เข้าสู่ระบบ</a>
                            </li>
                            <li class="nav-item ms-3 mb-2 align-self-center">
                                <a class="btn bg-main-opa-50 font-bold" aria-current="page" href="register" style="border-radius: 1vh; color:var(--main)"><i class="fa-duotone fa-user-plus" style="font-weight: 700;color:var(--main)"></i>&nbsp;สมัครสมาชิก</a>
                            </li>
                        </ul>
                    <?php
                    } else {
                    ?>
        <ul class="navbar-nav justify-content-center ms-auto mb-2 mb-lg-0">
  <li class="nav-item position-relative" id="profileWrapper">
    <!-- ปุ่มโปรไฟล์ -->
    <a href="#" class="nav-link font-bold d-flex align-items-center" id="profileBtn">
      <img class="rounded-circle me-2"
           src="<?= htmlspecialchars($user['profile'] ?? 'https://via.placeholder.com/40x40?text=U'); ?>"
           width="35" height="35">
    </a>

    <!-- ✅ เมนู dropdown -->
    <div class="profile-menu <?php echo $bg;?>" id="profileMenu">
      <div class="d-flex align-items-center p-3 border-bottom">
        <img src="<?= htmlspecialchars($user['profile'] ?? 'https://via.placeholder.com/40x40?text=U'); ?>"
             class="rounded-circle me-2" width="45" height="45" style="object-fit:cover;">
        <div class="d-flex flex-column">
          <span class="fw-bold text-main"><?= htmlspecialchars($user['username']); ?></span>
          <small class="text-muted">
            ยอดเงินคงเหลือ: <span class="text-main"><?= number_format($user['point'], 1); ?> บาท</span>
          </small>
        </div>
      </div>

      <a class="profile-item" href="/profile"><i class="fa-duotone fa-gear fa-spin"></i> จัดการโปรไฟล์</a>
      <a class="profile-item" href="./my_order"><i class="fa-duotone fa-box"></i> Order ของคุณ</a>
      <a class="profile-item" href="./history"><i class="fa-duotone fa-clock-rotate-left"></i> ประวัติทั้งหมด</a>
      <a class="profile-item" href="./history_topup"><i class="fa-duotone fa-coins"></i> ประวัติเติมเงิน</a>

      <?php if ($byshop_status == "on") { ?>
        <a class="profile-item" href="./my_premiumapp"><i class="fa-duotone fa-star"></i> แอพ Premium</a>
      <?php } ?>

      <?php if ($user["rank"] == "1") { ?>
        <a class="profile-item" href="./backend"><i class="fa-duotone fa-gears"></i> จัดการหลังร้าน</a>
      <?php } ?>

      <hr class="m-0">
      <a class="profile-item text-danger it-d" href="./logout"><i class="fa-duotone fa-right-from-bracket"></i> ออกจากระบบ</a>
    </div>
  </li>
</ul>

<style>
.it-d {
  border-top: 1px solid #00000020;
}

/* กล่อง dropdown (Desktop ปกติ) */
.profile-menu {
  position: absolute;
  right: 0;
  top: 100%;
  min-width: 250px;
  background: <?php if($bg == 'bg-light'){ echo '#ffffff'; }else{ echo '#222222'; } ?>;
  border-radius: 1rem;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
  overflow: hidden;
  max-height: 0;
  transition: max-height 1s ease, opacity 0.3s ease;
  z-index: 9999;
}

/* hover (เฉพาะ desktop) */
@media (min-width: 577px) {
  #profileWrapper:hover .profile-menu {
    max-height: 700px;
    opacity: 1;
  }
}


@media (max-width: 768px) {
    .profile-menu {
  position: absolute;
  right: 0;
  top: 100%;
  min-width: 250px;
  background: <?php if($bg == 'bg-light'){ echo '#ffffff'; }else{ echo '#222222'; } ?>;
  border-radius: 1rem;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
  overflow: hidden;
  max-height: 0;
  transition: max-height 1s ease, opacity 0.3s ease;
  z-index: 9999;
}
}
/* รายการเมนู */
.profile-item {
  display: block;
  padding: 10px 18px;
  text-decoration: none;
  color: var(--font);
  border-bottom: 1px solid rgba(255,255,255,0.05);
  transition: all 0.2s ease;
}

.profile-item:hover {
  background: <?php if($bg == 'bg-light'){ echo '#f1f1f1'; }else{ echo '#1a1a1a'; } ?>;
  color: var(--main);
  transform: translateX(8px);
}

.profile-item i {
  width: 18px;
  text-align: center;
  margin-right: 8px;
}

/* ============================== */
/* 📱 มือถือ: เปิดขึ้นด้านบนแทน */
/* ============================== */
@media (max-width: 576px) {
  .profile-menu {
    top: auto;
    bottom: 0;
    right: 0;
    transform: translateY(10px);
    pointer-events: none;
    max-height: none;
    border-radius: 1rem;
    box-shadow: 0 -8px 25px rgba(0, 0, 0, 0.4);
    transition: transform 0.3s ease, opacity 0.3s ease;
  }

  .profile-menu.show {
    opacity: 1;
    transform: translateY(45px) translateX(25px);
    pointer-events: auto;
  }

  .profile-item:hover {
    transform: none;
  }
}
/* ❌ ปิด hover บนมือถือจริง ๆ */
@media (max-width: 576px) {
  #profileWrapper:hover .profile-menu {
    max-height: 0 !important;
    opacity: 0 !important;
  }
}
/* =============================== */
/* 🖥 Desktop: Hover แสดง dropdown */
/* =============================== */
@media (min-width: 577px) {
  #profileWrapper:hover .profile-menu {
    max-height: 700px;
    opacity: 1;
    pointer-events: auto;
  }
}

/* =============================== */
/* 📱 Mobile: ปิด hover effect ไปเลย */
/* =============================== */
@media (max-width: 576px) {
  #profileWrapper:hover .profile-menu {
    max-height: 0 !important;
    opacity: 0 !important;
    pointer-events: none !important;
  }
}

</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("profileBtn");
  const menu = document.getElementById("profileMenu");
  let menuOpen = false;

  // reset state ทุกครั้งเมื่อโหลด
  menu.classList.remove("show");
  menu.style.opacity = "0";
  menu.style.maxHeight = "0";

  btn.addEventListener("click", (e) => {
    e.preventDefault();
    menuOpen = !menuOpen;

    if (window.innerWidth <= 576) {
      // 📱 toggle ด้วย JS เท่านั้น
      if (menuOpen) {
        menu.classList.add("show");
        menu.style.opacity = "1";
        menu.style.maxHeight = "500px";
        document.addEventListener("click", closeOnOutsideClick);
      } else {
        menu.classList.remove("show");
        menu.style.opacity = "0";
        menu.style.maxHeight = "0";
        document.removeEventListener("click", closeOnOutsideClick);
      }
    } else {
      // 💻 Desktop
      if (menuOpen) openMenu();
      else closeMenu();
    }
  });

  function openMenu() {
    menu.style.maxHeight = "700px";
    menu.style.opacity = "1";
  }
  function closeMenu() {
    menu.style.maxHeight = "0";
    menu.style.opacity = "0";
  }

  function closeOnOutsideClick(e) {
    if (!e.target.closest("#profileWrapper")) {
      menu.classList.remove("show");
      menu.style.opacity = "0";
      menu.style.maxHeight = "0";
      menuOpen = false;
      document.removeEventListener("click", closeOnOutsideClick);
    }
  }
});

</script>

<script>
document.getElementById("search").addEventListener("keyup", function(){
    const query = this.value.trim();
    const resultBox = document.getElementById("search-result");

    if(query.length === 0){
        resultBox.style.display = "none";
        resultBox.innerHTML = "";
        return;
    }

    fetch("search.php?q=" + encodeURIComponent(query))
    .then(res => res.text())
    .then(data => {
        resultBox.innerHTML = data;
        resultBox.style.display = "block";
    });
});
</script>






   <style>
  

.container-search {
    flex-grow: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 1rem;
    margin-right: 1rem;
    width: 10%;
}
  /* Animation when dropdown opens */
  .dropdown-menu {
    transform-origin: top right;
    animation: dropdownFade 0.3s ease-in-out;
  }

  @keyframes dropdownFade {
    0% {
      opacity: 0;
      transform: scale(0.95) translateY(-10px);
    }
    100% {
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }

  
  .card-anim-main {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
.card-anim-main:hover {
    transform: scale(1.02) translateY(-5px);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

  .dropdown-item i {
    width: 1.2rem;
    text-align: center;
    margin-right: 0.5rem;
  }

  .dropdown-menu  {
    border-radius: 0.75rem;
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    padding: 0.5rem 0;
    min-width: 260px;
  }
.dropdown-menu-dark .dropdown-item{
    
    color: #f8f9fa;
}


   .dropdown-menu .dropdown-item, .dropdown-menu-light .dropdown-item, .dropdown-menu-dark .dropdown-item {
    transition: all 0.2s ease-in-out;
  }
 .dropdown-menu-light .dropdown-item:hover {
    color: var(--main);
    background-color:#cacaca;
    font-weight: 600;
    transform: scale(1.02);
}


    .dropdown-menu-dark .dropdown-item:hover {
    transform: scale(1.02);
    background-color: #222222;
    color: var(--main);
    font-weight: 600;
  }
  .btn-check:focus + .btn,
.btn-check:active + .btn {
  box-shadow: none !important;
  outline: none !important;
}
.btn-check:focus+.btn, .btn:focus {
  box-shadow: none !important;
  outline: none !important;
}
</style>

<style>
/* ปิดปุ่มมือถือทั้งหมดใน Desktop */
#openSearchmb {
  display: none !important;
  visibility: hidden !important;
  opacity: 0 !important;
  pointer-events: none !important;
}

/* แสดงเฉพาะบนจอเล็ก */
@media (max-width: 768px) {
  #openSearch {
    display: none !important;
  }
  #openSearchmb {
    display: inline-flex !important;
    visibility: visible !important;
    opacity: 1 !important;
    pointer-events: auto !important;
  }
}
</style>

                    <?php
                    }
                    ?>
                </div>
                </div>

            </div>
        </nav>
        <!-- Popup ค้นหา -->
<div id="searchModal"
     class="search-modal position-fixed top-0 start-0 w-100 h-100 d-none"
     style="z-index:1055;background:rgba(0,0,0,0.6);backdrop-filter:blur(12px);">
  <div class="d-flex justify-content-center align-items-start mt-5">
    <div class="search-box  <?= $bg ?> shadow p-3"
         style="width:90%;max-width:600px;">
      <div class="input-group mb-2 search-input">
        <span class="input-group-text bg-transparent border-0 text-white">
          <i class="fa-duotone fa-magnifying-glass"></i>
        </span>
        <input type="text" id="searchInput"
               class="form-control border-0 bg-transparent <?php if($bg == "bg-light"){ echo "text-dark";}else{ echo "text-white";} ?>"
               placeholder="ค้นหาสินค้าที่คุณต้องการ..." autocomplete="off">
      </div>
      <div id="searchResults" class="list-group list-group-flush"></div>
    </div>
  </div>
</div>



<style>
    .smodal {
    transition: opacity 0.3s ease;
    border-radius: 1rem;
    }
    .search-modal {
  background: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(10px);
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease;
}
  #search-result a {
  background: var(--main-opa-50);
  color: var(--font);
  transition: 0.2s;
}
.text-color {
  color: var(--font);
}
#search-result a:hover {
  background: var(--main);
  color: #fff;
}
#openSearch {
    border-radius: 1rem;
    top: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    color: var(--main);
    border: 1px solid var(--main-opa-50);
    background: var(--main-opa-25);
    justify-self: center;
    left: 0;
}

#openSearch i , #openSearchmb i {
    color: var(--main);
}
#openSearchmb i {
    margin-top: 2px;
}
#openSearchmb {
    display: none; /* ← เพิ่ม ; ตรงนี้ */
    color: var(--main);
    border-radius: 1rem;
    top: 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: 1px solid var(--main-opa-50);
    background: var(--main-opa-25);
    justify-self: center;
    left: 0;
    margin: auto;
}

@media screen and (max-width: 1024px) {
     #openSearch { font-size: .8rem; margin-bottom: 2rem}
     .nav-link { font-size: .9rem}
}
@media screen and (max-width: 768px) {
    #openSearch {
        display: none;
    }
    #openSearchmb {
        display: block;
    }
}
.search-input {
    border-bottom: 1px solid <?php  if($bg == "bg-light"){ echo "#00000040";}else{ echo "#ffffff40";} ?>;
    box-shadow: none;
}
.search-input input:focus {
  box-shadow: none;
  border-color: <?php  if($bg == "bg-light"){ echo "#00000080";}else{ echo "#ffffff80";} ?>;
}
.search-item {
  cursor: pointer;
  transition: background 0.2s ease;
  background: <?php  if($bg == "bg-light"){ echo "#ffffff40";}else{ echo "#25252540";} ?>;
}
.search-item:hover {
  background: <?php  if($bg == "bg-light"){ echo "#ffffff80";}else{ echo "#25252580";} ?>;
}

.search-modal.show {
  opacity: 1;
  pointer-events: auto;
}

.search-box {
  background: rgba(30, 30, 30, 0.9);
  color: white;
  transform: scale(0.9);
  opacity: 0;
  transition: transform 0.25s ease, opacity 0.25s ease;
}

.search-modal.show .search-box {
  transform: scale(1);
  opacity: 1;
}

.search-muted {
    text-align: center;
  background: transparent !important;
}
</style>
<script>
const openBtn = document.getElementById('openSearch');
const modal = document.getElementById('searchModal');
const input = document.getElementById('searchInput');
const resultsBox = document.getElementById('searchResults');
const openBtnMb = document.getElementById('openSearchmb');
// เปิด modal พร้อมแอนิเมชัน
openBtn.addEventListener('click', () => {
  modal.classList.remove('d-none');
  setTimeout(() => modal.classList.add('show'), 10); // หน่วงให้ transition ทำงาน
  input.focus();
  resultsBox.innerHTML = showRecentProducts?.() || '';
});
// ✅ ปุ่มเปิด modal สำหรับมือถือ
if (openBtnMb) {
  openBtnMb.addEventListener('click', () => {
    modal.classList.remove('d-none');
    setTimeout(() => modal.classList.add('show'), 10);
    input.focus();
    resultsBox.innerHTML = showRecentProducts?.() || '';
  });
}

// ปิด modal เมื่อคลิกนอกกล่อง
// ปิด modal เมื่อคลิกนอกกล่อง
modal.addEventListener('click', (e) => {
  const box = document.querySelector('#searchModal .search-box');
  if (!box.contains(e.target)) {
    closeModal();
  }
});
// กันไม่ให้คลิกในกล่องแล้ว modal ปิด
document.querySelector('#searchModal .search-box').addEventListener('click', (e) => e.stopPropagation());

// ปิดด้วยคีย์ ESC
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closeModal();
});
function closeModal(){
  modal.classList.remove('show');
  setTimeout(() => modal.classList.add('d-none'), 300); // 0.3s = ระยะเวลา fade out
}

// โหลดผลลัพธ์แบบ realtime
input.addEventListener('keyup', () => {
  const q = input.value.trim();
  if (!q) {
    resultsBox.innerHTML = showRecentProducts();
    return;
  }
  fetch("search.php?q=" + encodeURIComponent(q))
    .then(res => res.text())
    .then(data => {
      resultsBox.innerHTML = data;

      // เมื่อคลิกผลลัพธ์ ให้บันทึกสินค้าใน localStorage
      resultsBox.querySelectorAll('.search-item').forEach(item => {
        item.addEventListener('click', () => {
          const product = {
            name: item.dataset.name,
            image: item.dataset.image,
            price: item.dataset.price,
            link: item.href
          };
          saveProduct(product);
        });
      });
    });
});

// ========================
// ฟังก์ชันบันทึกสินค้า
// ========================
function saveProduct(product){
  let history = JSON.parse(localStorage.getItem('productHistory') || '[]');

  // ป้องกันซ้ำ
  history = history.filter(p => p.name !== product.name);

  // เก็บล่าสุดไว้บนสุด
  history.unshift(product);
  if (history.length > 5) history.pop();
  localStorage.setItem('productHistory', JSON.stringify(history));
}

// ========================
// ฟังก์ชันแสดงประวัติ
// ========================
function showRecentProducts(){
  let history = JSON.parse(localStorage.getItem('productHistory') || '[]');
  if (history.length === 0) {
    return `<div class="list-group-item text-muted rounded search-muted">ยังไม่มีประวัติการค้นหา</div>`;
  }

  // ✅ สร้าง HTML ของประวัติ
  const html = history.map(p => `
    <a href="${p.link}" 
       class="list-group-item list-group-item-action d-flex align-items-center recent-item rounded mb-1 search-item"
       data-name="${p.name}" data-price="${p.price}" data-image="${p.image}" data-link="${p.link}">
      <img src="${p.image}" height="55" class="rounded me-3">
      <div>
        <div class="fw-bold">${p.name}</div>
        <small class="text-muted">${p.price} บาท</small>
      </div>
      <i class="fa fa-clock ms-auto text-secondary"></i>
    </a>
  `).join('');

  // ✅ หลังจาก DOM render แล้ว ผูก event click
  setTimeout(() => {
    document.querySelectorAll('.recent-item').forEach(item => {
      item.addEventListener('click', () => {
        const product = {
          name: item.dataset.name,
          image: item.dataset.image,
          price: item.dataset.price,
          link: item.dataset.link
        };
        updateRecentProduct(product);
      });
    });
  }, 100);

  return html;
}

// ✅ ฟังก์ชัน: ย้ายสินค้าที่คลิกขึ้นบนสุด
function updateRecentProduct(product) {
  let history = JSON.parse(localStorage.getItem('productHistory') || '[]');
  history = history.filter(p => p.name !== product.name); // ลบของเก่า
  history.unshift(product); // ใส่บนสุด
  if (history.length > 5) history.pop(); // จำกัด 5 ชิ้น
  localStorage.setItem('productHistory', JSON.stringify(history));
}

</script>
        <style>
            #searchModal {
  pointer-events: auto;
  z-index: 1055;
}

            .glass {
                background: <?php if($bg == "bg-light"){ echo "#ffffff";}else{ echo "#252525";} ?>;
                backdrop-filter: blur(2px)
            }
            #MainNav {
  transition: all 1s ease;
  border-radius: 4vh;
  z-index: 99;
}
#MainNav.scrolled {
  top: 10px;
  box-shadow: 0 6px 25px rgba(0,0,0,0.45);
  border-radius: 4vh;
}

        </style>
  <script>
window.addEventListener("scroll", () => {
  const nav = document.getElementById("MainNav");
  if (window.scrollY > 20) {
    nav.classList.add("scrolled");
  } else {
    nav.classList.remove("scrolled");
  }
});
</script>

        <?php
        function admin($user)
        {
            if (isset($_SESSION['id']) && $user["rank"] == "1") {
                return true;
            } else {
                return false;
            }
        }
        if (isset($_GET['page']) && $_GET['page'] == "home") {
            require_once('page/simple.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "forgot_password" && !isset($_SESSION['id'])) {
            require_once('page/forgot_password.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "reset_password" && !isset($_SESSION['id'])) {
            require_once('page/reset_password.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "login" && !isset($_SESSION['id'])) {
             require_once('page/login.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "logout" && isset($_SESSION['id'])) {
             require_once('page/logout.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "angpao") {
            if (isset($_SESSION['id'])) {
                require_once('page/angpao.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "profile") {
            if (isset($_SESSION['id'])) {
                require_once('page/profile.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "payment") {
            if (isset($_SESSION['id'])) {
                require_once('page/payment.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "contact") {
            require_once('page/contact.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "howto") {
            require_once('page/howto.php');
        } elseif (isset($_GET['page']) && $_GET['page'] == "slip") {
            if (isset($_SESSION['id'])) {
                require_once('page/slip.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "c_recom_manage") {
            if (isset($_SESSION['id'])) {
                require_once('page/c_recom_manage.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "connect") {
            if (isset($_SESSION['id'])) {
                require_once('page/connect.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "payment_manage") {
            if (isset($_SESSION['id'])) {
                require_once('page/payment_manage.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "service_manage_cate") {
            if (isset($_SESSION['id'])) {
                require_once('page/service_manage_cate.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "service_manage_main") {
            if (isset($_SESSION['id'])) {
                require_once('page/service_manage_main.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "redeem") {
            if (isset($_SESSION['id'])) {
                require_once('page/redeem.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "id") {
            if (isset($_SESSION['id'])) {
                require_once('page/id.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "information") {
            if (isset($_SESSION['id'])) {
                require_once('page/information.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "gp") {
            if (isset($_SESSION['id'])) {
                require_once('page/gp.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "product" && isset($_GET['id'])) {
            if (isset($_SESSION['id'])) {
                require_once('page/product.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "slidebloxfruit") {
            if (isset($_SESSION['id'])) {
                require_once('page/csgo_1.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "id_p" && isset($_GET['id'])) {
            if (isset($_SESSION['id'])) {
                require_once('page/id_p.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "random_wheel") {
            if (isset($_SESSION['id'])) {
                require_once('page/random_wheel.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "play" && isset($_GET['wheel'])) {
            if (isset($_SESSION['id'])) {
                require_once('page/play.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "history") {
            if (isset($_SESSION['id'])) {
                require_once('page/profile.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "history_log") {
            if (isset($_SESSION['id'])) {
                require_once('page/history_log.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "shop") {
            if (isset($_SESSION['id'])) {
                require_once('page/shop.php');
            } else {
                require_once('page/login.php');
            }

        } elseif (isset($_GET['page']) && $_GET['page'] == "category") {
            if (isset($_SESSION['id'])) {
                require_once('page/category.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "shop_manage") {
            if (isset($_SESSION['id'])) {
                require_once('page/shop_manage.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "buy") {
            if (isset($_SESSION['id'])) {
                require_once('page/buy.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "history_product") {
            if (isset($_SESSION['id'])) {
                require_once('page/history_product.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "history_minigame") {
            if (isset($_SESSION['id'])) {
                require_once('page/history_minigame.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "history_program") {
            if (isset($_SESSION['id'])) {
                require_once('page/history_program.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "service_buy") {
            if (isset($_SESSION['id'])) {
                require_once('page/service_buy.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "my_order") {
            if (isset($_SESSION['id'])) {
                require_once('page/my_order.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "app") {
            if (isset($_SESSION['id'])) {
                require_once('page/premiumapp.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "buyapp") {
            if (isset($_SESSION['id'])) {
                require_once('page/buyapp.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "my_premiumapp") {
            if (isset($_SESSION['id'])) {
                require_once('page/myapp.php');
            } else {
                require_once('page/login.php');
            }
        } elseif (isset($_GET['page']) && $_GET['page'] == "register" && !isset($_SESSION['id'])) {
            require_once('page/register.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "loading_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "user_edit") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "topup_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "service_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "product_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "manage_theme") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "manage_howto") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "stock_manage" && $_GET['id'] != "") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel_cate") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "wheel") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "stock_wheel" && $_GET['id'] != "") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "code_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "category_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_buy_history") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_topup_history") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "backend_app_history") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "carousel_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "recom_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "crecom_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "slip_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "website") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_success") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_unsuccess") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_temp") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "captcha_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "discount_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "particle_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "apibyshop") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "discord_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "contact_manage") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "order_product") {
            require_once('page/backend/menu_manage.php');
        } elseif (admin($user) && isset($_GET['page']) && $_GET['page'] == "helpbutton") {
            require_once('page/backend/menu_manage.php');
        } else {
            require_once('page/simple.php');
        }
        ?>
        
        <div class="modal fade" id="buy_count" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title"><i class="fa-duotone fa-cart-shopping-fa-duotonet"></i>&nbsp;&nbsp;สั่งซื้อสินค้า</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3 pb-2">
                        <div class="row mt-2">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-auto">จำนวนสินค้าที่จะซื้อ</div>
                            <div class="col">
                                <hr>
                            </div>
                            <div class="mb-2">
                            </div>
                            <div class="d-flex justify-content-between pe-3 ps-3 mt-2">
                                <span class="m-0 align-self-center">สินค้าคงเหลือ <?php echo $count; ?> ชิ้น</span>
                                <span class="m-0 align-self-center" style="color: white; padding: 3.5px 5px; border-radius: 1vh; background-color: var(--main);">ยอดเงินคงเหลือ <?php echo $user["point"]; ?></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="shop-btn" class="btn w-100" style="background-color: var(--main); color: #fff;" onclick="buybox()" data-id="" data-name="" data-price=""><i class=" fa-duotone fa-cart-shopping-fa-duotonet"></i>&nbsp;&nbsp;สั่งซื้้อเลย</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
    <footer class="<?= $bg ?> shadow-sm pt-3">
  <div class="container">
    <div class="row align-items-center text-center text-lg-start">

      <!-- ✅ โลโก้ฝั่งซ้าย -->
      <div class="col-12 col-lg-4 mb-3 mb-lg-0 text-lg-start text-center">
        <img src="<?= $config['logo']; ?>" width="180" class="mb-2 bounce">
      
      </div>

      <!-- ช่องทางการติดต่อ -->
      <div class="col-12 col-lg-4 mb-3 mb-lg-0 text-start">
          <h5 class="mt-2 mb-1"><?= $config['name']; ?></h5>
        <p class="mb-0 small text-muted"><?= $config['des']; ?></p>
        <h5>ทางลัด</h5>
        <a href="/home" class="text-muted text-decoration-none d-block mb-1 t-h">
          <i class="fa-solid fa-chevron-right text-muted"></i></i> หน้าหลัก
        </a>
        <a href="/shop" class="text-muted text-decoration-none d-block mb-1 t-h">
          <i class="fa-solid fa-chevron-right text-muted"></i></i> ซื้อสินค้า
        </a>
        <a href="/random_wheel" class="text-muted text-decoration-none d-block mb-1 t-h">
          <i class="fa-solid fa-chevron-right text-muted"></i></i> มินิเกม
        </a>
        <a href="/contact" class="text-muted text-decoration-none d-block mb-1 t-h">
          <i class="fa-solid fa-chevron-right text-muted"></i></i> ช่องทางติดต่อ
        </a>
      </div>

      <style>
        .bounce {
          animation: 1s bounce infinite;
        }
    @keyframes bounce {
  0%, 100% {
    transform: translateY(0) scale(1, 1);
  }
  30% {
    transform: translateY(-12px) scale(1.1, 0.9); /* เด้งขึ้น ยืดแนวนอน */
  }
  50% {
    transform: translateY(0) scale(0.9, 1); /* หดตอนลง */
  }
  70% {
    transform: translateY(-6px) scale(1.05, 0.95); /* เด้งเล็ก */
  }
}

        .t-h {
          transition: 1s ease
        }
        .t-h:hover i {
          animation: 1s t-i infinite;
          transform: translateX(3px);
        }

        @keyframes t-i {
          0%,100% { transform: translateX(0) }
          50% { transform: translateX(3px) }
        }
      </style>

      <!-- ฝั่งขวา (Facebook Widget หรืออื่นๆ) -->
      <div class="col-12 col-lg-4 text-center text-lg-end">
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous"
          src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v16.0"
          nonce="ExHRiLWq"></script>
      </div>
    </div>

    <hr>

    <div class="text-center">
      <p class="mb-1">
        <strong><i class="fa-duotone fa-copyright"></i>
        2023 <?= $config['name']; ?>, All rights reserved.</strong>
      </p>
      <small>
        <i class="fa-duotone fa-cog fa-spin"></i>&nbsp; XDNVC - Xdnvc Cloud.
        <a href="https://www.facebook.com/profile.php?id=100089755431618"
           class="text-decoration-none" style="color:#39b3fe">
          ติดต่อเจ้าของร้านไม่ได้ / แจ้งปัญหาร้านค้าโกง
        </a>
      </small>
    </div>
  </div>
</footer>

            <script>
                async function shake_alert(status, result) {
                    if (status) {
                        if (result.salt == "prize") {
                            // await GShake();
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: result.message
                            }).then(function() {
                                window.location = "/history";
                            });
                        } else {
                            await GShake();
                            Swal.fire({
                                icon: 'error',
                                title: 'เสียใจด้วย',
                                text: result.message
                            });
                        }
                    } else {
                        if (result.salt == "salt") {
                            // await GShake();
                            Swal.fire({
                                icon: 'error',
                                title: 'เสียใจด้วย',
                                text: result.message
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: result.message
                            });
                        }
                    }
                }

          function buybox() {
    var name = $("#shop-btn").attr("data-name");
    var basePrice = parseFloat($("#shop-btn").attr("data-price"));
    var count = parseInt($("#b_count").val());
    var discountCode = $("#discountCode").val().trim(); // ✅ รับโค้ดส่วนลด
    var discountValue = 0;
    var discountType = null;
    var finalPrice = basePrice * count;

    // ✅ ตรวจสอบว่ามีส่วนลดหรือไม่ (จากข้อความใน #discountResult)
    const discountInfo = $("#discountResult").text();
    if (discountInfo.includes("%")) {
        const percent = parseFloat(discountInfo.match(/\d+/)[0] || 0);
        discountType = "percent";
        discountValue = percent;
        finalPrice = finalPrice - (finalPrice * (percent / 100));
    } else if (discountInfo.includes("บาท")) {
        const baht = parseFloat(discountInfo.match(/\d+/)[0] || 0);
        discountType = "fixed";
        discountValue = baht;
        finalPrice = Math.max(finalPrice - baht, 0);
    }

    // ✅ เตรียมข้อมูลส่งไป PHP
    var formData = new FormData();
    formData.append('id', $("#shop-btn").attr("data-id"));
    formData.append('count', count);
    if (discountCode) formData.append('discount_code', discountCode); // ส่งโค้ดส่วนลดด้วย

    // ✅ ยืนยันราคาหลังหักส่วนลด
    Swal.fire({
        title: 'ยืนยันการสั่งซื้อ?',
        html: `
            <div style="text-align:left; color: #000">
                <b style="color: #000">สินค้า:</b> ${name}<br>
                <b style="color: #000">จำนวน:</b> ${count} ชิ้น<br>
                <b style="color: #000">ราคาต่อชิ้น:</b> ${basePrice.toLocaleString()} บาท<br>
                ${discountCode ? `<b style="color: #000">โค้ดส่วนลด:</b> ${discountCode} (${discountType === "percent" ? discountValue + "%" : discountValue + " บาท"})<br>` : ""}
                <hr>
                <b style="color: #000">ราคาสุทธิ:</b> <span style="color:var(--main);font-size:1.2em;">${finalPrice.toLocaleString()} บาท</span>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ซื้อเลย'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'services/buybox.php',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btn_buyid').attr('disabled', 'disabled');
                    $('#btn_buyid').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>รอสักครู่...');
                },
            }).done(function(res) {
                console.log(res);
                shake_alert(true, res);
                $('#btn_buyid').html('<i class="fa-duotone fa-shopping-cart mr-1"></i>สั่งซื้อสินค้า');
                $('#btn_buyid').removeAttr('disabled');
            }).fail(function(jqXHR) {
                console.log(jqXHR);
                var res = jqXHR.responseJSON;
                shake_alert(false, res);
                $('#btn_buyid').html('<i class="fa-duotone fa-shopping-cart mr-1"></i>สั่งซื้อสินค้า');
                $('#btn_buyid').removeAttr('disabled');
            });
        }
    });
}


                
            </script>
            <script>
                // var options = {
                //     strings: [`<?php //echo $s_info['des']; 
                                    ?>`],
                //     typeSpeed: 40,
                //     color: "#fff"
                // };
  // var typed = new Typed('#typing', options);
            </script>
            <!-- ตัวไฟล์กัน f12 และ คลิ๊กขวา -->
         <script>

</script>
<script>
    setTimeout(() => {
     window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }, 2000);
</script>


    </body>

    </html>
<?php
} else {
    require_once('home.php');
}
?>