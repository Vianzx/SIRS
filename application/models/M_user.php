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

//     public function getPengajuan()
//     {
//         $query = "SELECT `tb_pengajuan`.*, `tb_siswa`.*, `tb_kelas`.`nama_kelas`,`tb_jurusan`.`nama_panjang`
//                   FROM `tb_pengajuan`
//                   JOIN `tb_siswa`
//                   ON `tb_pengajuan`.`id_siswa` = `tb_siswa`.`id`
//                   JOIN `tb_kelas`
//                   ON `tb_pengajuan`.`id_kelas` = `tb_kelas`.`id`
//                   JOIN `tb_siswa`
//                   ON `tb_pengajuan`.`id_jurusan` = `tb_jurusan`.`id`
//                   ORDER BY `nis` ASC"
//                 ;
//         return $this->db->query($query)->result_array();
//     }

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