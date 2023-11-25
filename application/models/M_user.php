<?php  

defined('BASEPATH') or exit('No direct script access allowed');
class M_user extends CI_Model 
{
    public function getGuru()
    {
        $query = "SELECT `guru`.*, `mapel`.`nama_mapel`
                  FROM `guru`
                  JOIN `mapel`
                  ON `guru`.`mapel_id` = `mapel`.`id`
                  ORDER BY `username` ASC"
                ;
        return $this->db->query($query)->result_array();
    }

    public function getSiswa()
    {
        $query = "SELECT `siswa`.*, `kelas`.`nama_kelas`
                  FROM `siswa`
                  JOIN `kelas`
                  ON `siswa`.`kelas_id` = `kelas`.`id`
                  ORDER BY `username` ASC"
                ;
        return $this->db->query($query)->result_array();
    }
    
    public function getPengajaran()
    {
        $query = "SELECT `pengajaran`.*, `kelas`.`nama_kelas`, `mapel`.`nama_mapel`, `guru`.*
                  FROM `pengajaran`
                  JOIN `kelas`
                  ON `pengajaran`.`kelas_id` = `kelas`.`id`
                  JOIN `mapel`
                  ON `pengajaran`.`mapel_id` = `mapel`.`id`
                  JOIN `guru`
                  ON `pengajaran`.`guru_id` = `guru`.`id`
                  ORDER BY `username` ASC"
                ;
        return $this->db->query($query)->result_array();
    }

    public function getPengajuan()
    {  
        $query = "SELECT `pengajuan`.*, `siswa`.*, `mapel`.`nama_mapel`
                  FROM `pengajuan`
                  JOIN `siswa`
                  ON `pengajuan`.`siswa_id` = `siswa`.`id`
                  JOIN `pengajaran`
                  ON `pengajuan`.`pengajaran_id` = `pengajaran`.`id`
                  JOIN `mapel`
                  ON `pengajaran`.`mapel_id` = `mapel`.`id`
                  ORDER BY `nama_mapel` ASC";
        $data = $this->db->query($query)->result_array();
        return $data;
    }

    public function getPermintaan($user)
    {  
        $query = "SELECT `pengajuan`.*, `siswa`.*, kelas.nama_kelas
                  FROM `pengajuan`
                  JOIN `siswa`
                  ON `pengajuan`.`siswa_id` = `siswa`.`id`
                  JOIN `pengajaran`
                  ON `pengajuan`.`pengajaran_id` = `pengajaran`.`id`
                  JOIN `kelas`
                  ON siswa.kelas_id = kelas.id
                  ORDER BY `name` ASC"
                ;
        $data = $this->db->query($query)->result_array();
        return $data;
    }

//     public function getTempatSiswa()
//     {
//         $query = "SELECT `tb_tempat_siswa`.*, `tb_siswa`.*
//                   FROM `tb_tempat_siswa`
//                   JOIN `tb_siswa`
//                   ON `tb_tempat_siswa`.`id_siswa` = `tb_siswa`.`id`
//                   ORDER BY `nis` ASC"
//                 ;
//         return $this->db->query($query)->result_array();
//     }
}