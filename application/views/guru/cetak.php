<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Siswa :: <?= $siswa->nama ?></title>
</head>
<body>
	<h1 style="text-align: center;">SMP N 1 KARANG TENGAH</h1>
	<hr>
	<table>
		<tr>
			<th width="100px">Nama</th>
			<td width="10px">:</td>
			<td><?= ucwords($siswa->nama) ?></td>
		</tr>
		<tr>
			<th>Kelas</th>
			<td>:</td>
			<td><?= $siswa->kelas->kelas ?></td>
		</tr>
		<tr>
			<th>Ruang</th>
			<td>:</td>
			<td><?= $siswa->ruang->ruang ?></td>
		</tr>
	</table>
	<hr>
</body>
</html>