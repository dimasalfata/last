<?php $user = $this->session->userdata(); ?>

<table class="table table-sm table-borderless">
	<tr>
		<td>Pegawai</td>
		<td>:</td>
		<th><?= $user['nama'] ?></th>
	</tr>

	<tr>
		<td>Cabang</td>
		<td>:</td>
		<th><?= $user['nama_cabang'] ?></th>
	</tr>
</table>

<hr>

<form id="form-posting">

	<?php if($type === "edit") :  ?>
		<input type="hidden" name="id" value="<?= $posting->id ?>" required readonly>
	<?php endif ?>
	
	<div class="row">
		<div class="col-12 col-md-6 mb-3">
			<label for="kode-sosmed">
				SOSMED
				<i class="text-danger">*</i>
			</label>

			<select name="kode_sosmed" id="kode-sosmed" class="custom-select" required>
				<option value="">[Pilih SOSMED]</option>
				<?php foreach($sosmeds as $sosmed) : ?>
					<option
						value="<?= $sosmed->kode ?>"
						<?php
							if($type === "edit") {
								if($sosmed->kode === $posting->kode_sosmed) {
									echo "selected";
								}
							}
						?>
					>
						<?= $sosmed->nama ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="col-12 col-md-6 mb-3">
			<label for="tgl-posting">
				Tgl Posting
				<i class="text-danger">*</i>
			</label>

			<input
				type="date"
				name="tgl_posting" id="tgl-posting"
				class="form-control"
				required

				<?php if($type === "edit") : ?>
					value="<?= $posting->tgl_posting ?>"
				<?php endif ?>
			>
		</div>

		<div class="col-12 mb-3">
			<label for="link-posting">
				Link Posting
				<i class="text-danger">*</i>
			</label>

			<input
				type="url"
				name="link" id="link-posting"
				class="form-control"
				placeholder="ex: https://google.com"
				required
				<?php if($type === "edit") : ?>
					value="<?= $posting->link ?>"
				<?php endif ?>
			>
		</div>
	</div>
</form>
