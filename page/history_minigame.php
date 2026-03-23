<style>
  .bg-light { box-shadow: none }
  .container-fluid.rounded { border-radius: 1rem !important; }
</style>

<div class="container-fluid p-4">
  <div class="container-sm m-auto p-4 pt-0 aos-init aos-animate">
    <div class="container-fluid ps-4 pe-4 p-3 rounded <?php echo $bg ?>" data-aos="<?php echo $anim; ?>">
      <center class="m-0">
        <h2 class="mb-2 mt-4"><i class="fa-solid fa-dice"></i> ประวัติการเล่นมินิเกม</h2>
      </center>
      <hr class="mt-1">

      <!-- ✅ ตารางวงล้อ -->
      <div class="table-responsive mb-4 <?php echo $bg ?>">
        <table class="table table-striped <?php echo $bg ?>" id="table_wheel">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>รูปวงล้อ</th>
              <th>ชื่อรางวัล</th>
              <th>จำนวนครั้งที่ได้รับ</th>
              <th>วันที่ล่าสุด</th>
              <th>การจัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $q = dd_q("
              SELECT wheellog.*, wheel_item.img
              FROM wheellog
              LEFT JOIN wheel_item ON wheellog.category = wheel_item.name
              WHERE wheellog.uid = ?
              ORDER BY wheellog.id DESC
            ", [$_SESSION['id']]);

            $items = [];
            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
              $cat = $row['category'];
              if (!isset($items[$cat])) {
                $items[$cat] = [
                  'img' => $row['img'],
                  'category' => $cat,
                  'count' => 0,
                  'latest' => $row['date'],
                  'records' => []
                ];
              }
              $items[$cat]['count']++;
              $items[$cat]['latest'] = max($items[$cat]['latest'], $row['date']);
              $items[$cat]['records'][] = [
                'prize_name' => $row['prize_name'],
                'date' => $row['date']
              ];
            }

            $i = 1;
            foreach ($items as $cat => $p) {
            ?>
            <tr data-category="<?= htmlspecialchars($cat); ?>">
              <td class="text-center" style="color: var(--font)"><?= $i++; ?></td>
              <td><img src="<?= htmlspecialchars($p['img']); ?>" class="rounded" style="width:90px;"></td>
              <td style="color: var(--font)"><?= htmlspecialchars($p['category']); ?></td>
              <td style="color: var(--font)"><?= number_format($p['count']); ?> ครั้ง</td>
              <td style="color: var(--font)"><?= htmlspecialchars($p['latest']); ?></td>
              <td>
                <button 
                  class="btn btn-main view-wheel-btn"
                  data-items='<?= htmlspecialchars(json_encode($p['records'], JSON_UNESCAPED_UNICODE)); ?>'
                  data-category="<?= htmlspecialchars($p['category']); ?>"
                >
                  <i class="fa-solid fa-eye"></i> ดูข้อมูล
                </button>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- ✅ Modal -->
<div class="modal fade" id="wheelDataModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content <?php echo $bg; ?> shadow-lg border-0" style="border-radius: 1.2vh;">
      <div class="modal-header border-0" style="background: var(--main); color: var(--font);">
        <h5 class="modal-title fw-bold text-white">
          <i class="fa-solid fa-dice me-2 text-white"></i> รายละเอียดรางวัล: 
          <span id="modalWheelCategory" class="text-light"></span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table class="table align-middle mb-0 text-light table-hover table-borderless">
            <thead>
              <tr>
                <th style="width:40px;"></th>
                <th>#</th>
                <th>ของรางวัล / โค้ด</th>
                <th>วันที่</th>
              </tr>
            </thead>
            <tbody id="wheelDataBody">
              <tr><td colspan="4" class="text-center text-muted py-3">เลือก “ดูข้อมูล”</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="modal-footer border-0 d-flex justify-content-between">
        <button class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark"></i> ปิด
        </button>
        <div>
          <button class="btn btn-outline-success rounded-pill px-4 me-2" id="copySelectedWheel">
            <i class="fa-solid fa-copy"></i> คัดลอกที่เลือก
          </button>
          <button class="btn btn-success rounded-pill px-4" id="copyAllWheel">
            <i class="fa-solid fa-clipboard-check"></i> คัดลอกทั้งหมด
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".view-wheel-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const cat = btn.dataset.category;
      const items = JSON.parse(btn.dataset.items);
      document.getElementById("modalWheelCategory").textContent = cat;

      let html = "";
      items.forEach((it, i) => {
        html += `
          <tr>
            <td><input type="checkbox" class="row-check" value="${it.prize_name}"></td>
            <td>${i + 1}</td>
            <td>${it.prize_name}</td>
            <td>${it.date}</td>
          </tr>`;
      });
      document.getElementById("wheelDataBody").innerHTML = html;

      new bootstrap.Modal(document.getElementById("wheelDataModal")).show();
    });
  });

  // ✅ Copy ทั้งหมด
  document.getElementById("copyAllWheel").addEventListener("click", () => {
    const vals = [...document.querySelectorAll(".row-check")].map(cb => cb.value);
    if (!vals.length) return Swal.fire("ไม่มีข้อมูลให้คัดลอก", "", "warning");
    navigator.clipboard.writeText(vals.join("\n"));
    Swal.fire("คัดลอกแล้ว!", "คัดลอกข้อมูลทั้งหมดสำเร็จ", "success");
  });

  // ✅ Copy เฉพาะที่เลือก
  document.getElementById("copySelectedWheel").addEventListener("click", () => {
    const vals = [...document.querySelectorAll(".row-check:checked")].map(cb => cb.value);
    if (!vals.length) return Swal.fire("ยังไม่ได้เลือกรายการ", "", "warning");
    navigator.clipboard.writeText(vals.join("\n"));
    Swal.fire("คัดลอกแล้ว!", "คัดลอกเฉพาะรายการที่เลือกสำเร็จ", "success");
  });
});
</script>
