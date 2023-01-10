<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<meta charset="UTF-8">
<?php
require_once "../../ayar.php";

$url = $_SERVER['REQUEST_URI'];
$id = explode("id=", $url);
$data = $db->query("SELECT * FROM students WHERE student_id='$id[1]'")->fetch(PDO::FETCH_ASSOC);

$time = $data["student_time"];
$std_no = $data["student_no"];
$std_lesson = str_replace("Ç","C",str_replace("İ","I",str_replace("Ş","S",str_replace("Ğ","G",strtoupper($data["student_lesson"])))));
$exam = str_replace("İ","I",str_replace("Ş","S",str_replace("Ğ","G",strtoupper(str_replace("ı","i",$data["student_exam"])))));
$date = $data["student_date"];

$input_text = strtoupper(str_replace("Ü","U",str_replace("Ç","C",str_replace("İ","I",str_replace("Ş","S",str_replace("Ğ","G",$data["student_name"]))))));
$width = 815;
$height = 440;

$textImage = imagecreate($width, $height);
$color = imagecolorallocate($textImage, 0, 0, 0);
imagecolortransparent($textImage, $color);
imagestring($textImage, 15, 10, 15, $input_text, 0xFFFFFF);
imagestring($textImage, 40, 130, 167, $time, 0xFFFFFF);
imagestring($textImage, 40, 18, 55, $std_no, 0xFFFFFF);
imagestring($textImage, 40, 18, 90, $std_lesson, 0xFFFFFF);
imagestring($textImage, 40, 18, 130, $exam, 0xFFFFFF);
imagestring($textImage, 40, 18, 168, $date, 0xFFFFFF);
// create background image layer
$background = imagecreatefrompng('card.png');

// Merge background image and text image layers
imagecopymerge($background, $textImage, 520, 135, 0, 0, $width, $height, 100);


$output = imagecreatetruecolor($width, $height);
imagecopy($output, $background, 0, 0, 0, 0, $width, $height);


ob_start();
imagepng($output);
$foto = "data:image/png;base64,".base64_encode(ob_get_clean());
echo "<div class='container text-center'><a href='$foto' download class='btn btn-success mt-3 mb-3 container'>İNDİR</a>";
echo "<br>";
echo "<img id='output' src='$foto' /></div>";
?>

