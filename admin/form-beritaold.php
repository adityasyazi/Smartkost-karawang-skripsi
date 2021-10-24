<div class="row">
      <div class="column side">

      </div>

      <div class="column middle">
          <h2>Biodata Form</h2>
          <p>please fill in your biodata in the following form</p>
          
          
          <div class="container">
            <form action="add-member.php" method="post" enctype="multipart/form-data">
            
              <!-- judul -->
              <div class="row">
                <div class="col-25">
                  <label for="jdl1">Judul</label>
                </div>
                <div class="col-75">
                  <input type="text" id="jdl1" name="judul1" value="<?php echo $judul1; ?>" placeholder="Masukan Judul..">
                  <span class="error"><?php echo $judul1err; ?></span>
                </div>
              </div>

              <!-- isi -->
               <div class="row">
                <div class="col-25">
                  <label for="isi1">Isi</label>
                </div>
                <div class="col-75">
                  <textarea id="isi1" name="isi1" value="<?php echo $address; ?> placeholder="Masukan Isi Berita.." style="height:200px"></textarea>
                  <span class="error"><?php echo $isi1err; ?></span>
                </div>
              </div>

              <!-- tanggal -->
              <div class="row">
                  <div class="col-25">
                    <label for="tanggal1">Tanggal</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="datepicker" name="tanggal1" value="<?php echo $tanggal1; ?>" placeholder="Masukan Tanggal..">
                    <span class="error"><?php echo $tanggal1err; ?></span>
                  </div>
              </div>  

              <!-- gambar -->
              <div class="row">
                  <div class="col-25">
                    <label for="picture">Photo</label>
                  </div>
                  <div class="col-75">
                    <input type="file" name="file_gambar" placeholder="Masukan gambar..">
                  </div>
              </div>

              <div class="row">
                <input type="submit" name="submit" value="Submit">
              </div>
              </form>
            </div>
      </div>
      <div class="column side">

        </div>
  </div>