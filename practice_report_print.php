<?php
include_once("./templates/header.php");
include_once("./libs/functions.php");

if(!isset($_GET['metId']) && $_GET['metId'] == 'PRTREP'){
    echo "[INFO] Permission denied, please waiting.";
    echo "<meta http-equiv=\"refresh\" content=\"1; url=practice_report.php\">";
    die();
}

$prtId = $_GET['prtId'];
$sql = "SELECT * FROM cga_practice_time WHERE prt_id=$prtId";
$result = $conn->query($sql);
$obj = $result->fetch_object();
?>
<div class="container-fluid mt-3 mb-5 text-start">
  <h5 class="p-1 mb-3 border-bottom"><i class="bi bi-file-text-fill"></i> รายงานการจับเวลาขานนาม</h5>
  <div class="px-3 row d-flex justify-content-center">
        <div class="d-flex justify-content-center">
            <h4>รายงานการจับเวลาขานนามบัณฑิตและพิธีการในพิธีพระราชทานปริญญาบัตร</h4>
        </div>
        <div class="d-flex justify-content-center">
            <h5><?=_TITLE_3?></h5>
        </div>
        <div class="d-flex justify-content-center">
            <h5>วันที่ <?=displayDate($obj->prt_date)?> รอบที่ <?=$obj->prt_time?></h5>
        </div>
    <hr />
  </div>
  <div class="mb-1 d-flex justify-content-end">
    <a href="practice_pdf.php?prtId=<?=$obj->prt_id?>&metId=PRTREP" class="btn btn-success" target="_blank"><i class="bi bi-file-pdf-fill"></i> พิมพ์รายงาน</a>
  </div>
  <div class="mb-1 px-3 row d-flex justify-content-center">
   <table class="table table-hover border">
    <thead>
        <tr class="table-info">
        <th scope="col">ลำดับ</th>
        <th scope="col">รายการ</th>
        <th scope="col">จำนวนบัณฑิต</th>
        <th scope="col">เวลาเริ่ม</th>
        <th scope="col">เวลาจบ</th>
        <th scope="col">เวลารวม (นาที:วินาที)</th>
        <th scope="col">ความเร็วในการอ่าน (คน/นาที)</th>
        <th scope="col">เกณฑ์พิจารณา</th>
        <th scope="col">จำนวนบัณฑิตจริง</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $prrTT = 0;
    $sql_prr = "SELECT a.*,b.*,c.* FROM cga_practice_record AS a ";
    $sql_prr.= "INNER JOIN cga_ceremony_seq AS b ON a.ces_id=b.ces_id ";
    $sql_prr.= "INNER JOIN cga_practice_time AS c ON a.prt_id=c.prt_id ";
    $sql_prr.= "WHERE a.prt_id=$obj->prt_id";
    $result_prr = $conn->query($sql_prr);
    if ($result_prr->num_rows > 0) {
        while($obj_prr = $result_prr->fetch_object()) {
    ?>
    <tr>
    <td class="text-center col-md-1" scope="row"><?=$obj_prr->ces_order?></td>
    <td class="col-md-3"><?=$obj_prr->ces_title?></td>
    <td class="col-md-1"><?=displayText($obj_prr->ces_numOfCert)?></td>
    <td class="col-md-1"><?=displayTime($obj_prr->prr_time_start)?></td>
    <td class="col-md-1"><?=displayTime($obj_prr->prr_time_end)?></td>
    <td class="col-md-1"><?=displayMinute($obj_prr->prr_time_total)?></td>
    <td class="col-md-1"><?=displayText($obj_prr->prr_speed_per_min)?></td>
    <td class="col-md-2"><?=displayResult($obj_prr->prr_result)?></td>
    <td class="col-md-1"><?=displayText($obj_prr->prr_counting)?></td>
    </tr>
    <?php
            $prrTT+= $obj_prr->prr_time_total;
        }
    }
    ?>
    <tr class="fw-bold table-secondary">
        <td class="col-md-6 text-center" colspan="5">เวลาเฉลี่ยรวม</td>
        <td class="col-md-1"><?=displayMinute($prrTT)?></td>
        <td class="col-md-5" colspan="3"><?=''?></td>
    </tr>
    </tbody>
  </table>
  </div>
  <div class="ms-1 mb-4 d-flex align-items-start">
            หมายเหตุ:
            <div class="ps-3 pb-3">
                <span class="text-primary"><i class="bi bi-stop-circle"></i> หมายถึง ตามเกณฑ์</span><br />
                <span class="text-success"><i class="bi bi-arrow-up-circle"></i> หมายถึง ดีกว่าเกณฑ์</span><br />
                <span class="text-danger"><i class="bi bi-arrow-down-circle"></i> หมายถึง ต่ำกว่าเกณฑ์</span>
            </div>
    </div>
  <a href="practice_report.php" type="button" class="btn btn-warning"><i class="bi bi-arrow-left-circle"></i> ย้อนกลับ</a>
</div>
<?php
$conn->close();
include_once("./templates/footer.php");
?>