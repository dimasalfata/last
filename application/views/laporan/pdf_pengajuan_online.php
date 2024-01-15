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
		DATA PENGAJUAN NASABAH VIA  DIGITAL MARKETING
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

<table border="1" cellspacing="0" cellpadding="10px">
	<thead>
		<tr>
			<th align="right">No</th>
			<th>Tanggal Pengajuan</th> 
			<th>Nama Lengkap</th> 
			<th align="right">NIK</th> 
			<th align="right">Nomor HP</th> 
			<th>Alamat</th>
			<th>Usaha</th>
			<th align="right">Plafond</th>  
			<th>No Ref.</th>
			<th>ID Pegawai</th>
			<th>Pegawai</th>
			<th>Jabatan</th>
			<th>Tanggal</th>
			<th>Status</th> 
			<th>Hasil</th> 
			<th>Lampiran</th>
			<th>Cabang</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($laporan)) : ?>
			<?php $no = 1; foreach($laporan as $laporans) : ?>
				<tr>
					<td align="right"><?= $no++ ?></td>
					<td><?php echo date_format(date_create($laporans->tanggal_input),'d-m-Y'); ?></td>
					<td><?php echo $laporans->nama;  ?></td>
					<td align="right"><?php echo $laporans->nik;  ?></td>
					<td align="right"><?php echo $laporans->no_hp;  ?></td>
					<td><?php echo $laporans->alamat_rumah;  ?></td>
					<td><?php echo $laporans->nama_usaha_pekerjaan;  ?></td>
					<td align="right"><?php echo number_format($laporans->besar_plafon,0,",","."); ?></td>
					
					<td><?php echo $laporans->id_user ?></td>
					<td>
						<?php echo $laporans->nama_marketing ?? '-';  ?>
					</td>
					<td><?php echo $laporans->nama_jabatan ?? '-';  ?></td>
					<td>
						<?php if(!empty($laporans->tanggal_input)) : ?>
							<?= date('d/m/Y', strtotime($laporans->tanggal_input)) ?>
						<?php else: ?>
							-
						<?php endif ?>
					</td>
					<td><?php echo $laporans->status != 'Nasabah Baru' ? 'Nasabah Baru' : $laporans->status ;  ?></td>
					<td>-</td>
					<td>
						<?php if(!empty($laporans->foto_usaha)) : ?>
							<img src="<?php echo base_url($laporans->foto_usaha )?>" width="200px">
						<?php else : ?>
							-
						<?php endif ?>
					</td>
					<td>[<?= $laporans->id_cabang ?>] <?php echo $laporans->nama_cabang;  ?></td>
					<td><?php echo $laporans->no_referensi;  ?></td>

				</tr>
				<?php
					$lastKeys = [];

					foreach($laporan_fu as $fukey => $fus) {
						if($fus->id_nasabah == $laporans->kode_pengajuan) {
							$lastKeys[$fukey] = $fukey;
						}
					}
				?>
				<?php foreach($laporan_fu as $fukey => $fus) : ?>

					<?php if($fus->id_nasabah == $laporans->kode_pengajuan) : ?>

						<?php

							$isLast = ($fukey == end($lastKeys));

							$status = $fus->status;
							$tgl = $fus->tanggal_fu;

							if($isLast) {
								if(in_array($laporans->status, ['Realisasi', 'Tolak'])) {
									$status = $laporans->status;
									$tgl = $laporans->tgl_realisasi ?? $fus->tanggal_fu;
								}
							}
						?>
						<tr>
							<td align="right"><?= $no++ ?></td>
							<td><?php echo date_format(date_create($laporans->tanggal_input),'d-m-Y'); ?></td>
							<td><?php echo $laporans->nama;  ?></td>
							<td align="right"><?php echo $laporans->nik;  ?></td>
							<td align="right"><?php echo $laporans->no_hp;  ?></td>
							<td><?php echo $laporans->alamat_rumah;  ?></td>
							<td><?php echo $laporans->nama_usaha_pekerjaan;  ?></td>
							<td align="right"><?php echo number_format($laporans->besar_plafon,0,",","."); ?></td>
							
							<td><?php echo $fus->id_user ?></td>
							<td>
								<?php echo $fus->user_fu ?? '-';  ?>
							</td>
							<td><?php echo $fus->nama_jabatan ?? '-';  ?></td>
							<td>
								<?php if(!empty($tgl)) : ?>
									<?= date('d/m/Y', strtotime($tgl)) ?>
								<?php else: ?>
									-
								<?php endif ?>
							</td>
							<td><?php echo $status;  ?></td>
							<td><?php echo $fus->hasil_fu;  ?></td>
							<td>
								<?php if(!empty($fus->lampiran_fu)) : ?>
									<img src="<?php echo base_url($fus->lampiran_fu )?>" width="200px">
								<?php else : ?>
									-
								<?php endif ?>
							</td>
							<td>[<?= $laporans->id_cabang ?>] <?php echo $laporans->nama_cabang;  ?></td>
							<td><?php echo $laporans->no_referensi;  ?></td>

						</tr>
					<?php endif ?>
						
				<?php endforeach ?>

			<?php endforeach ?>
		<?php else : ?>
			<tr>
				<td align="center" colspan="16">
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
				align: left;
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