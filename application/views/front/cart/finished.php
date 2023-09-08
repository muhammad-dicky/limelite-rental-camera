<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    <div class="col-sm-12 col-lg-12">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a></li>
					<li class="breadcrumb-item active">Transaksi Selesai</li>
			  </ol>
			</nav>
    </div>

    <div class="col-lg-12"><h1>TRANSAKSI SELESAI</h1><hr>
			<h4>INVOICE NO. <?php echo $cart_finished_row->id_invoice ?> (<font color='red'>BELUM LUNAS</font>)</h4>
			<?php echo form_open('cart/download_invoice/'.$cart_finished_row->id_trans, array("target"=>"_blank")) ?>
				<button type="submit" name="download_invoice" class="btn btn-sm btn-success">Download Invoice</button>
			<?php echo form_close() ?>
			<br>
			<div class="row">
			  <div class="col-lg-12">
          <div class="box-body table-responsive padding">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
									<th style="text-align: center">No.</th>
                  <th style="text-align: center">Kamera</th>
									<th style="text-align: center">Harga Per Jam</th>
									<th style="text-align: center">Tanggal</th>
                  <th style="text-align: center">Mulai</th>
									<th style="text-align: center">Durasi</th>
									<th style="text-align: center">Selesai</th>
                  <th style="text-align: center">Total</th>
                </tr>
              </thead>
              <tbody>
              <?php $no=1; foreach ($cart_finished as $cart){ ?>
                <tr>
                  <td style="text-align:center"><?php echo $no++ ?></td>
                  <td style="text-align:left"><?php echo $cart->nama_kamera ?></td>
									<td style="text-align:center"><?php echo number_format($cart->harga_jual) ?></td>
									<td style="text-align:center"><?php echo tgl_indo($cart->tanggal) ?></td>
                  <td style="text-align:center"><?php echo $cart->jam_mulai ?></td>
									<td style="text-align:center"><?php echo $cart->durasi ?></td>
									<td style="text-align:center"><?php echo $cart->jam_selesai ?></td>
                  <td style="text-align:right"><?php echo number_format($cart->total) ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
  			  </div>
  			</div>
  		</div>

			<div class="row">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered">
					  <tbody>
							<tr>
					      <th scope="row">SubTotal</th>
					      <td align="right">Rp</td>
								<td align="right"><?php echo number_format($cart_finished_row->subtotal) ?></td>
					    </tr>
							<tr>
					      <th scope="row">Diskon (Member)</th>
					      <td align="right">Rp</td>
								<td align="right"><?php echo number_format($cart_finished_row->diskon) ?></td>
					    </tr>
							<tr>
					      <th scope="row">Grand Total</th>
					      <td align="right">Rp</td>
								<td align="right"><b><?php echo number_format($cart_finished_row->grand_total) ?></b></td>
					    </tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="row">
					<label>Catatan:</label><br>
					<?php if($cart_finished_row->catatan != NULL){?>
			      <?php echo $cart_finished_row->catatan ?>
			    <?php } else{echo "-";} ?>
				</div>
			</div>


			
<div class="row" style="padding-top:50px;">
<label>UPLOAD BUKTI BAYAR</label><br>

			<!-- fungsi upload gambar bukti  -->
			<form action="<?= base_url('cart/upload_gambar/'.$cart_finished_row->id_trans); ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="userfile" size="20" />
    <br /><br />
    <input type="submit" value="Upload Bukti Bayar" />
</form>

<?php if ($this->session->flashdata('success_message')): ?>
<div class="alert alert-success">
    <?php echo $this->session->flashdata('success_message'); ?>
</div>
<?php endif; ?>
</div>

<!-- fungsi upload gambar  -->

			<div class="row">
				<div class="col-lg-12">
					<hr><h4>Pembayaran</h4><hr>
					<p>Anda dapat melakukan pembayaran melalui nomor rekening kami dibawah ini:</p>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th style="text-align: center">No.</th>
								<th style="text-align: center">Bank</th>
								<th style="text-align: center">Atas Nama</th>
								<th style="text-align: center">No. Rekening</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($data_bank as $bank){ ?>
							<tr>
								<td align="center"><?php echo $no++ ?></td>
								<td align="center"><?php echo $bank->nama_bank ?></td>
								<td align="center"><?php echo $bank->atas_nama ?></td>
								<td align="center"><?php echo $bank->norek ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<hr><h4>PERHATIAN</h4><hr>
					<ul>
						<li>Segera lakukan pembayaran sebelum: <b><?php $time = strtotime($cart_finished_row->deadline); echo date("d F Y | H:i:s",$time); ?> WIB</b>, apabila melewati batas waktu tersebut maka booking dianggap batal.</li>
			      <li>Jumlah yang harus Anda bayarkan adalah sebesar: Rp <b><?php echo number_format($cart_finished_row->grand_total) ?></b></li>
			      <li>Silahkan melakukan konfirmasi pembayaran ke halaman berikut ini, <a href="<?php echo base_url('contact') ?>">klik disini</a> atau langsung menghubungi kami ke customer service yang telah disediakan dan melampirkan foto bukti bayarnya.</li>
			      <li>Kami akan segera memproses pemesanan Anda setelah mendapatkan konfirmasi pembayaran segera mungkin.</li>
					</ul>
					<p align="center">~ Terima Kasih ~</p>
				</div>
			</div>
	  </div>
  </div>
</div>

<?php $this->load->view('front/footer'); ?>
