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

	<?php if($marketing != "All") : ?>
		<p>
			Marketing : <?= $pejabat ?>
		</p>
	<?php endif ?>
</div>

<?php
	$total_column = 12;
	if(($level == "Admin") || ($level == "PIC")) {
		$total_column = 13;
	}
?>

<table width="100%" border="1" cellspacing="0" cellpadding="10px">
	<thead>
		<tr>
			<th align="right">No</th>
			<th>Tanggal</th>
			<?php if(($level == "Admin") || ($level == "PIC")) : ?>
				<th align="center">Rekening</th>
			<?php endif ?>
			<th>Nasabah</th> 
			<th align="right">Plafon</th> 
			<th align="center">Tanggal Realisasi</th> 
			<th>Alamat</th> 
			<th>Marketing</th> 
			<th>Approver</th> 
			<th>Approval</th> 
			<th>Hasil Kunjungan</th> 
			<th align="center">Status</th> 
			<th align="center">Lampiran</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($laporan)) : ?>
			<?php $no = 0; foreach($laporan as $laporans) : $no++ ?>
				<tr>
					<td align="right"><?= $no ?></td>
					<td ><?php echo $laporans->tanggal_kunjungan;  ?></td>
					<?php if(($level == "Admin") || ($level == "PIC")) : ?>
						<td align="center"><?= $laporans->no_rekening ?></td>
					<?php endif ?>
					<td ><?php echo $laporans->nama_nasabah;  ?></td>
					<td align="right"><?php echo number_format($laporans->plafon,0,",","."); ?></td>
					<td align="center"><?php echo $laporans->tgl_realisasi;  ?></td>
					<td ><?php echo $laporans->alamat_nasabah;  ?></td>
					<td ><?php echo $laporans->marketing;  ?></td>
					<td ><?php echo $laporans->approver;  ?></td>
					<td ><?php echo $laporans->approval;  ?></td>
					<td ><?php echo $laporans->hasil_kunjungan;  ?></td>
					<td align="center"><?php echo $laporans->status_fu;  ?></td>=
					<td align="center">
						<?php if(!empty($laporans->lampiran_kunjungan)) : ?>
							<img src="<?php echo base_url().$key->lampiran_kunjungan ?>" width="200px">
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		<?php else : ?>
			<tr>
				<td align="center" colspan="<?= $total_column ?>">
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