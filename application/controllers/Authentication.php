<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	public function index(){
        redirect('authentication/login');
	}
	public function forgot_password(){
		$payload = array();
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|max_length[50]');
		if($this->form_validation->run()){
			$username = $this->input->post("username");
			$user = $this->user->find_by_username($username);
			if($user){
				$reset_token = $this->user->get_reset_token($user);
				$this->user->log("forgot_password", $user->id);

				$to = $user->email;
				$subject = 'Expo Password Reset';
				$email = AUTH_RESET_EMAIL;
				$headers = "From: " . $email . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$message = $this->load->view("authentication/email_forgot_password", array(
					"url" => base_url("authentication/reset_password/" . $reset_token)
				), true);
				mail($to, $subject, $message, $headers);

				$payload["success"] = "Email is sent.";
			}else{
				$payload["error"] = "Username or Email was not found.";
			}
		}

		$this->load->view("authentication/head.php");
		$this->load->view("authentication/forgot_password.php", $payload);
		$this->load->view("authentication/foot.php");
	}
	public function reset_password($authentication_token = "A"){
		$payload = array();
		if(!$this->user->get_token_exists($authentication_token)){
			redirect("authentication/login");
		}
		$user = $this->user->get_token_user($authentication_token);

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[256]');

		if($this->form_validation->run()){
			$this->user->log("reset_password", $user->id);
			$password = $this->input->post("password");
			$this->user->reset_password($password, $user);
			$this->user->delete_token_user($user);
			$payload["success"] = "Password is now updated.";
		}

		$this->load->view("authentication/head.php");
		$this->load->view("authentication/reset_password.php", $payload);
		$this->load->view("authentication/foot.php");
	}
    public function login(){
		$payload = array();

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[256]');

		if($this->form_validation->run()){
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$user = $this->user->find_by_username($username);
			if($user){
				if($this->user->match_password($password, $user->password)){
					$this->user->log("login", $user->id);
					auth_persist_user($user);
					$payload["success"] = "You are logged in.";
				}else{
					$payload["error"] = "Password is incorrect.";
				}
			}else{
				$payload["error"] = "Username or email does not exist.";
			}
		}
		$this->load->view("authentication/head.php");
		$this->load->view("authentication/login.php", $payload);
		$this->load->view("authentication/foot.php");
    }
    public function register(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user_authentication.email]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash|min_length[6]|max_length[20]|is_unique[user_authentication.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[256]');

		if($this->form_validation->run()){
			$this->load->model("user");
			$name = $this->input->post("name");
			$email = $this->input->post("email");
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$this->user->insert($name, $email, $username, $password);
			$this->load->view("authentication/head.php");
			$this->load->view("authentication/register.php", array(
				"success" => "User is created"
			));
			$this->load->view("authentication/foot.php");
		}else{
			$this->load->view("authentication/head.php");
			$this->load->view("authentication/register.php");
			$this->load->view("authentication/foot.php");
		}
	}
	public function logout(){
		$this->user->log("logout", auth()->id);
		auth_abandon_user();
		redirect("authentication/login");
	}
}
