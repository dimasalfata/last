<form id="form-sosmed">

	<?php if($type === "edit") :  ?>
		<input type="hidden" name="id" value="<?= $sosmed->id ?>" required readonly>
	<?php endif ?>
	
	<div class="row row-cols-1 row-cols-md-2">
		<div class="col">
			<label for="kode">
				Kode Sosmed
				<i class="text-danger">*</i>
			</label>

			<input
				type="text"
				name="kode" id="kode"
				class="form-control"
				minlength="2" maxlength="30"
				placeholder="IG, FB, TWITTER"
				required

				<?php if($type === "edit") : ?>
					value="<?= $sosmed->kode ?>"
				<?php endif ?>
			>

			<small class="text-danger">
				Pastikan Kode Bersifat Unik!
			</small>
		</div>

		<div class="col">
			<label for="nama">
				Nama Sosmed
				<i class="text-danger">*</i>
			</label>

			<input
				type="text"
				name="nama" id="nama"
				class="form-control"
				minlength="2" maxlength="255"
				placeholder="Instagram, Facebook"
				required

				<?php if($type === "edit") : ?>
					value="<?= $sosmed->nama ?>"
				<?php endif ?>
			>
		</div>
	</div>
</form>
