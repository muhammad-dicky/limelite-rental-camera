<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kamera_model extends CI_Model
{
  public $table = 'kamera';
  public $id    = 'id_kamera';
  public $order = 'DESC';

	function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

  function get_all()
  {
    $this->db->order_by('nama_kamera','ASC');
    return $this->db->get($this->table)->result();
  }

  function get_all_home()
  {
    $this->db->order_by('nama_kamera', 'ASC');
    return $this->db->get($this->table)->result();
  }

  function ambil_kamera()
  {
    $this->db->order_by('nama_kamera', 'ASC');
  	$data=$this->db->get('kamera');
  	if($data->num_rows()>0)
    {
  		foreach ($data->result_array() as $row)
			{
				$result['']= '- Pilih Kamera -';
				$result[$row['id_kamera']]= ucwords(strtolower($row['nama_kamera']));
			}
			return $result;
		}
	}

  function ambil_subkat($kat)
  {
    $this->db->where('id_kat',$kat);
  	// $this->db->order_by('judul_subkat','asc');
  	$sql_subkat=$this->db->get('subkamera');
  	if($sql_subkat->num_rows()>0)
    {
  		foreach ($sql_subkat->result_array() as $row)
      {
        $result[$row['id_subkamera']]= ucwords(strtolower($row['judul_subkamera']));
      }
      return $result;
    }
    // else
    // {
		//   $result['-']= '- Belum Ada Sub Kamera -';
		// }
    // return $result;
	}

  function ambil_subkamera($kat_id)
  {
  	$this->db->where('id_kat',$kat_id);
  	$this->db->order_by('judul_subkamera','asc');
  	$sql=$this->db->get('subkamera');
  	if($sql->num_rows()>0)
    {
  		foreach ($sql->result_array() as $row)
      {
        $result[$row['id_subkamera']]= ucwords(strtolower($row['judul_subkamera']));
      }
    }
    else
    {
		  $result['-']= '- Belum Ada SubKamera -';
		}
    return $result;
	}

  function ambil_supersubkat($subkat_id)
  {
  	$this->db->where('id_subkat',$subkat_id);

  	$sql=$this->db->get('supersubkamera');
  	if($sql->num_rows()>0)
    {
  		foreach ($sql->result_array() as $row)
      {
        $result[$row['id_supersubkamera']]= ucwords(strtolower($row['judul_supersubkamera']));
      }
    }
    else
    {
		  $result['-']= '- Belum Ada SuperSubKamera -';
		}
    return $result;
	}

  function ambil_supersubkamera($subkat_id)
  {
  	$this->db->where('id_subkat',$subkat_id);

  	$sql=$this->db->get('supersubkamera');
  	if($sql->num_rows()>0)
    {
  		foreach ($sql->result_array() as $row)
      {
        $result[$row['id_supersubkamera']]= ucwords(strtolower($row['judul_supersubkamera']));
      }
    }
    else
    {
		  $result['-']= '- Belum Ada SuperSubKamera -';
		}
    return $result;
	}

  function get_list_by_kamera($slug, $limit=null, $offset=null)
  {
    $this->db->join('kamera', 'produk.kat_id=kamera.id_kamera');
    $this->db->where('kamera.slug_kat', $slug);
    $this->db->limit($limit, $offset);

    return $this->db->get('produk');
  }

  function get_by_kamera_nr($slug)
  {
    $this->db->join('kamera', 'produk.kat_id=kamera.id_kamera');
    $this->db->where('kamera.slug_kat', $slug);

    return $this->db->get('produk')->num_rows();
  }

  function get_list_by_subkamera($slug, $limit=null, $offset=null)
  {
    $this->db->join('subkamera', 'produk.subkat_id=subkamera.id_subkamera');
    $this->db->where('subkamera.slug_subkat', $slug);
    $this->db->limit($limit, $offset);

    return $this->db->get('produk');
  }

  function get_by_subkamera_nr($slug)
  {
    $this->db->join('subkamera', 'produk.subkat_id=subkamera.id_subkamera');
    $this->db->where('subkamera.slug_subkat', $slug);

    return $this->db->get('produk')->num_rows();
  }

  function get_list_by_superskamera($slug, $limit=null, $offset=null)
  {
    $this->db->join('supersubkamera', 'produk.supersubkat_id=supersubkamera.id_supersubkamera');
    $this->db->where('supersubkamera.slug_supersubkat', $slug);
    $this->db->limit($limit, $offset);

    return $this->db->get('produk');
  }

  function get_by_superskamera_nr($slug)
  {
    $this->db->join('supersubkamera', 'produk.supersubkat_id=supersubkamera.id_supersubkamera');
    $this->db->where('supersubkamera.slug_supersubkat', $slug);

    return $this->db->get('produk')->num_rows();
  }

  function get_all_new_home()
  {
    $this->db->limit(4);
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  function get_all_kamera_sidebar()
  {
    $this->db->order_by('judul_kamera', 'asc');
    return $this->db->get($this->table)->result();
  }

  function get_total_row_kamera()
  {
    return $this->db->get($this->table)->count_all_results();
  }

  function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }

  function get_by_id_front($id)
  {
    $this->db->from('produk');
    $this->db->where('slug_subkat', $id);
    $this->db->join('subkamera', 'produk.subkat_id = subkamera.id_subkamera');
    $this->db->order_by('id_produk','desc');
    return $this->db->get();
  }

  // get total rows
  function total_rows()
  {
    return $this->db->get($this->table)->num_rows();
  }

  function insert($data)
  {
    $this->db->insert($this->table, $data);
  }

  function update($id, $data)
  {
    $this->db->where($this->id,$id);
    $this->db->update($this->table, $data);
  }

  function delete($id)
  {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }

  function del_by_id($id)
  {
    $this->db->select("foto");
    $this->db->where($this->id,$id);
    return $this->db->get($this->table)->row();
  }

}