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

    public function getPermintaan()
    {  
        $query = "SELECT pengajuan.id as id_pengajuan,`pengajuan`.*, `siswa`.*, kelas.nama_kelas, `pengajaran`.*
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

    public function waiting()
    {
        $query = "SELECT `pengajuan`.*, `kelas`.`nama_kelas`, `siswa`.*
                  FROM `pengajuan`
                  JOIN `siswa`
                  ON `pengajuan`.`siswa_id` = `siswa`.`id`
                  JOIN `kelas`
                  ON `siswa`.`kelas_id` = `kelas`.`id`
                  ORDER BY `siswa_id` ASC"
                ;
        return $this->db->query($query)->result_array();
    }

    public function proses()
    {
        $query = "SELECT `laporan`.*, `siswa`.*, `kelas`.`nama_kelas`
                  FROM `laporan`
                  JOIN `siswa`
                  ON `laporan`.`siswa_id` = `siswa`.`id`
                  JOIN `kelas`
                  ON `siswa`.`kelas_id` = `kelas`.`id`
                  ORDER BY `siswa_id` ASC"
                ;
        return $this->db->query($query)->result_array();
    }
}