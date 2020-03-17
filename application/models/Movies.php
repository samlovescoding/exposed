<?php

    class Movies extends CI_Model{
        public function find($id){
            return $this->db->where("id", $id)->get("tmdb_movies")->row();
        }
        public function all(){
            return $this->db->get("tmdb_movies")->result();
        }
        public function delete($id){
            $this->db->delete("tmdb_movies", compact(id));
        }


        public function source_find($id){
            return $this->db->where("id", $id)->get("sources")->row();
        }
        public function source_create($link_id, $resolution, $meta, $filename, $original_filename){
            
            $this->db->insert("sources", array_merge(array(
                "link_type" => "movie"
            ), compact("link_id", "resolution", "meta", "filename", "original_filename")));
        }
        public function source_all($id){
            return $this->db->where("link_id", $id)->where("link_type", "movie")->get("sources")->result();
        }
        public function source_delete($id){
            $this->db->delete("sources", compact(id));
        }
        public function source_file($source){
            $count = $this->db->where("filename", $source)->count_all_results("sources");
            if($count != 0){
                return $this->db->where("filename", $source)->get("sources")->row();
            }
            return false;
        }

    }