<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
</head>
<body>
	<h1>Create New Schedule</h1>
	<p>
<div class="errors">
<?php echo $flash['emptytitle']; ?>
<?php echo $flash['emptydate']; ?>
<?php echo $flash['invalid']; ?>
</div>
		<form action="" method="post">
			<label for="title">title:</label>
			<input type="text" name="title" id="title" />
			</br>
			<label for="start">start:</label>
			<input type="date" name="start-date" id="start" />
			<input type="time" name="start-time" id="start-time" />
			</br>
			<label for="end">end:</label>
			<input type="date" name="end-date" id ="end" />
			<input type="time" name="end-time" id ="end-time" />
			</br>
			<input type="checkbox" name="allday" />終日
			</br>
			<label for="detail">detail:</label>
			</br>
			<textarea name="detail" id="detail" cols="40" rows="4" placeholder="予定の詳細" maxlength="300"></textarea>
			<input type="submit" value="作成" />
		</form>
	</p>
</body>
</html>
