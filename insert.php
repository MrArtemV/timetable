<?php
	session_start();
	include 'header.php';
	require_once 'db_connect.php';
	require_once 'query.php';
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php';
	if ($_SESSION['user'] == NULL) {
		header("Location: http://$host$uri/$extra");
	}
	elseif ($_REQUEST['subject'] == NULL) {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");				
	}
	elseif ($_REQUEST['subject'] != NULL) {?>
			<main class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="main round pad_b_10">
						<?php
							insert($_REQUEST, $pdo);
						?>
						</div>
					</div>
				</div>
			</main>
		<?php
	}
	include 'footer.php';
?>