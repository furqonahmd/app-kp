<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Siswa</title>
</head>
<body>
	<table>
		<tr>
			<td width="75">
				<img src="data:image/png;base64, <?= base64_encode(file_get_contents(base_url('images/logo.png'))) ?>" alt="" width="50" height="50">
			</td>
			<td width="85%">
				<h3 style="text-align: center;">SMP N 1 KARANG TENGAH</h3>
				<!-- <p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos esse totam, officiis culpa voluptatibus iste.</p> -->
			</td>
		</tr>
	</table>
	<br>
	<hr>
	<table>
		<tr>
			<td width="70%">
				<table>
					<tr>
						<th width="80px">&nbsp;&nbsp;&nbsp;Wali Kelas</th>
						<td width="10px">:</td>
						<td><?= $data->nama ?></td>
					</tr>
					<tr>
						<th width="80px">&nbsp;&nbsp;&nbsp;NIP</th>
						<td width="10px">:</td>
						<td><?= $data->nip ?></td>
					</tr>
				</table>
			</td>
			<td width="30%">
				<table>
					<tr>
						<th width="80px">&nbsp;&nbsp;&nbsp;Kelas</th>
						<td width="10px">:</td>
						<td><?= $data->kelas->kelas ?></td>
					</tr>
					<tr>
						<th width="80px">&nbsp;&nbsp;&nbsp;Ruang</th>
						<td width="10px">:</td>
						<td><?= $data->ruang->ruang ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<hr>
	<p></p>
	<table style="font-size: 10px;" border="1">
		<tr>
			<th width="20">#</th>
			<th width="50">NISN</th>
			<th width="110">NAMA</th>
			<th width="50">TBG</th>
			<th width="70">HUT+PPSHN</th>
			<th width="50">OSIS</th>
			<th width="80">PRPS+KMPT</th>
			<?php if ($data->kelas->kelas == 9): ?>
			<th width="50">SPI(9)</th>
			<?php else : ?>
			<th width="50">SPI(7&8)</th>
			<?php endif ?>
			<th width="60">PLKPLLS</th>
		</tr>
		<?php 
			$no = 1;
			foreach ($data->siswas as $siswa):
		?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $siswa->nisn ?></td>
			<td><?= $siswa->nama ?></td>
			<?php foreach ($siswa->status as $s): ?>
			<td style="text-align: right;"><?= $s->status ? number_format($s->iuran->jumlah, 0,',','.') : '-' ?></td>
			<?php endforeach ?>
		</tr>
		<?php endforeach ?>
	</table>
</body>
</html>