<?php
class User extends CI_Model{
    public $name;
    public $username;
    public $email;
    public $password;
    public $role;
    public $date_created;

    public function find($id, $get_permissions = true){
        $query = $this->db->where("id", $id);
        $matching_users = $query->count_all_results("user_authentication", false);
        if($matching_users == 1){
            $user = $query->get()->row();
            if($get_permissions){
                $user->permissions = $this->get_permissions($user);
            }
            return $user;
        }else{
            return false;
        }
    }

    public function find_all($db = null){
        if(!isset($db)){
            $db = $this->db;
        }
        $query = $db->get("user_authentication")->result();
        $users = [];
        foreach ($query as $row) {
            $row->permissions = $this->get_permissions($row);
            $users[$row->id] = $row;
        }
        return $users;
    }

    public function find_by_name($name, $get_permissions = true){
        $query = $this->db->like("name", $name)->get("user_authentication");
        $matching_users = $query->num_rows();
        if($matching_users == 1){
            $user = $query->row();
            if($get_permissions){
                $user->permissions = $this->get_permissions($user);
            }
            return $user;
        }else{
            return false;
        }
    }

    public function change_password($old_password, $new_password, $user){
        if(password_verify($old_password, $user->password)){
            $this->db->update("user_authentication", array(
                "password" => password_hash($new_password, PASSWORD_DEFAULT)
            ), array(
                "id" => $user->id
            ));
            return true;
        }else{
            return false;
        }
    }

    public function get_permissions($user){
        $permissions_of_user = array();
        $roles = $this->db->where("id", $user->role)->get("user_roles")->result();
        $permissions = $this->list_all_permissions();
        $roles_permissions = $this->db->where("role", $user->role)->get("user_roles_permissions")->result();
        foreach ($roles_permissions as $role_permission) {
            $permissions_of_user[] = $permissions[$role_permission->permission]->name;
        }
        return $permissions_of_user;
    }

    public function find_by_username($username, $get_permissions = true){
        $query = $this->db->where("username", $username)->or_where("email", $username);
        $matching_users = $query->count_all_results("user_authentication", false);
        if($matching_users == 1){
            $user = $query->get()->row();
            if($get_permissions){
                $user->permissions = $this->get_permissions($user);
            }
            return $user;
        }else{
            return false;
        }
    }

    public function list(){
        $query = $this->db->get("user_authentication");
        return $query->result();
    }

    public function match_password($password, $password_hash){
        return password_verify($password, $password_hash);
    }

    public function insert($name, $email, $username, $password, $role = AUTH_DEFAULT_ROLE){
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->role = $role;
        $this->date_created = date("Y-m-d H:i:s");        
        $this->db->insert("user_authentication", $this);
    }

    public function update($id, $key, $value){
        $this->db->update("user_authentication", array(
            $key => $value
        ) , array(
            "id" => $id
        ));
    }

    public function logs($user_id){
        return $this->db->order_by("date_logged", 'DESC')->where("user", $user_id)->get("user_logs")->result();
    }

    public function get_reset_token($user){
        $token = md5(rand(0, 100000) . time());
        $this->db->delete("user_authentication_tokens", array(
            "user" => $user->id
        ));
        $this->db->insert("user_authentication_tokens", array(
            "token" => $token,
            "user" => $user->id,
            "date_created" => date("Y-m-d H:i:s"),
            "date_verified" => null
        ));
        return $token;
    }

    public function get_token_exists($token){
        $results = $this->db->where("token", $token)->count_all_results("user_authentication_tokens");
        if($results == 1){
            return true;
        }else{
            return false;
        }
    }

    public function get_token_user($token){
        $token = $this->db->where("token", $token)->get("user_authentication_tokens")->row();
        return $this->db->where("id", $token->user)->get("user_authentication")->row();
    }

    public function reset_password($password, $user){
        $this->db->update("user_authentication", array(
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ), array(
            "id" => $user->id
        ));
    }

    public function delete_token_user($user){
        $this->db->delete("user_authentication_tokens", array(
            "user" => $user->id
        ));
    }

    public function find_detail($id){
        return $this->db->where("id", $id)->get("user_details")->row();
    }

    public function insert_detail($name, $type, $meta){
        $this->db->insert("user_details", array(
            "name" => $name,
            "type" => $type,
            "meta" => $meta
        ));
    }

    public function get_info($user){
        $details = $this->list_all_details();
        if(empty($details)) return array();
        $detail_ids = array();
        foreach ($details as $detail) {
            $detail_ids[] = $detail->id;
        }
        $information_raw = $this->db->where_in("detail", $detail_ids)->where("user", $user->id)->get("user_information")->result();
        $information = array();
        foreach ($information_raw as $data) {
            $information[$data->detail] = $data;
        }
        return $information;
    }

    public function has_info($detail, $user){
        $results = $this->db->where("detail", $detail)->where("user", $user->id)->count_all_results("user_information");
        if($results == 0){
            return false;
        }else{
            return true;
        }
    }

    public function insert_info($detail, $info, $user){
        $this->db->insert("user_information", array(
            "detail" => $detail,
            "information" => $info,
            "user" => $user->id,
            "date_modified" => date("Y-m-d H:i:s"),
            "date_created" => date("Y-m-d H:i:s")
        ));
    }

    public function update_info($detail, $info, $user){
        $this->db->update("user_information", array(
            "information" => $info,
            "date_modified" => date("Y-m-d H:i:s")
        ), array(
            "detail" => $detail,
            "user" => $user->id
        ));
    }
    
    public function delete_detail($id){
        $this->db->delete("user_details", array(
            "id" => $id
        ));

        $this->db->delete("user_information", array(
            "detail" => $id
        ));
    }

    public function list_all_details(){
        $query = $this->db->get("user_details");
        $details = array();
        foreach ($query->result() as $row) {
            $details[$row->id] = $row;
        }
        return $details;
    }

    public function insert_permission($permission_name){
        $this->db->insert("user_permissions", array(
            "name" => $permission_name
        ));
    }

    public function delete_permission($id){
        $this->db->delete("user_roles_permissions", array(
            "permission" => $id
        ));
        $this->db->delete("user_permissions", array(
            "id" => $id
        ));        
    }

    public function list_all_permissions(){
        $query = $this->db->get("user_permissions");
        $permissions = array();
        foreach ($query->result() as $row) {
            $permissions[$row->id] = $row;
        }
        return $permissions;
    }

    public function insert_role($name, $parent){
        $query = $this->db->insert("user_roles", array(
            "name" => $name,
            "parent" => $parent
        ));
    }

    public function delete_role($id){
        $this->db->delete("user_roles", array(
            "id" => $id
        ));
    }

    public function make_role_default($id){
        $current_default_role = $this->db->where("id", AUTH_DEFAULT_ROLE)->get("user_roles");
        $candidate_role = $this->db->where("id", $id)->get("user_roles");
        if($current_default_role->num_rows() == 1){
            $this->db->update("user_roles", array("id" => -1), array("id" => AUTH_DEFAULT_ROLE));
            $this->db->update("user_roles", array("id" => AUTH_DEFAULT_ROLE), array("id" => $id));
            $this->db->update("user_roles", array("id" => $id), array("id" => -1));
        }else{
            $this->db->update("user_roles", array("id" => AUTH_DEFAULT_ROLE), array("id" => $id));
        }
    }

    public function list_all_roles(){
        $query = $this->db->get("user_roles");
        $roles = array();
        $role_links = $this->list_all_roles_links();
        foreach ($query->result() as $row) {
            $roles[$row->id] = $row;
            if(in_array($row->id, array_keys($role_links))){
                $roles[$row->id]->permissions = $role_links[$row->id];
            }else{
                $roles[$row->id]->permissions = array();
            }
        }
        return $roles;
    }

    public function update_role_permissions($role, $permissions){
        $this->db->delete("user_roles_permissions", array(
            "role" => $role
        ));
        foreach ($permissions as $permission) {
            $this->db->insert("user_roles_permissions", array(
                "role" => $role,
                "permission" => $permission
            ));
        }
    }

    public function list_all_roles_links(){
        $query = $this->db->get("user_roles_permissions");
        $roles_permissions = array();
        foreach ($query->result() as $row) {
            $roles_permissions[$row->role][] = $row->permission;
        }
        return $roles_permissions;
    }

    public function log($message, $user_id, $type = "auth"){
        $this->db->insert("user_logs", array(
            "type" => $type,
            "message" => $message,
            "user" => $user_id,
            "ip_address" => $_SERVER['REMOTE_ADDR'],
            "date_logged" => date("Y-m-d H:i:s")
        ));
        
    }
}

function auth_can($permission, $else_redirect_to){
    if(!in_array($permission, auth()->permissions)){
        $_SESSION["flash_message"] = "You do not have permission to access the page.";
        redirect($else_redirect_to);
    }
}

function auth_has($permission){
    if(!in_array($permission, auth()->permissions)){
        return true;
    }else{
        return false;
    }
}

function auth_has_all(){
    $user = auth();
    foreach (func_get_args() as $permission) {
        if(!in_array($permission, $user->permissions)){
            return false;
        }
    }
    return true;
}

function auth_persist_user($user){
    $_SESSION["persist_user"] = $user;
}

function is_auth(){
    if(isset($_SESSION["persist_user"])){
        return true;
    }else{
        return false;
    }
}

function auth(){
    if(isset($_SESSION["persist_user"])){
        return $_SESSION["persist_user"];
    }else{
        return false;
    }
}

function auth_abandon_user(){
    unset($_SESSION["persist_user"]);
}