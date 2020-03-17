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

            $screenshot = "default.jpg";

            if(isset($_FILES["screenshot"])){
                $file = $_FILES["screenshot"];
                $filename = md5(time().rand(0,10000));

                move_uploaded_file($file["tmp_name"], FCPATH . "data/course_previews/" . $filename . ".jpg");
                if(file_exists(FCPATH . "data/course_previews/" . $filename . ".jpg")){
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = FCPATH . "data/course_previews/" . $filename . ".jpg";
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 640;
                    $config['height']       = 360;
                    $this->load->library('image_lib', $config);
                    if ( ! $this->image_lib->resize())
                    {
                            echo $this->image_lib->display_errors();
                            die();
                    }
                    $screenshot = $filename;
                }else{
                    $screenshot = "default.jpg";
                }
            }

            $this->load->model("course");
            $this->course->create($title, $description, $publisher, $instructor, $screenshot);

            $_SESSION["flash_message"] = "Course has been created.";
            redirect("coursecreator/all");
        }

		$this->view('coursecreator/create_course', $payload);
    }
    public function update_course($id, $key){
        if($key != "preview"){
            $this->db->update("course", array(
                $key => $this->input->post($key)
            ), compact("id"));
        }else{
            $course = $this->db->where(compact("id"))->get("course")->row();
            $screenshot = $course->preview;
            
            if(isset($_FILES["preview"])){
                $file = $_FILES["preview"];
                $filename = md5(time().rand(0,10000));

                move_uploaded_file($file["tmp_name"], FCPATH . "data/course_previews/" . $filename . ".jpg");
                if(file_exists(FCPATH . "data/course_previews/" . $filename . ".jpg")){
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = FCPATH . "data/course_previews/" . $filename . ".jpg";
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 640;
                    $config['height']       = 360;
                    $this->load->library('image_lib', $config);
                    if ( ! $this->image_lib->resize())
                    {
                            echo $this->image_lib->display_errors();
                            die();
                    }
                    $screenshot = $filename;
                }else{
                    $screenshot = $course->preview;
                }
            }
        }
        $this->db->update("course", array(
            "preview" => $screenshot
        ), compact("id"));
        redirect("coursecreator/modules/" . $id);
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
        $this->form_validation->set_rules("video", "Video", "trim|required");
        $this->form_validation->set_rules("description", "Description", "trim");
        $this->form_validation->set_rules("resource", "Resource", "trim");
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
