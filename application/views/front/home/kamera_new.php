<hr><h3 align="center"><b>KAMERA KAMI</b></h3><hr>
<div class="row">
  <?php foreach($kamera_new as $kamera){ ?>
    <div class="col-lg-4">
      <div class="thumbnail">
        <?php
        if(empty($kamera->foto)) {echo "<img class='card-img-top img-thumbnail' src='".base_url()."assets/images/no_image_thumb.png'>";}
        else { echo "<img class='img-thumbnail' src='".base_url()."assets/images/kamera/".$kamera->foto."'> ";}
        ?>
        <div class="caption">
          <p class="card-text"><b><?php echo $kamera->nama_kamera ?></b></p>
          <hr>
          <a href="<?php echo base_url('cart/buy/').$kamera->id_kamera ?>">
            <button class="btn btn-sm btn-primary"><i class="fa fa-shopping-cart"></i> Booking Sekarang!</button>
          </a>
        </div>
      </div>
    </div>
  <?php } ?>
  
</div>


<style>
  .img-thumbnail {
    max-width: 100%; /* Mengatur lebar maksimum gambar */
    height: auto;    /* Menjaga aspek ratio gambar */
    width:100%;
    position:relative;
    overflow:hidden;
   
}
.img-thumbnail img{
  object-fit:cover;
  width:100%;
  height:100%;
}

</style>