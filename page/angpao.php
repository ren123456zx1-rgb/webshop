<style>
    .font-bold {
        font-weight: 700;
    }
    .font-semibold {
        font-weight: 600;
    }  
</style>
<div class="container-fluid p-4">
    <div class="container-md  ps-4 pe-4">

<div class="container-fluid p-4">
    <div class="container-md ps-4 pe-4">

        <div class="row">

            <!-- ============ ซ้าย : ปุ่ม 3 ปุ่ม ============ -->
            <div class="col-12 col-lg-3">

                <div class="mb-3">
                    <a href="/angpao" style="text-decoration: none;">
                        <div class="container-md <?php echo $bg?> shadow p-3" style="border-radius:1vh">
                            <div class="d-flex justify-content-between">
                                <img src="https://www.truemoney.com/wp-content/uploads/2022/01/truemoneywallet-sendgift-hongbao-20220125-icon-1.png" style="max-height: 50px;">
                                <div class="ms-1" style="text-align: right;">
                                    <h5 class="font-semibold text-dark mb-0">ซองอั่งเปา</h5>
                                    <p class="text-muted mb-0">กรอกลิงค์เลย</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="/slip" style="text-decoration: none;">
                        <div class="container-md <?php echo $bg?> shadow p-3" style="border-radius:1vh">
                            <div class="d-flex justify-content-between">
                                <img src="https://cdn.discordapp.com/attachments/1097917702875660358/1102660427453825074/slipscanpay.png" style="max-height: 50px;">
                                <div class="ms-1" style="text-align: right;" style="text-align: right;">
                                    <h5 class="font-semibold text-dark mb-0">โอนด้วยธนาคาร</h5>
                                    <p class="text-muted mb-0">เช็คสลิปเลย</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="mb-3">
                    <a href="/redeem" style="text-decoration: none;">
                        <div class="container-md <?php echo $bg?> shadow p-3" style="border-radius:1vh">
                            <div class="d-flex justify-content-between">
                                <img src="assets/icon/unboxing.png" style="max-height: 50px;">
                                <div class="ms-1" style="text-align: right;">
                                    <h5 class="font-semibold text-dark mb-0">โค้ด</h5>
                                    <p class="text-muted mb-0">กรอกโค้ดเลย</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <!-- ============ จบซ้าย ============ -->



            <!-- ============ ขวา : เนื้อหาการเติมเงิน ============ -->
            <div class="col-12 col-lg-9">

                <div class="container-fluid <?php echo $bg?> p-4" style="border-radius:1vh">
                    <div class="col-lg-7 m-auto">

                        <h1 class="text-strongest" data-aos="fade-right" data-aos-duration="500">
                            <i class="fa-duotone fa-coins"></i> TOPUP (เติมเงิน)
                        </h1>

                        <div data-aos="fade-right" data-aos-duration="600">
                            <hr class="mt-1 mb-2">
                            <h5 class="m-0"><i class="fa-regular fa-plus-circle"></i>&nbsp;ระบบเติมเงินด้วยซองของขวัญ</h5>
                        </div>

                        <center>
                            <div class="col-lg-4" data-aos="fade-down" data-aos="700">
                                <img src="assets/img/topup.png" class="img-fluid">
                            </div>
                        </center>

                        <?php if ($config['fee'] == "on") { ?>
                            <div data-aos="<?php echo $anim; ?>" data-aos-duration="750">
                                <p class="m-0 text-center text-danger"><b>ค่าธรรมเนียม 2.3 %</b></p>
                            </div>
                        <?php } elseif ($config['fee'] == "off") { ?>
                            <div data-aos="<?php echo $anim; ?>" data-aos-duration="750">
                                <p class="m-0 text-center text-success"><b>ไม่มีค่าธรรมเนียม</b></p>
                            </div>
                        <?php } ?>

                        <div data-aos="<?php echo $anim; ?>" data-aos-duration="750">
                            <input type="text" id="link" class="form-control text-center mt-1" style="border-radius: 10px;"
                                placeholder="กรอกลิงค์ซองของขวัญที่นี่">
                        </div>

                        <button class="bg-main-gra btn mt-2 w-100" id="topup_btn" style="border-radius: 10px;"
                            data-aos="fade-up" data-aos-duration="800">
                            ยืนยันการเติมเงิน
                        </button>
                    </div>
                </div>

            </div>
            <!-- ============ จบขวา ============ -->

        </div>

    </div>
</div>

        <!-- <div class="container-fluid ps-4 pe-4 <?php echo $bg?> border border-2">
            <center class="m-0"><h2 class="text-main mb-2 mt-4"><i class="fa-regular fa-history"></i> ประวัติการเติมเงิน</h2></center>
            <hr class="mt-1">
            <div class="table-responsive">
            <table class="table table-striped text-center" id="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">จำนวนเงิน</th>
                    <th scope="col">วันที่</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $i = 1;
                    $f = dd_q("SELECT * FROM topup_his WHERE uid = ? ORDER BY date DESC", [$_SESSION['id']]);
                    while($row = $f->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <th scope="row"><?php echo $row['id'];?></th>
                    <td><?php echo $row['amount'];?></td>
                    <td><?php echo $row['date'];?></td>
                </tr>
                <?php $i++;} ?>
            </table>
            </div>
        </div> -->
    </div>
</div>

<script>
    $("#topup_btn").click(function(){
        var formData = new FormData();
        formData.append('link'  , $("#link").val());
        $.ajax({
            type: 'POST',
            url: 'services/topup.php',
            data:formData,
            contentType: false,
            processData: false,   
        }).done(function(res){
            result = res;
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: result.message
            }).then(function() {
                    window.location = "/<?php echo $_GET['page'];?>";
            });
        }).fail(function(jqXHR){
            console.log(jqXHR);
            res = jqXHR.responseJSON;
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            //console.clear();
        });
        // $("#save_btn").attr("data-id") <- id user
    });
</script>