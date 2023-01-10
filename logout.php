<?php
session_start();
ob_start();
session_destroy();
?>
	<script type="text/javascript">
		setTimeout(function(){   
        window.location.assign("index.php");
        });</script>

	<?php 
?>