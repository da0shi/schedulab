<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
</head>
<body>
	<h1>User Register</h1>
	<p>
<div class="errors">
<?php if (isset($duplicate)) echo $duplicate; ?>
<?php if (isset($shortpass)) echo $shortpass; ?>
</div>
		<form action="" method="post">
			<label for="name">username:</label>
			<input type="text" name="name" id="name" />
			</br>
			<label for="email">email:</label>
			<input type="text" name="email" id="email" />
			</br>
			<label for="password">password:</label>
			<input type="password" name="password" id ="password" />
			</br>
			<input type="submit" value="登録" />
		</form>
	</p>
</body>
</html>
