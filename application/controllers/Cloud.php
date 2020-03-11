<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cloud extends CI_Controller {
	public function shared($username, $filename)
	{
        $user = $this->user->find_by_username($username);
        if($user){
            
            $user_folder = "cdn/" . md5($user->id) . "/";
            
            if(!file_exists($user_folder)){
                mkdir($user_folder);
            }

            if(file_exists($user_folder . $filename)){
                $file = $user_folder . $filename;
                
                $this->load->helper("byteserve");
                byteserve($file);
                exit();
            }else{
                http_response_code(404);
            }
        }else{
            http_response_code(404);
        }
    }
}
