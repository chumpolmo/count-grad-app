<?php
include_once("./config/dbConnection.php");
include_once("./config/settings.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=_TITLE?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="./bootstrap-5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <script src="./bootstrap-5.3.3/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai+Looped&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
  body {
    font-family: "Noto Sans Thai Looped", Tahoma;
  }
  </style>
  <script>
  function timeUpdate(prrId, metId, numOfCert=0) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (metId == 'PRRTSUPD')
          document.getElementById("prrTS"+prrId).innerHTML = this.responseText;
        if (metId == 'PRRTEUPD')
          document.getElementById("prrTE"+prrId).innerHTML = this.responseText;
      }
    }
    xmlhttp.open("GET", "processing.php?prrId="+prrId+"&numOfCert="+numOfCert+"&metId="+metId, true);
    xmlhttp.send();
  }

  function prrView(prrId, metId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("prrView"+prrId).innerHTML = this.responseText;
      }
    }
    xmlhttp.open("GET", "processing.php?prrId="+prrId+"&metId="+metId, true);
    xmlhttp.send();
  }

  function prrCouting(prrId, metId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("prrCounting"+prrId).value = this.responseText;
      }
    }
    xmlhttp.open("GET", "processing.php?prrId="+prrId+"&metId="+metId, true);
    xmlhttp.send();
  }
  </script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-info navbar-dark nav-underline">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="<?=_LOGO?>" title="<?=_TITLE?>" style="width:40px;" class="rounded-pill">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="index.php"><i class="bi bi-house-fill"></i> หน้าแรก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="practice_record.php"><i class="bi bi-stopwatch-fill"></i> การจับเวลาขานนาม</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="practice_report.php"><i class="bi bi-file-text-fill"></i> รายงานการจับเวลาขานนาม</a>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-gear-fill"></i> การตั้งค่าระบบ</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="setting_criteria.php"><i class="bi bi-1-circle-fill"></i> กำหนดจำนวนมาตรฐานขานนาม</a></li>
            <li><a class="dropdown-item" href="setting_ceremony_seq.php"><i class="bi bi-list-ol"></i> กำหนดลำดับ/ขั้นตอนขานนาม</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#logoutModal" href="#"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</a>
        </li>  
      </ul>
    </div>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        คุณกำลังออกจากระบบ กรุณากดปุ่ม "ยืนยัน" เพื่อดำเนินการ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle-fill"></i> ยกเลิก</button>
        <button type="button" class="btn btn-primary" onClick="location.href='login.php'"><i class="bi bi-check-circle-fill"></i> ยืนยัน</button>
      </div>
    </div>
  </div>
</div>
