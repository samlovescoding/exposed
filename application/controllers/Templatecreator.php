<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templatecreator extends CI_Controller {
	public function create(){
        auth_can("templates creator", "/dashboard");

        $this->form_validation->set_rules("title", "Title", "trim|required");
        $this->form_validation->set_rules("description", "Description", "trim|required");
        $this->form_validation->set_rules("screenshot", "Screenshot", "trim|required");
        $this->form_validation->set_rules("source", "Source", "trim|required");
        $this->form_validation->set_rules("links", "Links", "trim|required");
        $this->form_validation->set_rules("file", "File", "trim|required");

        if($this->form_validation->run()){
            $title = $this->input->post("title");
            $description = $this->input->post("description");
            $screenshot = $this->input->post("screenshot");
            $source = $this->input->post("source");
            $links = $this->input->post("links");
            $file = $this->input->post("file");

            $this->load->model("template");
            $this->template->create($title, $description, $screenshot, $source, $links, $file);
            $_SESSION["flash_message"] = "New template has been added.";
            redirect("templatecreator/all");
        }

        $this->view("templatecreator/create");
    }
    public function all(){
        auth_can("templates creator", "/dashboard");
        $payload = [];
        
        $this->load->model("template");

        $payload["templates"] = $this->template->all();

        $this->view("templatecreator/all", $payload);
    }
    public function delete($id){
        auth_can("templates creator", "/dashboard");

        $this->load->model("template");
        $this->template->delete($id);
        redirect("templatecreator/all");
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
