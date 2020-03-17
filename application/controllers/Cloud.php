<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('CHUNK_SIZE', 1024*1024);

function readfile_chunked($filename, $retbytes = TRUE) {
    $buffer = '';
    $cnt    = 0;
    $handle = fopen($filename, 'rb');

    if ($handle === false) {
        return false;
    }

    while (!feof($handle)) {
        $buffer = fread($handle, CHUNK_SIZE);
        echo $buffer;
        ob_flush();
        flush();

        if ($retbytes) {
            $cnt += strlen($buffer);
        }
    }

    $status = fclose($handle);

    if ($retbytes && $status) {
        return $cnt; // return num. bytes delivered like readfile() does.
    }

    return $status;
}

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
    public function movie($source){
        $this->load->model("movies");
        $movies_folder = "data/movies/";
        $filename = $this->movies->source_file($source)->original_filename;
        if(file_exists($movies_folder . $filename)){
            $file = $movies_folder . $filename;
            $mimetype = mime_content_type($file);
            header('Content-Type: '.$mimetype );
            header('Content-Length: '. filesize($file) );
            header("Content-Transfer-Encoding: binary\n");
            header("Access-Control-Allow-Origin: *");
            readfile_chunked($file);
            
        }else{
            http_response_code(404);
        }
    }
    public function movie_original($source){
        $this->load->model("movies");
        $movies_folder = "data/movies/";
        $filename = $this->movies->source_file($source)->original_filename;
        if(file_exists($movies_folder . $filename)){
            $file = $movies_folder . $filename;
            header("Location: http://samlovescoding.com/" . $file);
            
        }else{
            http_response_code(404);
        }
    }
}
