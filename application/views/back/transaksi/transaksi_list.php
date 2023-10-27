<?php $this->load->view('back/meta') ?>
  <div class="wrapper">
    <?php $this->load->view('back/navbar') ?>
    <?php $this->load->view('back/sidebar') ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1><?php echo $title ?></h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#"><?php echo $module ?></a></li>
					<li class="active"><?php echo $title ?></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12">
						<div class="box box-primary">
              <div class="box-body">
								<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                <div class="table-responsive no-padding">
									<table id="datatable" class="table table-striped">
										<thead>
											<tr>
                        <th style="text-align: center">No.</th>
                        <th style="text-align: center">Invoice</th>
                        <th style="text-align: center">Atas Nama</th>
      									<th style="text-align: center">Dibuat</th>

                        <!-- percobaan jumlah -->
      									<th style="text-align: center">Jumlah</th>

      									<th style="text-align: center">Grand Total</th>
      									<th style="text-align: center">Status</th>
      									<!-- <th style="text-align: center">Bukti Bayar</th> -->
                        <th style="text-align: center">Aksi</th>
											</tr>
										</thead>
                    <?php $no=1; foreach ($get_all as $data){ ?>
                      <tr>
                        <td style="text-align:center"><?php echo $no++ ?></td>
                        <td style="text-align:center"><?php echo $data->id_invoice ?></a></td>
                        <td style="text-align:center"><?php echo $data->name ?></a></td>
      									<td style="text-align:center"><?php echo tgl_indo($data->created_date) ?></td>

                        <!-- percobaan jumlah -->
      									<td style="text-align:center"><?php echo number_format($data->jumlah) ?></a></td>

      									<td style="text-align:center"><?php echo number_format($data->grand_total) ?></a></td>


      									<td style="text-align:center">
                          <?php if($data->status == '0'){ ?>
      		                  <button id="statusButton" type="button" name="status" class="btn btn-primary"><i class="fa fa-ban"></i> BELUM CHECKOUT</button>
      		                <?php } elseif($data->status == '1'){ ?>
      		                  <button id="statusButton" type="button" name="status" class="btn btn-warning"><i class="fa fa-minus-circle"></i> BELUM LUNAS</button>
      		                <?php } elseif($data->status == '2'){ ?>
      		                  <button id="statusButton" type="button" name="status" class="btn btn-success"><i class="fa fa-check"></i> LUNAS</button>
      		                <?php } elseif($data->status == '3'){ ?>
      		                  <button id="statusButton" type="button" name="status" class="btn btn-danger"><i class="fa fa-remove"></i> EXPIRED</button>
      		                <?php } elseif($data->status == '4'){ ?>
      		                  <button id="statusButton" type="button" name="status" class="btn btn-success"><i class="fa fa-check"></i> DIKEMBALIKAN</button>
      		                <?php } ?>
      									</td>



                        

      									<td style="text-align:center">
                          <?php if($data->status != '2'){ ?>
                            <a href="<?php echo base_url('admin/transaksi/set_lunas/').$data->id_trans ?>">
                              <button id="setLunasButton" name="update" class="btn btn-success" ><i class="fa fa-check"></i> Set Lunas</button>
                            </a>
                          <?php } ?>


                          <?php if($data->status != '4'){ ?>
                            <a href="<?php echo base_url('admin/transaksi/set_pengembalian/').$data->id_trans ?>">
                              <button id="setPengembalianButton" name="update" class="btn btn-success" "><i class="fa fa-check"></i> Set Pengembalian</button>
                            </a>
                          <?php } ?>


                          <a href="<?php echo base_url('admin/transaksi/detail/').$data->id_trans ?>">
                            <button name="update" class="btn btn-primary"><i class="fa fa-search-plus"></i> Detail</button>
                          </a>

                          <?php
                            echo anchor(site_url('admin/transaksi/delete/'.$data->id_trans),'<i class="fa fa-remove"></i>','title="Hapus", class="btn btn-sm btn-danger", onclick="javasciprt: return confirm(\'Apakah Anda yakin ?\')"');
                            ?>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
									</table>
                </div>
							</div>
						</div>
          </div><!-- ./col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php $this->load->view('back/footer') ?>
  </div><!-- ./wrapper -->
  <?php $this->load->view('back/js') ?>
	<!-- DATA TABLES-->
  <link href="<?php echo base_url('assets/plugins/') ?>datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url('assets/plugins/') ?>datatables/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/plugins/') ?>datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	<script type="text/javascript">
  $('#datatable').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false,
    "aaSorting": [[0,'desc']],
    "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Semua"]]
  });
  </script>


<script>
  // Tangkap tombol "Set Lunas" dan "Set Pengembalian" dengan JavaScript
  var setLunasButton = document.getElementById('setLunasButton');
  var setPengembalianButton = document.getElementById('setPengembalianButton');
  var statusButton = document.getElementById('statusButton');

  // Ambil status dari tombol "statusButton"
  var status = <?php echo $data->status; ?>;

  // Berdasarkan status, atur tampilan tombol "Set Lunas" dan "Set Pengembalian"
  if (status == 1) {
    // Jika status adalah 1, tampilkan tombol "Set Lunas" dan sembunyikan tombol "Set Pengembalian"
    setLunasButton.style.display = 'block';
    setPengembalianButton.style.display = 'none';
  } else if (status == 2) {
    // Jika status adalah 2, sembunyikan tombol "Set Lunas" dan tampilkan tombol "Set Pengembalian"
    setLunasButton.style.display = 'none';
    setPengembalianButton.style.display = 'block';
  }
  else if (status == 4){
    setLunasButton.style.display = 'none';
    setPengembalianButton.style.display = 'none';
  }
  
  // else if (status === 3){
  //   setLunasButton.style.display = 'block';
  //   setPengembalianButton.style.display = 'block';
  // }
  else {
    // Untuk status lainnya, sembunyikan kedua tombol tersebut
    setLunasButton.style.display = 'block';
    setPengembalianButton.style.display = 'none';
  }
</script>



</body>
</html>
