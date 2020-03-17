<?php

    class Taxonomy extends CI_Model{
        
        function create($name){
            $this->db->insert("taxonomy", array(
                "name" => $name
            ));
        }

        function delete($id){
            $categories = $this->db->where("id", $id)->get("taxonomy_category")->result();
            foreach ($categories as $category) {
                $this->db->delete("taxonomy_links", array(
                    "category" => $category->id
                ));
            }
            $this->db->delete("taxonomy_category", array(
                "taxonomy" => $id
            ));
            $this->db->delete("taxonomy", array(
                "id" => $id
            ));
        }

        function list($taxonomy_name){
            $count = $this->db->where("name", $taxonomy)->get("taxonomy")->num_rows();
            if($count != 0){
                $taxonomy_id = $this->db->where("name", $taxonomy)->get("taxonomy")->result()->id;
                return $this->db->where("taxonomy", $taxonomy_id)->get("taxonomy_category")->result();
            }else{
                return [];
            }
        }

        function links($category_id, $link_id){
            $count = $this->db->where("id", $category_id)->get("taxonomy_category")->num_rows();
            if($count != 0){
                return $this->db->where("category", $category_id)->get("taxonomy_links")->result();
            }else{
                return [];
            }
        }

        function add_link($category_id, $link_id){
            $this->db->insert("taxonomy_links", array(
                "category" => $category_id,
                "link" => $link_id
            ));
        }
        
        function delete_link($category_id, $link_id){
            $this->db->delete("taxonomy_links", array(
                "category" => $category_id,
                "link" => $link_id
            ));
        }

        function list_all_types(){
            $categories = $this->db->get("taxonomy_category")->result();
            $taxonomy = [];
            foreach ($this->db->get("taxonomy")->result() as $row) {
                $taxonomy[$row->id] = $row;
                $taxonomy[$row->id]->categories = [];
                foreach ($categories as $category) {
                    if($category->taxonomy == $row->id){
                        $taxonomy[$row->id]->categories[] = $category;
                    }
                }
            }
            return $taxonomy;
        }

        function create_category($name, $taxonomy_id){
            $this->db->insert("taxonomy_category", array(
                "name" => $name,
                "taxonomy" => $taxonomy_id
            ));
        }

        function delete_category($id){
            $this->db->delete("taxonomy_category", array(
                "id" => $id
            ));
        }
    }