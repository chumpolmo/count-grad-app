<?php
include_once("./templates/header.php");
include_once("./libs/functions.php");

date_default_timezone_set('Asia/Bangkok');

$disCheck = false;
$last_prt_id = 0;
$prtDate = date("Y-m-d");
$prtTime = '';
$result_prt = '';
$result_prr = '';
if(isset($_POST['metId']) && $_POST['metId'] == 'PRTINS'){
    $prtDate = $_POST['prtDate'];
    $prtTime = $_POST['prtTime'];

    // In case this information has already been completed.
    $sql_alr = "SELECT * FROM cga_practice_time WHERE prt_date=\"$prtDate\" AND prt_time=$prtTime AND prt_status=20";
    $result_alr = $conn->query($sql_alr);
    if($result_alr->num_rows > 0){
        echo "<div class=\"alert alert-danger m-4 p-3\" role=\"alert\">";
        echo "วันที่และรอบที่ดำเนินการนี้เสร็จสิ้นไปแล้ว กรุณาเลือกวันที่และรอบที่ใหม่อีกครั้ง...";
        echo "</div>";
        echo "<meta http-equiv=\"refresh\" content=\"2; url=practice_record.php\">";
        die();
    }

    // In case this information is still incomplete.
    $sql_chk = "SELECT * FROM cga_practice_time WHERE prt_date=\"$prtDate\" AND prt_time=$prtTime AND prt_status=10";
    $result_chk = $conn->query($sql_chk);
    if($result_chk->num_rows > 0){
        $obj_chk = $result_chk->fetch_object();
        $last_prt_id = $obj_chk->prt_id;
        $disCheck = true;
    }else{
        $prtAdded = date('Y-m-d h:i:s');
        $sql_ins = "INSERT INTO cga_practice_time VALUES (NULL, \"$prtDate\", \"$prtTime\", 10, \"$prtAdded\")";
        $result = $conn->query($sql_ins);
        if ($result == TRUE) {
            $disCheck = true;
            $last_prt_id = $conn->insert_id;
    
            $sql = "SELECT ces_id FROM cga_ceremony_seq ORDER BY ces_order ASC";
            $result = $conn->query($sql);
            while($obj = $result->fetch_object()){
                $sql_tmp = "INSERT INTO cga_practice_record VALUES (NULL, $obj->ces_id, $last_prt_id, ";
                $sql_tmp.= "'','',0,0,0,0,'')";
                $result_tmp = $conn->query($sql_tmp);
            }
        }else{
            $disCheck = false;
        }
    }
}
?>
<div class="container-fluid mt-3 mb-5 text-start">
  <h5 class="p-1 mb-3 border-bottom"><i class="bi bi-stopwatch-fill"></i> การจับเวลาขานนาม</h5>
  <div class="px-3 row d-flex justify-content-center">
  <?php
  if($disCheck == false){
  ?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <div class="d-flex justify-content-center">
            <div class="col-3">
            <label>วันที่ดำเนินการ <span class="text-danger">(*)</span></label>
            <input type="date" class="form-control" name="prtDate" value="<?=$prtDate?>" required>
            </div>
            <div class="col-3 ms-1">
            <label>รอบที่ <span class="text-danger">(*)</span></label>
            <select class="form-select" name="prtTime" required>
                <option value="">-เลือกครั้งที่-</option>
                <option value="1" <?php if($prtTime == 1) echo 'selected'; ?>>1</option>
                <option value="2" <?php if($prtTime == 2) echo 'selected'; ?>>2</option>
                <option value="3" <?php if($prtTime == 3) echo 'selected'; ?>>3</option>
                <option value="4" <?php if($prtTime == 4) echo 'selected'; ?>>4</option>
            </select>
            </div>
        </div>
        <div class="p-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> บันทึก</button>
            <button type="reset" class="ms-1 btn btn-secondary" onclick="location.href='./practice_record.php'"><i class="bi bi-x-circle-fill"></i> ยกเลิก</button>
            <input type="hidden" name="metId" value="PRTINS">
        </div>
    </form>
    <?php 
    }else{
        //$sql = "SELECT * FROM cga_practice_time WHERE prt_date=\"$prtDate\" AND prt_time=$prtTime";
        $sql = "SELECT * FROM cga_practice_time WHERE prt_id=$last_prt_id AND prt_status=10";
        $result = $conn->query($sql);
        $obj = $result->fetch_object();
    ?>
    <div class="p-3 d-flex justify-content-center">
        <h5 class="mb-3">วันที่ดำเนินการ: <?=displayDate($obj->prt_date)?> รอบที่: <?=$obj->prt_time?></h5>
    </div>
    <div class="alert alert-warning col-md-7" role="alert">
        หมายเหตุ ห้ามกด Refresh หน้าจอซ้ำ ถ้าต้องการกำหนดวันที่และรอบการขานนามใหม่ให้กดปุ่ม "ยกเลิก"
    </div>
    <div class="pb-3 d-flex justify-content-end">
        <a href="processing.php?prtId=<?=$obj->prt_id?>&metId=PRTUPD" class="btn btn-success" onClick="return confirm('กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อน\nยืนยันการบันทึกข้อมูลขานนาม?');"><i class="bi bi-floppy-fill"></i> ยืนยันบันทึกข้อมูลขานนาม</a>
        <a href="processing.php?prtId=<?=$obj->prt_id?>&metId=PRTDEL" type="reset" class="ms-1 btn btn-secondary" onClick="return confirm('กรุณาตรวจสอบข้อมูลอีกครั้ง\nเมื่อกดยืนยันการยกเลิกข้อมูลจะถูกลบออกจากฐานข้อมูลทันที?');"><i class="bi bi-x-circle-fill"></i> ยกเลิก</a>
    </div>
    <hr />
    <div class="mb-1 px-3 row d-flex justify-content-center">
    <table class="table table-hover border">
        <thead>
            <tr class="table-info text-center">
                <th scope="col">ลำดับ</th>
                <th scope="col">รายการ</th>
                <th scope="col">จำนวนบัณฑิต</th>
                <th scope="col">รายละเอียด</th>
                <th scope="col">เริ่ม</th>
                <th scope="col">เวลาเริ่ม</th>
                <th scope="col">จำนวนบัณฑิตจริง</th>
                <th scope="col">จบ</th>
                <th scope="col">เวลาจบ</th>
            </tr>
        </thead>
        <tbody>
<?php
  $sql_prr = "SELECT a.*,b.*,c.* FROM cga_practice_record AS a ";
  $sql_prr.= "INNER JOIN cga_ceremony_seq AS b ON a.ces_id=b.ces_id ";
  $sql_prr.= "INNER JOIN cga_practice_time AS c ON a.prt_id=c.prt_id ";
  $sql_prr.= "WHERE a.prt_id=$last_prt_id";
  $result_prr = $conn->query($sql_prr);
  if ($result_prr->num_rows > 0) {
    while($obj_prr = $result_prr->fetch_object()) {
?>
    <tr>
        <td class="text-center col-md-1" scope="row"><?=$obj_prr->ces_order?></td>
        <td class="col-md-4"><?=$obj_prr->ces_title?></td>
        <td class="col-md-1"><?=$obj_prr->ces_numOfCert?></td>
        <td class="col-md-1">
            <a onClick="prrView(<?=$obj_prr->prr_id?>, 'PRRVIE')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#prrModal<?=$obj_prr->prr_id?>"><i class="bi bi-eye-fill"></i></a>
            <!-- Modal -->
            <div class="modal fade" id="prrModal<?=$obj_prr->prr_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-stopwatch-fill"></i> การจับเวลาขานนาม</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="prrView<?=$obj_prr->prr_id?>"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
                </div>
            </div>
        </td>
        <td class="col-md-1">
            <a onClick="timeUpdate(<?=$obj_prr->prr_id?>, 'PRRTSUPD', 0)" class="btn btn-primary"><i class="bi bi-stopwatch-fill"></i> เริ่ม</a>
        </td>
        <td class="col-md-1"><span id="prrTS<?=$obj_prr->prr_id?>">hh:mm:ss</span></td>
        <td class="text-center col-md-1" scope="row">
            <input type="number" class="form-control" name="prrCounting" id="prrCounting<?=$obj_prr->prr_id?>"
            value="<?=$obj_prr->prr_counting?>" onkeypress="prrCouting(<?=$obj_prr->prr_id?>, 'PRRCOUUPD')">
            <!-- <a onClick="prrCouting(<?=$obj_prr->prr_id?>, 'PRRCOUUPD')" class="btn btn-warning"><i class="bi bi-person-plus-fill"></i>
            <span class="badge bg-secondary">4</span>
            </a> -->
        </td>
        <td class="col-md-1">
            <a onClick="timeUpdate(<?=$obj_prr->prr_id?>, 'PRRTEUPD', <?=$obj_prr->ces_numOfCert?>)" class="btn btn-danger"><i class="bi bi-stop-circle-fill"></i> จบ</a>
        </td>
        <td class="col-md-1"><span id="prrTE<?=$obj_prr->prr_id?>">hh:mm:ss</span></td>
        </div>
    </tr>
<?php
    }
  }
?>
        </tbody>
    </table>
    </div>
    <div class="mb-4 d-flex align-items-start">
            หมายเหตุ:
            <div class="ps-3 pb-3">
                <span class="text-primary"><i class="bi bi-stop-circle"></i> หมายถึง ตามเกณฑ์</span><br />
                <span class="text-success"><i class="bi bi-arrow-up-circle"></i> หมายถึง ดีกว่าเกณฑ์</span><br />
                <span class="text-danger"><i class="bi bi-arrow-down-circle"></i> หมายถึง ต่ำกว่าเกณฑ์</span>
            </div>
    </div>
    <?php } ?>
  </div>
  <a href="index.php" type="button" class="btn btn-warning"><i class="bi bi-arrow-left-circle"></i> ย้อนกลับ</a>
</div>
<?php
$conn->close();

include_once("./templates/footer.php");
?>