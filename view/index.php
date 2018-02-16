<?php
session_start();
require_once '../class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
   $user_home->redirect('/upload');
}
else {
    $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$user = $row['userName'];
}


?>
<?php 
        $pid = $_GET['p'];
			require_once '../conn.php';
			$sql = "SELECT * FROM post WHERE postid='$pid'";
$result = $conn->query($sql);
while ($row=mysqli_fetch_array($result)){
				extract($row);
				$id = $row['postid'];
				$title = $row['filename'];
				$uploader = $row['username'];
				$size = $row['size'];
				$cat = $row['category'];
				$times = $row['waktu'];
				$info = $row['information'];
				$description =$row['description'];
				$link1 =$row ['linkone'];
				$link2 =$row ['linktwo'];
				$link3 =$row ['linkthree'];
				$link4 =$row ['linkfourth'];
				?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title ; ?> :: <?php echo $_SERVER['SERVER_NAME'];?></title>
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/png" href="../static/favicon.png">
<link rel="icon" type="image/png" href="../static/favicon.png">
<link rel="mask-icon" href="../static/pinned-tab.svg" color="#3582F7">
<link rel="alternate" type="application/rss+xml" href="https://nyaa.si/?page=rss"/>
<meta property="og:site_name" content="<?php echo $_SERVER['SERVER_NAME'];?>">
<meta property="og:title" content="<?php echo $title ; ?> :: <?php echo $_SERVER['SERVER_NAME'];?>">
<meta property="og:image" content="../static/img/avatar/default.png">
<meta property="og:description" content="Anime - English-translated | 544.0 MiB | Uploaded by <?php echo $uploader ; ?> on <?php echo $times ; ?>">
 
 
<link href="../static/css/bootstrap.min.css" rel="stylesheet" id="bsThemeLink">
<link href="../static/css/bootstrap-xl-mod.css" rel="stylesheet">
 
<script>function toggleDarkMode(){"dark"===localStorage.getItem("theme")?setThemeLight():setThemeDark()}function setThemeDark(){bsThemeLink.href="../static/css/bootstrap-dark.min.css",localStorage.setItem("theme","dark")}function setThemeLight(){bsThemeLink.href="../static/css/bootstrap.min.css",localStorage.setItem("theme","light")}if("undefined"!=typeof Storage){var bsThemeLink=document.getElementById("bsThemeLink");"dark"===localStorage.getItem("theme")&&setThemeDark()}</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" integrity="sha256-an4uqLnVJ2flr7w0U74xiF4PJjO2N5Df91R2CUmCLCA=" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous"/>
 
<link href="../static/css/main.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/8.3.1/markdown-it.min.js" integrity="sha256-3WZyZQOe+ql3pLo90lrkRtALrlniGdnf//gRpW0UQks=" crossorigin="anonymous"></script>
 
<script src="../static/js/bootstrap-select.js"></script>
<script src="../static/js/main.js"></script>
 
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
<a class="navbar-brand" href="../">Nyaa</a>
</div> 
<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li><a href="../upload">Upload</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
About
<span class="caret"></span>
</a>
<ul class="dropdown-menu">
<li><a href="../rules">Rules</a></li>
<li><a href="../help">Help</a></li>
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
<a href='../login'>
<i class='fa fa-sign-in fa-fw'></i>
Login
</a>
</li>
<li>
<a href='../register'>
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
<a href='../user/$user'>
<i class='fa fa-user fa-fw'></i>
Torrents
</a>
</li>
<li>
<a href='../profile'>
<i class='fa fa-gear fa-fw'></i>
Profile
</a>
</li>
<li>
<a href='../logout'>
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
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">
<?php echo $title ; ?>
</h3>
</div>
<div class="panel-body">
<div class="row">
<div class="col-md-1">Category:</div>
<div class="col-md-5">
<?php
$cate = array(

    "1_1"=>"<a href='/?c=1_0'>Anime</a> - <a href='/?c=1_1'>Anime Music Video</a>",
    "1_2"=>"<a href='/?c=1_0'>Anime</a> - <a href='/?c=1_2'>English-translated</a>",
    "1_3"=>"<a href='/?c=1_0'>Anime</a> - <a href='/?c=1_3'>Indonesia-translated</a>",
    "1_4"=>"<a href='/?c=1_0'>Anime</a> - <a href='/?c=1_4'>Raw</a>",

    "2_1"=>"<a href='/?c=2_0'>Audio</a> - <a href='/?c=2_1'>Lossless</a>",
    "2_2"=>"<a href='/?c=2_0'>Audio</a> - <a href='/?c=2_2'>Lossy</a>",

    "3_1"=>"<a href='/?c=3_0'>Literature</a> - <a href='/?c=3_1'>English-translated</a>",
    "3_2"=>"<a href='/?c=3_0'>Literature</a> - <a href='/?c=3_2'>Indonesia-translated</a>",
    "3_3"=>"<a href='/?c=3_0'>Literature</a> - <a href='/?c=3_3'>Raw</a>",

    "4_1"=>"<a href='/?c=4_0'>Live Action</a> - <a href='/?c=4_1'>English-translated</a>",
    "4_2"=>"<a href='/?c=4_0'>Live Action</a> - <a href='/?c=4_2'>Idol/Promotional Video</a>",
    "4_3"=>"<a href='/?c=4_0'>Live Action</a> - <a href='/?c=4_3'>Indonesia-translated</a>",
    "4_4"=>"<a href='/?c=4_0'>Live Action</a> - <a href='/?c=4_4'>Raw</a>",

    "5_1"=>"<a href='/?c=5_0'>Pictures</a> - <a href='/?c=5_1'>Graphics</a>",
    "5_2"=>"<a href='/?c=5_0'>Pictures</a> - <a href='/?c=5_2'>Photos</a>",

    "6_1"=>"<a href='/?c=6_0'>Software</a> - <a href='/?c=6_1'>Applications</a>",
    "6_2"=>"<a href='/?c=6_0'>Software</a> - <a href='/?c=6_2'>Games</a>"
    );
print_r($cate[$cat]) ;
?>

</div>
<div class="col-md-1">Date:</div>
<div class="col-md-5" ><?php echo $times ; ?></div>
</div>
<div class="row">
<div class="col-md-1">Submitter:</div>
<div class="col-md-5">
<a class="text-default" href="/user/desyo"><?php echo $uploader ; ?></a> </div>
<div class="col-md-1">Coment:</div>
<div class="col-md-5"><span style="color: green;">12</span></div>
</div>
<div class="row">
<div class="col-md-1">Information:</div>
<div class="col-md-5"><?php echo $info ; ?></a>
</div>
<div class="col-md-1">Report:</div>
<div class="col-md-5"><span style="color: red;">4</span></div>
</div>
<div class="row">
<div class="col-md-1">File size:</div>
<div class="col-md-5"><?php echo $size ; ?></div>
<div class="col-md-1">View:</div>
<div class="col-md-5">14</div>
</div>
<div class="row">
<div class="col-md-offset-6 col-md-1">Link site:</div>
<div class="col-md-5"><kbd>https://<?php echo $id; ?></kbd></div>
</div>
</div> 
<div class="panel-footer clearfix">
<a href="<?php echo $link1 ; ?>"><i class="fa fa-download fa-fw"></i>Download Torrent</a> or <a href="<?php echo $link2 ; ?>"><i class="fa fa-magnet fa-fw"></i>Magnet</a>
or
<a href="<?php echo $link1 ; ?>"><i class="fa fa-download fa-fw"></i>Download Torrent</a> or <a href="<?php echo $link2 ; ?>"><i class="fa fa-magnet fa-fw"></i>Magnet</a>
<button type="button" class="btn btn-xs btn-danger pull-right" data-toggle="modal" data-target="#reportModal">
Report
</button>
</div>
</div> 
<div class="panel panel-default">
<div markdown-text class="panel-body" id="torrent-description"><?php echo $description ; ?></div>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">File list</h3>
</div>
<div class="torrent-file-list panel-body">
<ul>
<li><i class="fa fa-file"></i><?php echo $title ; ?> <span class="file-size">(<?php echo $size ; ?>)</span></li>
</ul>
</div>
</div> 
<?php
			}
			
        ?>
<div id="comments" class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">
Comments - 1
</h3>
</div>
<div class="panel panel-default comment-panel" id="com-1">
<div class="panel-body">
<div class="col-md-2">
<p>
<a class="text-default" href="/user/handriand">handriand</a>
(uploader)
</p>
<p><img class="avatar" src="https://www.gravatar.com/avatar/00a6a203ec86c3667913dec3e663123e?d=https%3A%2F%2Fnyaa.si%2Fstatic%2Fimg%2Favatar%2Fdefault.png&amp;s=120" alt="User"></p>
</div>
<div class="col-md-10">
<div class="row">
<a href="#com-1"><small data-timestamp-swap data-timestamp="1497028928">2017-06-09 17:22 UTC</small></a>
<form class="delete-comment-form" action="/view/929582/comment/2009/delete" method="POST">
<button name="submit" type="submit" class="btn btn-danger btn-xs" title="Delete">Delete</button>
</form>
</div>
<div class="row">
<div markdown-text class="comment-content" id="torrent-comment2009">ty for uploading</div>
</div>
</div>
</div>
</div>
<form class="comment-box" method="POST">
<input id="csrf_token" name="csrf_token" type="hidden" value="IjM5ZjFhMTU0NDQ1NGQ1YTViODRjNTc1N2M2YWE4MDExMjkwMGM2ZGUi.DBxqwQ.WLydgNmr08ijkeyLvZxRrPY65GM">
<div class="form-group">
<label class="control-label" for="comment">Make a comment</label>
<textarea class="form-control" id="comment" name="comment" title=""></textarea>
</div>
<input type="submit" value="Submit" class="btn btn-success btn-sm">
</form>
</div>
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Report torrent #929582</h4>
</div>
<div class="modal-body">
<form method="POST" action="https://nyaa.si/view/929582/submit_report">
<input id="csrf_token" name="csrf_token" type="hidden" value="IjM5ZjFhMTU0NDQ1NGQ1YTViODRjNTc1N2M2YWE4MDExMjkwMGM2ZGUi.DBxqwQ.WLydgNmr08ijkeyLvZxRrPY65GM">
<div class="form-group">
<label class="control-label" for="reason">Report reason</label>
<textarea class="form-control" id="reason" maxlength="255" name="reason" title=""></textarea>
</div>
<div style="float: right;">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-danger">Report</button>
</div>
</form>
</div>
<div class="modal-footer" style="border-top: none;">
</div>
</div>
</div>
</div>
<script type="text/javascript">
	// Focus the report text field once the modal is opened.
	$('#reportModal').on('shown.bs.modal', function () {
		$('#reason').focus();
	});
</script>
</div>  
<footer style="text-align: center;">
<p>Dark Mode: <a href="#" id="themeToggle">Toggle</a></p>
<p>Commit: <a href="https://github.com/nyaadevs/nyaa/tree/9fbaf3c12a2c1e7e20a72a1c985f5a2e5fb27529">9fbaf3c</a></p>
</footer>
</body>
</html>