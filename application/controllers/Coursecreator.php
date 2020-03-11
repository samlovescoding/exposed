<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Coursecreator extends CI_Controller {
    public function all(){
        auth_can("course creator", "/dashboard");
        $payload = [];

        $this->load->model("course");
        $payload["courses"] = $this->course->all();

        $this->view("coursecreator/all", $payload);
    }
    public function delete($id){
        auth_can("course creator", "/dashboard");
        
        $this->load->model("course");
        $this->course->delete($id);
        
        $_SESSION["flash_message"] = "Course was deleted successfully";
        redirect("coursecreator/all");
    }
	public function create(){
        auth_can("course creator", "/dashboard");
        $payload = [];

        $this->form_validation->set_rules("title", "Title", "trim|required");
        $this->form_validation->set_rules("description", "Description", "trim|required");
        $this->form_validation->set_rules("publisher", "Publisher", "trim|required");
        $this->form_validation->set_rules("instructor", "Instructor", "trim|required");

        if($this->form_validation->run()){
            $title = $this->input->post("title");
            $description = $this->input->post("description");
            $publisher = $this->input->post("publisher");
            $instructor = $this->input->post("instructor");

            $this->load->model("course");
            $this->course->create($title, $description, $publisher, $instructor);

            $_SESSION["flash_message"] = "Course has been created.";
            redirect("coursecreator/all");
        }

		$this->view('coursecreator/create_course', $payload);
    }
    public function modules($id){
        auth_can("course creator", "/dashboard");
        $payload = [];

        $this->load->model("course");

        $this->form_validation->set_rules("title", "Title", "trim|required");
        if($this->form_validation->run()){
            $title = $this->input->post("title");
            $this->course->module_create($title, $id);
        }

        $payload["course"] = $this->course->find($id);
        $payload["modules"] = $this->course->modules($id);

        $this->view("coursecreator/modules", $payload);
    }
    public function module_delete($id){
        auth_can("course creator", "/dashboard");
        
        $this->load->model("course");
        $module = $this->course->module_find($id);
        $this->course->module_delete($id);
        
        $_SESSION["flash_message"] = "Module was deleted successfully";
        redirect("coursecreator/modules/" . $module->course);
    }
    public function articles($course_id, $module_id){
        auth_can("course creator", "/dashboard");
        $payload = [];

        $this->load->model("course");
        $payload["course"] = $this->course->find($course_id);
        $payload["module"] = $this->course->module_find($module_id);

        $this->form_validation->set_rules("title", "Title", "trim|required");
        $this->form_validation->set_rules("video", "Title", "trim|required");
        $this->form_validation->set_rules("description", "Title", "trim|required");
        $this->form_validation->set_rules("resource", "Title", "trim|required");
        if($this->form_validation->run()){
            $title = $this->input->post("title");
            $video = $this->input->post("video");
            $description = $this->input->post("description");
            $resource = $this->input->post("resource");
            $this->course->article_create($title, $payload["module"]->id, $payload["course"]->id, $video, $description, $resource);
            $payload["success"] = "Article has been added.";
        }


        $payload["articles"] = $this->course->articles($module_id);

        $this->view("coursecreator/articles" , $payload);
    }
    public function article_delete($id){
        auth_can("course creator", "/dashboard");
        
        $this->load->model("course");
        $article = $this->course->article_find($id);
        $this->course->article_delete($id);
        
        $_SESSION["flash_message"] = "Article was deleted successfully";
        redirect("coursecreator/articles/" . $article->course . "/" . $article->module);
    }
    public function edit_article_video($id){
        $this->load->model("course");

        $this->form_validation->set_rules("video", "Video", "trim|required");
        $article = $this->course->article_find($id);
        if($this->form_validation->run()){
            $video = $this->input->post("video");
            $this->course->article_edit("video", $video, $id);
            $_SESSION["flash_message"] = "Video for the article {$article->id}. {$article->title} was updated.";
        }else{
            $_SESSION["flash_message"] = "Error in updating video.";
        }
        redirect("coursecreator/articles/" . $article->course . "/" . $article->module);
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
