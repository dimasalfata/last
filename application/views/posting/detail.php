<div class="row row-cols-1 row-cols-md-2">
    <div class="col mb-3">
        <div class="d-flex justify-content-start">
            <div class="p-1">
                <p>Nama Pegawai</p>
            </div>
            <div class="p-1">
                <p class="font-weight-bold"><?= $posting->user ?></p>
            </div>
        </div>
    </div>
    <div class="col mb-3">
        <div class="d-flex justify-content-start">
            <div class="p-1">
                <p>Sosial Media</p>
            </div>
            <div class="p-1">
                <p class="font-weight-bold"><?= $posting->sosmed ?></p>
            </div>
        </div>
    </div>

    <div class="col mb-3">
        <div class="d-flex justify-content-start">
            <div class="p-1">
                <p>Kantor Cabang</p>
            </div>
            <div class="p-1">
                <p class="font-weight-bold"><?= $posting->cabang ?></p>
            </div>
        </div>
    </div>
    <div class="col mb-3">
        <div class="d-flex justify-content-start">
            <div class="p-1">
                <p>Link Posting</p>
            </div>
            <div class="p-1">
                <a href="<?= $posting->link ?>" target="_blank" class="text-decoration-none">
                    <?= mb_strimwidth($posting->link, 0, 25, '....') ?>
                </a>
            </div>
        </div>
    </div>

    <div class="col mb-3">
        <div class="d-flex justify-content-start">
            <div class="p-1">
                <p>Tgl Posting</p>
            </div>
            <div class="p-1">
                <p class="font-weight-bold"><?= date('d/m/Y', strtotime($posting->tgl_posting)) ?></p>
            </div>
        </div>
    </div>
<!--
    <div class="col mb-3">
        <div class="d-flex justify-content-start">
            <div class="p-1">
                <p>Approval</p>

                <?php if($posting->approval == "disetujui") : ?>
                    <p class='p-1 bg-primary rounded text-white'>
                        <i class='fa fa-check-square'></i>
                        ACC || <?= $posting->approval_user ?>
                    </p>

                <?php elseif($posting->approval == "ditolak") : ?>
                    <p class='p-1 bg-danger rounded text-white'>
                        <i class='fa fa-times'></i>
                        DITOLAK || <?= $posting->approval_user ?>
                    </p>

                <?php endif ?>
            </div>
        </div>
    </div>
                -->
</div>

<div class="row">
    <div class="col-12">
        <h5 class="text-dark">Preview URL</h5>
        <br>
        <h6 class="text-dark">*** Apabila terjadi eror di preview dengan keterangan, example : <b><i>facebook.com</i> refused to connect.</b></h6    >
        <h6 class="text-dark">** Silahkan tambahkan extension I-Frame di Google Chrome/Mozila Firefox anda.</h6>
        <h6 class="text-dark">* Link extension I-Frame <b>Google Chrome</b> <a href="https://chrome.google.com/webstore/detail/iframe-allow/gifgpciglhhpmeefjdmlpboipkibhbjg">KLIK DISINI !</a></h6>
        <h6 class="text-dark">* Link extension I-Frame <b>Mozila Firefox</b> <a href="https://addons.mozilla.org/id/firefox/addon/open_iframe/?utm_source=addons.mozilla.org&utm_medium=referral&utm_content=search">KLIK DISINI !</a></h6>
        <h6 class="text-dark"></h6>
        <br />
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="<?= $posting->link ?>" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#modal-title-posting').text(`<?= $title ?>`)
	$('#modal-footer-posting').html(`
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
	`)
</script>
