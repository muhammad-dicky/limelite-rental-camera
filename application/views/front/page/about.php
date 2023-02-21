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
			<div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Jl.%20Kaliurang%20No.7,7,%20Ngabean%20Kulon,%20Sinduharjo,%20Kec.%20Ngaglik,%20Kabupaten%20Sleman,%20Daerah%20Istimewa%20Yogyakarta%2055581+(Jakal%207%20Futsal)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">measure distance on map</a></iframe></div>
		</div>
		<?php $this->load->view('front/sidebar'); ?>
	</div>
</div>
<?php $this->load->view('front/footer'); ?>
