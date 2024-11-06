<?php
include_once("./templates/header.php");

$sql = "SELECT * FROM cga_ceremony_seq ORDER BY ces_order ASC";
$result = $conn->query($sql);

$sql_seq = "SELECT MAX(ces_order)+1 AS newCesOrder FROM cga_ceremony_seq ORDER BY ces_order ASC";
$result_seq = $conn->query($sql_seq);
$obj_seq = $result_seq->fetch_object();
?>
<div class="container-fluid mt-3 mb-5 text-start">
  <h5 class="p-1 mb-3 border-bottom"><i class="bi bi-list-ol"></i> กำหนดลำดับ/ขั้นตอนขานนาม</h5>
  <div class="alert alert-danger my-2" role="alert">
  ข้อควรระวัง: ให้มีคำว่า คณบดี ขึ้นต้นเพื่อให้มีการนับยอดรวมแต่ละคณะ / และต้องมีคำว่า เบิก สำหรับเบิกบัณฑิตรับเหรียญ เพื่อให้ระบบรวมของคณะสุดท้าย
  </div>
  <div class="mb-1 d-flex justify-content-end">
    <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle-fill"></i> เพิ่มลำดับ/ขั้นตอนขานนาม</a>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-plus-circle-fill"></i> เพิ่มลำดับ/ขั้นตอนขานนาม</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="processing.php" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>ลำดับ <span class="text-danger">(*)</span></label>
                <input type="number" class="form-control" value="<?=$obj_seq->newCesOrder?>" name="cesOrder" required>
            </div>
            <div class="form-group">
                <label>รายการ <span class="text-danger">(*)</span></label>
                <input type="text" class="form-control" name="cesTitle" required>
            </div>
            <div class="form-group">
                <label>จำนวนบัณฑิต</label>
                <input type="number" class="form-control" name="cesNumOfCert">
            </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle-fill"></i> ยกเลิก</button>
            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> บันทึก</button>
            <input type="hidden" name="metId" value="CESINS">
        </div>
        </form>
        </div>
    </div>
  </div>
  
  <div class="mb-4 px-3 row d-flex justify-content-center">
  <table class="table table-hover border">
    <thead>
        <tr class="table-info">
        <th scope="col">ลำดับ</th>
        <th scope="col">รายการ</th>
        <th scope="col">จำนวน</th>
        <th scope="col">ดำเนินการ</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php
  if ($result->num_rows > 0) {
    while($obj = $result->fetch_object()) {
?>
    <form action="processing.php" method="POST">
    <td class="text-center col-md-1" scope="row">
        <input type="number" class="form-control" name="cesOrder" value="<?=$obj->ces_order?>" required>
    </td>
    <td class="col-md-8">
        <input type="text" class="form-control" name="cesTitle" value="<?=$obj->ces_title?>" required>
    </td>
    <td class="col-md-1">
        <input type="number" class="form-control" name="cesNumOfCert" value="<?=$obj->ces_numOfCert?>" required>
        <input type="hidden" name="cesId" value="<?=$obj->ces_id?>">
    </td>
    <td class="col-md-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> บันทึก</button>
        <a href="processing.php?cesId=<?=$obj->ces_id?>&metId=CESDEL" class="btn btn-danger" onClick="return confirm('กรุณายืนยันการลบข้อมูล?');"><i class="bi bi-trash3-fill"></i> ลบ</button>
        <input type="hidden" name="metId" value="CESUPD">
        <a name="sec<?=$obj->ces_order?>"></a>
    </td>
    </div>
    </form>
    </tr>
<?php
  }
} else {
  echo "***ไม่พบข้อมูลลำดับ/ขั้นตอนขานนาม***";
}
$conn->close();
?>
    </tbody>
  </table>
  </div>
  <a href="index.php" type="button" class="mt-2 btn btn-warning"><i class="bi bi-arrow-left-circle"></i> ย้อนกลับ</a>
</div>
<?php
include_once("./templates/footer.php");
?>