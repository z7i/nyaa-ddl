<?php
session_start();
require_once '../class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
   $user_home->redirect('../login');
}
else {
    $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$user = $row['userName'];
$stats = $row['status'];
}

if ($stats == 'y') {
  $t = 'y';
}

?>
<?php
$rand = substr(md5(microtime()),rand(0,26),8);
$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789'); // and any other characters
shuffle($seed); // probably optional since array_is randomized; this may be redundant
$rand = '';
foreach (array_rand($seed, 8) as $k) $rand .= $seed[$k];

$timeset = date("d-m-Y");

?>
<?php
    if(isset($_POST['submit'])) {

    //get the name and comment entered by user
    $postid = $rand;
    $waktu = $timeset;
    $uploder = $user;
    $filename = $_POST['display_name'];
    $filesize = $_POST['filesize'];
    $category = $_POST['category_name'];
    $information = $_POST['information'];
    $anonim = $_POST['is_anonymous'];
    $hidden = $_POST['is_hidden'];
    $remake = $_POST['is_remake'];
    $complete = $_POST['is_complete'];
    $description = $_POST['description'];
    $linkone = $_POST['linkgoogle'];
    $linktwo = $_POST['linkzippy'];
    $linkthree = $_POST['linkany1'];
    $linkfourth = $_POST['linkany2'];

    //connect to the database
    require 'conn.php';
    $check=mysqli_query($conn,"select * from post where filename='$filename' AND postid='$postid'");
    $checkrows=mysqli_num_rows($check);

   if($checkrows>0) {
    $msg = base64_encode('File Already Axist !');
      header("location: ../upload/?errors=$msg");
   } else {  
    //insert results from the form input
      $sql = "INSERT IGNORE INTO `post`(`postid`, `username`, `filename`, `size`, `information`, `category`, `anonim`, `hidden`, `remake`, `complete`, `description`, `waktu`, `linkone`, `linktwo`, `linkthree`, `linkfourth`, `report`, `coment`, `view`, `trusted`) VALUES ('$postid','$uploder','$filename','$filesize','$information','$category','$anonim','$hidden','$remake','complete','$description','$waktu','$linkone','$linktwo','$linkthree','$linkfourth', '', '', '', '$t')";

      $result = $conn->query($sql);
      header("location: ../view/?p=$postid");
    }
    
    };
  ?>