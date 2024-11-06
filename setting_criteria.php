<?php
include_once("./templates/header.php");

$setId = 0;
$numOfStud = 0;
$sql = "SELECT * FROM cga_settings";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($obj = $result->fetch_object()) {
    if($obj->set_name == "numOfStud"){
        $setId = $obj->set_id;
        $numOfStud = $obj->set_value;
    }
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<div class="container-fluid mt-3 mb-5 text-start">
  <h5 class="p-1 mb-3 border-bottom"><i class="bi bi-1-circle-fill"></i> กำหนดจำนวนมาตรฐานขานนาม</h5>
  <div class="my-4 row d-flex justify-content-center">
    <form action="processing.php" method="POST">
    <div class="col-md-4 mx-auto d-flex align-items-start">
        <label>เกณฑ์ขานนาม (<i class="bi bi-info-circle-fill"></i> ระบุจำนวนคน/นาที)</label>
    </div>
    <div class="col-md-4 mx-auto d-flex align-items-start">
        <input type="number" class="form-control" name="numOfStud" placeholder="ระบุจำนวนคน/นาที"
         value="<?=$numOfStud?>" required>
        <input type="hidden" name="setId" value="<?=$setId?>">
    </div>
    <div class="col-md-4 mx-auto d-flex align-items-start">
        <label>คน/นาที</label>
    </div>
    <div class="col-md-4 mx-auto d-flex align-items-start">
        <small class="form-text text-muted">
            หมายเหตุ:
            <div class="ps-3 pb-3">
                <span class="text-primary"><i class="bi bi-stop-circle"></i> หมายถึง ตามเกณฑ์</span><br />
                <span class="text-success"><i class="bi bi-arrow-up-circle"></i> หมายถึง ดีกว่าเกณฑ์</span><br />
                <span class="text-danger"><i class="bi bi-arrow-down-circle"></i> หมายถึง ต่ำกว่าเกณฑ์</span>
            </div>
        </small>
    </div>
    <div class="col-md-4 mx-auto d-flex justify-content-center">
        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> บันทึก</button>
        <button type="reset" class="btn btn-secondary ms-1"><i class="bi bi-eraser-fill"></i> เคลียร์</button>
        <input type="hidden" name="metId" value="SETUPD">
    </div>    
    </form>
  </div>
  <a href="index.php" type="button" class="mt-5 btn btn-warning"><i class="bi bi-arrow-left-circle"></i> ย้อนกลับ</a>
</div>
<?php
include_once("./templates/footer.php");
?>