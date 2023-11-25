<?php  

defined('BASEPATH') or exit('No direct script access allowed');
class M_perusahaan extends CI_Model 
{
    public function getPerusahaan()
    {
        $query = "SELECT `tb_tempat_rekomendasi`.*, `tb_kategori`.`kategori`
                  FROM `tb_tempat_rekomendasi`
                  JOIN `tb_kategori`
                  ON `tb_tempat_rekomendasi`.`id_kategori` = `tb_kategori`.`id`
                  ORDER BY `kategori` ASC"
                ;
        return $this->db->query($query)->result_array();
    }
    
    public function getPengajuan()
    {
        $query = "SELECT `tb_pengajuan`.*, `user`.*
                  FROM `tb_pengajuan`
                  JOIN `user`
                  ON `tb_pengajuan`.`user_id` = `user`.`id`
                  ORDER BY `user_id` ASC"
                ;
        return $this->db->query($query)->result_array();
    }

}