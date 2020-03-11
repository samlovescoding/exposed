<?php

    class Course extends CI_Model{
        public function find($id){
            return $this->db->where("id", $id)->get("course")->row();
        }
        public function all(){
            return $this->db->get("course")->result();
        }
        public function create($title, $description, $publisher, $instructors){
            $this->db->insert("course", compact("title", "description", "publisher", "instructors"));
        }
        public function delete($id){
            $this->db->delete("course", compact(id));
        }

        public function module_find($id){
            return $this->db->where("id", $id)->get("course_modules")->row();
        }
        public function modules($id){
            return $this->db->where("course", $id)->get("course_modules")->result();
        }
        public function module_create($title, $course){
            $this->db->insert("course_modules", compact("title", "course"));
        }
        public function module_delete($id){
            $this->db->delete("course_modules", compact("id"));
        }

        public function article_find($id){
            return $this->db->where("id", $id)->get("course_articles")->row();
        }
        public function articles($module_id){
            return $this->db->where("module", $module_id)->get("course_articles")->result();
        }
        public function article_create($title, $module, $course, $video, $description, $resource){
            $this->db->insert("course_articles", compact("title", "course", "module", "video", "description", "resource"));
        }
        public function article_edit($key, $value, $id){
            $this->db->update("course_articles", array($key=>$value), compact("id"));
        }
        public function article_delete($id){
            $this->db->delete("course_articles", compact("id"));
        }
    }