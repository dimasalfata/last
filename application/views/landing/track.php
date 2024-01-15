<div class="col-12 col-md-6 mx-auto">

    <div class="mb-3">
        <table class="table table-bordered" width="100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Kode Pengajuan</th>
                    <th>Nasabah</th>
                    <th>Tgl Input</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $pengajuan->kode_pengajuan ?></td>
                    <td><?= $pengajuan->nama ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($pengajuan->tanggal_input)) ?></td>
                    <td><?= $pengajuan->status ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mb-3">
        <table class="table table-sm table-bordered" width="100%">
            <thead class="bg-primary text-white">
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
        
</div>