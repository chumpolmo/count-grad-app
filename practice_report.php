<?php
include_once("./templates/header.php");
include_once("./libs/functions.php");
?>
<div class="container-fluid mt-3 mb-5 text-start">
  <h5 class="p-1 mb-3 border-bottom"><i class="bi bi-file-text-fill"></i> รายงานการจับเวลาขานนาม</h5>
  <div class="px-3 row d-flex justify-content-center">
    <table class="table table-hover">
    <thead>
        <tr class="table-info">
        <th scope="col">ลำดับ</th>
        <th scope="col">วันที่ดำเนินการ</th>
        <th scope="col">รอบที่</th>
        <th scope="col">วันที่สร้างรายงาน</th>
        <th scope="col">ดำเนินการ</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $ord = 1;
    $sql = "SELECT * FROM cga_practice_time WHERE prt_status=20 ORDER BY prt_date, prt_time ASC";
    $result = $conn->query($sql);
    while($obj = $result->fetch_object()){
    ?>
        <tr>
        <th scope="row"><?=$ord?></th>
        <td><?=$obj->prt_date?></td>
        <td><?=$obj->prt_time?></td>
        <td><?=$obj->prt_added?></td>
        <td>
            <a href="practice_report_print.php?prtId=<?=$obj->prt_id?>&metId=PRTREP" class="btn btn-success"><i class="bi bi-file-text"></i> ดูรายงาน</a>
            <a href="processing.php?prtId=<?=$obj->prt_id?>&metId=PRTDEL" type="reset" class="ms-1 btn btn-danger" onClick="return confirm('กรุณาตรวจสอบข้อมูลอีกครั้ง\nเมื่อกดยืนยันการยกเลิกข้อมูลจะถูกลบออกจากฐานข้อมูลทันที?');"><i class="bi bi-x-circle-fill"></i> ลบ</a>
        </td>
        </tr>
    <?php
        $ord++;
    }
    ?>
    </tbody>
    </table>
    <div class="alert alert-warning" role="alert">
    หมายเหตุ เลือกรายงานการจับเวลาขานนามตามที่ปรากฎ
    </div>
  </div>
  <a href="index.php" type="button" class="btn btn-warning"><i class="bi bi-arrow-left-circle"></i> ย้อนกลับ</a>
</div>
<?php
$conn->close();
include_once("./templates/footer.php");
?>