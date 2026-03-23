<?php
if (isset($_GET['wheel'])) {
    $find = dd_q("SELECT * FROM wheel WHERE id = ? ", [$_GET['wheel']]);
    if ($find->rowCount() == 1) {
        $wheel = $find->fetch(PDO::FETCH_ASSOC);

        // กำหนดโหมดจาก field mode ใน table wheel
        // รองรับ: csgo, box, crane, normal(ค่าเริ่มต้น)
        $mode = 'normal';
        if (!empty($wheel['mode'])) {
            if ($wheel['mode'] === 'csgo') {
                $mode = 'csgo';
            } elseif ($wheel['mode'] === 'box') {
                $mode = 'box';
            } elseif ($wheel['mode'] === 'crane') {
                $mode = 'crane';
            }
        }
?>
        <script src="/assets/easywheel/easywheel.js"></script>
        <link rel="stylesheet" href="/assets/easywheel/easywheel.css">

        <style>
            img.asdas {
                width: 110px;
                transform: rotate(-260deg) translate(-16px, -20%);
                max-width: 190px !important;
                margin-top: 23px;
                height: auto !important;
            }

            /* :root {
            --main-color: <?= $config["main_color"]; ?>;
            --sub-color: <?= $config["sec_color"]; ?>;
            --font-color: <?= $config["font_color"]; ?>;
            }

            .btn-main {
            font-size: 15px;
            padding: 10px 25px;
            border-radius: 1vh;
            text-decoration: none;
            color: var(--main-color);
            font-family: 'Prompt', sans-serif;
            border: 2.5px dotted var(--main-color);
            filter: drop-shadow(0 0 90px var(--main-color));
            transition: all .5s ease;
            }

            .btn-main:hover {
                color: white;
                background-color: var(--main-color);
                border: 2.5px solid var(--main-color);
            } */

            @media screen and (max-width: 767px) {
                img.asdas {
                    width: 120px;
                    /* width: 140px; */
                    transform: rotate(-272deg) translate(3px, -43%);
                }
            }

            @media screen and (max-width: 577px) {
                img.asdas {
                    width: 140px;
                    /* width: 160px; */
                }
            }

            @media screen and (max-width: 460px) {
                img.asdas {
                    width: 125px;
                    /* width: 145px; */
                    margin: 15px;
                }
            }

            @media screen and (max-width: 430px) {
                img.asdas {
                    width: 120px;
                    /* width: 140px; */
                    transform: rotate(-272deg) translate(3px, -49%);
                    padding: 10px;
                    margin: 15px;
                }
            }

            @media screen and (max-width: 400px) {
                img.asdas {
                    width: 105px;
                    /* width: 125px; */
                    margin: 15px;
                    padding: 10px;
                }
            }

            @media screen and (max-width: 370px) {
                img.asdas {
                    width: 95px;
                    /* width: 115px; */
                    transform: rotate(-272deg) translate(3px, -51%);
                    margin: 15px;
                    padding: 10px;
                }
            }

            @media screen and (max-width: 350px) {
                img.asdas {
                    width: 80px;
                    margin: 15px;
                    padding: 10px;
                    /* width: 80px; */
                }
            }
        </style>

        <style>
            img.spin-reward {
                transform: rotate(-260deg) translate(-16px, -20%) translateY(-10px) !important;
                max-height: 150px;
                width: auto;
            }

            @media only screen and (max-width: 770px) {
                img.spin-reward {
                    max-height: 130px;
                }
            }

            @media only screen and (max-width: 420px) {
                img.spin-reward {
                    max-height: 100px;
                }
            }

            /* ---------- CSGO SLIDER MODE ---------- */
            .csgo-roll-wrapper {
                position: relative;
                overflow: hidden;
                width: 100%;
                height: 120px; /* แก้เว้นวรรคผิดเป็น 120px ปกติ */
                background: #111;
                border-radius: 10px;
                border: 2px solid var(--main);
                margin-bottom: 15px;
            }

            .csgo-roll {
                display: flex;
                align-items: center;
                height: 100%;
                transform: translate3d(0, 0, 0);
            }

            .csgo-item {
                flex: 0 0 90px;      /* จอใหญ่: เห็นใหญ่ ๆ ชัด ๆ */
                margin: 0 2px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 4px;
                box-shadow: 0 0 8px rgba(0, 0, 0, 0.4);
                height: 90%;
            }

            .csgo-item img {
                border-radius: 8px;
                width: 100%;
                transform: rotate(0) translate(0) translateY(0) !important;
            }

            /* ---------------- มือถือ / แท็บเล็ต: อยากให้เห็นหลายช่องขึ้น ---------------- */
            @media (max-width: 768px) {
                .csgo-roll-wrapper {
                    height: 105px;
                }

                .csgo-item {
                    flex: 0 0 70px;   /* เล็กลง → เห็นเยอะขึ้นในหนึ่งจอ */
                    margin: 0 2px;
                    height: 85%;
                }
            }

            @media (max-width: 480px) {
                .csgo-roll-wrapper {
                    height: 95px;
                }

                .csgo-item {
                    flex: 0 0 60px;   /* มือถือเล็ก: ลดอีก เห็นได้หลายช่อง */
                    margin: 0 1px;
                    height: 80%;
                }

                .csgo-item img {
                    border-radius: 6px;
                }
            }

            .csgo-marker {
                position: absolute;
                top: -5px;             /* เลื่อนขึ้นเล็กน้อย */
                left: 50%;
                width: 40px;
                height: 40px;
                transform: translateX(-50%);
                background: url('https://cdn-icons-png.flaticon.com/128/9131/9131546.png') no-repeat center;
                background-size: contain;
                z-index: 99;
                pointer-events: none; /* ป้องกันคลิกโดน */
            }

            @media only screen and (max-width: 576px) {
                .csgo-marker {
                    width: 32px;
                    height: 32px;
                    top: -8px;
                }
            }

            @media only screen and (max-width: 576px) {
                .csgo-roll-wrapper {
                    height: 120px;
                }

                .csgo-item {
                    flex: 0 0 80px;
                }

                .csgo-item img {
                    max-height: 70px;
                }
            }

            /* ---------- BOX MODE ---------- */
            #box-container {
                width: 220px;
                margin: 15px auto;
                text-align: center;
                position: relative;
            }

            #box-img {
                width: 120%;
                max-width: 220px;
                cursor: pointer;
                user-select: none;
            }

            .box-shake {
                animation: boxShake .6s ease-in-out infinite;
            }

            @keyframes boxShake {
                0%   { transform: translateX(0) rotate(0deg); }
                20%  { transform: translateX(-3px) rotate(-1deg); }
                40%  { transform: translateX(3px) rotate(1deg); }
                60%  { transform: translateX(-3px) rotate(-1deg); }
                80%  { transform: translateX(3px) rotate(1deg); }
                100% { transform: translateX(0) rotate(0deg); }
            }

            .box-open {
                animation: boxPop .4s ease-out forwards;
            }

            @keyframes boxPop {
                0%   { transform: scale(0.8); opacity: 0; }
                60%  { transform: scale(1.15); opacity: 1; }
                100% { transform: scale(1); }
            }

            /* รูปของรางวัลเด้งออกจากกล่อง */
            @keyframes prizePop {
                0% { transform: scale(0.3); opacity: 0; }
                60% { transform: scale(1.2); opacity: 1; }
                100% { transform: scale(1); }
            }

            .prize-pop {
                animation: prizePop .45s ease-out forwards;
            }

            /* ---------- CRANE MACHINE MODE (ตู้คีบตุ๊กตา) ---------- */
            .crane-machine {
                position: relative;
                width: 100%;
                max-width: 600px;
                margin: 20px auto;
                background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
                border: 6px solid var(--main);
                border-radius: 20px;
                padding: 25px;
                box-shadow: 
                    0 20px 60px rgba(0,0,0,0.6),
                    inset 0 0 30px rgba(0,0,0,0.3),
                    0 0 20px rgba(var(--main-rgb), 0.3);
            }

            .crane-display {
                position: relative;
                width: 100%;
                height: 450px;
                background: linear-gradient(180deg, #87ceeb 0%, #b8e0f5 30%, #e0f6ff 60%, #f8fcff 100%);
                border-radius: 15px;
                overflow: hidden;
                margin-bottom: 15px;
                box-shadow: 
                    inset 0 0 50px rgba(135, 206, 235, 0.3),
                    0 10px 30px rgba(0,0,0,0.3);
                border: 3px solid rgba(255,255,255,0.3);
            }


            .crane-prize-container {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 65%;
                display: flex;
                flex-wrap: wrap;
                align-items: flex-end;
                justify-content: center;
                padding: 15px;
                gap: 12px;
                z-index: 2;
            }

            .crane-prize-item {
                width: 85px;
                height: 85px;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 
                    0 6px 12px rgba(0,0,0,0.4),
                    inset 0 2px 4px rgba(255,255,255,0.2);
                transition: transform 0.3s, box-shadow 0.3s;
                border: 2px solid rgba(255,255,255,0.5);
                position: relative;
                background: #fff;
            }

            .crane-prize-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 16px rgba(0,0,0,0.5);
            }

            .crane-prize-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .crane-prize-item.captured {
                position: absolute;
                z-index: 100;
                pointer-events: none;
            }

            .crane-arm-wrapper {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 200px;
                height: 100%;
                z-index: 10;
                pointer-events: none;
            }

            .crane-arm {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 14px;
                height: 180px;
                background: linear-gradient(90deg, 
                    #5a6578 0%, 
                    #4a5568 25%,
                    #3a4558 50%,
                    #4a5568 75%,
                    #5a6578 100%);
                transform-origin: top center;
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 11;
                box-shadow: 
                    0 4px 12px rgba(0,0,0,0.5),
                    inset 2px 0 6px rgba(255,255,255,0.15),
                    inset -2px 0 6px rgba(0,0,0,0.3);
                border-radius: 7px;
                border: 1px solid rgba(0,0,0,0.2);
            }

            .crane-claw-wrapper {
                position: absolute;
                bottom: -25px;
                left: 50%;
                transform: translateX(-50%);
                width: 100px;
                height: 140px;
                z-index: 12;
            }

            /* เอฟเฟกต์ suspense: Glow เมื่อกำลังคีบ */
            .crane-claw-wrapper.suspense {
                animation: clawSuspense 0.5s ease-in-out infinite;
            }

            .crane-claw-wrapper.suspense::before {
                animation: clawGlow 1s ease-in-out infinite;
                box-shadow: 
                    0 4px 12px rgba(0,0,0,0.4),
                    inset 0 2px 8px rgba(255,255,255,0.6),
                    inset 0 -2px 8px rgba(0,0,0,0.2),
                    0 0 30px rgba(255,215,0,0.6),
                    0 0 50px rgba(255,215,0,0.4);
            }

            .crane-claw-wrapper.suspense .crane-claw-finger {
                animation: fingerTremble 0.3s ease-in-out infinite;
            }

            @keyframes clawSuspense {
                0%, 100% {
                    transform: translateX(-50%) translateY(0);
                }
                50% {
                    transform: translateX(-50%) translateY(-2px);
                }
            }

            @keyframes clawGlow {
                0%, 100% {
                    box-shadow: 
                        0 4px 12px rgba(0,0,0,0.4),
                        inset 0 2px 8px rgba(255,255,255,0.6),
                        inset 0 -2px 8px rgba(0,0,0,0.2),
                        0 0 20px rgba(255,255,255,0.3),
                        0 0 30px rgba(255,215,0,0.4);
                }
                50% {
                    box-shadow: 
                        0 4px 12px rgba(0,0,0,0.4),
                        inset 0 2px 8px rgba(255,255,255,0.6),
                        inset 0 -2px 8px rgba(0,0,0,0.2),
                        0 0 30px rgba(255,255,255,0.5),
                        0 0 50px rgba(255,215,0,0.8),
                        0 0 70px rgba(255,215,0,0.6);
                }
            }

            @keyframes fingerTremble {
                0%, 100% {
                    transform: translateX(0) rotate(0deg);
                }
                25% {
                    transform: translateX(-0.5px) rotate(-0.5deg);
                }
                75% {
                    transform: translateX(0.5px) rotate(0.5deg);
                }
            }

            /* เอฟเฟกต์ pulse เมื่อกำลังลงไปคีบ */
            .crane-claw-wrapper.dropping {
                animation: clawDropSuspense 0.4s ease-in-out infinite;
            }

            @keyframes clawDropSuspense {
                0%, 100% {
                    transform: translateX(-50%) scale(1);
                }
                50% {
                    transform: translateX(-50%) scale(1.02);
                }
            }

         
       
            .crane-claw {
                position: relative;
                width: 100%;
                height: 100%;
            }

            /* ส่วนกลาง: กล่องโครเมียม */
            .crane-claw::before {
                content: '';
                position: absolute;
                top: 68px;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 35px;
                background: linear-gradient(180deg, 
                    #e8e8e8 0%, 
                    #d0d0d0 30%,
                    #b8b8b8 50%,
                    #a0a0a0 70%,
                    #888888 100%);
                border-radius: 8px;
                box-shadow: 
                    0 4px 10px rgba(0,0,0,0.4),
                    inset 0 2px 6px rgba(255,255,255,0.5),
                    inset 0 -2px 6px rgba(0,0,0,0.3),
                    0 0 15px rgba(255,255,255,0.2);
                z-index: 2;
            }

            /* สปริงกลาง */
            .crane-claw::after {
                content: '';
                position: absolute;
                top: 75px;
                left: 50%;
                transform: translateX(-50%);
                width: 8px;
                height: 20px;
                background: repeating-linear-gradient(90deg,
                    #888 0px,
                    #888 2px,
                    #aaa 2px,
                    #aaa 4px);
                border-radius: 4px;
                z-index: 3;
                box-shadow: inset 0 0 4px rgba(0,0,0,0.3);
            }

            /* นิ้วคีบทั้ง 3 นิ้ว */
            .crane-claw-finger {
                position: absolute;
                bottom: 0;
                width: 16px;
                height: 32px;
                background: linear-gradient(135deg, 
                    #f0f0f0 0%,
                    #e0e0e0 20%,
                    #d0d0d0 40%,
                    #c0c0c0 60%,
                    #b0b0b0 80%,
                    #a0a0a0 100%);
                border-radius: 8px 8px 4px 4px;
                transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                box-shadow: 
                    0 4px 12px rgba(0,0,0,0.5),
                    inset 0 2px 6px rgba(255,255,255,0.6),
                    inset 0 -2px 6px rgba(0,0,0,0.3),
                    0 0 10px rgba(255,255,255,0.3);
                z-index: 1;
                transform-origin: bottom center;
            }

            .crane-claw-finger.left {
                left: 12px;
            }

            .crane-claw-finger.center {
                left: 50%;
                transform: translateX(-50%);
            }

            .crane-claw-finger.right {
                right: 12px;
            }

            /* มือคีบเปิด */
            .crane-claw.open .crane-claw-finger.left {
                transform: rotate(-30deg) translateX(-4px);
            }

            .crane-claw.open .crane-claw-finger.center {
                transform: translateX(-50%) rotate(0deg);
            }

            .crane-claw.open .crane-claw-finger.right {
                transform: rotate(30deg) translateX(4px);
            }

            /* มือคีบปิด */
            .crane-claw.close .crane-claw-finger {
                transform: translateX(0) rotate(0deg);
            }

            .crane-claw.close .crane-claw-finger.center {
                transform: translateX(-50%) rotate(0deg);
            }

            /* Animation เคลื่อนที่ */
            .crane-arm-wrapper.moving {
                transition: left 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .crane-arm.dropping {
                height: 350px;
                transition: height 1.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .crane-arm.lifting {
                height: 180px;
                transition: height 1.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .crane-prize-item.following {
                position: absolute;
                transition: all 1.8s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 15;
                transform: scale(1.2);
                box-shadow: 0 8px 20px rgba(0,0,0,0.6);
            }

            .crane-result {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                z-index: 100;
                display: none;
            }

            .crane-result img {
                max-width: 220px;
                max-height: 220px;
                border-radius: 15px;
                animation: prizeReveal 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                box-shadow: 
                    0 15px 40px rgba(0,0,0,0.5),
                    0 0 30px rgba(var(--main-rgb), 0.4);
                border: 4px solid rgba(255,255,255,0.9);
            }

            @keyframes prizeReveal {
                0% {
                    transform: scale(0) rotate(-180deg);
                    opacity: 0;
                }
                60% {
                    transform: scale(1.2) rotate(10deg);
                }
                100% {
                    transform: scale(1) rotate(0deg);
                    opacity: 1;
                }
            }

            @media (max-width: 768px) {
                .crane-machine {
                    max-width: 95%;
                    padding: 15px;
                }
                .crane-display {
                    height: 350px;
                }
                .crane-prize-item {
                    width: 65px;
                    height: 65px;
                }
                .crane-arm {
                    height: 150px;
                    width: 10px;
                }
                .crane-claw-wrapper {
                    width: 75px;
                    height: 110px;
                }
                .crane-claw-wrapper::before {
                    width: 55px;
                    height: 40px;
                }
                .crane-claw-wrapper::after {
                    width: 60px;
                    height: 15px;
                    top: 40px;
                }
                .crane-claw::before {
                    width: 50px;
                    height: 28px;
                    top: 55px;
                }
                .crane-claw-finger {
                    width: 14px;
                    height: 26px;
                }
                .crane-claw-finger.left {
                    left: 10px;
                }
                .crane-claw-finger.right {
                    right: 10px;
                }
                .crane-claw-cable {
                    width: 6px;
                    height: 15px;
                    top: -12px;
                }
                .crane-claw-cable::before {
                    width: 10px;
                    height: 10px;
                    top: -6px;
                }
                .crane-claw-brand {
                    width: 40px;
                    height: 12px;
                    top: 42px;
                    font-size: 7px;
                }
                .crane-result img {
                    max-width: 160px;
                    max-height: 160px;
                }
            }
        </style>

        <div class="container-fluid p-0">
            <div class="container-sm m-auto p-4 pt-0">
                <div class="container-fluid p-4  <?php echo $bg?> shadow-sm " style="border-radius: 1rem;" data-aos="<?php echo $anim; ?>" data-aos-duration="8000" data-aos-delay="50000">
                    <div class="d-flex mb-2">
                        <img src="assets/icon/wheel.png" class="align-self-center" style="max-height: 78px;">
                        <div class="align-self-center">
                            <h2 class=" ms-1 mb-0"><?= $wheel['name'] ?></h2>
                            <h5 class=" ms-1">เล่นวงล้อนำโชค </h5>
                        </div>
                    </div>

                    <?php if ($mode === 'csgo'): ?>
                        <!-- โหมดรางเลื่อน CSGO -->
                        <div class="csgo-roll-wrapper">
                            <div class="csgo-roll" id="csgo-roll">
                                <?php
                                    $findItems = dd_q("SELECT * FROM wheel_item WHERE w_id = ? ", [$wheel['id']]);
                                    $items = [];
                                    while ($it = $findItems->fetch(PDO::FETCH_ASSOC)) {
                                        $items[] = $it;
                                    }
                                    $itemCount = count($items); // เอาไว้คำนวณระยะหมุน 1 รอบ

                                    if (!empty($items)) {
                                        for ($r = 0; $r < 20; $r++) { // วนซ้ำให้ยาว
                                            foreach ($items as $it) {
                                ?>
                                                <div class="csgo-item" data-id="<?= $it['id'] ?>">
                                                    <img src="<?= htmlspecialchars($it['img']) ?>" class="spin-reward" alt="<?= htmlspecialchars($it['name']) ?>">
                                                </div>
                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </div>
                            <div class="csgo-marker"></div>
                        </div>

                    <?php elseif ($mode === 'box'): ?>
                        <!-- โหมดกล่องสุ่ม -->
                       <!-- แสดงของรางวัลเหนือกล่อง -->
<!-- WRAPPER ครอบทั้งรูปของรางวัล + กล่อง -->
<div id="box-wrapper" style="position:relative; width:220px; margin:20px auto; text-align:center;">

    <!-- รูปผลรางวัล ลอยเหนือกล่อง -->
    <div id="box-result"
         style="
            display:none;
            position:absolute;
            top:-50px;
            left:50%;
            transform:translateX(-50%);
            width:100%;
            text-align:center;
            z-index:10;
         ">
        <img id="box-result-img"
             src=""
             style="width:100px; border-radius:12px;"
             alt="รางวัลจากกล่อง">
    </div>

    <!-- กล่องปิด -->
    <div id="box-container">
        <img id="box-img"
             src="https://img5.pic.in.th/file/secure-sv1/b2d8df424b0df31201.png"
             alt="Lucky Box"
             style="width:220px;">
    </div>

</div>

                    <?php elseif ($mode === 'crane'): ?>
                        <!-- โหมดตู้คีบตุ๊กตา -->
                        <div class="crane-machine">
                            <div class="crane-display">
                                <div class="crane-arm-wrapper" id="crane-arm-wrapper">
                                    <div class="crane-arm" id="crane-arm">
                                        <div class="crane-claw-wrapper">
                                            <div class="crane-claw-cable"></div>
                                           
                                            <div class="crane-claw open" id="crane-claw">
                                                <div class="crane-claw-finger left"></div>
                                                <div class="crane-claw-finger center"></div>
                                                <div class="crane-claw-finger right"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="crane-prize-container" id="crane-prize-container">
                                    <?php
                                        $findItemsCrane = dd_q("SELECT * FROM wheel_item WHERE w_id = ? ", [$wheel['id']]);
                                        $craneItems = [];
                                        $itemCount = 0;
                                        while ($itCrane = $findItemsCrane->fetch(PDO::FETCH_ASSOC)) {
                                            $craneItems[$itCrane['id']] = [
                                                'img' => $itCrane['img'],
                                                'name' => $itCrane['name']
                                            ];
                                            // แสดงของรางวัลในตู้
                                            if ($itemCount < 12) { // แสดงสูงสุด 12 ชิ้น
                                    ?>
                                        <div class="crane-prize-item" data-id="<?= $itCrane['id'] ?>">
                                            <img src="<?= htmlspecialchars($itCrane['img']) ?>" alt="<?= htmlspecialchars($itCrane['name']) ?>">
                                        </div>
                                    <?php
                                                $itemCount++;
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="crane-result" id="crane-result">
                                    <img id="crane-result-img" src="" alt="รางวัล">
                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- โหมดวงล้อ easyWheel ปกติ -->
                        <div class="spinner"></div>
                    <?php endif; ?>

                    <div class="col-lg-4 m-auto">
                        <div class="row">
                            <center>
                                <h5 class="text-muted" style=" width: 100%;">
                                    ราคารอบละ :
                                    <span class="text-main"><?php echo number_format($wheel["price"])?> บาท</span>
                                </h5>

                                <a class="btn bg-main w-100 justify-content-center align-items-center text-white mb-2"
                                   id="random" style="border-radius: 10px;">
                                    เริ่มสุ่ม 
                                </a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    // ดึงของรางวัลทั้งหมดของวงล้อนี้มาเก็บเป็น array ก่อน
    $findPrizeList = dd_q("SELECT * FROM wheel_item WHERE w_id = ? ", [$wheel['id']]);
    $prizes = [];
    while ($row = $findPrizeList->fetch(PDO::FETCH_ASSOC)) {
        $prizes[] = $row;
    }
?>

<div class="container-sm m-auto p-4 mt-3 <?php echo $bg?> shadow-sm" style="border-radius: 1rem;" data-aos="<?php echo $anim; ?>" data-aos-duration="8000" data-aos-delay="50000">
    <h4 class="text-center mb-3">
        รายการของรางวัล 
    </h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-white">
                <tr>
                    <!-- คอลัมน์ # แคบ ๆ -->
                    <th style="width: 60px; white-space: nowrap;">#</th>
                    <th style="width: 80px;">รูปภาพ</th>
                    <th>ชื่อรางวัล</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prizes as $index => $p): ?>
                    <tr>
                        <!-- ใช้เลขลำดับจาก PHP (1,2,3,...) ไม่เกี่ยวกับ id SQL -->
                        <td><?= $index + 1 ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($p['img']) ?>"
                                 style="max-height: 60px;"
                                 class="img-fluid rounded"
                                 alt="<?= htmlspecialchars($p['name']) ?>">
                        </td>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


    <div class="row">
        <?php while($p = $findPrizeList->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="col-6 col-md-3 mb-3 text-center">
                <div class="card h-100">
                    <div class="card-body p-2">
                        <img src="<?= htmlspecialchars($p['img']) ?>"
                             class="img-fluid mb-2"
                             style="max-height:80px;"
                             alt="<?= htmlspecialchars($p['name']) ?>">
                        <div class="small">
                            <?= htmlspecialchars($p['name']) ?>
                        </div>
                        <!-- ไม่ต้อง echo field เปอร์เซ็นต์ ก็จะไม่เห็น % -->
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

        <?php if ($mode === 'box'): ?>
            <?php
                // map id => img สำหรับโหมดกล่อง
                $findItemsBox = dd_q("SELECT * FROM wheel_item WHERE w_id = ? ", [$wheel['id']]);
                $boxItemsById = [];
                while ($itBox = $findItemsBox->fetch(PDO::FETCH_ASSOC)) {
                    $boxItemsById[$itBox['id']] = $itBox['img'];
                }
            ?>
        <?php endif; ?>

        <script>
    jQuery(document).ready(function() {
<?php if ($mode === 'csgo'): ?>
    // ---------- โหมดรางเลื่อน CSGO ----------
    var isRolling = false;

    jQuery('#random').on('click', function() {
        if (isRolling) return;
        isRolling = true;

        var $btn = jQuery('#random');
        $btn.attr('disabled', true).html("รอสักครู่...");

        jQuery.ajax({
            url: '/services/spin.php',
            type: 'POST',
            dataType: 'json',
            data: {
                wheel: '<?= $wheel['id'] ?>',
                nonce: jQuery.now()
            },
            success: function(msg) {
                var $roll    = jQuery('#csgo-roll');
                var $wrapper = jQuery('.csgo-roll-wrapper');
                var $items   = $roll.find('.csgo-item');

                if (!$items.length) {
                    Swal.fire({
                        icon: 'success',
                        title: 'ยินดีด้วยคุณได้รับ',
                        text: msg.message
                    }).then(function() {
                        window.location.reload();
                    });
                    return;
                }

                var winnerId = msg.winner;
                var winnerBaseIndex = -1;

                $items.each(function(i) {
                    if (jQuery(this).data('id') == winnerId && winnerBaseIndex === -1) {
                        winnerBaseIndex = i;
                    }
                });

                if (winnerBaseIndex === -1) {
                    winnerBaseIndex = 0;
                }

                var itemWidth    = $items.outerWidth(true);
                var wrapperWidth = $wrapper.innerWidth();
                var perRound = <?= isset($itemCount) ? (int)$itemCount : 0 ?> || $items.length;

                var loopsBefore = 12;
                var targetIndex = (loopsBefore * perRound) + winnerBaseIndex;

                var itemCenterPos = (targetIndex * itemWidth) + (itemWidth / 2);
                var wrapperCenter = wrapperWidth / 2;
                var finalOffset = -(itemCenterPos - wrapperCenter);

                var duration = 6;

                $roll.css({
                    transition: 'none',
                    transform: 'translate3d(0, 0, 0)'
                });
                $roll[0].offsetHeight;

                $roll.css({
                    transition: 'transform ' + duration + 's cubic-bezier(0.08, 0.6, 0, 1)',
                    transform: 'translate3d(' + finalOffset + 'px, 0, 0)'
                });

                setTimeout(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'ยินดีด้วยคุณได้รับ',
                        text: msg.message
                    }).then(function() {
                        window.location.reload();
                    });
                }, (duration * 1000) + 200);
            },
            error: function(xhr) {
                var res = xhr.responseJSON || {message: 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง'};
                Swal.fire({
                    icon: 'error',
                    title: 'ขออภัย',
                    text: res.message
                }).then(function() {
                    window.location.reload();
                });
            }
        });
    });

<?php elseif ($mode === 'box'): ?>
    // ---------- โหมดกล่องสุ่ม ----------
  // ---------- โหมดกล่องสุ่ม ----------
var isOpening = false;

var boxItems = <?= json_encode($boxItemsById ?? [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;

jQuery('#random, #box-img').on('click', function() {
    if (isOpening) return;
    isOpening = true;

    var $btn        = jQuery('#random');
    var $box        = jQuery('#box-img');
    var $resultBox  = jQuery('#box-result');
    var $resultImg  = jQuery('#box-result-img');    

    $btn.attr('disabled', true).html("กำลังเปิดกล่อง...");
    $box.removeClass('box-open').addClass('box-shake');
    $box.attr('src', 'https://img5.pic.in.th/file/secure-sv1/b2d8df424b0df31201.png');

    $resultBox.hide();
    $resultImg.attr("src", "").removeClass("prize-pop");

    jQuery.ajax({
        url: '/services/spin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            wheel: '<?= $wheel['id'] ?>',
            nonce: jQuery.now()
        },
        success: function(msg) {

            setTimeout(function() {

                $box.removeClass('box-shake');

                var imgUrl = 'https://img2.pic.in.th/pic/b1a111e7a18a6f51c0.png';
                var winnerImg = boxItems[msg.winner];
                $box.attr('src', imgUrl).addClass('box-open');

                // ----------- แสดงของรางวัลด้านบน -----------
                $resultImg.attr("src", winnerImg);
                $resultBox.show();

                // เล่นแอนิเมชันเด้ง
                setTimeout(() => {
                    $resultImg.addClass("prize-pop");
                }, 50);

                // ดีเลย์ก่อนแสดง Swal
                setTimeout(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'ยินดีด้วยคุณได้รับ',
                        text: msg.message
                    }).then(function() {
                        window.location.reload();
                    });
                }, 900);

            }, 1600);
        }
    });

<?php elseif ($mode === 'crane'): ?>
    // ---------- โหมดตู้คีบตุ๊กตา ----------
    var isOperating = false;
    var craneItems = <?= json_encode($craneItems ?? [], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;

    jQuery('#random').on('click', function() {
        if (isOperating) return;
        isOperating = true;

        var $btn = jQuery('#random');
        var $armWrapper = jQuery('#crane-arm-wrapper');
        var $arm = jQuery('#crane-arm');
        var $claw = jQuery('#crane-claw');
        var $clawWrapper = jQuery('.crane-claw-wrapper');
        var $prizeContainer = jQuery('#crane-prize-container');
        var $result = jQuery('#crane-result');
        var $resultImg = jQuery('#crane-result-img');
        var $display = jQuery('.crane-display');

        $btn.attr('disabled', true).html("กำลังคีบ...");
        $result.hide();
        
        // เพิ่ม suspense effect ทันที
        $clawWrapper.addClass('suspense');

        // เรียก API เพื่อดึงรางวัล
        jQuery.ajax({
            url: '/services/spin.php',
            type: 'POST',
            dataType: 'json',
            data: {
                wheel: '<?= $wheel['id'] ?>',
                nonce: jQuery.now()
            },
            success: function(msg) {
                var winnerId = msg.winner;
                var $targetPrize = $prizeContainer.find('[data-id="' + winnerId + '"]').first();
                
                if (!$targetPrize.length) {
                    // ถ้าไม่พบของในตู้ ให้สุ่มตัวอื่น
                    $targetPrize = $prizeContainer.find('.crane-prize-item').first();
                    winnerId = $targetPrize.data('id');
                }

                // หาตำแหน่งของของรางวัล
                var prizePosition = $targetPrize.position();
                var prizeLeft = prizePosition.left + ($targetPrize.outerWidth() / 2);
                var displayWidth = $display.innerWidth();
                var targetLeftPercent = (prizeLeft / displayWidth) * 100;
                
                // จำกัดค่าให้อยู่ในช่วง 10-90%
                targetLeftPercent = Math.max(10, Math.min(90, targetLeftPercent));
                
                // ขั้นตอนที่ 1: เลื่อนไปมาก่อนเพื่อสร้างความตื่นเต้น
                var scanPositions = [15, 85, 25, 75, 40, 60, targetLeftPercent]; // ตำแหน่งที่เลื่อนไปมา
                var currentScanIndex = 0;
                var scanSpeed = 500; // ความเร็วในการเลื่อน (ms)
                
                function performScan() {
                    if (currentScanIndex < scanPositions.length) {
                        var scanPos = scanPositions[currentScanIndex];
                        $armWrapper.addClass('moving');
                        $armWrapper.css({
                            'left': scanPos + '%',
                            'transition': 'left ' + (scanSpeed / 1000) + 's ease-in-out'
                        });
                        currentScanIndex++;
                        setTimeout(performScan, scanSpeed);
                    } else {
                        // หลังจากเลื่อนไปมาเสร็จแล้ว ไปที่ตำแหน่งเป้าหมาย
                        $armWrapper.css({
                            'left': targetLeftPercent + '%',
                            'transition': 'left 0.8s ease-out'
                        });
                        
                        setTimeout(function() {
                            // ขั้นตอนที่ 2: ลงไปคีบ - เพิ่ม suspense effect
                            $clawWrapper.removeClass('suspense').addClass('dropping');
                            $arm.removeClass('lifting').addClass('dropping');
                            $claw.removeClass('close').addClass('open');
                    
                    setTimeout(function() {
                        // ขั้นตอนที่ 3: ปิดกรงเล็บและจับของ - ลบ suspense
                        $clawWrapper.removeClass('dropping');
                        $claw.removeClass('open').addClass('close');
                        
                        // ทำให้ของรางวัลตามมือคีบขึ้นมา
                        var prizeCurrentPos = $targetPrize.position();
                        var prizeCurrentLeft = prizeCurrentPos.left;
                        var prizeCurrentTop = prizeCurrentPos.top;
                        
                        // เปลี่ยนของรางวัลเป็น absolute positioning
                        $targetPrize.css({
                            'position': 'absolute',
                            'left': prizeCurrentLeft + 'px',
                            'top': prizeCurrentTop + 'px',
                            'z-index': '100',
                            'transform': 'scale(1.2)',
                            'transition': 'all 1.8s cubic-bezier(0.4, 0, 0.2, 1)'
                        });
                        
                        setTimeout(function() {
                            // ยกขึ้นมา
                            $arm.removeClass('dropping').addClass('lifting');
                            
                            // คำนวณตำแหน่งของมือคีบ
                            var armWrapperPos = $armWrapper.position();
                            var armWrapperLeft = armWrapperPos.left;
                            var clawCenterLeft = armWrapperLeft + ($armWrapper.outerWidth() / 2);
                            
                            // อัพเดทตำแหน่งของรางวัลให้ตามมือคีบขึ้นมา (อยู่ใต้มือคีบ)
                            var prizeWidth = $targetPrize.outerWidth() * 1.2;
                            var finalLeft = clawCenterLeft - (prizeWidth / 2);
                            var finalTop = 80; // ยกขึ้นมาอยู่ใกล้ด้านบน
                            
                            $targetPrize.css({
                                'left': finalLeft + 'px',
                                'top': finalTop + 'px'
                            });
                            
                            setTimeout(function() {
                                // ซ่อนของรางวัลและแสดงผล
                                $targetPrize.hide();
                                
                                if (craneItems[winnerId]) {
                                    $resultImg.attr('src', craneItems[winnerId].img);
                                    $result.show();
                                }
                                
                                // แสดงผลลัพธ์
                                setTimeout(function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ยินดีด้วยคุณได้รับ',
                                        text: msg.message
                                    }).then(function() {
                                        window.location.reload();
                                    });
                                }, 500);
                            }, 1800);
                        }, 500);
                    }, 1800);
                        }, 800);
                    }
                }
                
                // เริ่มการเลื่อนไปมา
                performScan();
            },
            error: function(xhr) {
                var res = xhr.responseJSON || {message: 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง'};
                Swal.fire({
                    icon: 'error',
                    title: 'ขออภัย',
                    text: res.message
                }).then(function() {
                    window.location.reload();
                });
            }
        });
    });

<?php else: ?>
    // ---------- โหมดวงล้อ easyWheel เดิม ----------
    var tick = new Audio('/assets/easywheel/tick.mp3');
    jQuery('.spinner').easyWheel({
        items: [
            <?php 
                $find = dd_q("SELECT * FROM wheel_item WHERE w_id = ? ", [$wheel['id']]);
                while($item = $find->fetch(PDO::FETCH_ASSOC)){
            ?>
                {
                    id: '<?= $item['id'] ?>',
                    name: "<img src='<?= htmlspecialchars($item['img'])?>' class='spin-reward'></img>",
                    message: '<?= htmlspecialchars($item['name'])?>',
                    color: '#212529',
                },
            <?php
                }    
            ?>
        ],
        centerBackground: '#fff',
        button: '.btn',
        type: 'spin',
        frame: 1,
        outerLineColor: 'var(--main)',
        centerLineColor: 'var(--main)',
        selectedSliceColor: 'var(--main)',
        sliceLineColor: 'var(--main)',
        centerImage: '<?php echo $config['logo']; ?>',
        markerAnimation: true,
        centerClass: 0,
        width: 600,
        textOffset: 10,
        textLine: "v",
        textArc: false,
        sliceLineWidth: 1,
        shadowOpacity: 0,
        fontSize: 18,
        centerWidth: 35,
        centerImageWidth: 30,
        outerLineWidth: 4,
        ajax: {
            url: '/services/spin.php',
            type: 'POST',
            data: {'wheel': '<?= $wheel['id'] ?>'},
            nonce: true,
            success: function(msg) {
            },
            error: function(msg) {
                msg = msg.responseJSON;
                Swal.fire({
                    icon: 'error',
                    title: 'ขออภัย',
                    text: msg.message,
                }).then(function() {
                    window.location.reload();
                })
            }
        },
        onStart: function(results, spinCount, now) {},
        onStep: function(results, slicePercent, circlePercent) {
            if (typeof tick.currentTime !== 'undefined')
                tick.currentTime = 0;
            tick.play();
        },
        onProgress: function(results, spinCount, now) {
            jQuery(".spin-button").attr("disabled", true);
            jQuery(".spin-button").html("รอสักครู่...");
        },
        onComplete: function(results, count, now) {
            console.log(results)
            Swal.fire({
                icon: 'success',
                title: 'ยินดีด้วยคุณได้รับ',
                text: results.message,
            }).then(function() {
                window.location.reload();
            })
        }
    });
<?php endif; ?>
    });
</script>

<?php
    }
}
?>
