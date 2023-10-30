<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kamera extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Kamera_model');

    $this->data['module'] = 'Kamera';

    if(!$this->ion_auth->logged_in()){redirect('admin/auth/login', 'refresh');}
    elseif(!$this->ion_auth->is_superadmin() && !$this->ion_auth->is_admin()){redirect(base_url());}
  }

  public function index()
  {
    $this->data['title']    = 'Data '.$this->data['module'];
    $this->data['get_all']  = $this->Kamera_model->get_all();

    $this->load->view('back/kamera/kamera_list', $this->data);
  }

  public function create()
  {
    $this->data['title']          = 'Tambah '.$this->data['module'].' Baru';
    $this->data['action']         = site_url('admin/kamera/create_action');
    $this->data['button_submit']  = 'Simpan';
    $this->data['button_reset']   = 'Reset';

    $this->data['nama_kamera'] = array(
      'name'  => 'nama_kamera',
      'id'    => 'nama_kamera',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nama_kamera'),
      'required'    => '',
    );
    $this->data['harga'] = array(
      'name'  => 'harga',
      'id'    => 'harga',
      'type'  => 'number',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('harga'),
      'required'    => '',
    );
    $this->data['jumlah'] = array(
      'name'  => 'jumlah',
      'id'    => 'jumlah',
      'type'  => 'number',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('jumlah'),
      'required'    => '',
    );

    $this->load->view('back/kamera/kamera_add', $this->data);
  }

  public function create_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->create();
    }
    else
    {
      /* 4 adalah menyatakan tidak ada file yang diupload*/
      if ($_FILES['foto']['error'] <> 4)
      {
        $nmfile = strtolower(url_title($this->input->post('nama_kamera'))).date('YmdHis');

        /* memanggil library upload ci */
        $config['upload_path']      = './assets/images/kamera/';
        $config['allowed_types']    = 'jpg|jpeg|png|gif';
        $config['max_size']         = '2048'; // 2 MB
        $config['file_name']        = $nmfile; //nama yang terupload nantinya

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto'))
        {
          //file gagal diupload -> kembali ke form tambah
          $error = array('error' => $this->upload->display_errors());
          $this->session->set_flashdata('message', '<div class="alert alert-danger alert">'.$error['error'].'</div>');

          $this->create();
        }
          //file berhasil diupload -> lanjutkan ke query INSERT
          else
          {
            $foto = $this->upload->data();
            $thumbnail                = $config['file_name'];
            // library yang disediakan codeigniter
            $config['image_library']  = 'gd2';
            // gambar yang akan disimpan thumbnail
            $config['source_image']   = './assets/images/kamera/'.$foto['file_name'].'';
            // rasio resolusi
            $config['maintain_ratio'] = FALSE;
            // lebar
            $config['width']          = 1280;
            // tinggi
            $config['height']         = 720;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $data = array(
              'nama_kamera'   => $this->input->post('nama_kamera'),
              'harga'           => $this->input->post('harga'),
              'jumlah'           => $this->input->post('jumlah'),
              'foto'            => $nmfile.$foto['file_ext'],
              'created_by'      => $this->session->userdata('username')
            );

            // eksekusi query INSERT
            $this->Kamera_model->insert($data);
            // set pesan data berhasil disimpan
            $this->session->set_flashdata('message', '
            <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
              <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil disimpan
            </div>');
            redirect(site_url('admin/kamera'));
          }
      }
      else // Jika file upload kosong
      {
        $data = array(
          'nama_kamera'   => $this->input->post('nama_kamera'),
          'harga'           => $this->input->post('harga'),
          'jumlah'           => $this->input->post('jumlah'),
          'created_by'      => $this->session->userdata('username')
        );

        // eksekusi query INSERT
        $this->Kamera_model->insert($data);
        // set pesan data berhasil disimpan
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
          <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil disimpan
        </div>');
        redirect(site_url('admin/kamera'));
      }
    }
  }

  public function update($id)
  {
    $row = $this->Kamera_model->get_by_id($id);
    $this->data['kamera'] = $this->Kamera_model->get_by_id($id);

    if ($row)
    {
      $this->data['title']          = 'Ubah Data '.$this->data['module'];
      $this->data['action']         = site_url('admin/kamera/update_action');
      $this->data['button_submit']  = 'Simpan';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_kamera'] = array(
        'name'  => 'id_kamera',
        'id'    => 'id_kamera',
        'type'  => 'hidden',
      );
      $this->data['nama_kamera'] = array(
        'name'  => 'nama_kamera',
        'id'    => 'nama_kamera',
        'type'  => 'text',
        'class' => 'form-control',
        'required'    => '',
      );
      $this->data['harga'] = array(
        'name'  => 'harga',
        'id'    => 'harga',
        'type'  => 'number',
        'class' => 'form-control',
        'required'    => '',
      );
      $this->data['jumlah'] = array(
        'name'  => 'jumlah',
        'id'    => 'jumlah',
        'type'  => 'number',
        'class' => 'form-control',
        'required'    => '',
      );

      $this->load->view('back/kamera/kamera_edit', $this->data);
    }
      else
      {
        $this->session->set_flashdata('message', '<div class="alert alert-warning alert">Data tidak ditemukan</div>');
        redirect(site_url('admin/kamera'));
      }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE)
    {
      $this->update($this->input->post('id_kamera'));
    }
      else
      {
        $nmfile = strtolower(url_title($this->input->post('nama_kamera'))).date('YmdHis');

        /* Jika file upload diisi */
        if ($_FILES['foto']['error'] <> 4)
        {
          $nmfile = strtolower(url_title($this->input->post('nama_kamera'))).date('YmdHis');

          //load uploading file library
          $config['upload_path']      = './assets/images/kamera/';
          $config['allowed_types']    = 'jpg|jpeg|png|gif';
          $config['max_size']         = '2048'; // 2 MB
          $config['file_name']        = $nmfile; //nama yang terupload nantinya

          $this->load->library('upload', $config);

          // Jika file gagal diupload -> kembali ke form update
          if (!$this->upload->do_upload('foto'))
          {
            //file gagal diupload -> kembali ke form update
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert">'.$error['error'].'</div>');

            $this->update($this->input->post('id_kamera'));
          }
            // Jika file berhasil diupload -> lanjutkan ke query INSERT
            else
            {
              $delete = $this->Kamera_model->del_by_id($this->input->post('id_kamera'));

              $dir        = "assets/images/kamera/".$delete->foto;

              if(file_exists($dir))
              {
                // Hapus foto dan thumbnail
                unlink($dir);
              }

              $foto = $this->upload->data();
              // library yang disediakan codeigniter
              $thumbnail                = $config['file_name'];
              //nama yang terupload nantinya
              $config['image_library']  = 'gd2';
              // gambar yang akan disimpan thumbnail
              $config['source_image']   = './assets/images/kamera/'.$foto['file_name'].'';
              // rasio resolusi
              $config['maintain_ratio'] = FALSE;
              // lebar
              $config['width']          = 1280;
              // tinggi
              $config['height']         = 720;

              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $data = array(
                'nama_kamera'   => $this->input->post('nama_kamera'),
                'harga'           => $this->input->post('harga'),
                'jumlah'           => $this->input->post('jumlah'),
                'foto'            => $nmfile.$foto['file_ext'],
                'modified_by'     => $this->session->userdata('username')
              );

              $this->Kamera_model->update($this->input->post('id_kamera'), $data);
              $this->session->set_flashdata('message', '
              <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
                <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil disimpan
              </div>');
              redirect(site_url('admin/kamera'));
            }
        }
          // Jika file upload kosong
          else
          {
            $data = array(
              'nama_kamera'   => $this->input->post('nama_kamera'),
              'harga'           => $this->input->post('harga'),
              'jumlah'           => $this->input->post('jumlah'),
              'modified_by'     => $this->session->userdata('username')
            );

            $this->Kamera_model->update($this->input->post('id_kamera'), $data);
            $this->session->set_flashdata('message', '
            <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
              <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil disimpan
            </div>');
            redirect(site_url('admin/kamera'));
          }
      }
  }

  public function delete($id)
  {
    $delete = $this->Kamera_model->del_by_id($id);

    // menyimpan lokasi gambar dalam variable
    $dir = "assets/images/foto/".$delete->foto.$delete->foto_type;

    // Hapus foto
    unlink($dir);

    // Jika data ditemukan, maka hapus foto dan record nya
    if($delete)
    {
      $this->Kamera_model->delete($id);

      $this->session->set_flashdata('message', '
      <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        <i class="ace-icon fa fa-bullhorn green"></i> Data berhasil dihapus
      </div>');
      redirect(site_url('admin/kamera'));
    }
      // Jika data tidak ada
      else
      {
        $this->session->set_flashdata('message', '
        <div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					<i class="ace-icon fa fa-bullhorn green"></i> Data tidak ditemukan
        </div>');
        redirect(site_url('admin/kamera'));
      }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('nama_kamera', 'Judul Kamera', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_kamera', 'id_kamera', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }



  // public function kurangi_stok($kamera_id, $jumlah){
    
  //   $kamera = $this->Kamera_model->get_by_id($id);
  //   $this->data['kamera'] = $this->Kamera_model->get_by_id($id);
  //   if($kamera){
  //     $new_stok = $kamera->jumlah - $jumlah;
  //     $this->db->where('id', $kamera_id)->update
  //   }
  // }

}
