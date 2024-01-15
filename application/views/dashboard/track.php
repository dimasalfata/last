<div class="col-12 col-md-6 mx-auto">
    <table class="table table-sm table-borderless" width="100%">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($fu as $fus) : ?>
                <tr>
                    <td><?= date('d/m/Y H:i:s', strtotime($fus->tanggal_fu)) ?></td>
                    <td>
                        <?php if($fus->status == 'Follow UP') : ?>
                            Data Sedang Diproses
                        <?php elseif($fus->status == 'Realisasi') : ?>
                            Sudah Realisasi

                        <?php else : ?>
                            <?= $fus->status ?>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td><?= date('d/m/Y H:i:s', strtotime($pengajuan->tanggal_input)) ?></td>
                <td>
                    Menunggu Follow UP
                </td>
            </tr>
        </tbody>
    </table>
</div>