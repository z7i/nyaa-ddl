<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
    $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Browse :: Nyaa</title>
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" type="image/png" href="/static/favicon.png">
<link rel="icon" type="image/png" href="/static/favicon.png">
<link rel="mask-icon" href="/static/pinned-tab.svg" color="#3582F7">
<link rel="alternate" type="application/rss+xml" href="https://nyaa.si/?page=rss"/>
<meta property="og:site_name" content="Nyaa">
<meta property="og:title" content="Browse :: Nyaa">
<meta property="og:image" content="/static/img/avatar/default.png">
<meta name="description" content="A BitTorrent community focused on Eastern Asian media including anime, manga, music, and more">
<meta name="keywords" content="torrents, bittorrent, torrent, anime, manga, sukebei, download, nyaa, magnet, magnets">
<meta property="og:description" content="Nyaa homepage">
 
 
<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="../nyaa/static/css/bootstrap-xl-mod.css" rel="stylesheet">
 
<script>function toggleDarkMode(){"dark"===localStorage.getItem("theme")?setThemeLight():setThemeDark()}function setThemeDark(){bsThemeLink.href="/static/css/bootstrap-dark.min.css?t=1495008187",localStorage.setItem("theme","dark")}function setThemeLight(){bsThemeLink.href="/static/css/bootstrap.min.css?t=1494621267",localStorage.setItem("theme","light")}if("undefined"!=typeof Storage){var bsThemeLink=document.getElementById("bsThemeLink");"dark"===localStorage.getItem("theme")&&setThemeDark()}</script>
<link rel="stylesheet" href="css/bootstrap-select/1.12.2/css/bootstrap-select.min.css"/>
<link rel="stylesheet" href="css/font-awesome/4.7.0/css/font-awesome.min.css"/>
 
<link href="static/css/main.css" rel="stylesheet">
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/8.3.1/markdown-it.min.js" integrity="sha256-3WZyZQOe+ql3pLo90lrkRtALrlniGdnf//gRpW0UQks=" crossorigin="anonymous"></script>
 
<script src="/static/js/bootstrap-select.js?t=1494621267"></script>
<script src="/static/js/main.js?t=1496819044"></script>
 
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
<ul class="nav navbar-nav navbar-right">
<li class="dropdown">
<a href="#" class="dropdown-toggle visible-lg visible-sm visible-xs" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
<i class="fa fa-user fa-fw"></i>
handriand
<span class="caret"></span>
</a>
<a href="#" class="dropdown-toggle hidden-lg hidden-sm hidden-xs" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
<i class="fa fa-user fa-fw"></i>
<span class="caret"></span>
</a>
<ul class="dropdown-menu">
<li class="hidden-lg hidden-sm hidden-xs">
<a><i class="fa fa-user fa-fw"></i>Logged in as handriand</a>
</li>
<li class="hidden-lg hidden-sm hidden-xs divider" role="separator">
</li>
<li>
<a href="/user/handriand">
<i class="fa fa-user fa-fw"></i>
Torrents
</a>
</li>
<li>
<a href="/profile">
<i class="fa fa-gear fa-fw"></i>
Profile
</a>
</li>
<li>
<a href="/logout">
<i class="fa fa-times fa-fw"></i>
Logout
</a>
</li>
</ul>
</li>
</ul>
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
<option value="1_3" title="Anime - Non-English">
- Non-English-translated
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
<option value="3_2" title="Literature - Non-English">
- Non-English-translated
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
<option value="4_3" title="Live Action - Non-English">
- Non-English-translated
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
<option value="1_3" title="Anime - Non-English">
- Non-English-translated
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
<option value="3_2" title="Literature - Non-English">
- Non-English-translated
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
<option value="4_3" title="Live Action - Non-English">
- Non-English-translated
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
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929241" title="[Animok] Boruto - Naruto Next Generations - 10 [1080p] [by mlouka].mp4">[Animok] Boruto - Naruto Next Generations - 10 [1080p] [by mlouka].mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929241.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:F66DU3HN2I5QVL2XDRSFDMC7ZMLKBFTX&amp;dn=%5BAnimok%5D+Boruto+-+Naruto+Next+Generations+-+10+%5B1080p%5D+%5Bby+mlouka%5D.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">444.9 MiB</td>
<td class="text-center" data-timestamp="1496857155">2017-06-07 17:39</td>
<td class="text-center" style="color: green;">1</td>
<td class="text-center" style="color: red;">3</td>
<td class="text-center">0</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=2_1" title="Audio - Lossless">
<img src="/static/img/icons/nyaa/2_1.png" alt="Audio - Lossless">
</a>
</td>
<td colspan="2">
<a href="/view/929240" title="[AAC-tan] SHIN KIMAGURE ORANGE★ROAD Soshite, Ano Natsu no Hajimari Image Album 新きまぐれオレンジ★ロード～そして,あの夏のはじまり～ イメージ アルバム FLAC">[AAC-tan] SHIN KIMAGURE ORANGE★ROAD Soshite, Ano Natsu no Hajimari Image Album 新きまぐれオレンジ★ロード～そして,あの夏のはじまり～ イメージ アルバム FLAC</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929240.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:4LTJVGJLJIY7J7WQ4GELYLOCCIDYYCD7&amp;dn=%5BAAC-tan%5D+SHIN+KIMAGURE+ORANGE%E2%98%85ROAD+Soshite%2C+Ano+Natsu+no+Hajimari+Image+Album+%E6%96%B0%E3%81%8D%E3%81%BE%E3%81%90%E3%82%8C%E3%82%AA%E3%83%AC%E3%83%B3%E3%82%B8%E2%98%85%E3%83%AD%E3%83%BC%E3%83%89%EF%BD%9E%E3%81%9D%E3%81%97%E3%81%A6%2C%E3%81%82%E3%81%AE%E5%A4%8F%E3%81%AE%E3%81%AF%E3%81%98%E3%81%BE%E3%82%8A%EF%BD%9E+%E3%82%A4%E3%83%A1%E3%83%BC%E3%82%B8+%E3%82%A2%E3%83%AB%E3%83%90%E3%83%A0+FLAC&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">309.7 MiB</td>
<td class="text-center" data-timestamp="1496857151">2017-06-07 17:39</td>
<td class="text-center" style="color: green;">1</td>
<td class="text-center" style="color: red;">16</td>
<td class="text-center">0</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=2_2" title="Audio - Lossy">
<img src="/static/img/icons/nyaa/2_2.png" alt="Audio - Lossy">
</a>
</td>
<td colspan="2">
<a href="/view/929239" title="[AAC-tan] SHIN KIMAGURE ORANGE★ROAD Soshite, Ano Natsu no Hajimari Image Album 新きまぐれオレンジ★ロード～そして,あの夏のはじまり～ イメージ アルバム">[AAC-tan] SHIN KIMAGURE ORANGE★ROAD Soshite, Ano Natsu no Hajimari Image Album 新きまぐれオレンジ★ロード～そして,あの夏のはじまり～ イメージ アルバム</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929239.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:3LDKTJWKWOVSKG7UZDGVEEFRO4KSGRZX&amp;dn=%5BAAC-tan%5D+SHIN+KIMAGURE+ORANGE%E2%98%85ROAD+Soshite%2C+Ano+Natsu+no+Hajimari+Image+Album+%E6%96%B0%E3%81%8D%E3%81%BE%E3%81%90%E3%82%8C%E3%82%AA%E3%83%AC%E3%83%B3%E3%82%B8%E2%98%85%E3%83%AD%E3%83%BC%E3%83%89%EF%BD%9E%E3%81%9D%E3%81%97%E3%81%A6%2C%E3%81%82%E3%81%AE%E5%A4%8F%E3%81%AE%E3%81%AF%E3%81%98%E3%81%BE%E3%82%8A%EF%BD%9E+%E3%82%A4%E3%83%A1%E3%83%BC%E3%82%B8+%E3%82%A2%E3%83%AB%E3%83%90%E3%83%A0&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">120.4 MiB</td>
<td class="text-center" data-timestamp="1496857147">2017-06-07 17:39</td>
<td class="text-center" style="color: green;">3</td>
<td class="text-center" style="color: red;">8</td>
<td class="text-center">3</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929238" title="[Animok] Boruto - Naruto Next Generations - 10 [720p] [by mlouka].mp4">[Animok] Boruto - Naruto Next Generations - 10 [720p] [by mlouka].mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929238.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:OLXO6VIKQ46IODPKQNOQAH5ZI77FDMYD&amp;dn=%5BAnimok%5D+Boruto+-+Naruto+Next+Generations+-+10+%5B720p%5D+%5Bby+mlouka%5D.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">277.3 MiB</td>
<td class="text-center" data-timestamp="1496857111">2017-06-07 17:38</td>
<td class="text-center" style="color: green;">1</td>
<td class="text-center" style="color: red;">4</td>
<td class="text-center">0</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=2_2" title="Audio - Lossy">
<img src="/static/img/icons/nyaa/2_2.png" alt="Audio - Lossy">
</a>
</td>
<td colspan="2">
<a href="/view/929237" title="[Mashin] [170607] TVアニメ「クロックワーク・プラネット」オリジナルサウンドトラック [320K]">[Mashin] [170607] TVアニメ「クロックワーク・プラネット」オリジナルサウンドトラック [320K]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929237.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:S23Z66UBPLHJNKIGORJRELF56I7MQZXM&amp;dn=%5BMashin%5D+%5B170607%5D+TV%E3%82%A2%E3%83%8B%E3%83%A1%E3%80%8C%E3%82%AF%E3%83%AD%E3%83%83%E3%82%AF%E3%83%AF%E3%83%BC%E3%82%AF%E3%83%BB%E3%83%97%E3%83%A9%E3%83%8D%E3%83%83%E3%83%88%E3%80%8D%E3%82%AA%E3%83%AA%E3%82%B8%E3%83%8A%E3%83%AB%E3%82%B5%E3%82%A6%E3%83%B3%E3%83%89%E3%83%88%E3%83%A9%E3%83%83%E3%82%AF+%5B320K%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">175.6 MiB</td>
<td class="text-center" data-timestamp="1496856559">2017-06-07 17:29</td>
<td class="text-center" style="color: green;">40</td>
<td class="text-center" style="color: red;">33</td>
<td class="text-center">58</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929236" title="[HorribleSubs] Sagrada Reset - 10 [1080p].mkv">[HorribleSubs] Sagrada Reset - 10 [1080p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929236.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:OSS7BLJLA2S5A2WLAT5UKC3Y42ZVCCUC&amp;dn=%5BHorribleSubs%5D+Sagrada+Reset+-+10+%5B1080p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">567.0 MiB</td>
<td class="text-center" data-timestamp="1496854872">2017-06-07 17:01</td>
<td class="text-center" style="color: green;">421</td>
<td class="text-center" style="color: red;">142</td>
<td class="text-center">649</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929235" title="[HorribleSubs] Sagrada Reset - 10 [720p].mkv">[HorribleSubs] Sagrada Reset - 10 [720p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929235.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:QSAJSW5VJ2YUP6OWONHZGTHK32V4ITP4&amp;dn=%5BHorribleSubs%5D+Sagrada+Reset+-+10+%5B720p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">227.7 MiB</td>
<td class="text-center" data-timestamp="1496854871">2017-06-07 17:01</td>
<td class="text-center" style="color: green;">589</td>
<td class="text-center" style="color: red;">187</td>
<td class="text-center">959</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929234" title="[HorribleSubs] Sagrada Reset - 10 [480p].mkv">[HorribleSubs] Sagrada Reset - 10 [480p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929234.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:HRGS5AZ6KFCAALS2RXUXFUSZTPZMQK65&amp;dn=%5BHorribleSubs%5D+Sagrada+Reset+-+10+%5B480p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">86.1 MiB</td>
<td class="text-center" data-timestamp="1496854870">2017-06-07 17:01</td>
<td class="text-center" style="color: green;">161</td>
<td class="text-center" style="color: red;">75</td>
<td class="text-center">237</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929233" title="【喵萌奶茶屋/Nekomoe kissaten】[与僧侣交合的色欲之夜/Souryo to Majiwaru Shikiyoku no Yoru ni…][10][GB][720P]【AT-X版】【急募翻译校对】">【喵萌奶茶屋/Nekomoe kissaten】[与僧侣交合的色欲之夜/Souryo to Majiwaru Shikiyoku no Yoru ni…][10][GB][720P]【AT-X版】【急募翻译校对】</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929233.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:5U3L5VIP3OTRC4YCOL3VTL4RLMN6O3ZU&amp;dn=%E3%80%90%E5%96%B5%E8%90%8C%E5%A5%B6%E8%8C%B6%E5%B1%8B%2FNekomoe+kissaten%E3%80%91%5B%E4%B8%8E%E5%83%A7%E4%BE%A3%E4%BA%A4%E5%90%88%E7%9A%84%E8%89%B2%E6%AC%B2%E4%B9%8B%E5%A4%9C%2FSouryo+to+Majiwaru+Shikiyoku+no+Yoru+ni%E2%80%A6%5D%5B10%5D%5BGB%5D%5B720P%5D%E3%80%90AT-X%E7%89%88%E3%80%91%E3%80%90%E6%80%A5%E5%8B%9F%E7%BF%BB%E8%AF%91%E6%A0%A1%E5%AF%B9%E3%80%91&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">26.9 MiB</td>
<td class="text-center" data-timestamp="1496854691">2017-06-07 16:58</td>
<td class="text-center" style="color: green;">5</td>
<td class="text-center" style="color: red;">2</td>
<td class="text-center">7</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929232" title="【喵萌奶茶屋/Nekomoe kissaten】[與僧侶交合的色慾之夜/Souryo to Majiwaru Shikiyoku no Yoru ni…][10][BIG5][720P]【AT-X版】【急募翻譯校對】">【喵萌奶茶屋/Nekomoe kissaten】[與僧侶交合的色慾之夜/Souryo to Majiwaru Shikiyoku no Yoru ni…][10][BIG5][720P]【AT-X版】【急募翻譯校對】</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929232.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:YCU6B2MQMPFCD2WSCVSELDM5LXH7A4XY&amp;dn=%E3%80%90%E5%96%B5%E8%90%8C%E5%A5%B6%E8%8C%B6%E5%B1%8B%2FNekomoe+kissaten%E3%80%91%5B%E8%88%87%E5%83%A7%E4%BE%B6%E4%BA%A4%E5%90%88%E7%9A%84%E8%89%B2%E6%85%BE%E4%B9%8B%E5%A4%9C%2FSouryo+to+Majiwaru+Shikiyoku+no+Yoru+ni%E2%80%A6%5D%5B10%5D%5BBIG5%5D%5B720P%5D%E3%80%90AT-X%E7%89%88%E3%80%91%E3%80%90%E6%80%A5%E5%8B%9F%E7%BF%BB%E8%AD%AF%E6%A0%A1%E5%B0%8D%E3%80%91&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">26.9 MiB</td>
<td class="text-center" data-timestamp="1496854681">2017-06-07 16:58</td>
<td class="text-center" style="color: green;">12</td>
<td class="text-center" style="color: red;">6</td>
<td class="text-center">11</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929231#comments" class="comments" title="1 comment">
<i class="fa fa-comments-o"></i>1</a>
<a href="/view/929231" title="[Fabrebatalla18][RAW] Detective Conan [Remastered]">[Fabrebatalla18][RAW] Detective Conan [Remastered]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929231.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:5K6FG3CUXJPF3DFE4FXF6FW2J5T4DPQQ&amp;dn=%5BFabrebatalla18%5D%5BRAW%5D+Detective+Conan+%5BRemastered%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">12.4 GiB</td>
<td class="text-center" data-timestamp="1496854427">2017-06-07 16:53</td>
<td class="text-center" style="color: green;">2</td>
<td class="text-center" style="color: red;">5</td>
<td class="text-center">1</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929230" title="[HorribleSubs] Sakura Quest - 10 [1080p].mkv">[HorribleSubs] Sakura Quest - 10 [1080p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929230.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:RJN5AFDXZT5AYVVU7JS4T5PB6PP3IRXT&amp;dn=%5BHorribleSubs%5D+Sakura+Quest+-+10+%5B1080p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">542.2 MiB</td>
<td class="text-center" data-timestamp="1496854383">2017-06-07 16:53</td>
<td class="text-center" style="color: green;">494</td>
<td class="text-center" style="color: red;">143</td>
<td class="text-center">880</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929229" title="[HorribleSubs] Sakura Quest - 10 [720p].mkv">[HorribleSubs] Sakura Quest - 10 [720p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929229.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:TADRUQIW65GLNPHBMCYFUZX67L6V5JBM&amp;dn=%5BHorribleSubs%5D+Sakura+Quest+-+10+%5B720p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">322.5 MiB</td>
<td class="text-center" data-timestamp="1496854190">2017-06-07 16:49</td>
<td class="text-center" style="color: green;">838</td>
<td class="text-center" style="color: red;">246</td>
<td class="text-center">1439</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929228" title="[HorribleSubs] Sakura Quest - 10 [480p].mkv">[HorribleSubs] Sakura Quest - 10 [480p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929228.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:CGRCHRDH2UVWD3KPSEXSH4Y53YKJU2AK&amp;dn=%5BHorribleSubs%5D+Sakura+Quest+-+10+%5B480p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">146.9 MiB</td>
<td class="text-center" data-timestamp="1496854043">2017-06-07 16:47</td>
<td class="text-center" style="color: green;">151</td>
<td class="text-center" style="color: red;">72</td>
<td class="text-center">252</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929227" title="[Fabrebatalla18][RAW] Gosho Aoyama Short Stories (&#39;Aoyama Gosho Tanpen-shu&#39;) [Remastered][960x720][10 bits]">[Fabrebatalla18][RAW] Gosho Aoyama Short Stories (&#39;Aoyama Gosho Tanpen-shu&#39;) [Remastered][960x720][10 bits]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929227.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:ZMCQQDGYTKIPWNDPHYU3HZCWQL52AQ2N&amp;dn=%5BFabrebatalla18%5D%5BRAW%5D+Gosho+Aoyama+Short+Stories+%28%27Aoyama+Gosho+Tanpen-shu%27%29+%5BRemastered%5D%5B960x720%5D%5B10+bits%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">1.9 GiB</td>
<td class="text-center" data-timestamp="1496854018">2017-06-07 16:46</td>
<td class="text-center" style="color: green;">4</td>
<td class="text-center" style="color: red;">5</td>
<td class="text-center">1</td>
</tr>
<tr class="danger">
<td style="padding:0 4px;">
<a href="/?c=5_2" title="Pictures - Photos">
<img src="/static/img/icons/nyaa/5_2.png" alt="Pictures - Photos">
</a>
</td>
<td colspan="2">
<a href="/view/929226" title="【JOJO熱情瑪麗組】★ [田村隆平] 腹ペコのマリー 飢餓的瑪麗 / 飢腸轆轆的瑪麗 14話">【JOJO熱情瑪麗組】★ [田村隆平] 腹ペコのマリー 飢餓的瑪麗 / 飢腸轆轆的瑪麗 14話</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929226.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:W335JN5WOC3FQKDH7EFHFN6XUKYOVKNI&amp;dn=%E3%80%90JOJO%E7%86%B1%E6%83%85%E7%91%AA%E9%BA%97%E7%B5%84%E3%80%91%E2%98%85+%5B%E7%94%B0%E6%9D%91%E9%9A%86%E5%B9%B3%5D+%E8%85%B9%E3%83%9A%E3%82%B3%E3%81%AE%E3%83%9E%E3%83%AA%E3%83%BC+%E9%A3%A2%E9%A4%93%E7%9A%84%E7%91%AA%E9%BA%97+%2F+%E9%A3%A2%E8%85%B8%E8%BD%86%E8%BD%86%E7%9A%84%E7%91%AA%E9%BA%97+14%E8%A9%B1&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">6.9 MiB</td>
<td class="text-center" data-timestamp="1496853860">2017-06-07 16:44</td>
<td class="text-center" style="color: green;">11</td>
<td class="text-center" style="color: red;">6</td>
<td class="text-center">16</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929225#comments" class="comments" title="3 comments">
<i class="fa fa-comments-o"></i>3</a>
<a href="/view/929225" title="Detective Conan - 589 - Saiaku na birthday (zempen) [usotsuki][RAW-720p][42970EE2].mp4">Detective Conan - 589 - Saiaku na birthday (zempen) [usotsuki][RAW-720p][42970EE2].mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929225.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:DAGXM65XPKOAIIK6CEIFE5UUI4NLXO2R&amp;dn=Detective+Conan+-+589+-+Saiaku+na+birthday+%28zempen%29+%5Busotsuki%5D%5BRAW-720p%5D%5B42970EE2%5D.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">314.8 MiB</td>
<td class="text-center" data-timestamp="1496853323">2017-06-07 16:35</td>
<td class="text-center" style="color: green;">3</td>
<td class="text-center" style="color: red;">3</td>
<td class="text-center">5</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929224" title="[PuyaSubs!] Sagrada Reset - 10 [1080p][0E013B8E].mkv">[PuyaSubs!] Sagrada Reset - 10 [1080p][0E013B8E].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929224.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:3ONWKNBUVX52VKHO3ZBX4KHEX74ICRTY&amp;dn=%5BPuyaSubs%21%5D+Sagrada+Reset+-+10+%5B1080p%5D%5B0E013B8E%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">389.5 MiB</td>
<td class="text-center" data-timestamp="1496852629">2017-06-07 16:23</td>
<td class="text-center" style="color: green;">57</td>
<td class="text-center" style="color: red;">22</td>
<td class="text-center">58</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929223" title="[ Yuma ] Boruto - Naruto Next Generations - 010 [10bit] [720p] [Sub-Spanish].mkv">[ Yuma ] Boruto - Naruto Next Generations - 010 [10bit] [720p] [Sub-Spanish].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929223.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:SFLTVTHOMEJOJH5EM6AYUUG7UGT3ZVET&amp;dn=%5B+Yuma+%5D+Boruto+-+Naruto+Next+Generations+-+010+%5B10bit%5D+%5B720p%5D+%5BSub-Spanish%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">210.8 MiB</td>
<td class="text-center" data-timestamp="1496852571">2017-06-07 16:22</td>
<td class="text-center" style="color: green;">17</td>
<td class="text-center" style="color: red;">2</td>
<td class="text-center">0</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929222" title="[PuyaSubs!] Room Mate - 09 [720p][2214CA1B].mkv">[PuyaSubs!] Room Mate - 09 [720p][2214CA1B].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929222.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:MWLLMAUXBFTY2OQXYSJFI5BPFJWQY67G&amp;dn=%5BPuyaSubs%21%5D+Room+Mate+-+09+%5B720p%5D%5B2214CA1B%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">54.5 MiB</td>
<td class="text-center" data-timestamp="1496852312">2017-06-07 16:18</td>
<td class="text-center" style="color: green;">14</td>
<td class="text-center" style="color: red;">4</td>
<td class="text-center">12</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929221" title="[Erai-raws] Sakura Quest - 10 [1080p][6CDDF335].mkv">[Erai-raws] Sakura Quest - 10 [1080p][6CDDF335].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929221.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:GLJ5D4TBQDN7K2T6C37DI3M7JDT3ZHAR&amp;dn=%5BErai-raws%5D+Sakura+Quest+-+10+%5B1080p%5D%5B6CDDF335%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">641.7 MiB</td>
<td class="text-center" data-timestamp="1496851795">2017-06-07 16:09</td>
<td class="text-center" style="color: green;">29</td>
<td class="text-center" style="color: red;">3</td>
<td class="text-center">56</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929220" title="[Erai-raws] Sakura Quest - 10 [720p][829663FC].mkv">[Erai-raws] Sakura Quest - 10 [720p][829663FC].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929220.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:2XBF74RDMX3CYUYIFYRLSWWO3CHZG6HL&amp;dn=%5BErai-raws%5D+Sakura+Quest+-+10+%5B720p%5D%5B829663FC%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">311.4 MiB</td>
<td class="text-center" data-timestamp="1496851780">2017-06-07 16:09</td>
<td class="text-center" style="color: green;">16</td>
<td class="text-center" style="color: red;">5</td>
<td class="text-center">48</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929219" title="[Arabic-Sub] Natsume Yuujinchou Roku EP09 [HD-Hardsub]">[Arabic-Sub] Natsume Yuujinchou Roku EP09 [HD-Hardsub]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929219.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:T4SLN33S5Y2KPTQ6K5JAHIP4WPIKXHLO&amp;dn=%5BArabic-Sub%5D+Natsume+Yuujinchou+Roku+EP09+%5BHD-Hardsub%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">186.1 MiB</td>
<td class="text-center" data-timestamp="1496851033">2017-06-07 15:57</td>
<td class="text-center" style="color: green;">1</td>
<td class="text-center" style="color: red;">1</td>
<td class="text-center">0</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929218" title="[Leopard-Raws] Yu-Gi-Oh! VRAINS - 005 RAW (TX 1280x720 x264 AAC).mp4">[Leopard-Raws] Yu-Gi-Oh! VRAINS - 005 RAW (TX 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929218.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:NWOYOIN5RLVDXNOCUVJTFEKNM5KLQAC5&amp;dn=%5BLeopard-Raws%5D+Yu-Gi-Oh%21+VRAINS+-+005+RAW+%28TX+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">486.0 MiB</td>
<td class="text-center" data-timestamp="1496851003">2017-06-07 15:56</td>
<td class="text-center" style="color: green;">57</td>
<td class="text-center" style="color: red;">18</td>
<td class="text-center">207</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929217" title="[Leopard-Raws] Boruto - 10 RAW (TX 1280x720 x264 AAC).mp4">[Leopard-Raws] Boruto - 10 RAW (TX 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929217.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:5RVNH6IQJK76Q322YXX565KNACQ25DIU&amp;dn=%5BLeopard-Raws%5D+Boruto+-+10+RAW+%28TX+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">307.9 MiB</td>
<td class="text-center" data-timestamp="1496850993">2017-06-07 15:56</td>
<td class="text-center" style="color: green;">115</td>
<td class="text-center" style="color: red;">21</td>
<td class="text-center">401</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929216" title="【喵萌奶茶屋】★七月新番★[徒然喜欢你/Tsure×dure children ][PV02][GB][720P]【招募翻译校对♥】">【喵萌奶茶屋】★七月新番★[徒然喜欢你/Tsure×dure children ][PV02][GB][720P]【招募翻译校对♥】</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929216.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:J4P2AOSY2HMEVXCGTPMCKLHVFUT2DHUL&amp;dn=%E3%80%90%E5%96%B5%E8%90%8C%E5%A5%B6%E8%8C%B6%E5%B1%8B%E3%80%91%E2%98%85%E4%B8%83%E6%9C%88%E6%96%B0%E7%95%AA%E2%98%85%5B%E5%BE%92%E7%84%B6%E5%96%9C%E6%AC%A2%E4%BD%A0%2FTsure%C3%97dure+children+%5D%5BPV02%5D%5BGB%5D%5B720P%5D%E3%80%90%E6%8B%9B%E5%8B%9F%E7%BF%BB%E8%AF%91%E6%A0%A1%E5%AF%B9%E2%99%A5%E3%80%91&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">2.1 MiB</td>
<td class="text-center" data-timestamp="1496850683">2017-06-07 15:51</td>
<td class="text-center" style="color: green;">8</td>
<td class="text-center" style="color: red;">1</td>
<td class="text-center">15</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929215" title="[PuyaSubs!] Makeruna!! Aku no Gundan! - 10 [720p][B438C044].mkv">[PuyaSubs!] Makeruna!! Aku no Gundan! - 10 [720p][B438C044].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929215.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:7UGSVS2TZMXT7MLI5477ILG7QPABTCNB&amp;dn=%5BPuyaSubs%21%5D+Makeruna%21%21+Aku+no+Gundan%21+-+10+%5B720p%5D%5BB438C044%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">61.3 MiB</td>
<td class="text-center" data-timestamp="1496850322">2017-06-07 15:45</td>
<td class="text-center" style="color: green;">12</td>
<td class="text-center" style="color: red;">4</td>
<td class="text-center">11</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929214" title="[PuyaSubs!] Love Kome - We Love Rice - 10 [720p][971E15D3].mkv">[PuyaSubs!] Love Kome - We Love Rice - 10 [720p][971E15D3].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929214.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:TUM3NCKNCZIGHHHVQN3P2C2XD2JBIVXP&amp;dn=%5BPuyaSubs%21%5D+Love+Kome+-+We+Love+Rice+-+10+%5B720p%5D%5B971E15D3%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">55.3 MiB</td>
<td class="text-center" data-timestamp="1496850308">2017-06-07 15:45</td>
<td class="text-center" style="color: green;">16</td>
<td class="text-center" style="color: red;">4</td>
<td class="text-center">18</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929213" title="[PuyaSubs!] Kenka Banchou Otome - Girl Beats Boys - 09 [720p][7ECFE93F].mkv">[PuyaSubs!] Kenka Banchou Otome - Girl Beats Boys - 09 [720p][7ECFE93F].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929213.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:OOEFMQL6DCM5QVWVMRSSRYBFUJ747BRP&amp;dn=%5BPuyaSubs%21%5D+Kenka+Banchou+Otome+-+Girl+Beats+Boys+-+09+%5B720p%5D%5B7ECFE93F%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">108.8 MiB</td>
<td class="text-center" data-timestamp="1496850295">2017-06-07 15:44</td>
<td class="text-center" style="color: green;">31</td>
<td class="text-center" style="color: red;">11</td>
<td class="text-center">31</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929212" title="[Ohys-Raws] Sakura Quest - 10 (AT-X 1280x720 x264 AAC).mp4">[Ohys-Raws] Sakura Quest - 10 (AT-X 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929212.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:4NVNGFBY2BR67DUTN5GIXRM6OK6XQ5FH&amp;dn=%5BOhys-Raws%5D+Sakura+Quest+-+10+%28AT-X+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">262.7 MiB</td>
<td class="text-center" data-timestamp="1496849756">2017-06-07 15:35</td>
<td class="text-center" style="color: green;">338</td>
<td class="text-center" style="color: red;">96</td>
<td class="text-center">798</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=3_1" title="Literature - English-translated">
<img src="/static/img/icons/nyaa/3_1.png" alt="Literature - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929211#comments" class="comments" title="3 comments">
<i class="fa fa-comments-o"></i>3</a>
<a href="/view/929211" title="[meep] Sword Oratoria Light Novel Vol 1-2">[meep] Sword Oratoria Light Novel Vol 1-2</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929211.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:WLLUWYRYGERXTPH4CSO5ZJRF4DIF45BY&amp;dn=%5Bmeep%5D+Sword+Oratoria+Light+Novel+Vol+1-2&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">35.4 MiB</td>
<td class="text-center" data-timestamp="1496849748">2017-06-07 15:35</td>
<td class="text-center" style="color: green;">14</td>
<td class="text-center" style="color: red;">2</td>
<td class="text-center">29</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=2_2" title="Audio - Lossy">
<img src="/static/img/icons/nyaa/2_2.png" alt="Audio - Lossy">
</a>
</td>
<td colspan="2">
<a href="/view/929210" title="[AAC-tan] (Hi-RES) ID-0 OP ID-0">[AAC-tan] (Hi-RES) ID-0 OP ID-0</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929210.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:C7GCOTT7ZWNOVVMPXFKLJKM3RGYILYCU&amp;dn=%5BAAC-tan%5D+%28Hi-RES%29+ID-0+OP+ID-0&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">24.9 MiB</td>
<td class="text-center" data-timestamp="1496849453">2017-06-07 15:30</td>
<td class="text-center" style="color: green;">7</td>
<td class="text-center" style="color: red;">7</td>
<td class="text-center">21</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929209" title="[HorribleSubs] Room Mate - 09 [1080p].mkv">[HorribleSubs] Room Mate - 09 [1080p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929209.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:TOXQ6YNOKQPKMHK3TB6OBSKHVCF4BI2R&amp;dn=%5BHorribleSubs%5D+Room+Mate+-+09+%5B1080p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">91.8 MiB</td>
<td class="text-center" data-timestamp="1496849197">2017-06-07 15:26</td>
<td class="text-center" style="color: green;">68</td>
<td class="text-center" style="color: red;">16</td>
<td class="text-center">178</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929208#comments" class="comments" title="1 comment">
<i class="fa fa-comments-o"></i>1</a>
<a href="/view/929208" title="[HorribleSubs] Room Mate - 09 [720p].mkv">[HorribleSubs] Room Mate - 09 [720p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929208.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:NAC3LM6T5FREP3C47QHVUJPAMWMHAZXA&amp;dn=%5BHorribleSubs%5D+Room+Mate+-+09+%5B720p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">54.5 MiB</td>
<td class="text-center" data-timestamp="1496849157">2017-06-07 15:25</td>
<td class="text-center" style="color: green;">127</td>
<td class="text-center" style="color: red;">13</td>
<td class="text-center">288</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929207" title="[HorribleSubs] Room Mate - 09 [480p].mkv">[HorribleSubs] Room Mate - 09 [480p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929207.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:TZBNNN6KLZN2AHHTN5FYFPHUDDHCKGVE&amp;dn=%5BHorribleSubs%5D+Room+Mate+-+09+%5B480p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">24.9 MiB</td>
<td class="text-center" data-timestamp="1496849128">2017-06-07 15:25</td>
<td class="text-center" style="color: green;">49</td>
<td class="text-center" style="color: red;">16</td>
<td class="text-center">98</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929206" title="[Ohys-Raws] Sagrada Reset - 10 (MX 1280x720 x264 AAC).mp4">[Ohys-Raws] Sagrada Reset - 10 (MX 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929206.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:ZSDBXFVU63B2YBIOHXPVVR5I5LL5MTUD&amp;dn=%5BOhys-Raws%5D+Sagrada+Reset+-+10+%28MX+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">263.4 MiB</td>
<td class="text-center" data-timestamp="1496849041">2017-06-07 15:24</td>
<td class="text-center" style="color: green;">265</td>
<td class="text-center" style="color: red;">75</td>
<td class="text-center">665</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929205" title="[HorribleSubs] Kenka Banchou Otome - Girl Beats Boys - 09 [1080p].mkv">[HorribleSubs] Kenka Banchou Otome - Girl Beats Boys - 09 [1080p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929205.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:3TRRSYJYPM54MAL4ZFYG53B4CPUC7YAW&amp;dn=%5BHorribleSubs%5D+Kenka+Banchou+Otome+-+Girl+Beats+Boys+-+09+%5B1080p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">182.9 MiB</td>
<td class="text-center" data-timestamp="1496848977">2017-06-07 15:22</td>
<td class="text-center" style="color: green;">163</td>
<td class="text-center" style="color: red;">30</td>
<td class="text-center">351</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929204" title="[HorribleSubs] Kenka Banchou Otome - Girl Beats Boys - 09 [720p].mkv">[HorribleSubs] Kenka Banchou Otome - Girl Beats Boys - 09 [720p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929204.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:RKYBK7LX7S5UXJYN2TIAJA7M65XFISHC&amp;dn=%5BHorribleSubs%5D+Kenka+Banchou+Otome+-+Girl+Beats+Boys+-+09+%5B720p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">108.8 MiB</td>
<td class="text-center" data-timestamp="1496848908">2017-06-07 15:21</td>
<td class="text-center" style="color: green;">289</td>
<td class="text-center" style="color: red;">46</td>
<td class="text-center">629</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929203" title="[HorribleSubs] Kenka Banchou Otome - Girl Beats Boys - 09 [480p].mkv">[HorribleSubs] Kenka Banchou Otome - Girl Beats Boys - 09 [480p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929203.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:345X2725AH7AKHFW5IZN5PXAN54272UD&amp;dn=%5BHorribleSubs%5D+Kenka+Banchou+Otome+-+Girl+Beats+Boys+-+09+%5B480p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">49.7 MiB</td>
<td class="text-center" data-timestamp="1496848857">2017-06-07 15:20</td>
<td class="text-center" style="color: green;">145</td>
<td class="text-center" style="color: red;">27</td>
<td class="text-center">264</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929202" title="[Anime Land] Boruto 09 (BSJ 720p Hi10P AAC) RAW [C646D7AD].mp4">[Anime Land] Boruto 09 (BSJ 720p Hi10P AAC) RAW [C646D7AD].mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929202.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:KMGOCGWFET6RPELGVCZNOE2AFRWQDFQU&amp;dn=%5BAnime+Land%5D+Boruto+09+%28BSJ+720p+Hi10P+AAC%29+RAW+%5BC646D7AD%5D.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">353.8 MiB</td>
<td class="text-center" data-timestamp="1496848661">2017-06-07 15:17</td>
<td class="text-center" style="color: green;">4</td>
<td class="text-center" style="color: red;">2</td>
<td class="text-center">4</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929201" title="[INDRA&amp;NMKST][四月新番] 樱花任务 / Sakura Quest [08] [720P][HardSub][GB][x264 AAC]">[INDRA&amp;NMKST][四月新番] 樱花任务 / Sakura Quest [08] [720P][HardSub][GB][x264 AAC]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929201.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:DNS4RKSEEW3PJFO2H7H3NE4FXSK5SDXW&amp;dn=%5BINDRA%26NMKST%5D%5B%E5%9B%9B%E6%9C%88%E6%96%B0%E7%95%AA%5D+%E6%A8%B1%E8%8A%B1%E4%BB%BB%E5%8A%A1+%2F+Sakura+Quest+%5B08%5D+%5B720P%5D%5BHardSub%5D%5BGB%5D%5Bx264+AAC%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">157.7 MiB</td>
<td class="text-center" data-timestamp="1496848125">2017-06-07 15:08</td>
<td class="text-center" style="color: green;">3</td>
<td class="text-center" style="color: red;">1</td>
<td class="text-center">3</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929200" title="[INDRA&amp;NMKST][四月新番] 櫻花任務 / Sakura Quest [08] [720P][HardSub][BIG5][x264 AAC]">[INDRA&amp;NMKST][四月新番] 櫻花任務 / Sakura Quest [08] [720P][HardSub][BIG5][x264 AAC]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929200.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:6CBZCUNR7S7A4SS2SPQ2L3ILFKFFMUQ2&amp;dn=%5BINDRA%26NMKST%5D%5B%E5%9B%9B%E6%9C%88%E6%96%B0%E7%95%AA%5D+%E6%AB%BB%E8%8A%B1%E4%BB%BB%E5%8B%99+%2F+Sakura+Quest+%5B08%5D+%5B720P%5D%5BHardSub%5D%5BBIG5%5D%5Bx264+AAC%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">157.7 MiB</td>
<td class="text-center" data-timestamp="1496848124">2017-06-07 15:08</td>
<td class="text-center" style="color: green;">6</td>
<td class="text-center" style="color: red;">4</td>
<td class="text-center">10</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929199" title="[DMG][Little_Witch_Academia][BDRip][Vol.02][AVC_Hi10P_FLAC_PGS][1080P] + [Vol.01] &gt;">[DMG][Little_Witch_Academia][BDRip][Vol.02][AVC_Hi10P_FLAC_PGS][1080P] + [Vol.01] &gt;</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929199.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:4CBZR5GKGTEGDH4TXER5LSN5H67T2AGC&amp;dn=%5BDMG%5D%5BLittle_Witch_Academia%5D%5BBDRip%5D%5BVol.02%5D%5BAVC_Hi10P_FLAC_PGS%5D%5B1080P%5D+%2B+%5BVol.01%5D+%3E&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">2.1 GiB</td>
<td class="text-center" data-timestamp="1496848070">2017-06-07 15:07</td>
<td class="text-center" style="color: green;">1</td>
<td class="text-center" style="color: red;">5</td>
<td class="text-center">1</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929198" title="[HorribleSubs] Makeruna!! Aku no Gundan! - 10 [1080p].mkv">[HorribleSubs] Makeruna!! Aku no Gundan! - 10 [1080p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929198.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:IGGSVWUIQOTJMBAAWDVQTJJIQ6GTYPQ5&amp;dn=%5BHorribleSubs%5D+Makeruna%21%21+Aku+no+Gundan%21+-+10+%5B1080p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">102.8 MiB</td>
<td class="text-center" data-timestamp="1496847713">2017-06-07 15:01</td>
<td class="text-center" style="color: green;">67</td>
<td class="text-center" style="color: red;">8</td>
<td class="text-center">151</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929197" title="[HorribleSubs] Makeruna!! Aku no Gundan! - 10 [720p].mkv">[HorribleSubs] Makeruna!! Aku no Gundan! - 10 [720p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929197.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:ZR5SJVKNGVP2YVLNGPKOWIRS4OHSFBAH&amp;dn=%5BHorribleSubs%5D+Makeruna%21%21+Aku+no+Gundan%21+-+10+%5B720p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">61.4 MiB</td>
<td class="text-center" data-timestamp="1496847673">2017-06-07 15:01</td>
<td class="text-center" style="color: green;">98</td>
<td class="text-center" style="color: red;">10</td>
<td class="text-center">263</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929196" title="[HorribleSubs] Makeruna!! Aku no Gundan! - 10 [480p].mkv">[HorribleSubs] Makeruna!! Aku no Gundan! - 10 [480p].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929196.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:RIQWDMXPUX3VCCQIRC3ZUYECZ2UCFFUN&amp;dn=%5BHorribleSubs%5D+Makeruna%21%21+Aku+no+Gundan%21+-+10+%5B480p%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">28.0 MiB</td>
<td class="text-center" data-timestamp="1496847645">2017-06-07 15:00</td>
<td class="text-center" style="color: green;">32</td>
<td class="text-center" style="color: red;">10</td>
<td class="text-center">86</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929195#comments" class="comments" title="1 comment">
<i class="fa fa-comments-o"></i>1</a>
<a href="/view/929195" title="[ID-anon] ID-0 - 09.mkv">[ID-anon] ID-0 - 09.mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929195.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:6FOVYB23N3S2EBX7DEEF772DMNQMUBVH&amp;dn=%5BID-anon%5D+ID-0+-+09.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">428.0 MiB</td>
<td class="text-center" data-timestamp="1496846281">2017-06-07 14:38</td>
<td class="text-center" style="color: green;">114</td>
<td class="text-center" style="color: red;">30</td>
<td class="text-center">226</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929194" title="[Ohys-Raws] Busou Shoujo Machiavellianism - 10 (AT-X 1280x720 x264 AAC).mp4">[Ohys-Raws] Busou Shoujo Machiavellianism - 10 (AT-X 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929194.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:DQKYSPHQTCXCIBWMHCFUHNO6DJ7THUOV&amp;dn=%5BOhys-Raws%5D+Busou+Shoujo+Machiavellianism+-+10+%28AT-X+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">343.5 MiB</td>
<td class="text-center" data-timestamp="1496846193">2017-06-07 14:36</td>
<td class="text-center" style="color: green;">574</td>
<td class="text-center" style="color: red;">146</td>
<td class="text-center">1523</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=4_4" title="Live Action - Raw">
<img src="/static/img/icons/nyaa/4_4.png" alt="Live Action - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929193" title="[JDrama] 3-nin no Papa Ep03-Ep06 (848x480 x264)">[JDrama] 3-nin no Papa Ep03-Ep06 (848x480 x264)</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929193.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:WHXWKGTA7EPCMOMSAYPKPKK3LT4F3H3G&amp;dn=%5BJDrama%5D+3-nin+no+Papa+Ep03-Ep06+%28848x480+x264%29&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">786.7 MiB</td>
<td class="text-center" data-timestamp="1496845722">2017-06-07 14:28</td>
<td class="text-center" style="color: green;">8</td>
<td class="text-center" style="color: red;">7</td>
<td class="text-center">11</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929192" title="[AnimeRG] Yu-Gi-Oh Vrains - 5 [1280X720] [English Sub] [Web-DL] [Pseudo-ReleaseBitch].mkv">[AnimeRG] Yu-Gi-Oh Vrains - 5 [1280X720] [English Sub] [Web-DL] [Pseudo-ReleaseBitch].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929192.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:E5ONYOMYLTSQUIMUQVRM4BFEKOQFWFSX&amp;dn=%5BAnimeRG%5D+Yu-Gi-Oh+Vrains+-+5+%5B1280X720%5D+%5BEnglish+Sub%5D+%5BWeb-DL%5D+%5BPseudo-ReleaseBitch%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">612.3 MiB</td>
<td class="text-center" data-timestamp="1496845545">2017-06-07 14:25</td>
<td class="text-center" style="color: green;">41</td>
<td class="text-center" style="color: red;">14</td>
<td class="text-center">115</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929191" title="[Ohys-Raws] Love Kome We Love Rice - 10 (MX 1280x720 x264 AAC).mp4">[Ohys-Raws] Love Kome We Love Rice - 10 (MX 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929191.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:VUTBF5F7PVI64MXYYNOQMQ2YDUF7H673&amp;dn=%5BOhys-Raws%5D+Love+Kome+We+Love+Rice+-+10+%28MX+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">55.6 MiB</td>
<td class="text-center" data-timestamp="1496844147">2017-06-07 14:02</td>
<td class="text-center" style="color: green;">64</td>
<td class="text-center" style="color: red;">11</td>
<td class="text-center">199</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929190" title="[Ohys-Raws] Room Mate - 09 (MX 1280x720 x264 AAC).mp4">[Ohys-Raws] Room Mate - 09 (MX 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929190.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:OWJ557U746E5J5ER62GO7PC5VB44WANR&amp;dn=%5BOhys-Raws%5D+Room+Mate+-+09+%28MX+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">75.2 MiB</td>
<td class="text-center" data-timestamp="1496843699">2017-06-07 13:54</td>
<td class="text-center" style="color: green;">53</td>
<td class="text-center" style="color: red;">14</td>
<td class="text-center">182</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929189" title="[Ohys-Raws] Kenka Banchou Otome Girl Beats Boys - 09 (MX 1280x720 x264 AAC).mp4">[Ohys-Raws] Kenka Banchou Otome Girl Beats Boys - 09 (MX 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929189.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:I4XWJXANDMDBR3WNXZPP2I52R75QLPJB&amp;dn=%5BOhys-Raws%5D+Kenka+Banchou+Otome+Girl+Beats+Boys+-+09+%28MX+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">150.1 MiB</td>
<td class="text-center" data-timestamp="1496843618">2017-06-07 13:53</td>
<td class="text-center" style="color: green;">117</td>
<td class="text-center" style="color: red;">31</td>
<td class="text-center">383</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929188" title="[RH] Kuzu no Honkai Vol. 1 &amp; 2 [BDRip] [Hi10] [1080p]">[RH] Kuzu no Honkai Vol. 1 &amp; 2 [BDRip] [Hi10] [1080p]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929188.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:AIU52AZILNBUXLYYG2DTWBRB6JBBMHKV&amp;dn=%5BRH%5D+Kuzu+no+Honkai+Vol.+1+%26+2+%5BBDRip%5D+%5BHi10%5D+%5B1080p%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">3.1 GiB</td>
<td class="text-center" data-timestamp="1496843381">2017-06-07 13:49</td>
<td class="text-center" style="color: green;">4</td>
<td class="text-center" style="color: red;">11</td>
<td class="text-center">11</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929187" title="[Ohys-Raws] Souryo to Majiwaru Shikiyoku no Yoru ni.. - 10 (AT-X 1280x720 x264 AAC).mp4">[Ohys-Raws] Souryo to Majiwaru Shikiyoku no Yoru ni.. - 10 (AT-X 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929187.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:7DNNR4M3UZLQY5WPQ47CX4TYT67F75P6&amp;dn=%5BOhys-Raws%5D+Souryo+to+Majiwaru+Shikiyoku+no+Yoru+ni..+-+10+%28AT-X+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">37.5 MiB</td>
<td class="text-center" data-timestamp="1496842845">2017-06-07 13:40</td>
<td class="text-center" style="color: green;">99</td>
<td class="text-center" style="color: red;">18</td>
<td class="text-center">364</td>
</tr>
<tr class="danger">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929186" title="[AnimeRG] Boruto - Naruto Next Generations - 10 [720p] [Multi-Sub] [HEVC] [x265] [pseudo].mkv">[AnimeRG] Boruto - Naruto Next Generations - 10 [720p] [Multi-Sub] [HEVC] [x265] [pseudo].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929186.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:C7BA3W5SUJ35T25HDEYHZX2U5BDQAPGW&amp;dn=%5BAnimeRG%5D+Boruto+-+Naruto+Next+Generations+-+10+%5B720p%5D+%5BMulti-Sub%5D+%5BHEVC%5D+%5Bx265%5D+%5Bpseudo%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">88.3 MiB</td>
<td class="text-center" data-timestamp="1496842768">2017-06-07 13:39</td>
<td class="text-center" style="color: green;">21</td>
<td class="text-center" style="color: red;">10</td>
<td class="text-center">79</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929185" title="Beyblade Burst God - 10 (TX 1280x720 x264 AAC).mp4">Beyblade Burst God - 10 (TX 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929185.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:N2A6TMW5DI7VLECAQNAWBRKFKYQVJ5C2&amp;dn=Beyblade+Burst+God+-+10+%28TX+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">289.2 MiB</td>
<td class="text-center" data-timestamp="1496842758">2017-06-07 13:39</td>
<td class="text-center" style="color: green;">0</td>
<td class="text-center" style="color: red;">17</td>
<td class="text-center">11</td>
</tr>
<tr class="danger">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929184" title="[AnimeRG] Boruto - Naruto Next Generations - 10 [1080p] [Multi-Sub] [HEVC] [x265] [pseudo].mkv">[AnimeRG] Boruto - Naruto Next Generations - 10 [1080p] [Multi-Sub] [HEVC] [x265] [pseudo].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929184.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:DB2PBN5RFWRD7ZYIQBXOL2NJGOSG54UI&amp;dn=%5BAnimeRG%5D+Boruto+-+Naruto+Next+Generations+-+10+%5B1080p%5D+%5BMulti-Sub%5D+%5BHEVC%5D+%5Bx265%5D+%5Bpseudo%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">206.2 MiB</td>
<td class="text-center" data-timestamp="1496842685">2017-06-07 13:38</td>
<td class="text-center" style="color: green;">13</td>
<td class="text-center" style="color: red;">7</td>
<td class="text-center">52</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929183" title="[Sanninkonoha] Boruto - Naruto Next Generations - 10 (TX 1280x720 x265 HEVC AAC).mp4">[Sanninkonoha] Boruto - Naruto Next Generations - 10 (TX 1280x720 x265 HEVC AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929183.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:JJDBSFR3XG7OVQP3EECGT536245JR72E&amp;dn=%5BSanninkonoha%5D+Boruto+-+Naruto+Next+Generations+-+10+%28TX+1280x720+x265+HEVC+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">71.4 MiB</td>
<td class="text-center" data-timestamp="1496842461">2017-06-07 13:34</td>
<td class="text-center" style="color: green;">6</td>
<td class="text-center" style="color: red;">1</td>
<td class="text-center">20</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929182" title="[Itsuwari] Suki ni Naru Kono Shunkan wo - Saat-Saat Kau Jatuh Cinta [720p-AAC][FD0092B8].mkv">[Itsuwari] Suki ni Naru Kono Shunkan wo - Saat-Saat Kau Jatuh Cinta [720p-AAC][FD0092B8].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929182.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:KW7XIN6NP65MLDJFM3C3TL5MGAM34UVG&amp;dn=%5BItsuwari%5D+Suki+ni+Naru+Kono+Shunkan+wo+-+Saat-Saat+Kau+Jatuh+Cinta+%5B720p-AAC%5D%5BFD0092B8%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">489.9 MiB</td>
<td class="text-center" data-timestamp="1496840627">2017-06-07 13:03</td>
<td class="text-center" style="color: green;">3</td>
<td class="text-center" style="color: red;">4</td>
<td class="text-center">8</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929181" title="[AnimeRG] The Moment You Fall In Love -  [1280X720] [English Sub] [Web-DL] [Pseudo-ReleaseBitch].mkv">[AnimeRG] The Moment You Fall In Love - [1280X720] [English Sub] [Web-DL] [Pseudo-ReleaseBitch].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929181.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:5T4SK5ZPGTQCTZS2ZGAZL7OBH2UUYDUB&amp;dn=%5BAnimeRG%5D+The+Moment+You+Fall+In+Love+-++%5B1280X720%5D+%5BEnglish+Sub%5D+%5BWeb-DL%5D+%5BPseudo-ReleaseBitch%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">907.0 MiB</td>
<td class="text-center" data-timestamp="1496840080">2017-06-07 12:54</td>
<td class="text-center" style="color: green;">11</td>
<td class="text-center" style="color: red;">7</td>
<td class="text-center">43</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929180" title="[PuyaSubs!] Shingeki no Bahamut - Virgin Soul - 09 [720p][33276A5A].mkv">[PuyaSubs!] Shingeki no Bahamut - Virgin Soul - 09 [720p][33276A5A].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929180.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:SMF4ET3DAWL6JPPLRVQ75WKBGCWQ3SMF&amp;dn=%5BPuyaSubs%21%5D+Shingeki+no+Bahamut+-+Virgin+Soul+-+09+%5B720p%5D%5B33276A5A%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">335.1 MiB</td>
<td class="text-center" data-timestamp="1496839734">2017-06-07 12:48</td>
<td class="text-center" style="color: green;">74</td>
<td class="text-center" style="color: red;">19</td>
<td class="text-center">128</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929179" title="[Leopard-Raws] Shuumatsu Nani Shitemasuka？ Isogashii Desuka？ Sukutte Moratte Ii Desuka？ - 09 RAW (ATX 1280x720 x264 AAC).mp4">[Leopard-Raws] Shuumatsu Nani Shitemasuka？ Isogashii Desuka？ Sukutte Moratte Ii Desuka？ - 09 RAW (ATX 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929179.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:26PGUJAS6BWNTH3LSIXYBCQYYICPS46N&amp;dn=%5BLeopard-Raws%5D+Shuumatsu+Nani+Shitemasuka%EF%BC%9F+Isogashii+Desuka%EF%BC%9F+Sukutte+Moratte+Ii+Desuka%EF%BC%9F+-+09+RAW+%28ATX+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">333.7 MiB</td>
<td class="text-center" data-timestamp="1496839456">2017-06-07 12:44</td>
<td class="text-center" style="color: green;">370</td>
<td class="text-center" style="color: red;">65</td>
<td class="text-center">2359</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=2_1" title="Audio - Lossless">
<img src="/static/img/icons/nyaa/2_1.png" alt="Audio - Lossless">
</a>
</td>
<td colspan="2">
<a href="/view/929178" title="[170607] TVアニメ「サクラダリセット」OP&amp;ED2テーマ「Reset／Colors of Happiness」／牧野由依 [通常盤] [FLAC+CUE+BK]">[170607] TVアニメ「サクラダリセット」OP&amp;ED2テーマ「Reset／Colors of Happiness」／牧野由依 [通常盤] [FLAC+CUE+BK]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929178.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:IPAROB3JMAJIUTNXBEH2TG23HLKQR72S&amp;dn=%5B170607%5D+TV%E3%82%A2%E3%83%8B%E3%83%A1%E3%80%8C%E3%82%B5%E3%82%AF%E3%83%A9%E3%83%80%E3%83%AA%E3%82%BB%E3%83%83%E3%83%88%E3%80%8DOP%26ED2%E3%83%86%E3%83%BC%E3%83%9E%E3%80%8CReset%EF%BC%8FColors+of+Happiness%E3%80%8D%EF%BC%8F%E7%89%A7%E9%87%8E%E7%94%B1%E4%BE%9D+%5B%E9%80%9A%E5%B8%B8%E7%9B%A4%5D+%5BFLAC%2BCUE%2BBK%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">439.3 MiB</td>
<td class="text-center" data-timestamp="1496839322">2017-06-07 12:42</td>
<td class="text-center" style="color: green;">211</td>
<td class="text-center" style="color: red;">126</td>
<td class="text-center">177</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=2_1" title="Audio - Lossless">
<img src="/static/img/icons/nyaa/2_1.png" alt="Audio - Lossless">
</a>
</td>
<td colspan="2">
<a href="/view/929177#comments" class="comments" title="1 comment">
<i class="fa fa-comments-o"></i>1</a>
<a href="/view/929177" title="[170607] TVアニメ「サクラクエスト」EDテーマ「Freesia」／(K)NoW_NAME [FLAC+CUE+BK]">[170607] TVアニメ「サクラクエスト」EDテーマ「Freesia」／(K)NoW_NAME [FLAC+CUE+BK]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929177.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:IJ2MSUDI2PG2ZXKE7OMMQGVQ52HHSATE&amp;dn=%5B170607%5D+TV%E3%82%A2%E3%83%8B%E3%83%A1%E3%80%8C%E3%82%B5%E3%82%AF%E3%83%A9%E3%82%AF%E3%82%A8%E3%82%B9%E3%83%88%E3%80%8DED%E3%83%86%E3%83%BC%E3%83%9E%E3%80%8CFreesia%E3%80%8D%EF%BC%8F%28K%29NoW_NAME+%5BFLAC%2BCUE%2BBK%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">727.8 MiB</td>
<td class="text-center" data-timestamp="1496839295">2017-06-07 12:41</td>
<td class="text-center" style="color: green;">224</td>
<td class="text-center" style="color: red;">185</td>
<td class="text-center">189</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=2_1" title="Audio - Lossless">
<img src="/static/img/icons/nyaa/2_1.png" alt="Audio - Lossless">
</a>
</td>
<td colspan="2">
<a href="/view/929176" title="[170607] TVアニメ「サクラクエスト」OPテーマ「Morning Glory」／(K)NoW_NAME [FLAC+CUE+BK]">[170607] TVアニメ「サクラクエスト」OPテーマ「Morning Glory」／(K)NoW_NAME [FLAC+CUE+BK]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929176.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:7HDW5B3U4MDPL4AO7FKMVQYDNW6INROA&amp;dn=%5B170607%5D+TV%E3%82%A2%E3%83%8B%E3%83%A1%E3%80%8C%E3%82%B5%E3%82%AF%E3%83%A9%E3%82%AF%E3%82%A8%E3%82%B9%E3%83%88%E3%80%8DOP%E3%83%86%E3%83%BC%E3%83%9E%E3%80%8CMorning+Glory%E3%80%8D%EF%BC%8F%28K%29NoW_NAME+%5BFLAC%2BCUE%2BBK%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">717.0 MiB</td>
<td class="text-center" data-timestamp="1496839266">2017-06-07 12:41</td>
<td class="text-center" style="color: green;">214</td>
<td class="text-center" style="color: red;">143</td>
<td class="text-center">190</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929175" title="[YokoAnime] Boku no Hero Academia [720p]">[YokoAnime] Boku no Hero Academia [720p]</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929175.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:GK34T26WG4Z47HUG74WMVE6OBM3QLLRA&amp;dn=%5BYokoAnime%5D+Boku+no+Hero+Academia+%5B720p%5D&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">2.1 GiB</td>
<td class="text-center" data-timestamp="1496838996">2017-06-07 12:36</td>
<td class="text-center" style="color: green;">4</td>
<td class="text-center" style="color: red;">4</td>
<td class="text-center">5</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_2" title="Anime - English-translated">
<img src="/static/img/icons/nyaa/1_2.png" alt="Anime - English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929174" title="[AnimeRG] Boruto -  Naruto Next Generations - 10 [1280X720] [English Sub] [Web-DL] [Pseudo-ReleaseBitch].mkv">[AnimeRG] Boruto - Naruto Next Generations - 10 [1280X720] [English Sub] [Web-DL] [Pseudo-ReleaseBitch].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929174.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:H6R7S5M2LMK5OGVUZNYG2MIPQV4L6NPI&amp;dn=%5BAnimeRG%5D+Boruto+-++Naruto+Next+Generations+-+10+%5B1280X720%5D+%5BEnglish+Sub%5D+%5BWeb-DL%5D+%5BPseudo-ReleaseBitch%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">447.0 MiB</td>
<td class="text-center" data-timestamp="1496838296">2017-06-07 12:24</td>
<td class="text-center" style="color: green;">9</td>
<td class="text-center" style="color: red;">1</td>
<td class="text-center">34</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=2_1" title="Audio - Lossless">
<img src="/static/img/icons/nyaa/2_1.png" alt="Audio - Lossless">
</a>
</td>
<td colspan="2">
<a href="/view/929173" title="家売るオンナ オリジナル・サウンドトラック">家売るオンナ オリジナル・サウンドトラック</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929173.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:HEGZ7EJIFNRIBMDHMQ22CSDRQYPQCLI5&amp;dn=%E5%AE%B6%E5%A3%B2%E3%82%8B%E3%82%AA%E3%83%B3%E3%83%8A+%E3%82%AA%E3%83%AA%E3%82%B7%E3%82%99%E3%83%8A%E3%83%AB%E3%83%BB%E3%82%B5%E3%82%A6%E3%83%B3%E3%83%88%E3%82%99%E3%83%88%E3%83%A9%E3%83%83%E3%82%AF&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">399.9 MiB</td>
<td class="text-center" data-timestamp="1496835737">2017-06-07 11:42</td>
<td class="text-center" style="color: green;">11</td>
<td class="text-center" style="color: red;">13</td>
<td class="text-center">25</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929172#comments" class="comments" title="1 comment">
<i class="fa fa-comments-o"></i>1</a>
<a href="/view/929172" title="[모에-Raws] Yu-Gi-Oh! VRAINS #05 (TVh 1280x720 x264 AAC).mp4">[모에-Raws] Yu-Gi-Oh! VRAINS #05 (TVh 1280x720 x264 AAC).mp4</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929172.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:TL6JXZJGGI72ZCXVCR2EJJHUKPF7S7KK&amp;dn=%5B%EB%AA%A8%EC%97%90-Raws%5D+Yu-Gi-Oh%21+VRAINS+%2305+%28TVh+1280x720+x264+AAC%29.mp4&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">867.7 MiB</td>
<td class="text-center" data-timestamp="1496835483">2017-06-07 11:38</td>
<td class="text-center" style="color: green;">66</td>
<td class="text-center" style="color: red;">12</td>
<td class="text-center">317</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929171" title="[PuyaSubs!] Boruto - Naruto Next Generations - 10 [1080p][B968B81A].mkv">[PuyaSubs!] Boruto - Naruto Next Generations - 10 [1080p][B968B81A].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929171.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:XCKGHU4JJH7FGANHMVUOCGGHBX5KWC5O&amp;dn=%5BPuyaSubs%21%5D+Boruto+-+Naruto+Next+Generations+-+10+%5B1080p%5D%5BB968B81A%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">545.8 MiB</td>
<td class="text-center" data-timestamp="1496835337">2017-06-07 11:35</td>
<td class="text-center" style="color: green;">68</td>
<td class="text-center" style="color: red;">12</td>
<td class="text-center">130</td>
</tr>
<tr class="success">
<td style="padding:0 4px;">
<a href="/?c=1_3" title="Anime - Non-English-translated">
<img src="/static/img/icons/nyaa/1_3.png" alt="Anime - Non-English-translated">
</a>
</td>
<td colspan="2">
<a href="/view/929170" title="[PuyaSubs!] Boruto - Naruto Next Generations - 10 [720p][F52D0EC6].mkv">[PuyaSubs!] Boruto - Naruto Next Generations - 10 [720p][F52D0EC6].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929170.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:EHX42NM4AXMSSV4BJCIQISRG7VBLA3G3&amp;dn=%5BPuyaSubs%21%5D+Boruto+-+Naruto+Next+Generations+-+10+%5B720p%5D%5BF52D0EC6%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">326.1 MiB</td>
<td class="text-center" data-timestamp="1496835324">2017-06-07 11:35</td>
<td class="text-center" style="color: green;">60</td>
<td class="text-center" style="color: red;">20</td>
<td class="text-center">129</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929169#comments" class="comments" title="1 comment">
<i class="fa fa-comments-o"></i>1</a>
<a href="/view/929169" title="[Erai-raws] Danmachi Sword Oratoria - 04 [720p AVC-YUV444P10 Opus][699F4F04].mkv">[Erai-raws] Danmachi Sword Oratoria - 04 [720p AVC-YUV444P10 Opus][699F4F04].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929169.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:QBSZAWOH7AJALJRWSAC5UVTRNSHLEGM2&amp;dn=%5BErai-raws%5D+Danmachi+Sword+Oratoria+-+04+%5B720p+AVC-YUV444P10+Opus%5D%5B699F4F04%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">368.6 MiB</td>
<td class="text-center" data-timestamp="1496835248">2017-06-07 11:34</td>
<td class="text-center" style="color: green;">8</td>
<td class="text-center" style="color: red;">2</td>
<td class="text-center">15</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929168" title="[Erai-raws] Danmachi Sword Oratoria - 03 [720p AVC-YUV444P10 Opus][E0F61FD1].mkv">[Erai-raws] Danmachi Sword Oratoria - 03 [720p AVC-YUV444P10 Opus][E0F61FD1].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929168.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:HHXOGPH4IZCLPV22AMCG7XRVDXCWB5JM&amp;dn=%5BErai-raws%5D+Danmachi+Sword+Oratoria+-+03+%5B720p+AVC-YUV444P10+Opus%5D%5BE0F61FD1%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">365.0 MiB</td>
<td class="text-center" data-timestamp="1496835230">2017-06-07 11:33</td>
<td class="text-center" style="color: green;">5</td>
<td class="text-center" style="color: red;">2</td>
<td class="text-center">7</td>
</tr>
<tr class="default">
<td style="padding:0 4px;">
<a href="/?c=1_4" title="Anime - Raw">
<img src="/static/img/icons/nyaa/1_4.png" alt="Anime - Raw">
</a>
</td>
<td colspan="2">
<a href="/view/929167" title="[Erai-raws] Danmachi Sword Oratoria - 02 [720p AVC-YUV444P10 Opus][E51A3A81].mkv">[Erai-raws] Danmachi Sword Oratoria - 02 [720p AVC-YUV444P10 Opus][E51A3A81].mkv</a>
</td>
<td class="text-center" style="white-space: nowrap;">
<a href="/download/929167.torrent"><i class="fa fa-fw fa-download"></i></a> <a href="magnet:?xt=urn:btih:VLINGYIQIDMLO4MUEZI6AEOZGC6GF22P&amp;dn=%5BErai-raws%5D+Danmachi+Sword+Oratoria+-+02+%5B720p+AVC-YUV444P10+Opus%5D%5BE51A3A81%5D.mkv&amp;tr=http%3A%2F%2Fnyaa.tracker.wf%3A7777%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969%2Fannounce&amp;tr=udp%3A%2F%2Ftracker.doko.moe%3A6969&amp;tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce"><i class="fa fa-fw fa-magnet"></i></a>
</td>
<td class="text-center">369.2 MiB</td>
<td class="text-center" data-timestamp="1496835220">2017-06-07 11:33</td>
<td class="text-center" style="color: green;">6</td>
<td class="text-center" style="color: red;">2</td>
<td class="text-center">9</td>
</tr>
</tbody>
</table>
</div>
<div class="center">
<nav>
<ul class="pagination">
<li class="disabled"><a href="#">&laquo;</a></li> <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
<li><a href="/?p=2">2</a></li>
<li><a href="/?p=3">3</a></li>
<li><a href="/?p=4">4</a></li>
<li><a href="/?p=5">5</a></li>
<li><a href="/?p=6">6</a></li>
<li><a href="/?p=2">&raquo;</a></li></ul>
</nav>
</div>
</div>  
<footer style="text-align: center;">
<p>Dark Mode: <a href="#" id="themeToggle">Toggle</a></p>
<p>Commit: <a href="https://github.com/nyaadevs/nyaa/tree/80fecd5496e580b84c017f4094c2c8a56b737149">80fecd5</a></p>
</footer>
</body>
</html>