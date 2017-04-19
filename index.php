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
		<table class="table table-condensed table-hover">
			<caption>
				Time: <?php echo $zoo->getHour(); ?> hour
			</caption>
			<thead>
				<th>Animal</th>
				<th>Name</th>
				<th>Health</th>
				<th>Status</th>
			</thead>

			<tbody>
				<?php foreach($zoo->getAnimals() as $animal): ?>
					<tr class="<?php echo $animal->getState() == Animal::ALIVE ? 'active' : ($animal->getState() == Elephant::IMMOBILE?'warning':'danger') ?>">
						<td>
							<?php echo $animal->getType(); ?>
						</td>
						<td>
							<?php echo $animal->getName(); ?>
						</td>
						<td >
							<div class="pull-right">
							<?php echo number_format($animal->getHP(), 2); ?> %
							</div>
						</td>
						<td>
							<?php echo $animal->getState() ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>

		</table>

		<form method="post">
			<input class="btn" type="submit" value="Feed" name="feed">
			<input class="btn"  type="submit" value="Next Hour" name="tick">
			<input class="btn pull-right"  type="submit" value="new Zoo" name="new">
		</form>
	</div>
	<link rel="stylesheet" type="text/css" href="bower_components/bootstrap-css/css/bootstrap.min.css" ></style>
</body>
</html>