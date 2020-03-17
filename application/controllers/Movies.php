<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movies extends CI_Controller {
	public function index()
	{
		$this->out($this->db->get("tmdb_movies")->result());
    }
    
    public function out($data, $success = true, $errors = []){
        header("Content-Type:application/json");
        if($success)
            echo json_encode(array(
                "data" => $data,
                "success" => $success
            ));
        else
            echo json_encode(array(
                "success" => false,
                "errors" => $errors
            ));
    }
}
