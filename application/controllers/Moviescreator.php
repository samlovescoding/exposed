<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moviescreator extends CI_Controller {

    public function all(){
        auth_can("movies creator", "/dashboard");
        $payload = [];
        
        $this->load->model("movies");

        $payload["movies"] = $this->movies->all();

        $this->view("moviescreator/all", $payload);
    }

    public function sources($id){
        auth_can("movies creator", "/dashboard");
        $payload = [];
        
        $this->load->model("movies");

        $this->form_validation->set_rules("resolution", "resolution", "trim|required");
        $this->form_validation->set_rules("filename", "filename", "trim|required");
        $this->form_validation->set_rules("original_filename", "original_filename", "trim|required");

        if($this->form_validation->run()){
            $resolution = $this->input->post("resolution");
            $filename = $this->input->post("filename");
            $original_filename = $this->input->post("original_filename");
            $meta = "";

            $ext = pathinfo($original_filename, PATHINFO_EXTENSION);
            $filename = $filename . "." . $ext;

            $this->movies->source_create($id, $resolution, $meta, $filename, $original_filename);
            $payload["success"] = "Movie source has been added.";
        }

        $payload["movie"] = $this->movies->find($id);
        $payload["sources"] = $this->movies->source_all($id);

        $this->view("moviescreator/sources", $payload);
    }
    public function delete_source($id, $movie_id){
        auth_can("movies creator", "/dashboard");

        $this->load->model("movies");
        $this->movies->source_delete($id);
        redirect("moviescreator/sources/" . $movie_id);
    }

    public function delete($id){
        auth_can("movies creator", "/dashboard");

        $this->load->model("movies");
        $this->movies->delete($id);
        redirect("moviescreator/all");
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
