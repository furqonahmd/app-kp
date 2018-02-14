<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Table</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>DATA</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $r): ?>
			<tr>
				<td><?= $r->id ?></td>
				<td><?= $r->data ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>