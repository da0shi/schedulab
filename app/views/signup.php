<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
</head>
<body>
<div class="container">
	<h1>User Register</h1>
	<p>
<div class="errors">
<?php echo $flash['emptyval']; ?>
</div>
		<form action="" method="post">
<section>
			<label for="name">username:</label>
			<input type="text" name="name" id="name" required />
</section>
<section>
			<label for="email">email:</label>
			<input type="email" name="email" id="email" required />
			<?php echo $flash['duplicate']; ?>
</section>
<section>
			<label for="password">password:</label>
			<input type="password" name="password" id ="password" required />
			<?php echo $flash['shortpass']; ?>
</section>
			<input type="submit" value="登録" />
		</form>
	</p>
</div><!-- .container -->
</body>
</html>
