<?php

require_once('models/Zoo.php');

session_start();

if(!isset($_SESSION['zoo']) || !empty($_POST['new'])) {
	$_SESSION['zoo'] = $zoo = new Zoo();
} else {
	$zoo = $_SESSION['zoo'];

	if(!empty($_POST['feed'])) {
		$zoo->feed();
	} else 	if(!empty($_POST['tick'])) {
		$zoo->nextHour();
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sim Zoo</title>
</head>
<body>

	<div class="container">
		<div>
			<?php echo $zoo->getHour(); ?> hour
		</div>

		<table class="table table-condensed table-hover">

			<thead>
				<th>Animal</th>
				<th>Name</th>
				<th>Health</th>
				<th>Status</th>
			</thead>

			<tbody>
				<?php foreach($zoo->getAnimals() as $animal): ?>
					<tr class="<?php echo $animal->getState() == Animal::ALIVE ? 'active' : ($animal->getState() == Animal::IMMOBILE?'warning':'danger') ?>">
						<td>
							<?php echo $animal->getType(); ?>
						</td>
						<td>
							<?php echo $animal->getName(); ?>
						</td>
						<td>
							<?php echo number_format($animal->getHP(), 2); ?>%
						</td>
						<td>
							<?php echo $animal->getState() ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>

		</table>

		<form method="post">
			<input type="submit" value="Feed" name="feed">
			<input type="submit" value="Next Hour" name="tick">
			<input type="submit" value="new Zoo" name="new">
		</form>
	</div>
	<link rel="stylesheet" type="text/css" href="bower_components/bootstrap-css/css/bootstrap.min.css" ></style>
</body>
</html>