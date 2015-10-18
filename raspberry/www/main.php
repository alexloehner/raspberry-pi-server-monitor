<?php

$shownav = true;
if (false === isset($_GET) || false === isset($_GET['action'])) {
	include 'main.menu.php';
	$shownav = false;
}

else if (true === isset($_GET) && true === isset($_GET['action']) && "live" == trim($_GET['action'])) {
	include 'main.livemonitor.php';
}

else if (true === isset($_GET) && true === isset($_GET['action']) && "procs" == trim($_GET['action'])) {
	include 'main.procs.php';
}

else if (true === isset($_GET) && true === isset($_GET['action']) && "net" == trim($_GET['action'])) {
	include 'main.net.php';
}

else if (true === isset($_GET) && true === isset($_GET['action']) && "raspi" == trim($_GET['action'])) {
	include 'main.raspi.php';
}

else if (true === isset($_GET) && true === isset($_GET['action']) && "reboot" == trim($_GET['action'])) {
	exec('sudo reboot');
}

else if (true === isset($_GET) && true === isset($_GET['action']) && "shutdown" == trim($_GET['action'])) {
	exec('sudo shutdown -h now');
}
























?>
<div id="copyright">&copy; 2015 by Alexander L&ouml;hner, The Linux Counter Project</div>
<?php
if (true === $shownav) {
?>
<nav id="nav" class="">
	<button id="navbutton" type="button" class="navbar-toggle ui-btn ui-shadow ui-corner-all">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
</nav>
<div id="footer" class="footer">
	<a href="/"><button type="button" class="btn btn-lg btn-default">Back</button></a>
	<a id="reload1" href="#"><button id="reload2" type="button" class="btn btn-lg btn-default">Reload</button></a>
	<a href="/?action=reboot"><button type="button" class="btn btn-lg btn-default">Reboot</button></a>
	<a href="/?action=shutdown"><button type="button" class="btn btn-lg btn-default">Shutdown</button></a>
</div>
<script type="text/javascript">
$( document ).ready(function() {
  function shownav() {
    $("#nav").hide();
    $("#footer").animate({
      bottom: "1px"
    }, 500 );
  }
  $("#nav").click(function() {
    shownav();
  });
  $("#reload1").click(function() {
    var nocache = new Date().getTime();
    $.ajax({
        type: "GET",
        url: "/ajax.php?nocache="+nocache+"&action=reload",
	cache: false
    });
  });
  $("#reload2").click(function() {
    var nocache = new Date().getTime();
    $.ajax({
        type: "GET",
        url: "/ajax.php?nocache="+nocache+"&action=reload",
	cache: false
    });
  });
});
</script>
<?php
}

