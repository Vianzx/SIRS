<?php  

defined('BASEPATH') or exit('No direct script access allowed');
class M_user extends CI_Model 
{
    public function getPengajuan()
    {
        $query = "SELECT `pengajuan`.*, `mapel`.`nama_mapel`, `siswa`.*
                  FROM `pengajuan`
                  JOIN `mapel`
                  ON `pengajuan`.`mapel_id` = `mapel`.`id`
                  JOIN `siswa`
                  ON `pengajuan`.`nis` = `siswa`.`id`
                  ORDER BY `nama_mapel` ASC"
                ;
        return $this->db->query($query)->result_array();
    }
}