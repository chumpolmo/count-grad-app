<?php
include_once("./templates/header.php");
?>
<div class="container-fluid my-5 text-center">
  <h3><?=_TITLE?></h3>
  <h2><?=_TITLE_2?></h2>
  <div class="my-4 row d-flex justify-content-center">
    <form action="index.php">
        <div class="col-md-4 mx-auto d-flex align-items-start">
            <label for="exampleInputEmail1" class="form-label"><i class="bi bi-envelope-fill"></i> อีเมล (E-mail)</label>
        </div>
        <div class="mb-3 col-md-4 mx-auto">
            <input type="email" class="form-control" id="exampleInputEmail1" value="admin.cga@rmutto.ac.th" placeholder="admin.cga@rmutto.ac.th">
        </div>
        <div class="col-md-4 mx-auto d-flex align-items-start">
            <label for="exampleInputPassword1" class="form-label"><i class="bi bi-key-fill"></i> รหัสผ่าน (Password)</label>
        </div>
        <div class="mb-3 col-md-4 mx-auto">
            <input type="password" class="form-control" id="exampleInputPassword1" value="xxxxxxxxxx" placeholder="xxxxxxxxxx">
        </div>
        <div class="mb-3 col-md-4 mx-auto">
            <button type="submit" class="btn btn-primary"><i class="bi bi-person-check-fill"></i> เข้าสู่ระบบ</button>
            <button type="reset" class="btn btn-secondary"><i class="bi bi-eraser-fill"></i> เคลียร์</button>
        </div>
    </form>
  </div>
</div>
<?php
include_once("./templates/footer.php");
?>