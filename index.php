<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
   
}
else {
    $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$user = $row['userName'];
}


?>
<?php 
require 'conn.php';
?> 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Browse :: <?php echo $_SERVER['SERVER_NAME'];?></title>
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/png" href="static/favicon.png">
<link rel="icon" type="image/png" href="static/favicon.png">
<link rel="mask-icon" href="static/pinned-tab.svg" color="#3582F7">
<link rel="alternate" type="application/rss+xml" href="https://nyaa.si/?page=rss"/>
<meta property="og:site_name" content="<?php echo $_SERVER['SERVER_NAME'];?>">
<meta property="og:title" content="Browse :: <?php echo $_SERVER['SERVER_NAME'];?>">
<meta property="og:image" content="static/img/avatar/default.png">
<meta name="description" content="A BitTorrent community focused on Eastern Asian media including anime, manga, music, and more">
<meta name="keywords" content="torrents, bittorrent, torrent, anime, manga, sukebei, download, nyaa, magnet, magnets">
<meta property="og:description" content="<?php echo $_SERVER['SERVER_NAME'];?> homepage">
 
 
<link href="static/css/bootstrap.min.css" rel="stylesheet" id="bsThemeLink">
<link href="static/css/bootstrap-xl-mod.css" rel="stylesheet">
 
<script>function toggleDarkMode(){"dark"===localStorage.getItem("theme")?setThemeLight():setThemeDark()}function setThemeDark(){bsThemeLink.href="static/css/bootstrap-dark.min.css",localStorage.setItem("theme","dark")}function setThemeLight(){bsThemeLink.href="static/css/bootstrap.min.css",localStorage.setItem("theme","light")}if("undefined"!=typeof Storage){var bsThemeLink=document.getElementById("bsThemeLink");"dark"===localStorage.getItem("theme")&&setThemeDark()}</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" integrity="sha256-an4uqLnVJ2flr7w0U74xiF4PJjO2N5Df91R2CUmCLCA=" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous"/>
 
<link href="static/css/main.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/8.3.1/markdown-it.min.js" integrity="sha256-3WZyZQOe+ql3pLo90lrkRtALrlniGdnf//gRpW0UQks=" crossorigin="anonymous"></script>
 
<script src="static/js/bootstrap-select.js"></script>
<script src="static/js/main.js"></script>
 
<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>
<body>
 
<nav class="navbar navbar-default navbar-static-top navbar-inverse">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="/">Nyaa</a>
</div> 
<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li><a href="/upload">Upload</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
About
<span class="caret"></span>
</a>
<ul class="dropdown-menu">
<li><a href="/rules">Rules</a></li>
<li><a href="/help">Help</a></li>
</ul>
</li>
<li><a href="/?page=rss">RSS</a></li>
<li><a href="//sukebei.Nyaa.si">Fap</a></li>
</ul>
<?php if(!$user_home->is_logged_in())
{
	echo "<ul class='nav navbar-nav navbar-right'>
<li class='dropdown'>
<a href='#' class='dropdown-toggle visible-lg visible-sm visible-xs' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
<i class='fa fa-user fa-fw'></i>
Guest
<span class='caret'></span>
</a>
<a href='#' class='dropdown-toggle hidden-lg hidden-sm hidden-xs' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
<i class='fa fa-user fa-fw'></i>
<span class='caret'></span>
</a>
<ul class='dropdown-menu'>
<li>
<a href='/login'>
<i class='fa fa-sign-in fa-fw'></i>
Login
</a>
</li>
<li>
<a href='/register'>
<i class='fa fa-pencil fa-fw'></i>
Register
</a>
</li>
</ul>
</li>
</ul>";
}else {
	echo "<ul class='nav navbar-nav navbar-right'>
<li class='dropdown'>
<a href='#' class='dropdown-toggle visible-lg visible-sm visible-xs' data-toggle='dropdown' role='button'aria-haspopup='true' aria-expanded='false'>
<i class='fa fa-user fa-fw'></i>
$user
<span class='caret'></span>
</a>
<a href='#' class='dropdown-toggle hidden-lg hidden-sm hidden-xs' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
<i class='fa fa-user fa-fw'></i>
<span class='caret'></span>
</a>
<ul class='dropdown-menu'>
<li class='hidden-lg hidden-sm hidden-xs'>
<a><i class='fa fa-user fa-fw'></i>Logged in as $user</a>
</li>
<li class='hidden-lg hidden-sm hidden-xs divider' role='separator'>
</li>
<li>
<a href='/user/$user'>
<i class='fa fa-user fa-fw'></i>
Torrents
</a>
</li>
<li>
<a href='/profile'>
<i class='fa fa-gear fa-fw'></i>
Profile
</a>
</li>
<li>
<a href='logout.php'>
<i class='fa fa-times fa-fw'></i>
Logout
</a>
</li>
</ul>
</li>
</ul>";
}

?>
<div class="search-container visible-xs visible-sm">
<form class="navbar-form navbar-right form" action="/" method="get">
<input type="text" class="form-control" name="q" placeholder="Search..." value="">
<br>
<select class="form-control" title="Filter" data-width="120px" name="f">
<option value="0" title="No filter" selected>No filter</option>
<option value="1" title="No remakes">No remakes</option>
<option value="2" title="Trusted only">Trusted only</option>
</select>
<br>
<select class="form-control" title="Category" data-width="200px" name="c">
<option value="0_0" title="All categories" selected>
All categories
</option>
<option value="1_0" title="Anime">
Anime
</option>
<option value="1_1" title="Anime - AMV">
- Anime Music Video
</option>
<option value="1_2" title="Anime - English">
- English-translated
</option>
<option value="1_3" title="Anime - Indonesia">
- Indonesia-translated
</option>
<option value="1_4" title="Anime - Raw">
- Raw
</option>
<option value="2_0" title="Audio">
Audio
</option>
<option value="2_1" title="Audio - Lossless">
- Lossless
</option>
<option value="2_2" title="Audio - Lossy">
- Lossy
</option>
<option value="3_0" title="Literature">
Literature
</option>
<option value="3_1" title="Literature - English">
- English-translated
</option>
<option value="3_2" title="Literature - Indonesia">
- Indonesia-translated
</option>
<option value="3_3" title="Literature - Raw">
- Raw
</option>
<option value="4_0" title="Live Action">
Live Action
</option>
<option value="4_1" title="Live Action - English">
- English-translated
</option>
<option value="4_2" title="Live Action - Idol/PV">
- Idol/Promotional Video
</option>
<option value="4_3" title="Live Action - Indonesia">
- Indonesia-translated
</option>
<option value="4_4" title="Live Action - Raw">
- Raw
</option>
<option value="5_0" title="Pictures">
Pictures
</option>
<option value="5_1" title="Pictures - Graphics">
- Graphics
</option>
<option value="5_2" title="Pictures - Photos">
- Photos
</option>
<option value="6_0" title="Software">
Software
</option>
<option value="6_1" title="Software - Apps">
- Applications
</option>
<option value="6_2" title="Software - Games">
- Games
</option>
</select>
<br>
<button class="btn btn-primary form-control" type="submit">
<i class="fa fa-search fa-fw"></i> Search
</button>
</form>
</div> 
<form class="navbar-form navbar-right form" action="/" method="get">
<div class="input-group search-container hidden-xs hidden-sm">
<div class="input-group-btn nav-filter" id="navFilter-criteria">
<select class="selectpicker show-tick" title="Filter" data-width="120px" name="f">
<option value="0" title="No filter" selected>No filter</option>
<option value="1" title="No remakes">No remakes</option>
<option value="2" title="Trusted only">Trusted only</option>
</select>
</div>
<div class="input-group-btn nav-filter" id="navFilter-category">
 
<select class="selectpicker show-tick" title="Category" data-width="130px" name="c">
<option value="0_0" title="All categories" selected>
All categories
</option>
<option value="1_0" title="Anime">
Anime
</option>
<option value="1_1" title="Anime - AMV">
- Anime Music Video
</option>
<option value="1_2" title="Anime - English">
- English-translated
</option>
<option value="1_3" title="Anime - Indonesia">
- Indonesia-translated
</option>
<option value="1_4" title="Anime - Raw">
- Raw
</option>
<option value="2_0" title="Audio">
Audio
</option>
<option value="2_1" title="Audio - Lossless">
- Lossless
</option>
<option value="2_2" title="Audio - Lossy">
- Lossy
</option>
<option value="3_0" title="Literature">
Literature
</option>
<option value="3_1" title="Literature - English">
- English-translated
</option>
<option value="3_2" title="Literature - Indonesia">
- Indonesia-translated
</option>
<option value="3_3" title="Literature - Raw">
- Raw
</option>
<option value="4_0" title="Live Action">
Live Action
</option>
<option value="4_1" title="Live Action - English">
- English-translated
</option>
<option value="4_2" title="Live Action - Idol/PV">
- Idol/Promotional Video
</option>
<option value="4_3" title="Live Action - Indonesia">
- Indonesia-translated
</option>
<option value="4_4" title="Live Action - Raw">
- Raw
</option>
<option value="5_0" title="Pictures">
Pictures
</option>
<option value="5_1" title="Pictures - Graphics">
- Graphics
</option>
<option value="5_2" title="Pictures - Photos">
- Photos
</option>
<option value="6_0" title="Software">
Software
</option>
<option value="6_1" title="Software - Apps">
- Applications
</option>
<option value="6_2" title="Software - Games">
- Games
</option>
</select>
</div>
<input type="text" class="form-control search-bar" name="q" placeholder="Search..." value=""/>
<div class="input-group-btn search-btn">
<button class="btn btn-primary" type="submit">
<i class="fa fa-search fa-fw"></i>
</button>
</div>
</div>
</form>
</div> 
</div> 
</nav>
<div class="container">
<div class="alert alert-info">
<p>We welcome you to provide feedback at <a href="irc://irc.rizon.net/nyaa-dev">#nyaa-dev@irc.rizon.net</a></p>
<p>Our GitHub: <a href="https://github.com/nyaadevs" target="_blank">https://github.com/nyaadevs</a> - creating <a href="https://github.com/nyaadevs/nyaa/issues">issues</a> for features and faults is recommendable!</p>
</div>
<div class="table-responsive">
<table class="table table-bordered table-hover table-striped torrent-list">
<thead>
<tr>
<th class="hdr-category text-center" style="width:80px;">
<div>Category</div>
</th>
<th class="hdr-name" style="width:auto;">
<div>Name</div>
</th>
<th class="hdr-comments sorting text-center" title="Comments" style="width:50px;">
<a href="/?s=comments&amp;o=desc"></a>
<i class="fa fa-comments-o"></i>
</th>
<th class="hdr-link text-center" style="width:70px;">
<div>Link</div>
</th>
<th class="hdr-size sorting text-center" style="width:100px;">
<a href="/?s=size&amp;o=desc"></a>
<div>Size</div>
</th>
<th class="hdr-date sorting_desc text-center" title="In UTC" style="width:140px;">
<a href="/?s=id&amp;o=asc"></a>
<div>Date</div>
</th>
<th class="hdr-seeders sorting text-center" title="Seeders" style="width:50px;">
<a href="/?s=seeders&amp;o=desc"></a>
<i class="fa fa-arrow-up" aria-hidden="true"></i>
</th>
<th class="hdr-leechers sorting text-center" title="Leechers" style="width:50px;">
<a href="/?s=leechers&amp;o=desc"></a>
<i class="fa fa-arrow-down" aria-hidden="true"></i>
</th>
<th class="hdr-downloads sorting text-center" title="Completed downloads" style="width:50px;">
<a href="/?s=downloads&amp;o=desc"></a>
<i class="fa fa-check" aria-hidden="true"></i>
</th>
</tr>
</thead>
<tbody>

<?php
$cate = array(

    "1_1"=>"Anime - Anime Music Video",
    "1_2"=>"Anime - English-translated",
    "1_3"=>"Anime - Indonesia-translated",
    "1_4"=>"Anime - Raw",

    "2_1"=>"Audio - Lossless",
    "2_2"=>"Audio - Lossy",

    "3_1"=>"Literature - English-translated",
    "3_2"=>"Literature - Indonesia-translated",
    "3_3"=>"Literature - Raw",

    "4_1"=>"Live Action - English-translated",
    "4_2"=>"Live Action - Idol/Promotional Video",
    "4_3"=>"Live Action - Indonesia-translated",
    "4_4"=>"Live Action - Raw",

    "5_1"=>"Pictures - Graphics",
    "5_2"=>"Pictures - Photos",

    "6_1"=>"Software - Applications",
    "6_2"=>"Software - Games"
    );

?>
<?php

$batas = 12;
$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
 
if ( empty( $pg ) ) {
$posisi = 0;
$pg = 1;
} else {
$posisi = ( $pg - 1 ) * $batas;
}
 
$sql = "SELECT * FROM post ORDER BY waktu DESC limit $posisi, $batas";
$result = $conn->query($sql);
$no = 1+$posisi;
while ( $r = mysqli_fetch_assoc( $result ) ) {

	$cat = $r['category'];
	$trust = $r['trusted'];

?>
<tr class="<?php if ($trust == 'y') {
					 echo "success";
				} else
				{
					echo "default";
					}?>">
<td style="padding:0 4px;">
<a href="/?c=<?php echo $cat;?>" title="<?php print_r($cate[$cat]) ;?>">
<img src="static/img/icons/nyaa/<?php echo $cat;?>.png" alt="<?php print_r($cate[$cat]) ;?>">
</a>
</td>
<td colspan="2">
<a href="/view/?p=<?php echo $r['postid']; ?>" title="<?php echo $r['filename']; ?>"><?php echo $r['filename']; ?></a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="<?php echo $r['linkone']; ?>"><i class="fa fa-fw fa-download"></i></a> <a href="<?php echo $r['linktwo']; ?>"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center"><?php echo $r['size']; ?></td>
<td class="text-center" ><?php echo $r['waktu']; ?></td>
<td class="text-center" style="color: green;">1</td>
<td class="text-center" style="color: red;">5</td>
<td class="text-center">0</td>
</tr>
<?php
$no++;
}
?>
</tbody>
</table>
</div>
<div class="center">
<nav>
<ul class="pagination">
        <?php
//hitung jumlah data
$jld = "SELECT * FROM post";
$jldat = $conn->query($jld);
$jml_data = mysqli_num_rows($jldat);
//Jumlah halaman
$JmlHalaman = ceil($jml_data/$batas); //ceil digunakan untuk pembulatan keatas
 
//Navigasi ke sebelumnya
if ( $pg > 1 ) {
$link = $pg-1;
$prev = "<li><a href='?pg=$link'>&laquo;</a></li>";
} else {
$prev = "<li class='disabled'><a href='#'>&laquo;</a></li>";
}
 
//Navigasi nomor
$nmr = '';
for ( $i = 1; $i<= $JmlHalaman; $i++ ){
 
if ( $i == $pg ) {
$nmr .= "<li class='active'><a href='#'>$i<span class='sr-only'>(current)</span></a></li>";
} else {
$nmr .= "<li><a href='?pg=$i'>$i</a></li>";
}
}
 
//Navigasi ke selanjutnya
if ( $pg < $JmlHalaman ) {
$link = $pg + 1;
$next = " <li><a href='?pg=$link'>&raquo;</a></li>";
} else {
$next = "<li class='disabled'><a href='#'>&raquo;</a></li>";
}
 
//Tampilkan navigasi
echo $prev . $nmr . $next;
?>
</ul>
</nav>
</div>

</div>  
<footer style="text-align: center;">
<p>Dark Mode: <a href="#" id="themeToggle">Toggle</a></p>
<p>Commit: <a href="https://github.com/nyaadevs/nyaa/tree/9fbaf3c12a2c1e7e20a72a1c985f5a2e5fb27529">9fbaf3c</a></p>
</footer>
</body>
</html>