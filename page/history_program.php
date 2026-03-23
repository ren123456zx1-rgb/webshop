
<style>
  .bg-light { box-shadow: none }
  .container-fluid.rounded { border-radius: 1rem !important; }
</style>

<div class="container-fluid p-4">
  <div class="container-sm m-auto p-4 pt-0 aos-init aos-animate" data-aos="<?php echo $anim; ?>">
    <div class="container-fluid ps-4 pe-4 p-3 rounded <?php echo $bg ?>">
      <center class="m-0">
        <h2 class="mb-2 mt-4"><i class="fa-solid fa-link"></i> ประวัติการสั่งซื้อโปรแกรม</h2>
      </center>
      <hr class="mt-1">

      <!-- ✅ ตารางโปรแกรม -->
      <div class="table-responsive mb-4 <?php echo $bg ?>">
        <table class="table table-striped <?php echo $bg ?>" id="table_program">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>รูปสินค้า</th>
              <th>ชื่อสินค้า</th>
              <th>ลิงก์ดาวน์โหลด</th>
              <th>ของรางวัล / โค้ด</th>
              <th>วันที่</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $q = dd_q("
              SELECT boxlog.*, box_product.img, box_product.link_download
              FROM boxlog
              LEFT JOIN box_product ON boxlog.category = box_product.name
              WHERE boxlog.uid = ? AND box_product.type = 2
              ORDER BY boxlog.id DESC
            ", [$_SESSION['id']]);

            $i = 1;
            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
              <td class="text-center" style="color: var(--font)"><?= $i++; ?></td>
              <td><img src="<?= htmlspecialchars($row['img']); ?>" class="rounded" style="width:100px;"></td>
              <td style="color: var(--font)"><?= htmlspecialchars($row['category']); ?></td>
              <td>
                <?php if (!empty($row['link_download'])): ?>
                  <a href="<?= htmlspecialchars($row['link_download']); ?>" target="_blank" class="btn btn-sm btn-main">
                    <i class="fa-solid fa-download"></i> ดาวน์โหลด
                  </a>
                <?php else: ?>
                  <span class="text-muted">ไม่มีลิงก์</span>
                <?php endif; ?>
              </td>
              <td style="color: var(--font)"><?= htmlspecialchars($row['prize_name']); ?></td>
              <td style="color: var(--font)"><?= htmlspecialchars($row['date']); ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- ✅ Modal (สำหรับคัดลอกโค้ด) -->
<div class="modal fade" id="programModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content <?php echo $bg; ?> shadow-lg border-0" style="border-radius: 1rem;">
      <div class="modal-header border-0" style="background: var(--main); color: var(--font);">
        <h5 class="modal-title fw-bold">
          <i class="fa-solid fa-code me-2"></i> คัดลอกโค้ดโปรแกรม
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <textarea id="codeContent" class="form-control" rows="5" readonly style="border-radius:1rem;"></textarea>
      </div>
      <div class="modal-footer border-0">
        <button class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark"></i> ปิด
        </button>
        <button class="btn btn-success rounded-pill px-4" id="copyCode">
          <i class="fa-solid fa-clipboard"></i> คัดลอกโค้ด
        </button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  // ✅ คลิกโค้ดแล้วเปิด modal
  document.querySelectorAll("#table_program tbody tr td:nth-child(5)").forEach(cell => {
    const code = cell.textContent.trim();
    if (code && code !== "ไม่มีลิงก์") {
      cell.style.cursor = "pointer";
      cell.title = "คลิกเพื่อดูโค้ด";
      cell.addEventListener("click", () => {
        document.getElementById("codeContent").value = code;
        new bootstrap.Modal(document.getElementById("programModal")).show();
      });
    }
  });

  // ✅ ปุ่มคัดลอกใน modal
  document.getElementById("copyCode").addEventListener("click", () => {
    const code = document.getElementById("codeContent").value.trim();
    if (!code) return Swal.fire("ไม่พบโค้ด", "", "warning");
    navigator.clipboard.writeText(code);
    Swal.fire("คัดลอกแล้ว!", "โค้ดถูกคัดลอกไปยังคลิปบอร์ดแล้ว", "success");
  });
});
</script>
