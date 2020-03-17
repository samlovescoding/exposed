<?php

    class Template extends CI_Model{
        public function find($id){
            return $this->db->where("id", $id)->get("templates")->row();
        }
        public function all(){
            return $this->db->get("templates")->result();
        }
        public function create($name, $description, $screenshot, $source, $links, $file){
            $this->db->insert("templates", compact("name", "description", "screenshot", "source", "links", "file"));
        }
        public function delete($id){
            $this->db->delete("templates", compact(id));
        }

    }