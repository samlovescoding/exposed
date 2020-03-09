<?php

    class Dashboard extends CI_Controller{
        public function index(){
            $this->view("dashboard/index");
        }

        public function cloud(){
            auth_can("cloud", "/dashboard");

            $user_folder = "cdn/" . md5(auth()->id) . "/";
            if(!file_exists($user_folder)){
                mkdir($user_folder);
            }

            $this->view("dashboard/cloud");
        }
        public function cloud_upload(){
            auth_can("cloud", "/dashboard");
            function verbose($ok=1,$info=""){
                if ($ok==0) { http_response_code(400); }
                die(json_encode(["ok"=>$ok, "info"=>$info]));
            }

            if (empty($_FILES) || $_FILES['file']['error']) {
                verbose(0, "Failed to move uploaded file.");
            }

            $filePath = "cdn/" . md5(auth()->id);

            if (!file_exists($filePath)) { 
                if (!mkdir($filePath, 0777, true)) {
                    verbose(0, "Failed to create $filePath");
                }
            }
            $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];
            $filePath = $filePath . DIRECTORY_SEPARATOR . $fileName;

            $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
            $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
                $in = @fopen($_FILES['file']['tmp_name'], "rb");
                if ($in) {
                    while ($buff = fread($in, 4096)) { fwrite($out, $buff); }
                } else {
                    verbose(0, "Failed to open input stream");
                }
                @fclose($in);
                @fclose($out);
                @unlink($_FILES['file']['tmp_name']);
            } else {
                verbose(0, "Failed to open output stream");
            }

            if (!$chunks || $chunk == $chunks - 1) {
                rename("{$filePath}.part", $filePath);
            }
            verbose(1, "Upload OK");
        }

        public function taxonomy(){
            auth_can("taxonomy", "/dashboard");
            $this->load->model("taxonomy");

            $payload = [];

            if(isset($_POST["category_label"])){
                $this->form_validation->set_rules('category_label', 'Category Label', 'trim|required|min_length[3]|max_length[256]|is_unique[taxonomy.name]');
                if($this->form_validation->run()){
                    $label = $this->input->post("category_label");
                    $this->taxonomy->create($label);
                    $payload["success"] = "Category {$label} was successfully created.";
                }
            }
            if(isset($_POST["category_parent"])){
                $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|min_length[3]|max_length[256]|is_unique[taxonomy_category.name]');
                $this->form_validation->set_rules('category_parent', 'Category Parent', 'trim|required');
                if($this->form_validation->run()){
                    $name = $this->input->post("category_name");
                    $parent = $this->input->post("category_parent");
                    $this->taxonomy->create_category($name, $parent);
                    $payload["success"] = "Category {$name} has been successfully added.";
                }
            }
            if(isset($_POST["category_delete"])){
                $id = $this->input->post("category_delete");
                $this->taxonomy->delete_category($id);
                $payload["success"] = "Category has been successfully deleted.";
            }
            if(isset($_POST["delete"])){
                $id = $this->input->post("delete");
                $this->taxonomy->delete($id);
                $payload["success"] = "Label has been successfully deleted.";
            }

            $payload["taxonomy"] = $this->taxonomy->list_all_types();

            $this->view("dashboard/taxonomy", $payload);
        }

        public function profile(){
            $payload = array();

            $details = $this->user->list_all_details();
            $payload["details"] = $details;

            $information = $this->user->get_info(auth());
            $payload["information"] = $information;

            $this->view("dashboard/profile", $payload);
        }

        public function profile_update($detail_id){
            $_SESSION["flash_message"] = "Your profile has been updated.";
            
            $detail = $this->user->find_detail($detail_id);

            $info = "";

            switch ($detail->type) {
                case 'image':

                    $config['upload_path']          = './uploads/profile/' . auth()->id . "/";
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 1000 * 20;
                    $config['max_width']            = 1920;
                    $config['max_height']           = 1920;

                    if (!file_exists($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, true);
                    }

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('detail_data')){
                            $_SESSION["flash_message"] = $this->upload->display_errors();
                    }else{
                            $upload_information = $this->upload->data();
                            $info = $upload_information["file_name"];
                            $_SESSION["flash_message"] = "The image has been uploaded successfully.";
                    }
                    break;

                    case 'file':

                        $config['upload_path']          = './uploads/profile/' . auth()->id . "/";
                        $config['allowed_types']        = "*";
                        $config['max_size']             = 1000 * 20;
    
                        if (!file_exists($config['upload_path'])) {
                            mkdir($config['upload_path'], 0777, true);
                        }
    
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('detail_data')){
                                $_SESSION["flash_message"] = $this->upload->display_errors();
                        }else{
                                $upload_information = $this->upload->data();
                                $info = $upload_information["file_name"];
                                $_SESSION["flash_message"] = "The file has been uploaded successfully.";
                        }
                        break;
                
                default:
                    $info = $this->input->post("detail_data");
                    break;
            }
            $user = auth();
            if($this->user->has_info($detail->id, $user)){
                $this->user->update_info($detail->id, $info, $user);
            }else{
                $this->user->insert_info($detail->id, $info, $user);
            }

            redirect("dashboard/profile");
        }

        public function change_password(){
            $payload = array();

            $this->form_validation->set_rules('old_password', 'Current Password', 'trim|required|min_length[8]|max_length[256]');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[8]|max_length[256]');

            if($this->form_validation->run()){
                $old_password = $this->input->post("old_password");
                $new_password = $this->input->post("new_password");
                
                if($this->user->change_password($old_password, $new_password, auth())){
                    $payload["success"] = "Your password is changed.";
                    $user = $this->user->find(auth()->id);
                    auth_persist_user($user);
                }else{
                    $payload["error"] = "Current Password you entered is incorrect.";
                }
                
            }

            $this->view("dashboard/change_password", $payload);
        }

        public function user_logs($user_id){
            auth_can("user logs", "/dashboard");

            $payload = array();

            $logs = $this->user->logs($user_id);
            $payload["logs"] = $logs;

            $payload["title"] = "User Logs";

            $this->view("dashboard/user_logs", $payload);
        }

        public function user_details(){
            auth_can("user details", "/dashboard");

            $payload = array();

            $this->form_validation->set_rules('detail_name', 'Detail Name', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('detail_type', 'Detail Type', 'trim|required|in_list[text,textarea,image,file,link,email,password,bool,select,date,time,datetime]');
            $this->form_validation->set_rules('detail_meta', 'Detail Meta', 'trim');

            if($this->form_validation->run()){
                $name = $this->input->post("detail_name");
                $type = $this->input->post("detail_type");
                $meta = $this->input->post("detail_meta");

                $this->user->insert_detail($name, $type, $meta);
                
                $payload["success"] = "New detail has been added successfully.";
            }

            $details = $this->user->list_all_details();
            $payload["details"] = $details;

            $payload["title"] = "User Details Table";

            $this->view("dashboard/user_details", $payload);
        }

        public function user_detail_delete($id){
            auth_can("user details", "/dashboard");

            $this->user->delete_detail($id);
            redirect("dashboard/user_details/");
        }

        public function user_permission_delete($id){
            auth_can("user permissions", "/dashboard");

            $this->user->delete_permission($id);
            redirect("dashboard/user_permissions/");
        }

        public function user_permissions(){
            auth_can("user permissions", "/dashboard");

            $payload = array();

            $this->form_validation->set_rules('permission_name', 'Permission Name', 'trim|required|min_length[4]|max_length[50]');

            if($this->form_validation->run()){
                $permission_name = $this->input->post("permission_name");
                $this->user->insert_permission($permission_name);
                $payload["success"] = "New permission has been added successfully.";
            }

            $permissions = $this->user->list_all_permissions();
            $payload["permissions"] = $permissions;

            $payload["title"] = "User Permissions Table";

            $this->view("dashboard/user_permissions", $payload);
        }

        public function user_roles(){
            auth_can("user roles", "/dashboard");

            $payload = array();

            $this->form_validation->set_rules('role_name', 'Role Name', 'trim|required|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('role_parent', 'Role Parent Name', 'trim|required|numeric');

            if($this->form_validation->run()){
                $role_name = $this->input->post("role_name");
                $role_parent = $this->input->post("role_parent");
                $this->user->insert_role($role_name, $role_parent);
                $payload["success"] = "New role has been added successfully.";
            }

            $permissions = $this->user->list_all_permissions();
            $payload["permissions"] = $permissions;

            $roles = $this->user->list_all_roles();
            $payload["roles"] = $roles;

            $roles_links = $this->user->list_all_roles_links();
            $payload["roles_links"] = $roles_links;

            $payload["title"] = "User Roles Table";

            $this->view("dashboard/user_roles", $payload);
        }

        public function user_role_permissions($role){
            auth_can("user roles", "/dashboard");

            $permissions = $this->input->post("permissions");
            $this->user->update_role_permissions($role, $permissions);
            $this->session->flash_message = 'Permissions have been updated successfully.';

            redirect("dashboard/user_roles");
        }

        public function user_role_default($id){
            auth_can("user roles", "/dashboard");

            $this->user->make_role_default($id);
            redirect("dashboard/user_roles/");
        }

        public function user_role_delete($id){
            auth_can("user roles", "/dashboard");

            $this->user->delete_role($id);
            redirect("dashboard/user_roles/");
        }

        public function user_role_update($id){
            auth_can("user management", "/dashboard");
            $role = $this->input->post("user_role");
            $this->user->update($id, "role", $role);
            $_SESSION["flash_message"] = "User role has been updated.";
            redirect("dashboard/user_management/");
        }

        public function user_management(){
            auth_can("user management", "/dashboard");

            $users = [];
            $has_search = false;
            if(isset($_POST["user_search_by_username"])){
                $username = $_POST["user_search_by_username"];
                $user = $this->user->find_by_username($username);
                if($user != false){
                    $users[] = $this->user->find_by_username($username);
                }
                $has_search = true;
            }
            if(isset($_POST["user_search_by_email"])){
                $email = $_POST["user_search_by_email"];
                $user = $this->user->find_by_username($email);
                if($user != false){
                    $users[] = $this->user->find_by_username($email);
                }
                $has_search = true;
            }
            if(isset($_POST["user_search_by_name"])){
                $name = $_POST["user_search_by_name"];
                $user = $this->user->find_by_name($name);
                if($user != false){
                    $users[] = $this->user->find_by_name($name);
                }
                $has_search = true;
            }
            if(isset($_POST["user_search_all"])){
                $users = $this->user->find_all();
                $has_search = true;
            }

            $roles = $this->user->list_all_roles();

            $this->view("dashboard/user_management", compact("users", "roles", "has_search"));
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