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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit Profile :: <?php echo $_SERVER['SERVER_NAME'];?></title>
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/png" href="../static/favicon.png">
<link rel="icon" type="image/png" href="../static/favicon.png">
<link rel="mask-icon" href="../static/pinned-tab.svg" color="#3582F7">
<link rel="alternate" type="application/rss+xml" href="https://nyaa.si/?page=rss"/>
<meta property="og:site_name" content="<?php echo $_SERVER['SERVER_NAME'];?>">
<meta property="og:title" content="Edit Profile :: <?php echo $_SERVER['SERVER_NAME'];?>">
<meta property="og:image" content="../static/img/avatar/default.png">
 
 
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
<a href='../logout.php'>
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
<h2 style="margin-bottom: 20px;">Profile of <strong class="text-default">handriand</strong></h2>
<div class="row" style="margin-bottom: 20px;">
<div class="col-sm-2" style="max-width: 150px;">
<img class="avatar" src="https://www.gravatar.com/avatar/00a6a203ec86c3667913dec3e663123e?d=https%3A%2F%2Fnyaa.si%2Fstatic%2Fimg%2Favatar%2Fdefault.png&amp;s=120">
</div>
<div class="col-sm-10">
<dl class="row" style="margin: 20px 0 15px 0;">
<dt class="col-sm-2">User ID:</dt><dd class="col-sm-10">12252</dd>
<dt class="col-sm-2">User Class:</dt><dd class="col-sm-10">User</dd>
<dt class="col-sm-2">User Created on:</dt><dd class="col-sm-10">2017-06-07 17:30:36</dd>
</dl>
</div>
</div>
<ul class="nav nav-tabs" id="profileTabs" role="tablist">
<li role="presentation" class="active">
<a href="#password-change" id="password-change-tab" role="tab" data-toggle="tab" aria-controls="profile" aria-expanded="true">Password</a>
</li>
<li role="presentation">
<a href="#email-change" id="email-change-tab" role="tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Email</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane fade active in" role="tabpanel" id="password-change" aria-labelledby="password-change-tab">
<form method="POST">
<input id="csrf_token" name="csrf_token" type="hidden" value="ImQxMGQzZDgwYzA0Y2FiMzU0N2NiNzM5Y2Y0YmExOGZhYThmNGU0OTMi.DBxs4A.7SR4RlakV1HDoaAHCHBcx6CfI7U">
<div class="row">
<div class="form-group col-md-4">
<div class="form-group">
<label class="control-label" for="current_password">Current Password</label>
<input class="form-control" id="current_password" name="current_password" placeholder="Current password" title="" type="password" value="">
</div>
</div>
</div>
<div class="row">
<div class="form-group col-md-4">
<div class="form-group">
<label class="control-label" for="new_password">New Password</label>
<input class="form-control" id="new_password" name="new_password" placeholder="New password" title="" type="password" value="">
</div>
</div>
</div>
<div class="row">
<div class="form-group col-md-4">
<div class="form-group">
<label class="control-label" for="password_confirm">Repeat New Password</label>
<input class="form-control" id="password_confirm" name="password_confirm" placeholder="New password (confirm)" title="" type="password" value="">
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<input type="submit" value="Update" class="btn btn-primary">
</div>
</div>
</form>
</div>
<div class="tab-pane fade" role="tabpanel" id="email-change" aria-labelledby="email-change-tab">
<form method="POST">
<input id="csrf_token" name="csrf_token" type="hidden" value="ImQxMGQzZDgwYzA0Y2FiMzU0N2NiNzM5Y2Y0YmExOGZhYThmNGU0OTMi.DBxs4A.7SR4RlakV1HDoaAHCHBcx6CfI7U">
<div class="row">
<div class="form-group col-md-4">
<label class="control-label" for="current_email">Current Email</label>
<div>handriandavid1@gmail.com</div>
</div>
</div>
<div class="row">
<div class="form-group col-md-4">
<div class="form-group">
<label class="control-label" for="email">New Email Address</label>
<input class="form-control" id="email" name="email" placeholder="New email address" title="" type="text" value="">
</div>
</div>
</div>
<div class="row">
<div class="form-group col-md-4">
<div class="form-group">
<label class="control-label" for="current_password">Current Password</label>
<input class="form-control" id="current_password" name="current_password" placeholder="Current password" title="" type="password" value="">
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<input type="submit" value="Update" class="btn btn-primary">
</div>
</div>
</form>
</div>
</div>
<hr>
</div>  
<footer style="text-align: center;">
<p>Dark Mode: <a href="#" id="themeToggle">Toggle</a></p>
<p>Commit: <a href="https://github.com/nyaadevs/nyaa/tree/9fbaf3c12a2c1e7e20a72a1c985f5a2e5fb27529">9fbaf3c</a></p>
</footer>
</body>
</html>