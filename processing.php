<?php
include_once("./config/dbConnection.php");
include_once("./libs/functions.php");

date_default_timezone_set('Asia/Bangkok');

if(isset($_POST['metId']) && $_POST['metId'] == 'SETUPD'){
    $setId = $_POST['setId'];
    $numOfStud = $_POST['numOfStud'];
    $sql = "UPDATE cga_settings SET set_value = \"$numOfStud\" WHERE set_id=$setId";
    if ($conn->query($sql) === TRUE) {
      echo "[INFO] การอัปเดตข้อมูลสำเร็จ";
    } else {
      echo "[ERR] การอัปเดตข้อมูลมีข้อผิดพลาด: " . $conn->error;
    }
    
    echo "<br/>กรุณารอสักครู่...";
    echo "<meta http-equiv=\"refresh\" content=\"1; url=setting_criteria.php\">";
}else if(isset($_POST['metId']) && $_POST['metId'] == 'CESUPD'){
    $cesId = $_POST['cesId'];
    $cesOrder = $_POST['cesOrder'];
    $cesTitle = $_POST['cesTitle'];
    $cesNumOfCert = $_POST['cesNumOfCert'];

    $sql = "UPDATE cga_ceremony_seq SET ces_order = \"$cesOrder\", ces_title = \"$cesTitle\", ces_numOfCert = \"$cesNumOfCert\" WHERE ces_id=$cesId";
    if ($conn->query($sql) === TRUE) {
      echo "[INFO] การอัปเดตข้อมูลสำเร็จ";
    } else {
      echo "[ERR] การอัปเดตข้อมูลมีข้อผิดพลาด: " . $conn->error;
    }
    
    echo "<br/>กรุณารอสักครู่...";
    echo "<meta http-equiv=\"refresh\" content=\"0; url=setting_ceremony_seq.php?#sec$cesOrder\">";
}else if(isset($_POST['metId']) && $_POST['metId'] == 'CESINS'){
    $cesOrder = $_POST['cesOrder'];
    $cesTitle = $_POST['cesTitle'];
    $cesNumOfCert = $_POST['cesNumOfCert'];

    $sql = "INSERT INTO cga_ceremony_seq VALUES (NULL, \"$cesOrder\", \"$cesTitle\", \"$cesNumOfCert\", 10)";
    if ($conn->query($sql) === TRUE) {
      echo "[INFO] การเพิ่มข้อมูลสำเร็จ";
    } else {
      echo "[ERR] การเพิ่มข้อมูลมีข้อผิดพลาด: " . $conn->error;
    }
    
    echo "<br/>กรุณารอสักครู่...";
    echo "<meta http-equiv=\"refresh\" content=\"0; url=setting_ceremony_seq.php?#sec$cesOrder\">";
}else if(isset($_GET['metId']) && $_GET['metId'] == 'CESDEL'){
    $cesId = $_GET['cesId'];
    $sql = "DELETE FROM cga_ceremony_seq WHERE ces_id=$cesId";
    if ($conn->query($sql) === TRUE) {
      echo "[INFO] การลบข้อมูลสำเร็จ";
    } else {
      echo "[ERR] การลบข้อมูลมีข้อผิดพลาด: " . $conn->error;
    }
    
    echo "<br/>กรุณารอสักครู่...";
    echo "<meta http-equiv=\"refresh\" content=\"0; url=setting_ceremony_seq.php\">";
}else if(isset($_GET['metId']) && $_GET['metId'] == 'PRTDEL'){
    $prtId = $_GET['prtId'];
    $sql = "DELETE FROM cga_practice_record WHERE prt_id=$prtId;DELETE FROM cga_practice_time WHERE prt_id=$prtId;";
    if ($conn->multi_query($sql) === TRUE) {
      echo "[INFO] การลบข้อมูลสำเร็จ";
    } else {
      echo "[ERR] การลบข้อมูลมีข้อผิดพลาด: " . $conn->error;
    }
    echo "<br/>กรุณารอสักครู่...";
    echo "<meta http-equiv=\"refresh\" content=\"1; url=practice_record.php\">";
}else if(isset($_GET['metId']) && $_GET['metId'] == 'PRRTSUPD'){
    $prrId = $_GET['prrId'];
    $prrTS = date('H:i:s');
    $sql = "UPDATE cga_practice_record SET prr_time_start=\"$prrTS\" WHERE prr_id=$prrId";
    if ($conn->query($sql) === TRUE) {
      $sql_tmp = "SELECT prr_time_start FROM cga_practice_record WHERE prr_id=$prrId";
      $result_tmp = $conn->query($sql_tmp);
      $obj_tmp = $result_tmp->fetch_object();
      echo $obj_tmp->prr_time_start;
    } else {
      echo "[ERR] การอัปเดตข้อมูลมีข้อผิดพลาด: " . $conn->error;
    }
}else if(isset($_GET['metId']) && $_GET['metId'] == 'PRRTEUPD'){
    $prrId = $_GET['prrId'];
    $numOfCert = $_GET['numOfCert'];
    $prrTS = date('H:i:s');

    $x1 = 0;
    $x2 = 0;
    $z1 = 0;
    $z2 = 0;
    $sql_cfg = "SELECT set_value FROM cga_settings WHERE set_name LIKE 'numOfStud'";
    $result_cfg = $conn->query($sql_cfg);
    $obj_cfg = $result_cfg->fetch_object();
    $numOfStud = $obj_cfg->set_value;
    $x1 = number_format((60/$numOfStud), 2);

    $sql = "UPDATE cga_practice_record SET prr_time_end=\"$prrTS\" WHERE prr_id=$prrId";
    if ($conn->query($sql) === TRUE) {
      $sql_tmp = "SELECT * FROM cga_practice_record WHERE prr_id=$prrId";
      $result_tmp = $conn->query($sql_tmp);
      $obj_tmp = $result_tmp->fetch_object();

      if($numOfCert != 0){
        if(!isset($obj_tmp->prr_time_start) || $obj_tmp->prr_time_start == '00:00:00'){
            echo "<span class=\"text-danger\">*กรุณากดปุ่ม [<i class=\"bi bi-stopwatch-fill\"></i>เริ่ม]</span>";
            die();
        }

        $x2 = number_format(calculateTime($obj_tmp->prr_time_start, $obj_tmp->prr_time_end), 2,'.','');
        $z2 = number_format(((60/$x2)*$obj_tmp->prr_counting), 2,'.','');
        $z1 = ($x1*$obj_tmp->prr_counting);

        // Check the reading speed criteria.
        $st = 0;
        if($z2 == $z1) $st = 10;
        else if($z2 > $z1) $st = 20;
        else if($z2 < $z1) $st = 30;
  
        // echo "[x1-$x1,x2-$x2,y-$numOfCert,z2-$z2,z1-$z1,st-$st]";
        // echo "[z2-$z2 | z1-$z1 | st-$st]";

        $sql_fin = "UPDATE cga_practice_record SET prr_time_total=$x2, prr_speed_per_min=$z2, prr_result=$st WHERE prr_id=$prrId";
        // echo $sql_fin;
        if ($conn->query($sql_fin) === FALSE) {
          echo "[ERR] การอัปเดตข้อมูลมีข้อผิดพลาด: " . $conn->error;
        }
      }

      echo $obj_tmp->prr_time_end;
    } else {
      echo "[ERR] การอัปเดตข้อมูลมีข้อผิดพลาด: " . $conn->error;
    }
}else if(isset($_GET['metId']) && $_GET['metId'] == 'PRRVIE'){
    $prrId = $_GET['prrId'];
    
    $sql_prr = "SELECT a.*,b.*,c.* FROM cga_practice_record AS a ";
    $sql_prr.= "INNER JOIN cga_ceremony_seq AS b ON a.ces_id=b.ces_id ";
    $sql_prr.= "INNER JOIN cga_practice_time AS c ON a.prt_id=c.prt_id ";
    $sql_prr.= "WHERE a.prr_id=$prrId";
    $result_prr = $conn->query($sql_prr);
    if ($result_prr === FALSE) {
      echo "[ERR] การเรียกดูข้อมูลมีข้อผิดพลาด: " . $conn->error;
      die();
    }

    $obj_prr = $result_prr->fetch_object();
?>
    <p class="text-center fs-5">วันที่: <?=$obj_prr->prt_date?> ครั้งที่: <?=$obj_prr->prt_time?></p>
    <p class="fs-6">
      <table class="table table-striped">
        <tr><td>ลำดับ:</td><td><?=$obj_prr->ces_order?></td></tr>
        <tr><td>รายการ:</td><td><?=$obj_prr->ces_title?></td></tr>
        <tr><td>จำนวนบัณฑิต:</td><td><?php echo displayText($obj_prr->ces_numOfCert); ?></td></tr>
        <tr><td>เวลาเริ่ม:</td><td><?php echo displayTime($obj_prr->prr_time_start); ?></td></tr>
        <tr><td>เวลาจบ:</td><td><?php echo displayTime($obj_prr->prr_time_end); ?></td></tr>
        <tr><td>เวลารวม (นาที:วินาที):</td><td><?php echo displayMinute($obj_prr->prr_time_total); ?></td></tr>
        <tr><td>ความเร็วในการอ่าน (คน/นาที):</td><td><?php echo displayNumber($obj_prr->prr_speed_per_min); ?></td></tr>
        <tr><td>เกณฑ์พิจารณา:</td><td><?php echo displayResult($obj_prr->prr_result); ?></td></tr>
        <tr><td>จำนวนขานนามบัณฑิต:</td><td><?php echo displayText($obj_prr->prr_counting); ?></td></tr>
      </table>
    </p>
<?php
}else if(isset($_GET['metId']) && $_GET['metId'] == 'PRRCOUUPD'){
  $prrId = $_GET['prrId'];
  $sql = "UPDATE cga_practice_record SET prr_counting=prr_counting+1 WHERE prr_id=$prrId";
  if ($conn->query($sql) === TRUE) {
    $sql_tmp = "SELECT prr_counting FROM cga_practice_record WHERE prr_id=$prrId";
    $result_tmp = $conn->query($sql_tmp);
    $obj_tmp = $result_tmp->fetch_object();
    echo $obj_tmp->prr_counting;
  } else {
    echo "[ERR] การอัปเดตข้อมูลมีข้อผิดพลาด: " . $conn->error;
  }
}else if(isset($_GET['metId']) && $_GET['metId'] == 'PRTUPD'){
  $prtId = $_GET['prtId'];

  $sql = "UPDATE cga_practice_time SET prt_status=20 WHERE prt_id=$prtId";
  if ($conn->query($sql) === TRUE) {
    echo "[INFO] การบันทึกข้อมูลสำเร็จ";
  } else {
    echo "[ERR] การบันทึกข้อมูลมีข้อผิดพลาด: " . $conn->error;
  }
  
  echo "<br/>กรุณารอสักครู่...";
  echo "<meta http-equiv=\"refresh\" content=\"0; url=practice_record.php\">";
}

$conn->close();
?>