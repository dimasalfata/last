<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
</head>
<body>
<div style="text-align: center;">
	<h4>
		PT. BPR BKK KARANGMALANG (PERSERODA)
	</h4>
	<h4>
		LAPORAN KUNJUNGAN NASABAH
	</h4>

	<p>
		Periode 
		<span>&nbsp;&nbsp;:&nbsp;<?php $tanggal=explode('-', $tanggal_awal);
		$bulan = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		);
		echo $tanggal[2]." ".$bulan[$tanggal[1]]." ".$tanggal[0]
		?></span><span style="text-align: right;">&nbsp;&nbsp;s/d&nbsp;&nbsp;</span><span>&nbsp;<?php $tgl=explode('-', $tanggal_akhir);

		echo $tgl[2]." ".$bulan[$tgl[1]]." ".$tgl[0]
		?></span>
	</p>
</div>

<table width="100%" border="1" cellspacing="0" cellpadding="10px">
	<thead>
		<tr>
			<th align="right">No</th>
			<th align="left">Marketing</th>
			<th align="left">Cabang</th>
			<th align="right">L</th>
			<th align="right">DP</th>
			<th align="right">KL</th>
			<th align="right">D</th>
			<th align="right">M</th>
			<th align="right">PH</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($laporan)) : ?>
			<?php $no = 0; foreach($laporan as $laporans) : $no++ ?>
				<tr>
					<td align="right"><?= $no ?></td>
					<td align="left"><?php echo $laporans->nama_marketing;  ?></td>
					<td align="left"><?php echo $laporans->nama_cabang;  ?></td>
					<td align="right"><?= $laporans->L ?></td>
					<td align="right"><?= $laporans->DP ?></td>
					<td align="right"><?= $laporans->KL ?></td>
					<td align="right"><?= $laporans->D ?></td>
					<td align="right"><?= $laporans->M ?></td>
					<td align="right"><?= $laporans->PH ?></td>
				</tr>
			<?php endforeach ?>
		<?php else : ?>
			<tr>
				<td align="center" colspan="9">
					<i style="color: red;">Data Tidak Ditemukan</i>
				</td>
			</tr>
		<?php endif ?>
			
	</tbody>
</table>

	<?php if(!empty($pejabat)) : ?>
		<br>
		<br>
		<br>
		<div
			style="
	    		left: 0;
	    		right: 0;
	    		width: 70mm;
				margin: auto;
			"
		>
			<table>
				<thead>
					<tr>
						<th
							style="border: 1px solid black; width: 250px;"
							align="center"
						>
							<?= $jabatan ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td
							style="border: 1px solid black; height: 200px !important; width: 250px; padding: 50px;"
							align="center"
						></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th
							style="border: 1px solid black; width: 250px;"
							align="center"
						>
							<?= $pejabat ?>
						</th>
					</tr>
				</tfoot>
			</table>
		</div>
	<?php endif ?>

</body>
</html>