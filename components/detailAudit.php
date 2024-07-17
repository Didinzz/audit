<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Bagian Dalam Kendaraan</h5>
                <div class="mb-3">

                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Stiker:</strong>
                        <span class="badge badge-<?php echo ($detail['stiker'] == 'Ada') ? 'success' : (($detail['stiker'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['stiker']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Dashcam:</strong>
                        <span class="badge badge-<?php echo ($detail['dashcam'] == 'Ada') ? 'success' : (($detail['dashcam'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['dashcam']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Sunvisor:</strong>
                        <span class="badge badge-<?php echo ($detail['sunvisor'] == 'Ada') ? 'success' : (($detail['sunvisor'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['sunvisor']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Klakson:</strong>
                        <span class="badge badge-<?php echo ($detail['klakson'] == 'Ada') ? 'success' : (($detail['klakson'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['klakson']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Door Trim:</strong>
                        <span class="badge badge-<?php echo ($detail['door_trim'] == 'Ada') ? 'success' : (($detail['door_trim'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['door_trim']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Jok:</strong>
                        <span class="badge badge-<?php echo ($detail['jok'] == 'Bagus') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['jok']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Speaker:</strong>
                        <span class="badge badge-<?php echo ($detail['speaker'] == 'Bagus') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['speaker']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Glovebox:</strong>
                        <span class="badge badge-<?php echo ($detail['glovebox'] == 'Ada') ? 'success' : (($detail['glovebox'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['glovebox']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Bagian Luar Kendaraan</h5>
                <div class="mb-3">
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Cap Ban:</strong>
                        <span class="badge badge-<?php echo ($detail['cap_ban'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['cap_ban']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Body:</strong>
                        <span class="badge badge-<?php echo ($detail['body'] == 'Mulus') ? 'success' : (($detail['body'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['body']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Bemper Depan:</strong>
                        <span class="badge badge-<?php echo ($detail['bemper_depan'] == 'Mulus') ? 'success' : (($detail['bemper_depan'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['bemper_depan']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Bemper Belakang:</strong>
                        <span class="badge badge-<?php echo ($detail['bemper_belakang'] == 'Mulus') ? 'success' : (($detail['bemper_belakang'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['bemper_belakang']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Fender Depan:</strong>
                        <span class="badge badge-<?php echo ($detail['fender_depan'] == 'Mulus') ? 'success' : (($detail['fender_depan'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['fender_depan']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Fender Belakang:</strong>
                        <span class="badge badge-<?php echo ($detail['fender_belakang'] == 'Mulus') ? 'success' : (($detail['fender_belakang'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['fender_belakang']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Box:</strong>
                        <span class="badge badge-<?php echo ($detail['box'] == 'Mulus') ? 'success' : (($detail['box'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['box']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Headlamp:</strong>
                        <span class="badge badge-<?php echo ($detail['headlamp'] == 'Mulus') ? 'success' : (($detail['headlamp'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['headlamp']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Stoplamp:</strong>
                        <span class="badge badge-<?php echo ($detail['stoplamp'] == 'Mulus') ? 'success' : (($detail['stoplamp'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['stoplamp']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Kaca Depan:</strong>
                        <span class="badge badge-<?php echo ($detail['kaca_depan'] == 'Bagus') ? 'success' : (($detail['kaca_depan'] == 'Retak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['kaca_depan']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Spion:</strong>
                        <span class="badge badge-<?php echo ($detail['spion'] == 'Bagus') ? 'success' : (($detail['spion'] == 'Baret') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['spion']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Ban Depan:</strong>
                        <span class="badge badge-<?php echo ($detail['ban_depan'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ban_depan']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Ban Belakang:</strong>
                        <span class="badge badge-<?php echo ($detail['ban_belakang'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ban_belakang']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Ban Serep:</strong>
                        <span class="badge badge-<?php echo ($detail['ban_serep'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ban_serep']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Toolkit</h5>
                <div class="mb-3">
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Dongkrak:</strong>
                        <span class="badge badge-<?php echo ($detail['dongkrak'] == 'Ada') ? 'success' : (($detail['dongkrak'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['dongkrak']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Kunci Roda:</strong>
                        <span class="badge badge-<?php echo ($detail['kunci_roda'] == 'Ada') ? 'success' : (($detail['kunci_roda'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['kunci_roda']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Stik Roda:</strong>
                        <span class="badge badge-<?php echo ($detail['stik_roda'] == 'Ada') ? 'success' : (($detail['stik_roda'] == 'Rusak') ? 'warning' : 'danger'); ?>"><?php echo ucfirst($detail['stik_roda']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Kotak P3K:</strong>
                        <span class="badge badge-<?php echo ($detail['kotak_p3k'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['kotak_p3k']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Warning Tirangel:</strong>
                        <span class="badge badge-<?php echo ($detail['warning_tirangel'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['warning_tirangel']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Dokumen</h5>
                <div class="mb-3">
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>STNK:</strong>
                        <span class="badge badge-<?php echo ($detail['stnk'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['stnk']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>KIR:</strong>
                        <span class="badge badge-<?php echo ($detail['kir'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['kir']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>Kartu KIR:</strong>
                        <span class="badge badge-<?php echo ($detail['kartu_kir'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['kartu_kir']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>SIPA:</strong>
                        <span class="badge badge-<?php echo ($detail['sipa'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['sipa']); ?></span>
                    </div>
                    <div class="d-flex mb-1 justify-content-between align-items-center">
                        <strong>IBM:</strong>
                        <span class="badge badge-<?php echo ($detail['ibm'] == 'Ada') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['ibm']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Temuan</h5>
        <div class="d-flex mb-1 justify-content-between align-items-center">
            <strong class="">Status Temuan:</strong>
            <span class="badge badge-<?php echo ($detail['status_temuan'] == 'Open') ? 'success' : 'danger'; ?>"><?php echo ucfirst($detail['status_temuan']); ?></span>
        </div>
        <div class="mb-3">
            <p><?php echo $detail['temuan'] ?></p>
        </div>

    </div>
</div>