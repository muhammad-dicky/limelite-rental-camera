<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>">Home</a></li>
		<li><a href="#">Profil</a></li>
		<li class="active">Hubungi Kami</li>
	</ol>

	<div class="row">
		<div class="col-md-8"><h1>HUBUNGI KAMI</h1><hr>
			<?php echo validation_errors() ?>
			<?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');} ?>
			<?php echo form_open_multipart('send',array('id'=>'contactForm')) ?>
				<div class="form-group">
					<div class="controls">
						<?php echo form_input($name) ?>
					</div>
				</div>
				<div class="form-group">
					<div class="controls">
						<?php echo form_input($email) ?>
					</div>
				</div>
				<div class="form-group">
					<div class="controls">
						<?php echo form_input($subject) ?>
					</div>
				</div>
				<div class="form-group">
					<div class="controls">
						<?php echo form_textarea($message) ?>
					</div>
				</div>
				<!-- batas atas gambar -->
				<div class="form-group"><label>Foto</label>
                    <input type="file" enctype="multipart/form-data" class="form-control" name="foto" id="foto" onchange="tampilkanPreview(this,'preview')"/>

					

                    <br><p><b>Preview Foto</b><br>
                    <img id="preview" src="" alt="" width="350px"/>
                  </div>
<!-- batas bawah gambar -->
				<button type="submit" id="submit" class="btn btn-sm btn-primary" style="pointer-events: all; cursor: pointer;">Kirim</button>
			<?php echo form_close() ?>
		</div>
		<?php $this->load->view('front/sidebar'); ?>
	</div>
</div>
<?php $this->load->view('front/footer'); ?>

<!-- fungsi buat preview -->
<?php $this->load->view('back/js') ?>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/tinymce/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	function tampilkanPreview(foto,idpreview)
	{ //membuat objek gambar
		var gb = foto.files;
		//loop untuk merender gambar
		for (var i = 0; i < gb.length; i++)
		{ //bikin variabel
			var gbPreview = gb[i];
			var imageType = /image.*/;
			var preview=document.getElementById(idpreview);
			var reader = new FileReader();
			if (gbPreview.type.match(imageType))
			{ //jika tipe data sesuai
				preview.file = gbPreview;
				reader.onload = (function(element)
				{
					return function(e)
					{
						element.src = e.target.result;
					};
				})(preview);
				//membaca data URL gambar
				reader.readAsDataURL(gbPreview);
			}
			else
			{ //jika tipe data tidak sesuai
				alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
			}
		}
	}
</script>
</body>
</html>