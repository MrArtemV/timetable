<?php
	require_once 'query.php';
	if ($_SESSION['user'] != NULL) {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
	}
	else {
		$mes = login($pdo, $_REQUEST['login'], $_REQUEST['password']);
	}
	include 'header.php';
?>

<main>
	<div class="row">
		<div class="col-lg-5" style="margin: 0 auto;">
			<div class="login">
				<h1 class="display-4 text-center">Авторизация</h1>
				<form action="login.php">
		    		<div class="form-group row">
		      			<label for="login" class="col-3 col-form-label">Логин</label>
		      			<div class="col-9">
		        			<input type="text" class="form-control" id="login" name="login">
		      			</div>
		    		</div>
		    		<div class="form-group row">
		      			<label for="password" class="col-3 col-form-label">Пароль</label>
		      			<div class="col-9">
		       				<input type="password" class="form-control" id="password" name="password">
		      			</div>
		    		</div>
		    		<input type="hidden" name="type" value="login">
		    		<div class="form-group row">
		      			<div class="offset-3 col-9">
		        		<button type="submit" class="btn btn-primary">Отправить</button>
		        		<p class="point_desc danger"><?=$mes?></p>
		     		</div>
		    		</div>
				</form>
			</div>
		</div>
	</div>
	
</main>
<?php include 'footer.php'; ?>