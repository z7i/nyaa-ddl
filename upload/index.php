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
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Upload Torrent :: <?php echo $_SERVER['SERVER_NAME'];?></title>
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/png" href="../static/favicon.png">
<link rel="icon" type="image/png" href="../static/favicon.png">
<link rel="mask-icon" href="../static/pinned-tab.svg" color="#3582F7">
<link rel="alternate" type="application/rss+xml" href="https://nyaa.si/?page=rss"/>
<meta property="og:site_name" content="<?php echo $_SERVER['SERVER_NAME'];?>">
<meta property="og:title" content="Upload Torrent :: <?php echo $_SERVER['SERVER_NAME'];?>">
<meta property="og:image" content="../static/img/avatar/default.png">
<meta property="og:description" content="Upload a torrent to <?php echo $_SERVER['SERVER_NAME'];?>">
 
 
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
<li class="active"><a href="../upload">Upload</a></li>
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
<h1>Post A File</h1>
<?php if(!$user_home->is_logged_in())
{
	
}else {
	echo "Upload as $user " ;
}

?>
<div id="upload-drop-zone"><span>Drop here!</span></div>
<form action="process.php" method="POST" enctype="multipart/form-data">
<?php
        if(isset($_GET['error']))
        {
            ?>
<?php
        }
        ?>
<input id="csrf_token" name="csrf_token" type="hidden" value="ImM1NDQ2YTVjYjI1ZDNmNWU2NmEwNmJhZGQ5ZWRmNzdmNmMzYzQ0Njci.DBslkQ.cNAX4rVoZSKXvW99nyGOm3_GgR0">
<p><strong>Important:</strong> Please Follow <kbd>https://nyaa.si/rules</kbd></p> <div class="row">
<div class="col-md-10">
<div class="form-group">
<div class="sr-only">
</div>
<div class="help-block"><?php if(isset($_GET['errors']))
        { $msg= base64_decode($_GET['errors']);
        	echo "$msg";
        	}
        	else {
}?></div>
</div>
</div>
</div>
<div class="form-group">
<label class="control-label" for="display_name">File display name (optional) </label>
<input class="form-control" id="display_name" name="display_name" placeholder="Display name" title="" type="text" value="" required>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="control-label" for="filesize">File Size (optional) </label>
<input class="form-control" id="filesize" name="filesize" placeholder="File size" title="" type="text" value="" required>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label class="control-label" for="category_name">Category</label>
<select class="form-control" id="category_name" name="category_name" title="" required><option value="">[Select a category]</option><option disabled="" value="1_0">Anime</option><option value="1_1">Anime - Anime Music Video</option><option value="1_2">Anime - English-translated</option><option value="1_3">Anime - Indonesia-translated</option><option value="1_4">Anime - Raw</option><option disabled="" value="2_0">Audio</option><option value="2_1">Audio - Lossless</option><option value="2_2">Audio - Lossy</option><option disabled="" value="3_0">Literature</option><option value="3_1">Literature - English-translated</option><option value="3_2">Literature - Indonesia-translated</option><option value="3_3">Literature - Raw</option><option disabled="" value="4_0">Live Action</option><option value="4_1">Live Action - English-translated</option><option value="4_2">Live Action - Idol/Promotional Video</option><option value="4_3">Live Action - Indonesia-translated</option><option value="4_4">Live Action - Raw</option><option disabled="" value="5_0">Pictures</option><option value="5_1">Pictures - Graphics</option><option value="5_2">Pictures - Photos</option><option disabled="" value="6_0">Software</option><option value="6_1">Software - Applications</option><option value="6_2">Software - Games</option></select>
</div>
</div>
</div>
<div class="row"></div>
<div class="row form-group">
<div class="col-md-6">
<div class="form-group">
<label class="control-label" for="information">Information</label>
<input class="form-control" id="information" name="information" placeholder="Your website or Name" title="" type="text" value="" required>
</div>
</div>
<div class="col-md-6">
<label class="control-label">Torrent flags</label><br>
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-default " title="Upload torrent anonymously (don't display your username)">
<input id="is_anonymous" name="is_anonymous" type="checkbox" value="y">
<span class="glyphicon glyphicon-check"></span><span class="glyphicon glyphicon-unchecked"></span> Anonymous
</label>
<label class="btn btn-grey" title="Hide torrent from listing">
<input id="is_hidden" name="is_hidden" type="checkbox" value="y">
<span class="glyphicon glyphicon-check"></span>
<span class="glyphicon glyphicon-unchecked"></span>
Hidden
</label>
</div>
<div class="hidden-xl hidden-lg"><br></div>
<div class="btn-group" data-toggle="buttons">
<label class="btn btn-danger" title="This torrent is derived from another release">
<input id="is_remake" name="is_remake" type="checkbox" value="y">
<input id="is_remake" name="is_remake" type="hidden" value="n">
<span class="glyphicon glyphicon-check"></span>
<span class="glyphicon glyphicon-unchecked"></span>
Remake
</label>
<label class="btn btn-warning" title="This torrent is a complete batch (eg. season)">
<input id="is_complete" name="is_complete" type="checkbox" value="y">
<input id="is_complete" name="is_complete" type="hidden" value="n">
<span class="glyphicon glyphicon-check"></span>
<span class="glyphicon glyphicon-unchecked"></span>
Complete
</label>
</div>
</div>
</div>
<div class="form-group">
<label class="control-label" for="linkgoogle">Link Download Google </label>
<input class="form-control" id="linkgoogle" name="linkgoogle" placeholder="Add Link Download here" title="" type="text" value="" required>
</div>
<div class="form-group">
<label class="control-label" for="linkzippy">Link Download Zippyshare</label>
<input class="form-control" id="linkzippy" name="linkzippy" placeholder="Add Link Download here" title="" type="text" value="" required>
</div>
<div class="form-group">
<label class="control-label" for="linkany1">Link Download any-1</label>
<input class="form-control" id="linkany1" name="linkany1" placeholder="Add Link Download here" title="" type="text" value="" >
</div>
<div class="form-group">
<label class="control-label" for="linkany2">Link Download any-2</label>
<input class="form-control" id="linkany2" name="linkany2" placeholder="Add Link Download here" title="" type="text" value="" >
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<div class="markdown-editor" id="description-markdown-editor" data-field-name="description">
<label class="control-label" for="description">Description</label>
<a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet" class="small">Markdown supported</a>
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active">
<a href="#description-tab" role="tab" data-toggle="tab">
Write
</a>
</li>
<li role="presentation">
<a href="#description-preview" id="description-preview-tab" role="tab" data-toggle="tab">
Preview
</a>
</li>
</ul>
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="description-tab" data-markdown-target="#description-markdown-target">
<textarea class="form-control markdown-source" id="description" name="description"></textarea>
</div>
<div role="tabpanel" class="tab-pane" id="description-preview">
<div class="well" id="description-markdown-target"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<div class="g-recaptcha" data-sitekey="6LeU4yAUAAAAAI_4K5cAusLUK8ywp1NHsmM7IZCm"></div>
</div>
</div>
<br>
<div class="row">
<div class="form-group col-md-6">
<button type="submit" name="submit" class="btn btn-primary">Upload</button>
</div>
</div>
</form>
</div>  
<footer style="text-align: center;">
<p>Dark Mode: <a href="#" id="themeToggle">Toggle</a></p>
<p>Commit: <a href="https://github.com/nyaadevs/nyaa/tree/9fbaf3c12a2c1e7e20a72a1c985f5a2e5fb27529">9fbaf3c</a></p>
</footer>
</body>
</html>