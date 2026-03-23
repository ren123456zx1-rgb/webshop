<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px; width: 26px;
  left: 4px; bottom: 4px;
  background-color: white;
  transition: .4s;
}
input:checked + .slider { background-color: #2196F3; }
input:checked + .slider:before { transform: translateX(26px); }
.slider.round { border-radius: 34px; }
.slider.round:before { border-radius: 50%; }
</style>

<div class="container-sm mt-5 shadow-sm p-4 mb-4 rounded <?= $bg ?>">
  <center><h1><i class="fa-brands fa-discord"></i> ตั้งค่า Discord</h1></center>
  <hr>

  <div class="col-lg-6 m-auto">
    <div class="shadow-sm p-4 mb-4 rounded">
      <p class="m-0">เปิด/ปิดระบบ <span class="text-danger">*</span></p>
      <label class="switch">
        <input type="checkbox" id="dc_status" <?php if($discord['status']=="1"){ echo "checked"; } ?> >
        <span class="slider round"></span>
      </label>

      <p class="mt-3 m-0">Client ID <span class="text-danger">*</span></p>
      <input type="text" id="clientid" class="form-control" value="<?php echo $discord['clientid']; ?>">

      <p class="mt-3 m-0">Client Secret <span class="text-danger">*</span></p>
      <input type="text" id="clientsecret" class="form-control" value="<?php echo $discord['clientsecret']; ?>">
    </div>
  </div>

  <center>
    <button class="btn btn-primary w-100" id="saveDiscord">บันทึกข้อมูล</button>
  </center>
</div>

<script>
$("#saveDiscord").click(function(e) {
    e.preventDefault();

    let formData = new FormData();
    formData.append('clientid', $("#clientid").val());
    formData.append('clientsecret', $("#clientsecret").val());
    formData.append('status', $('#dc_status').is(':checked') ? "1" : "0");

    $.ajax({
        type: 'POST',
        url: 'services/backend/discord.php',
        data: formData,
        contentType: false,
        processData: false,
    }).done(function(res) {
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            text: res.message
        }).then(() => location.reload());
    }).fail(function(jqXHR) {
        Swal.fire({
            icon: 'error',
            title: 'ผิดพลาด',
            text: jqXHR.responseJSON.message
        });
    });
});

$(document).ready(function(){
    $.ajax({
        type: 'POST',
        url: 'services/backend/discord_get.php',
        dataType: "json"
    }).done(function(res){
        console.log("LOAD:", res);

        $("#clientid").val(res.clientid);
        $("#clientsecret").val(res.clientsecret);

        if(res.status == "1"){
            $("#dc_status").prop('checked', true);
        } else {
            $("#dc_status").prop('checked', false);
        }
    });
});

</script>
