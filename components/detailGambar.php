  <div class="card mb-3">
      <div class="card-body">
          <h3 class="card-title">Dokumentasi</h3>
          <?php
            $gambar_query = "SELECT * FROM detail_gambar WHERE id_audit_detail = " . $detail['id'];
            $result_detail_gambar = mysqli_query($koneksi, $gambar_query);
            if (mysqli_num_rows($result_detail_gambar) > 0) {
                while ($g = mysqli_fetch_assoc($result_detail_gambar)) {
            ?>
                  <div class="row">
                      <?php if ($g['gambar_stiker'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Stiker:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_stiker'] ?>" width="100%" alt="<?= $g['gambar_stiker'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_dashcam'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Dashcam:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_dashcam'] ?>" width="100%" alt="<?= $g['gambar_dashcam'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_sunvisor'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Sunvisor:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_sunvisor'] ?>" width="100%" alt="<?= $g['gambar_sunvisor'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_klakson'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Klakson:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_klakson'] ?>" width="100%" alt="<?= $g['gambar_klakson'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_door_trim'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Door Trim:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_door_trim'] ?>" width="100%" alt="<?= $g['gambar_door_trim'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_jok'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Jok:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_jok'] ?>" width="100%" alt="<?= $g['gambar_jok'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_speaker'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Speaker:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_speaker'] ?>" width="100%" alt="<?= $g['gambar_speaker'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_glovebox'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Glovebox:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_glovebox'] ?>" width="100%" alt="<?= $g['gambar_glovebox'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_cap_ban'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Cap Ban:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_cap_ban'] ?>" width="100%" alt="<?= $g['gambar_cap_ban'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_body'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Body:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_body'] ?>" width="100%" alt="<?= $g['gambar_body'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_bemper_depan'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Bemper Depan:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_bemper_depan'] ?>" width="100%" alt="<?= $g['gambar_bemper_depan'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_bemper_belakang'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Bemper Belakang:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_bemper_belakang'] ?>" width="100%" alt="<?= $g['gambar_bemper_belakang'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_fender_depan'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Fender Depan:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_fender_depan'] ?>" width="100%" alt="<?= $g['gambar_fender_depan'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_fender_belakang'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Fender Belakang:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_fender_belakang'] ?>" width="100%" alt="<?= $g['gambar_fender_belakang'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_box'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Box:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_box'] ?>" width="100%" alt="<?= $g['gambar_box'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_headlamp'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Headlamp:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_headlamp'] ?>" width="100%" alt="<?= $g['gambar_headlamp'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_stoplamp'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Stoplamp:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_stoplamp'] ?>" width="100%" alt="<?= $g['gambar_stoplamp'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_kaca_depan'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar kaca Depan:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_kaca_depan'] ?>" width="100%" alt="<?= $g['gambar_kaca_depan'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_spion'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Spion:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_spion'] ?>" width="100%" alt="<?= $g['gambar_spion'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_ban_depan'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Ban Depan:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_ban_depan'] ?>" width="100%" alt="<?= $g['gambar_ban_depan'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_ban_belakang'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Ban Belakang:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_ban_belakang'] ?>" width="100%" alt="<?= $g['gambar_ban_belakang'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_ban_serep'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Ban Serep:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_ban_serep'] ?>" width="100%" alt="<?= $g['gambar_ban_serep'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_dongkrak'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Dongkrak:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_dongkrak'] ?>" width="100%" alt="<?= $g['gambar_dongkrak'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_kunci_roda'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Kunci Roda:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_kunci_roda'] ?>" width="100%" alt="<?= $g['gambar_kunci_roda'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_stik_roda'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Stik Roda:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_stik_roda'] ?>" width="100%" alt="<?= $g['gambar_stik_roda'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_kotak_p3k'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Kotak P3K:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_kotak_p3k'] ?>" width="100%" alt="<?= $g['gambar_kotak_p3k'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_warning_triangle'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Warning Tirangel:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_warning_triangle'] ?>" width="100%" alt="<?= $g['gambar_warning_triangle'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_stnk'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar STNK:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_stnk'] ?>" width="100%" alt="<?= $g['gambar_stnk'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_kir'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar KIR:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_kir'] ?>" width="100%" alt="<?= $g['gambar_kir'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_kartu_kir'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar Kartu Kir:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_kartu_kir'] ?>" width="100%" alt="<?= $g['gambar_kartu_kir'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_sipa'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar SIPA:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_sipa'] ?>" width="100%" alt="<?= $g['gambar_sipa'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                      <?php if ($g['gambar_ibm'] != 'kosong') { ?>
                          <div class="col-md-6 mb-3">
                              <div class="image-title-container">
                                  <strong style="color:black;"><span style="color:black;">&#9679;</span> Gambar IBM:</strong>
                                  <img src="./assets/gambar/<?= $g['gambar_ibm'] ?>" width="100%" alt="<?= $g['gambar_ibm'] ?>" style="border: 1px solid black;">
                              </div>
                          </div>
                      <?php } ?>
                  </div>
                  <!-- Dokumen End -->
          <?php
                }
            }
            ?>

      </div>
  </div>