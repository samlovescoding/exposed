<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templatecreator extends CI_Controller {
	public function create(){
        $this->view("templatecreator/create");
    }
    public function all(){
        $this->view("templatecreator/all");

    }
    
    private function view($name, $payload = []){
        if(!is_auth()){
            redirect("authentication/login");
        }
                
        if(isset($_SESSION["flash_message"])){
            $payload["success"] = $_SESSION["flash_message"];
            unset($_SESSION["flash_message"]);
        }
        
        $payload["page"] = $name;
        
        $this->load->view("dashboard/template", $payload);
    }
}
