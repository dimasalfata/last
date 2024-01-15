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
		DATA POSTING SOSIAL MEDIA
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

<table border="1" cellspacing="0" cellpadding="10px" width="100%">
	<thead>
		<tr>
			<th align="right">No</th>
			<th>Pegawai</th> 
			<th>Cabang</th> 
			<th>Tgl Posting</th> 
			<th>Sosmed</th> 
			<th>Link</th> 
            <!--
			Disable kolom laporan approvel
			<th>Approver</th> 
			<th>Approval</th> 
    -->
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($laporan)) : ?>
			<?php $no = 0; foreach($laporan as $laporans) : $no++ ?>
				<tr>
					<td align="right"><?= $no ?></td>
					<td align="center"><?php echo $laporans->user;  ?></td>
					<td align="center">
						[<?php echo $laporans->id_cabang;  ?>]
						<?php echo $laporans->cabang;  ?>
					</td>
					<td align="center"><?php echo date('d/m/Y', strtotime($laporans->tgl_posting));  ?></td>
					<td align="center"><?php echo $laporans->sosmed;  ?></td>
					<td align="center"><?php echo $laporans->link;  ?></td>
                    <!--
					Disable kolom laporan approvel
					<td align="center"><?php echo $laporans->approval_user;  ?></td>
					<td align="center"><?php echo $laporans->approval;  ?></td>
        -->
				</tr>
			<?php endforeach ?>
		<?php else : ?>
			<tr>
				<td align="center" colspan="6">
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
