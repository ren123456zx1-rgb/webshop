<?php 
    //topup by day
    date_default_timezone_set("Asia/Bangkok");
    $midnight = strtotime("today 00:00");
    $date_day =  date('Y-m-d H:i:s', $midnight);
    $q_1 = dd_q("SELECT sum(amount) AS total FROM topup_his WHERE date > ?",[$date_day]);
    $day = $q_1->fetch(PDO::FETCH_ASSOC);
    if($day["total"] == null){
        $day["total"] = "0.00";
    }
    // topup by month
    date_default_timezone_set("Asia/Bangkok");
    $midnight = strtotime("today 00:00");
    $date_month =  date('Y-m-01 H:i:s', $midnight);
    $q_2 = dd_q("SELECT sum(amount) AS total FROM topup_his WHERE date > ?",[$date_month]);
    $month = $q_2->fetch(PDO::FETCH_ASSOC);
    if($month["total"] == null){
        $month["total"] = "0.00";
    }
    // topup by week
    $date_week = date('Y-m-d H:i:s', strtotime('monday this week 00:00'));
    $q_3_week = dd_q("SELECT sum(amount) AS total FROM topup_his WHERE date > ?",[$date_week]);
    $week_topup = $q_3_week->fetch(PDO::FETCH_ASSOC);
    if($week_topup["total"] == null){
        $week_topup["total"] = "0.00";
    }
    // topup all
    $q_3 = dd_q("SELECT sum(amount) AS total FROM topup_his ");
    $topup = $q_3->fetch(PDO::FETCH_ASSOC);
    if($topup["total"] == null){
        $topup["total"] = "0.00";
    }
    //shop by day
    $q_4 = dd_q("SELECT id FROM boxlog WHERE date > ?",[$date_day]);
    $box_day = $q_4->rowCount();
    // shop by month
    $q_5 = dd_q("SELECT id FROM boxlog WHERE date > ?",[$date_month]);
    $box_month = $q_5->rowCount();
    // shop by all
    $q_6 = dd_q("SELECT id FROM boxlog");
    $box_all = $q_6->rowCount();
    
    // shop by week
    $q_4_week = dd_q("SELECT id FROM boxlog WHERE date > ?",[$date_week]);
    $box_week = $q_4_week->rowCount();
    
    // ยอดซื้อสินค้าตามราคา
    $q_7 = dd_q("SELECT sum(price) AS total FROM boxlog WHERE date > ?",[$date_day]);
    $box_price_day = $q_7->fetch(PDO::FETCH_ASSOC);
    if($box_price_day["total"] == null){
        $box_price_day["total"] = "0.00";
    }
    
    $q_8 = dd_q("SELECT sum(price) AS total FROM boxlog WHERE date > ?",[$date_month]);
    $box_price_month = $q_8->fetch(PDO::FETCH_ASSOC);
    if($box_price_month["total"] == null){
        $box_price_month["total"] = "0.00";
    }
    
    $q_9 = dd_q("SELECT sum(price) AS total FROM boxlog");
    $box_price_all = $q_9->fetch(PDO::FETCH_ASSOC);
    if($box_price_all["total"] == null){
        $box_price_all["total"] = "0.00";
    }
    
    // ยอดซื้อสินค้าสัปดาห์นี้
    $q_7_week = dd_q("SELECT sum(price) AS total FROM boxlog WHERE date > ?",[$date_week]);
    $box_price_week = $q_7_week->fetch(PDO::FETCH_ASSOC);
    if($box_price_week["total"] == null){
        $box_price_week["total"] = "0.00";
    }
    
    // จำนวนผู้ใช้
    $q_10 = dd_q("SELECT id FROM users");
    $user_count = $q_10->rowCount();
    
    // จำนวนผู้ใช้ใหม่วันนี้
    $q_11 = dd_q("SELECT id FROM users WHERE date >= ?",[$date_day]);
    $user_new_day = $q_11->rowCount();
    
    // จำนวนผู้ใช้ใหม่เดือนนี้
    $q_12 = dd_q("SELECT id FROM users WHERE date >= ?",[$date_month]);
    $user_new_month = $q_12->rowCount();
    
    // ยอดเล่นวงล้อวันนี้
    $q_13 = dd_q("SELECT id FROM wheellog WHERE date > ?",[$date_day]);
    $wheel_day = $q_13->rowCount();
    
    // ยอดเล่นวงล้อเดือนนี้
    $q_14 = dd_q("SELECT id FROM wheellog WHERE date > ?",[$date_month]);
    $wheel_month = $q_14->rowCount();
    
    // ยอดเล่นวงล้อทั้งหมด
    $q_15 = dd_q("SELECT id FROM wheellog");
    $wheel_all = $q_15->rowCount();
    
    // ยอดเงินจากวงล้อวันนี้
    $q_16 = dd_q("SELECT sum(price) AS total FROM wheellog WHERE date > ?",[$date_day]);
    $wheel_price_day = $q_16->fetch(PDO::FETCH_ASSOC);
    if($wheel_price_day["total"] == null){
        $wheel_price_day["total"] = "0.00";
    }
    
    // ยอดเงินจากวงล้อเดือนนี้
    $q_17 = dd_q("SELECT sum(price) AS total FROM wheellog WHERE date > ?",[$date_month]);
    $wheel_price_month = $q_17->fetch(PDO::FETCH_ASSOC);
    if($wheel_price_month["total"] == null){
        $wheel_price_month["total"] = "0.00";
    }
    
    // ยอดเงินจากวงล้อทั้งหมด
    $q_18 = dd_q("SELECT sum(price) AS total FROM wheellog");
    $wheel_price_all = $q_18->fetch(PDO::FETCH_ASSOC);
    if($wheel_price_all["total"] == null){
        $wheel_price_all["total"] = "0.00";
    }
    
    // ยอดเงินจากวงล้อสัปดาห์นี้
    $q_16_week = dd_q("SELECT sum(price) AS total FROM wheellog WHERE date > ?",[$date_week]);
    $wheel_price_week = $q_16_week->fetch(PDO::FETCH_ASSOC);
    if($wheel_price_week["total"] == null){
        $wheel_price_week["total"] = "0.00";
    }
    
    // ยอดเล่นวงล้อสัปดาห์นี้
    $q_13_week = dd_q("SELECT id FROM wheellog WHERE date > ?",[$date_week]);
    $wheel_week = $q_13_week->rowCount();
    
    // จำนวนสินค้า
    $q_19 = dd_q("SELECT id FROM box_product");
    $product_count = $q_19->rowCount();
    
    // จำนวนวงล้อ
    $q_20 = dd_q("SELECT id FROM wheel");
    $wheel_count = $q_20->rowCount();
    
    // ยอดรวมทั้งหมด (เติมเงิน + ซื้อสินค้า + เล่นวงล้อ)
    $total_revenue_day = floatval($day["total"]) + floatval($box_price_day["total"]) + floatval($wheel_price_day["total"]);
    $total_revenue_month = floatval($month["total"]) + floatval($box_price_month["total"]) + floatval($wheel_price_month["total"]);
    $total_revenue_all = floatval($topup["total"]) + floatval($box_price_all["total"]) + floatval($wheel_price_all["total"]);
    
    // วงล้อที่เล่นเยอะสุด (จาก wheellog) - join กับ wheel เพื่อดึงชื่อวงล้อ
    $q_21 = dd_q("SELECT COALESCE(w.name, wl.category) as wheel_name, COUNT(*) as count 
                  FROM wheellog wl 
                  LEFT JOIN wheel_item wi ON wl.category = wi.name 
                  LEFT JOIN wheel w ON wi.w_id = w.id 
                  GROUP BY COALESCE(w.name, wl.category)
                  ORDER BY count DESC 
                  LIMIT 10");
    $top_prizes = [];
    $top_prize_names = [];
    $top_prize_counts = [];
    while($row = $q_21->fetch(PDO::FETCH_ASSOC)){
        $top_prizes[] = $row;
        $top_prize_names[] = $row['wheel_name'];
        $top_prize_counts[] = $row['count'];
    }
    
    // สินค้าที่ขายเยอะสุด (จาก boxlog) - join กับ box_product เพื่อดึงชื่อสินค้าจริง
    $q_22 = dd_q("SELECT COALESCE(bp.name, bl.prize_name) as product_name, COUNT(*) as count 
                  FROM boxlog bl 
                  LEFT JOIN box_product bp ON bl.category = bp.c_type 
                  GROUP BY COALESCE(bp.name, bl.prize_name)
                  ORDER BY count DESC 
                  LIMIT 10");
    $top_products = [];
    $top_product_names = [];
    $top_product_counts = [];
    while($row = $q_22->fetch(PDO::FETCH_ASSOC)){
        $top_products[] = $row;
        $top_product_names[] = $row['product_name'];
        $top_product_counts[] = $row['count'];
    }
    
    // วงล้อเล่นล่าสุด 5 รายการ
    $q_23 = dd_q("SELECT wl.*, COALESCE(w.name, wl.category) as wheel_name 
                  FROM wheellog wl 
                  LEFT JOIN wheel_item wi ON wl.category = wi.name 
                  LEFT JOIN wheel w ON wi.w_id = w.id 
                  ORDER BY wl.date DESC 
                  LIMIT 5");
    $recent_wheels = [];
    while($row = $q_23->fetch(PDO::FETCH_ASSOC)){
        $recent_wheels[] = $row;
    }
    
    // สินค้าซื้อล่าสุด 5 รายการ
    $q_24 = dd_q("SELECT bl.*, COALESCE(bp.name, bl.prize_name) as product_name 
                  FROM boxlog bl 
                  LEFT JOIN box_product bp ON bl.category = bp.c_type 
                  ORDER BY bl.date DESC 
                  LIMIT 5");
    $recent_products = [];
    while($row = $q_24->fetch(PDO::FETCH_ASSOC)){
        $recent_products[] = $row;
    }

?>
<style>
    .font-bold {
        font-weight: 700;
    }
    .font-semibold {
        font-weight: 600;
    } 
    .font-semiboldx {
        font-weight: 550;
    }
    
    /* Stat Card Styles */
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 30px 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: var(--main);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }
    
    .stat-card:hover::before {
        transform: scaleX(1);
    }
    
    .stat-card h1 {
        color: var(--main);
        font-size: 2.5rem;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover h1 {
        transform: scale(1.05);
    }
    
    .stat-card h5 {
        color: #666;
        font-size: 1rem;
        margin: 0;
        font-weight: 500;
    }
    
    /* Chart Container */
    .chart-container {
        background: white;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .chart-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--main);
    }
    
    .chart-container:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }
    
    .chart-container h5 {
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.1rem;
    }
    
    .chart-container h5 i {
        color: var(--main);
        font-size: 1.4rem;
    }
    
    /* Table Container */
    .table-container {
        background: white;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .table-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--main);
    }
    
    .table-container:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }
    
    .table-container h5 {
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.1rem;
    }
    
    .table-container h5 i {
        color: var(--main);
        font-size: 1.4rem;
    }
    
    /* Table Styles */
    .table-container table {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .table-container thead th {
        background: var(--main) !important;
        color: white !important;
        font-weight: 600;
        padding: 14px 16px;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 11px;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    
    .table-container tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }
    
    .table-container tbody tr:hover {
        background: rgba(0,0,0,0.02);
        transform: scale(1.01);
    }
    
    .table-container tbody tr:last-child {
        border-bottom: none;
    }
    
    .table-container tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        border: none;
        font-size: 13px;
        color: #555;
    }
    
    /* Custom Scrollbar */
    .table-responsive::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    .table-responsive::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.05);
        border-radius: 10px;
    }
    
    .table-responsive::-webkit-scrollbar-thumb {
        background: var(--main);
        border-radius: 10px;
        opacity: 0.6;
    }
    
    .table-responsive::-webkit-scrollbar-thumb:hover {
        opacity: 1;
    }
    
    /* Header */
    .dashboard-header {
        color: var(--main);
        font-size: 2.8rem;
        margin-bottom: 15px;
        font-weight: 600;
        letter-spacing: -1px;
    }
    
    .dashboard-header i {
        color: var(--main);
    }
    
    /* HR */
    hr {
        border: none;
        height: 3px;
        background: var(--main);
        margin: 25px 0;
        opacity: 1;
        border-radius: 2px;
    }
    
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .stat-card, .chart-container, .table-container {
        animation: fadeInUp 0.6s ease-out;
    }
    
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    
    /* Empty State */
    .table-container tbody .text-muted {
        padding: 50px 20px !important;
        font-size: 14px;
        color: #999;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .stat-card h1 {
            font-size: 2rem;
        }
        
        .dashboard-header {
            font-size: 2.2rem;
        }
        
        .chart-container, .table-container {
            padding: 20px;
        }
        
        .stat-card {
            padding: 25px 15px;
        }
    }
</style>

<div class="container-sm <?php echo $bg?> mt-5 shadow-sm p-4 mb-4" style="border-radius: 16px;" data-aos="fade-down">
    <center>
        <h1 class="dashboard-header font-semibold"><i class="fa-duotone fa-chart-simple"></i>&nbsp;หน้าแดชบอร์ด</h1>
    </center>
    <hr>
    <div class="row justify-content-between mt-4">

        <!-- สรุปข้อมูลสำคัญ -->
        <div class="col-lg-3 mb-4">
            <div class="stat-card">
                <center>
                    <h1 class="font-semibold"><?php echo number_format($total_revenue_day, 2);?>฿</h1>
                    <h5 class="font-semiboldx"><i class="fa-duotone fa-coins"></i> รายได้วันนี้</h5>
                </center>
            </div>
        </div>

        <div class="col-lg-3 mb-4">
            <div class="stat-card">
                <center>
                    <h1 class="font-semibold"><?php echo number_format($total_revenue_month, 2);?>฿</h1>
                    <h5 class="font-semiboldx"><i class="fa-duotone fa-calendar"></i> รายได้เดือนนี้</h5>
                </center>
            </div>
        </div>

        <div class="col-lg-3 mb-4">
            <div class="stat-card">
                <center>
                    <h1 class="font-semibold"><?php echo $user_count;?></h1>
                    <h5 class="font-semiboldx"><i class="fa-duotone fa-users"></i> ผู้ใช้ทั้งหมด</h5>
                </center>
            </div>
        </div>

        <div class="col-lg-3 mb-4">
            <div class="stat-card">
                <center>
                    <h1 class="font-semibold"><?php echo $wheel_all + $box_all;?></h1>
                    <h5 class="font-semiboldx"><i class="fa-duotone fa-gamepad"></i> ยอดเล่นทั้งหมด</h5>
                </center>
            </div>
        </div>

        <!-- ยอดเติมเงิน -->
        <div class="col-lg-12 mb-4">
            <div class="table-container">
                <h5><i class="fa-duotone fa-wallet"></i> ยอดเติมเงิน</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($day["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">วันนี้</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($week_topup["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">สัปดาห์นี้</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($month["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">เดือนนี้</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($topup["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">ทั้งหมด</h6>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ยอดซื้อสินค้า -->
        <div class="col-lg-12 mb-4">
            <div class="table-container">
                <h5><i class="fa-duotone fa-shopping-bag"></i> ยอดซื้อสินค้า</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($box_price_day["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">วันนี้ (<?php echo $box_day;?> ครั้ง)</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($box_price_week["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">สัปดาห์นี้ (<?php echo $box_week;?> ครั้ง)</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($box_price_month["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">เดือนนี้ (<?php echo $box_month;?> ครั้ง)</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($box_price_all["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">ทั้งหมด (<?php echo $box_all;?> ครั้ง)</h6>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ยอดเล่นวงล้อ -->
        <div class="col-lg-12 mb-4">
            <div class="table-container">
                <h5><i class="fa-duotone fa-circle-dot"></i> ยอดเล่นวงล้อ</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($wheel_price_day["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">วันนี้ (<?php echo $wheel_day;?> ครั้ง)</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($wheel_price_week["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">สัปดาห์นี้ (<?php echo $wheel_week;?> ครั้ง)</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($wheel_price_month["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">เดือนนี้ (<?php echo $wheel_month;?> ครั้ง)</h6>
                            </center>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-card" style="padding: 20px;">
                            <center>
                                <h2 class="font-semibold" style="font-size: 1.8rem; color: var(--main);"><?php echo number_format($wheel_price_all["total"], 2);?>฿</h2>
                                <h6 class="font-semiboldx" style="font-size: 0.9rem; color: #666; margin: 0;">ทั้งหมด (<?php echo $wheel_all;?> ครั้ง)</h6>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- กราฟรายได้ -->
        <div class="col-lg-12 mb-4">
            <div class="chart-container">
                <h5><i class="fa-duotone fa-chart-line"></i> กราฟรายได้</h5>
                <canvas id="revenueChart" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <!-- กราฟวงล้อที่เล่นเยอะสุด -->
        <div class="col-lg-6 mb-4">
            <div class="chart-container">
                <h5><i class="fa-duotone fa-trophy"></i> วงล้อที่เล่นเยอะสุด</h5>
                <canvas id="topPrizesChart" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <!-- กราฟสินค้าที่ขายเยอะสุด -->
        <div class="col-lg-6 mb-4">
            <div class="chart-container">
                <h5><i class="fa-duotone fa-box"></i> สินค้าที่ขายเยอะสุด</h5>
                <canvas id="topProductsChart" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <!-- วงล้อเล่นล่าสุด -->
        <div class="col-lg-6 mb-4">
            <div class="table-container">
                <h5><i class="fa-duotone fa-clock"></i> วงล้อเล่นล่าสุด (5 รายการ)</h5>
                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ผู้เล่น</th>
                                <th>วงล้อ</th>
                                <th>รางวัล</th>
                                <th>เวลา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($recent_wheels)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">ยังไม่มีข้อมูล</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($recent_wheels as $rw): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($rw['username']); ?></td>
                                        <td><?php echo htmlspecialchars($rw['wheel_name']); ?></td>
                                        <td><?php echo htmlspecialchars($rw['prize_name']); ?></td>
                                        <td><?php echo date('H:i', strtotime($rw['date'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- สินค้าซื้อล่าสุด -->
        <div class="col-lg-6 mb-4">
            <div class="table-container">
                <h5><i class="fa-duotone fa-shopping-cart"></i> สินค้าซื้อล่าสุด (5 รายการ)</h5>
                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ผู้ซื้อ</th>
                                <th>สินค้า</th>
                                <th>ราคา</th>
                                <th>เวลา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($recent_products)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">ยังไม่มีข้อมูล</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($recent_products as $rp): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($rp['username']); ?></td>
                                        <td><?php echo htmlspecialchars($rp['product_name']); ?></td>
                                        <td style="color: var(--main); font-weight: 600;"><?php echo number_format($rp['price'], 2); ?>฿</td>
                                        <td><?php echo date('H:i', strtotime($rp['date'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    // กราฟรายได้
    const revenueData = {
        labels: ['รายวัน', 'รายเดือน', 'รวมทั้งหมด'],
        datasets: [
            {
                label: 'ยอดเติมเงิน',
                data: [<?php echo $day["total"];?>, <?php echo $month["total"];?>, <?php echo $topup["total"];?>],
                backgroundColor: 'rgba(255, 26, 104, 0.2)',
                borderColor: 'rgba(255, 26, 104, 1)',
                borderWidth: 1
            },
            {
                label: 'ยอดขายสินค้า',
                data: [<?php echo $box_price_day["total"];?>, <?php echo $box_price_month["total"];?>, <?php echo $box_price_all["total"];?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'ยอดเงินจากวงล้อ',
                data: [<?php echo $wheel_price_day["total"];?>, <?php echo $wheel_price_month["total"];?>, <?php echo $wheel_price_all["total"];?>],
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            },
            {
                label: 'ยอดรวมรายได้',
                data: [<?php echo $total_revenue_day;?>, <?php echo $total_revenue_month;?>, <?php echo $total_revenue_all;?>],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            }
        ]
    };

    const revenueConfig = {
        type: 'bar',
        data: revenueData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    new Chart(document.getElementById('revenueChart'), revenueConfig);

    // กราฟรางวัลที่เล่นเยอะสุด
    const topPrizesData = {
        labels: <?php echo json_encode($top_prize_names); ?>,
        datasets: [{
            label: 'จำนวนครั้ง',
            data: <?php echo json_encode($top_prize_counts); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(199, 199, 199, 0.6)',
                'rgba(83, 102, 255, 0.6)',
                'rgba(255, 99, 255, 0.6)',
                'rgba(99, 255, 132, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(199, 199, 199, 1)',
                'rgba(83, 102, 255, 1)',
                'rgba(255, 99, 255, 1)',
                'rgba(99, 255, 132, 1)'
            ],
            borderWidth: 1
        }]
    };

    const topPrizesConfig = {
        type: 'doughnut',
        data: topPrizesData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    };

    new Chart(document.getElementById('topPrizesChart'), topPrizesConfig);

    // กราฟสินค้าที่ขายเยอะสุด
    const topProductsData = {
        labels: <?php echo json_encode($top_product_names); ?>,
        datasets: [{
            label: 'จำนวนครั้ง',
            data: <?php echo json_encode($top_product_counts); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(199, 199, 199, 0.6)',
                'rgba(83, 102, 255, 0.6)',
                'rgba(255, 99, 255, 0.6)',
                'rgba(99, 255, 132, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(199, 199, 199, 1)',
                'rgba(83, 102, 255, 1)',
                'rgba(255, 99, 255, 1)',
                'rgba(99, 255, 132, 1)'
            ],
            borderWidth: 1
        }]
    };

    const topProductsConfig = {
        type: 'doughnut',
        data: topProductsData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    };

    new Chart(document.getElementById('topProductsChart'), topProductsConfig);
</script>