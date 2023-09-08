<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	function __construct()
  {
    parent::__construct();
    /* memanggil model untuk ditampilkan pada masing2 modul */
		$this->load->model('Company_model');
		$this->load->model('Event_model');
		$this->load->model('Foto_model');
		$this->load->model('Kategori_model');
		$this->load->model('Kontak_model');

		$this->data['company_data'] 	= $this->Company_model->get_by_company();
		$this->data['event_sidebar'] 			= $this->Event_model->get_all_sidebar();
		$this->data['kategori_sidebar'] 	= $this->Kategori_model->get_all();
		$this->data['kontak_sidebar'] 		= $this->Kontak_model->get_all();
		$this->data['kontak'] 				= $this->Kontak_model->get_all();
  }

	public function about()
	{
		$this->data['title'] 							= 'Tentang Kami';

    /* melakukan pengecekan data, apabila ada maka akan ditampilkan */
  	$this->data['company']            = $this->Company_model->get_by_company();

    /* memanggil view yang telah disiapkan dan passing data dari model ke view*/
		$this->load->view('front/page/about', $this->data);
	}

	public function contact()
	{
		$this->data['title'] = 'Contact';

		$this->data['name'] = array(
      'name'  => 'name',
      'id'    => 'name',
      'class' => 'form-control', 'placeholder' => 'Nama',
      'value' => $this->form_validation->set_value('name'),
    );
		$this->data['email'] = array(
      'name'  => 'email',
      'id'    => 'email',
      'class' => 'form-control',
			'placeholder'    => 'Email',
      'value' => $this->form_validation->set_value('email'),
    );
		$this->data['subject'] = array(
      'name'  => 'subject',
      'id'    => 'subject',
      'class' => 'form-control',
			'placeholder'    => 'Judul, ex: konfirmasi pembayaran',
      'value' => $this->form_validation->set_value('subject'),
    );
		$this->data['message'] = array(
      'name'  => 'message',
      'id'    => 'message',
      'class' => 'form-control',
			'placeholder'    => 'Isi Pesan',
      'value' => $this->form_validation->set_value('message'),
    );

		$this->data['foto'] = array(
      'name'  => 'foto',
      'id'    => 'foto',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('message'),
    );

		$this->load->view('front/page/contact', $this->data);
	}

	public function send()
	{
		$this->form_validation->set_rules('name', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('subject', 'Judul', 'trim|required');
		$this->form_validation->set_rules('message', 'Isi Pesan', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');

		if ($this->form_validation->run() == FALSE)
    {
      $this->contact();
    }
			else
			{
				$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
					);

				// fungsi upload foto
				$config['upload_path']          = './assets/images/bukti/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 4000;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('foto')) {
					echo $this->upload->display_errors();
				}else{
					$name = $this->input->post('name');
					$email = $this->input->post('email');
					$subject = $this->input->post('subject');
					$message = $this->input->post('message');
					$foto = $this->upload->file_name;
					
					$data = array(
						'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
						'foto' => $foto,
					);
					$this->db->insert('bukti', $data);
					$this->session->set_flashdata('message', '<div class="row"><div class="col-lg-12"><div class="alert alert-success alert">Pesan Anda telah Terkirim, Silahkan menunggu status bayar berhasil Terima Kasih</div></div></div>');
					redirect('page/contact');
				}
















				// ambil value dari masing2 form input
				// $name 			= $this->input->post('name');
				// $email 			= $this->input->post('email');
				// $subject 		= $this->input->post('subject');
				// $message 		= $this->input->post('message');
				// $data = array(
				// 'name' => $this->input->post('name'),
				// 'email' => $this->input->post('email'),
				// 'subject' => $this->input->post('subject'),
				// 'message' => $this->input->post('message'),
				// );
				
        // eksekusi query INSERT
        // $this->Kontak_model->insert_bukti($data);
        // set pesan data berhasil dibuat

				// setingan default tanpa smtp
				// $this->load->library('email');

				// $this->email->from('dickyzs155@gmail.com', 'Pesan Baru dari Website');
				// $this->email->to('muhammad.dickynn@gmail.com');
				// $this->email->subject($subject);
				// $this->email->message($message);

				// $this->session->set_flashdata('message', '<div class="row"><div class="col-lg-12"><div class="alert alert-success alert">Pesan Anda telah Terkirim, Terima Kasih</div></div></div>');
				// 	redirect(site_url('contact'));

			// 	if ($this->email->send())
		    // {
			// 		$this->session->set_flashdata('message', '<div class="row"><div class="col-lg-12"><div class="alert alert-success alert">Pesan Anda telah Terkirim, Terima Kasih</div></div></div>');
			// 		redirect(site_url('contact'));
		    // }
		    // else
		    // {
			// 		$this->session->set_flashdata('message', '<div class="row"><div class="col-lg-12"><div class="alert alert-danger alert">Pesan Anda Gagal Terkirim, silahkan coba kembali</div></div></div>');
			// 		redirect(site_url('contact'));
		    // }
			}
	}

	public function tes(){
		// setingan default tanpa smtp
		$this->load->library('email');

		$this->email->from('test1@gmail.com', 'fungsimail');
		$this->email->to('test@gmail.com');
		$this->email->subject('kirimemailpakemail');
		$this->email->message('asdsadasd');

		if ($this->email->send())
		{
			echo "berhasil";
		}
		else
		{
			echo "gasgal";
		}

		// Konfigurasi email dengan smtp
    // $config = [
    //    'smtp_host' => 'ssl://smtp.gmail.com',
    //    'smtp_user' => 'test@gmail.com',   // Ganti dengan email gmail Anda.
    //    'smtp_pass' => 'pass',             // Password gmail Anda.
    //    'smtp_port' => 465,
   	// ];
		
    // // Load library email dan konfigurasinya.
    // $this->load->library('email', $config);
		
    // // Pengirim dan penerima email.
    // $this->email->from('test@gmail.com', 'kirimpakesmtp');    // Email dan nama pegirim.
    // $this->email->to('test@gmail.com');                       // Penerima email.
		
    // // Subject email.
    // $this->email->subject('Kirim Email pada CodeIgniter');
		
    // // Isi email. Bisa dengan format html.
	// 	$this->email->message('Halo bos, ada konfirmasi pembayaran baru dengan rincian sebagai berikut: <br>');
		
    // if ($this->email->send())
    // {
    //   echo 'Sukses! email berhasil dikirim.';
    // }
    // else
    // {
    //   echo 'Error! email tidak dapat dikirim.';
    // }
	}

}
