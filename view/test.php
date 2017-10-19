<form method="post">
	<input type="text" name='username'>
	<button>add</button>
</form>
<a href="?reset=1">reset id</a>
<body>
	<h1>POGI KO</h1>
	<?php foreach ($user_data as $user): ?>
		<div class="">
			<div class="id"><?=$user->user_id?></div>
			<?=$user->username ?>
			<a href="?delete=<?=$user->user_id?>">
			delete
				
			</a></div>
	<?php endforeach; ?>
