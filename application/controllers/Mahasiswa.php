<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Mahasiswa extends Server {


	//buat fungsi "GET"
    function service_get()
    {
        //panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa","mdl",TRUE);

        //panggil fungsi "get_data"
        $this->mdl->get_data();

        //memberikan response
        $this->response(array("mahasiswa" => 
        $hasil),200);
    }
    //buat fungsi "POST"
    function service_post()
    {
        // panggil model "Mmahasiswa'
        $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil parameter data yang akan diisi
        $data = array(
            "npm" =>$this->post("npm"),
            "nama" =>$this->post("nama"),
            "telepon" =>$this->post("telepon"),
            "jurusan" =>$this->post("jurusan"),
            "token" => base64_encode($this->post("npm")),
        );
        // panggil method "save data"
        $hasil = $this->mdl->save_data(
            $data["npm"], $data["nama"], 
            $data["telepon"], $data["jurusan"], 
            $data["token"]);
        // jika hasil = 0
        if($hasil == 0)
        {
            $this->response(array("status" => "Data Mahasiswa Berhasil Disimpan"),200);
        }
        // jika hasil ! = 0
        else
        {
            $this->response(array("status" => "Data Mahasiswa Gagal Disimpan !"),200);
        }
    }
    //buat fungsi "PUT"
    function service_put()
    {

    }
    //buat service "DELETE"
    function service_delete()
    {
        //panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa","mdl",TRUE);
        //ambil parameter token "(NPM)"
        $token = $this->delete("npm");
        //panggil fungsi "delete_data"
        $hasil = $this->mdl->delete_data(base64_encode($token));
        //jika proses delete berhasil
        if($hasil == 1)
        {
            $this->repsonse(array("status" => "Data Mahasiswa Berhasil Dihapus"),200);
        } 
        //jika proses delete gagal
        else
        {
            $this->repsonse(array("status" => "Data Mahasiswa Gagal Dihapus !"),200);
        }

    }
}
