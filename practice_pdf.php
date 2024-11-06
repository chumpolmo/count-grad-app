<?php
include_once("./config/dbConnection.php");
include_once("./config/settings.php");
include_once("./libs/functions.php");
require_once('./fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->AddFont('THSarabunNew Bold','','THSarabunNew Bold.php');
$pdf->SetFont('THSarabunNew Bold','',16);
$pdf->AddPage();

if(!isset($_GET['metId']) || $_GET['metId'] != 'PRTREP'){
    $pdf->Cell(0,8, iconv('UTF-8', 'cp874', '[INFO] กรุณาเลือกพิมพ์รายงานผ่าน "เมนูรายงานการจับเวลาขานนาม"'),0,1,'C');
    $pdf->Output();
    die();
}

$prtId = $_GET['prtId'];
$sql = "SELECT * FROM cga_practice_time WHERE prt_id=$prtId";
$result = $conn->query($sql);
$obj = $result->fetch_object();

$pdf->Cell(0,7, iconv('UTF-8', 'cp874', 'รายงานการจับเวลาขานนามบัณฑิตและพิธีการในพิธีพระราชทานปริญญาบัตร'),0,1,'C');
$pdf->SetFont('THSarabunNew Bold','',14);
$pdf->Cell(0,6, iconv('UTF-8', 'cp874', _TITLE_3),0,1,'C');
$pdf->Cell(0,6, iconv('UTF-8', 'cp874', 'วันที่ '.displayDate($obj->prt_date).' รอบที่ '.$obj->prt_time),0,1,'C');
$pdf->Ln();

// header
$header = array(
    "ลำดับ","รายการ","จ.บัณฑิต","เวลาเริ่ม","เวลาจบ","เวลารวม (mm:ss)",
    "ความเร็วฯ (คน:นาที)","เกณฑ์พิจารณา","จ.บัณฑิตจริง"
);
// Header
$pdf->SetFont('THSarabunNew Bold','',12);
$pdf->Cell(8,12,iconv('UTF-8', 'cp874', $header[0]),1,0,'C');
$pdf->Cell(62,12,iconv('UTF-8', 'cp874', $header[1]),1,0,'C');
$pdf->Cell(18,12,iconv('UTF-8', 'cp874', $header[2]),1,0,'C');
$pdf->Cell(18,12,iconv('UTF-8', 'cp874', $header[3]),1,0,'C');
$pdf->Cell(18,12,iconv('UTF-8', 'cp874', $header[4]),1,0,'C');
$pdf->MultiCell(15,6,iconv('UTF-8', 'cp874', $header[5]),1,'C');
$pdf->SetXY(149,35);
$pdf->MultiCell(15,6,iconv('UTF-8', 'cp874', $header[6]),1,'C');
$pdf->SetXY(164,35);
$pdf->Cell(22,12,iconv('UTF-8', 'cp874', $header[7]),1,0,'C');
$pdf->SetXY(186,35);
$pdf->Cell(17,12,iconv('UTF-8', 'cp874', $header[8]),1,0,'C');
$pdf->Ln();

$sql_prr = "SELECT a.*,b.*,c.* FROM cga_practice_record AS a ";
$sql_prr.= "INNER JOIN cga_ceremony_seq AS b ON a.ces_id=b.ces_id ";
$sql_prr.= "INNER JOIN cga_practice_time AS c ON a.prt_id=c.prt_id ";
$sql_prr.= "WHERE a.prt_id=$obj->prt_id";
$result_prr = $conn->query($sql_prr);

$pdf->SetFont('THSarabunNew','',12);
while($obj_prr = $result_prr->fetch_object()){
    $pdf->Cell(8,6,$obj_prr->ces_order,1,0,'C');
    $pdf->Cell(62,6,iconv('UTF-8', 'cp874', $obj_prr->ces_title),1,0,'L');
    $pdf->Cell(18,6,iconv('UTF-8', 'cp874', $obj_prr->ces_numOfCert),1,0,'C');
    $pdf->Cell(18,6,iconv('UTF-8', 'cp874', $obj_prr->prr_time_start),1,0,'C');
    $pdf->Cell(18,6,iconv('UTF-8', 'cp874', $obj_prr->prr_time_end),1,0,'C');
    $pdf->Cell(15,6,iconv('UTF-8', 'cp874', displayMinute($obj_prr->prr_time_total)),1,0,'C');
    $pdf->Cell(15,6,iconv('UTF-8', 'cp874', displayText($obj_prr->prr_speed_per_min)),1,0,'C');
    $pdf->Cell(22,6,iconv('UTF-8', 'cp874', displayResultInPDF($obj_prr->prr_result)),1,0,'C');
    $pdf->Cell(17,6,iconv('UTF-8', 'cp874', displayText($obj_prr->prr_counting)),1,0,'C');
    $pdf->Ln();
}

// Go to 1.5 cm from bottom
$pdf->SetY(-34);
$pdf->SetFont('THSarabunNew','',12);
$pdf->MultiCell(200,6,iconv('UTF-8', 'cp874', 'หมายเหตุ ข้อมูลในตารางประกอบด้วยคอลัมน์ ดังนี้ ลำดับ, รายการ, จำนวนบัณฑิต, เวลาเริ่ม, เวลาจบ, เวลารวม (นาที:วินาที), ความเร็วในการอ่าน (คน:นาที), เกณฑ์พิจารณา และจำนวนบัณฑิตจริง ตามลำดับ'),0,'L');
$pdf->Output();
?>