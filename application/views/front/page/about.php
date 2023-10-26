<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url() ?>">Home</a></li>
		<li><a href="#">Profil</a></li>
		<li class="active">Tentang Kami</li>
	</ol>

	<div class="row">
		<div class="col-md-8"><h1>PROFIL <?php echo strtoupper($company->company_name) ?></h1><hr>
			<p align="center"><?php
				if(empty($company->foto)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png' width='400' height='400'>";}
				else { echo " <img src='".base_url()."assets/images/company/".$company->foto.$company->foto_type."' class='img-responsive' title='$company->company_name' alt='$company->company_name'> ";}
				?>
			</p>
			<p><?php echo $company->company_desc ?></p><br>
			<p><b>Alamat:</b><br>
				<?php echo $company->company_address ?>
			</p>
			<p><b>Email:</b><br>
				<?php echo $company->company_email ?>
			</p>
			<p><b>Telepon:</b><br>
				<?php echo $company->company_phone ?>
				<?php if($company->company_phone2 > 0){echo " / ". $company->company_phone2;} ?>
			</p>
			<?php if($company->company_fax > 0){ ?>
			<p><b>Fax:</b><br>
				<?php echo $company->company_fax ?>
			</p>
			<br>
			<?php } ?>
			
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.9057520285787!2d110.59786997401184!3d-7.69326337618042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a4378f920cf97%3A0x7c4156fef00a0343!2sLimelite%20Rental%20Kamera!5e0!3m2!1sid!2sid!4v1694185634129!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
		<?php $this->load->view('front/sidebar'); ?>
	</div>
</div>
<?php $this->load->view('front/footer'); ?>
