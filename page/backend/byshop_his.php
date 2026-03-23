<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api_app_premium.byshop.me/api/history-all',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('keyapi' => $byshop_key),  
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=u8df3d96ij8re36ld76cl64t3p'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$load_packz = json_decode($response);


?>

<div class="modal fade text-white bg-glass" id="appInfoModal" tabindex="-1" role="dialog" aria-labelledby="appInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-white bg-glass" style="border-radius: 1vh;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="appInfoModalLabel">ข้อมูล App Premium</h5>
                <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body text-white" id="appInfoContent">
                <!-- ข้อมูลจะถูกแสดงที่นี่ -->
            </div>
        </div>
    </div>
</div>

<div class="container-sm <?php echo $bg?>  mt-5 shadow-sm p-4 mb-4" data-aos="fade-down">
    <center>
        <h1 class="">&nbsp;<i class="fa-duotone fa-history"></i>&nbsp;ประวัติการแอพพรีเมี่ยม</h1>
    </center>
    <hr>
    <div class="table-responsive mt-3 ">
        <table id="table" class=" table mt-2">
            <thead class="table">
                <tr>
  					<th class="sorting sorting_desc">Order ID</th>
  					<th>สินค้า</th>
  					<th>E-mail/Password</th>						
  					<th>username(ตัวเอง)</th>
  					<th>userid(ลูกค้า)</th>
  					<th>ราคา</th>
  				    <th>เวลา</th>
  				</tr>
            </thead>
            <tbody>
                <?php 
					foreach ($load_packz as $data) {
					?>
  					<tr>
  						<td><?=$data->id;?></td>
  						<td><?=$data->name;?></td>
  						<td><button class="btn bg-main w-100 mb-2 text-white view-info-btn" data-toggle="modal" data-target="#appInfoModal" data-info="Email : <?= htmlspecialchars($data->email); ?> | Password : <?= htmlspecialchars($data->password); ?>"><i class="fa-regular fa-search"></i>&nbsp;ดูข้อมูล</button></td>
						<td><?=$data->username;?></td>
  						<td><?=$data->username_customer;?></td>
  						<td><?=$data->price;?></td>
  					    <td><?=$data->time;?></td>
  					</tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    // Triggered when "ดูข้อมูล" button is clicked
    $(".view-info-btn").click(function() {
        // Get the info attribute from the button
        var appInfo = $(this).data("info");

        // Set the content of the modal body
        $("#appInfoContent").html(appInfo);
    });
</script>