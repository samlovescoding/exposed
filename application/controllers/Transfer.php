<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends CI_Controller {
	public function movie(){
        if(isset($_POST["json"])){
            $movie = json_decode($_POST["json"]);
            
            $this->db->trans_start();
            
            foreach ($movie->genres as $genre) {
                $count = $this->db->where("id", $genre->id)->count_all_results("tmdb_genres");
                if($count == 0){
                    $this->db->insert("tmdb_genres", array(
                        "id" => $genre->id,
                        "name" => $genre->name
                    ));
                }
                $count = $this->db->where("genre", $genre->id)
                                  ->where("link_type", "movie")
                                  ->where("link_id", $movie->id)
                                  ->count_all_results("tmdb_genre_links");
                if($count == 0){
                    $this->db->insert("tmdb_genre_links", array(
                        "genre" => $genre->id,
                        "link_type" => "movie",
                        "link_id" => $movie->id
                    ));
                }
            }

            
            foreach($movie->images->posters as $image){
                $count = $this->db->where("file_path", $image->file_path)->count_all_results("tmdb_images");
                if($count == 0){
                    $this->db->insert("tmdb_images", array(
                        "file_path" => $image->file_path,
                        "aspect" => $image->aspect_ratio,
                        "height" => $image->height,
                        "width" => $image->width,
                        "vote_average" => $image->vote_average,
                        "vote_count" => $image->vote_count,
                        "type" => "poster",
                        "link_type" => "movie",
                        "link_id" => $movie->id,
                    ));
                }
            }

            foreach($movie->images->backdrops as $image){
                $count = $this->db->where("file_path", $image->file_path)->count_all_results("tmdb_images");
                if($count == 0){
                    $this->db->insert("tmdb_images", array(
                        "file_path" => $image->file_path,
                        "aspect" => $image->aspect_ratio,
                        "height" => $image->height,
                        "width" => $image->width,
                        "vote_average" => $image->vote_average,
                        "vote_count" => $image->vote_count,
                        "type" => "backdrop",
                        "link_type" => "movie",
                        "link_id" => $movie->id,
                    ));
                }
            }

            foreach($movie->keywords->keywords as $keyword){
                $count = $this->db->where("id", $keyword->id)->count_all_results("tmdb_keywords");
                if($count == 0){
                    $this->db->insert("tmdb_keywords", array(
                        "id" => $keyword->id,
                        "name" => $keyword->name
                    ));
                }
                $count = $this->db->where("keyword_id", $keyword->id)
                                  ->where("link_type", "movie")
                                  ->where("link_id", $movie->id)
                                  ->count_all_results("tmdb_keyword_links");
                if($count == 0){
                    $this->db->insert("tmdb_keyword_links", array(
                        "keyword_id" => $keyword->id,
                        "link_type" => "movie",
                        "link_id" => $movie->id
                    ));
                }
            }

            foreach($movie->similar->results as $similar){
                $count = $this->db->where("id", $movie->id)->where("similar_id", $similar->id)->count_all_results("tmdb_movies_similar");
                if($count == 0){
                    $this->db->insert("tmdb_movies_similar", array(
                        "id" => $movie->id,
                        "similar_id" => $similar->id
                    ));
                }
            }

            $count = $this->db->where("id", $movie->id)->count_all_results("tmdb_movies");
            if($count == 0){
                $this->db->insert("tmdb_movies", array(
                    "id" => $movie->id,
                    "title" => $movie->title,
                    "tagline" => $movie->tagline,
                    "overview" => $movie->overview,
                    "status" => $movie->status,
                    "poster_path" => $movie->poster_path,
                    "backdrop_path" => $movie->backdrop_path,
                    "popularity" => $movie->popularity,
                    "vote_average" => $movie->vote_average,
                    "vote_count" => $movie->vote_count,
                    "budget" => $movie->budget,
                    "revenue" => $movie->revenue,
                    "runtime" => $movie->runtime,
                    "video" => $movie->video,
                    "homepage" => $movie->homepage,
                    "imdb_id" => $movie->imdb_id,
                    "release_date" => $movie->release_date
                ));
                print("[Server] Movie {$movie->title} Added");
            }else{
                $this->db->update("tmdb_movies", array(
                    "title" => $movie->title,
                    "tagline" => $movie->tagline,
                    "overview" => $movie->overview,
                    "status" => $movie->status,
                    "poster_path" => $movie->poster_path,
                    "backdrop_path" => $movie->backdrop_path,
                    "popularity" => $movie->popularity,
                    "vote_average" => $movie->vote_average,
                    "vote_count" => $movie->vote_count,
                    "budget" => $movie->budget,
                    "revenue" => $movie->revenue,
                    "runtime" => $movie->runtime,
                    "video" => $movie->video,
                    "homepage" => $movie->homepage,
                    "imdb_id" => $movie->imdb_id,
                    "release_date" => $movie->release_date
                ), array("id" => $movie->id));

                print("[Server] Movie {$movie->title} Updated");
            }


            $this->db->trans_complete();
        }
    }

    public function show(){
        if(isset($_POST["json"])){
            $show = json_decode($_POST["json"]);
            
            $this->db->trans_start();
            
            foreach ($show->genres as $genre) {
                $count = $this->db->where("id", $genre->id)->count_all_results("tmdb_genres");
                if($count == 0){
                    $this->db->insert("tmdb_genres", array(
                        "id" => $genre->id,
                        "name" => $genre->name
                    ));
                }
                $count = $this->db->where("genre", $genre->id)
                                  ->where("link_type", "show")
                                  ->where("link_id", $show->id)
                                  ->count_all_results("tmdb_genre_links");
                if($count == 0){
                    $this->db->insert("tmdb_genre_links", array(
                        "genre" => $genre->id,
                        "link_type" => "show",
                        "link_id" => $show->id
                    ));
                }
            }

            foreach($show->keywords->results as $keyword){
                $count = $this->db->where("id", $keyword->id)->count_all_results("tmdb_keywords");
                if($count == 0){
                    $this->db->insert("tmdb_keywords", array(
                        "id" => $keyword->id,
                        "name" => $keyword->name
                    ));
                }
                $count = $this->db->where("keyword_id", $keyword->id)
                                  ->where("link_type", "show")
                                  ->where("link_id", $show->id)
                                  ->count_all_results("tmdb_keyword_links");
                if($count == 0){
                    $this->db->insert("tmdb_keyword_links", array(
                        "keyword_id" => $keyword->id,
                        "link_type" => "show",
                        "link_id" => $show->id
                    ));
                }
            }
            
            foreach($show->images->posters as $image){
                $count = $this->db->where("file_path", $image->file_path)->count_all_results("tmdb_images");
                if($count == 0){
                    $this->db->insert("tmdb_images", array(
                        "file_path" => $image->file_path,
                        "aspect" => $image->aspect_ratio,
                        "height" => $image->height,
                        "width" => $image->width,
                        "vote_average" => $image->vote_average,
                        "vote_count" => $image->vote_count,
                        "type" => "poster",
                        "link_type" => "show",
                        "link_id" => $show->id,
                    ));
                }
            }

            foreach($show->images->backdrops as $image){
                $count = $this->db->where("file_path", $image->file_path)->count_all_results("tmdb_images");
                if($count == 0){
                    $this->db->insert("tmdb_images", array(
                        "file_path" => $image->file_path,
                        "aspect" => $image->aspect_ratio,
                        "height" => $image->height,
                        "width" => $image->width,
                        "vote_average" => $image->vote_average,
                        "vote_count" => $image->vote_count,
                        "type" => "backdrop",
                        "link_type" => "show",
                        "link_id" => $show->id,
                    ));
                }
            }

            foreach($show->similar->results as $similar){
                $count = $this->db->where("id", $show->id)->where("similar_id", $similar->id)->count_all_results("tmdb_show_similar");
                if($count == 0){
                    $this->db->insert("tmdb_show_similar", array(
                        "id" => $show->id,
                        "similar_id" => $similar->id
                    ));
                }
            }

            $this->db->trans_complete();

            foreach($show->_seasons as $season){


                $count = $this->db->where("show_id", $show->id)->where("season_number", $season->season_number)->count_all_results("tmdb_season");
                
                if($count == 0){
                    $this->db->insert("tmdb_season", array(
                        "name" => $season->name,
                        "overview" => $season->overview,
                        "poster_path" => $season->poster_path,
                        "season_number" => $season->season_number,
                        "air_date" => $season->air_date,
                        "show_id" => $show->id,
                    ));
                    $season_id = $this->db->insert_id();
                }else{
                    $season_id = $this->db->where("show_id", $show->id)->where("season_number", $season->season_number)->get("tmdb_season")->row()->id;
                }

                foreach($season->images->posters as $image){
                    $count = $this->db->where("file_path", $image->file_path)->count_all_results("tmdb_images");
                    if($count == 0){
                        $this->db->insert("tmdb_images", array(
                            "file_path" => $image->file_path,
                            "aspect" => $image->aspect_ratio,
                            "height" => $image->height,
                            "width" => $image->width,
                            "vote_average" => $image->vote_average,
                            "vote_count" => $image->vote_count,
                            "type" => "poster",
                            "link_type" => "season",
                            "link_id" => $season_id,
                        ));
                    }
                }

                foreach ($season->_episodes as $episode) {
                    $count = $this->db  ->where("season_id", $season_id)
                                        ->where("episode_number", $episode->episode_number)
                                        ->count_all_results("tmdb_episodes");
                    if($count == 0){
                        $this->db->insert("tmdb_episodes", array(
                            "name" => $episode->name ,
                            "overview" => $episode->overview,
                            "still_path" => $episode->still_path,
                            "episode_number" => $episode->episode_number,
                            "season_number" => $episode->season_number,
                            "vote_average" => $episode->vote_average,
                            "vote_count" => $episode->vote_count,
                            "production_code" => $episode->production_code,
                            "season_id" => $season_id,
                            "show_id" => $show->id,
                            "air_date" => $episode->air_date
                        ));
                        $episode_id = $this->db->insert_id();
                    }else{
                        $episode_id = $this->db ->where("season_id", $season_id)
                                                ->where("episode_number", $episode->episode_number)
                                                ->get("tmdb_episodes")->row()->id;
                    }

                    foreach($episode->images->stills as $image){
                        $count = $this->db->where("file_path", $image->file_path)->count_all_results("tmdb_images");
                        if($count == 0){
                            $this->db->insert("tmdb_images", array(
                                "file_path" => $image->file_path,
                                "aspect" => $image->aspect_ratio,
                                "height" => $image->height,
                                "width" => $image->width,
                                "vote_average" => $image->vote_average,
                                "vote_count" => $image->vote_count,
                                "type" => "stills",
                                "link_type" => "episode",
                                "link_id" => $episode_id,
                            ));
                        }
                    }
                    
                }
            }

            $count = $this->db->where("id", $show->id)->count_all_results("tmdb_show");
            if($count == 0){
                $this->db->insert("tmdb_show", array(
                    "id" => $show->id,
                    "name" => $show->name,
                    "overview" => $show->overview,
                    "poster_path" => $show->poster_path,
                    "backdrop_path" => $show->backdrop_path,
                    "first_air_date" => $show->first_air_date,
                    "number_of_seasons" => $show->number_of_seasons,
                    "number_of_episodes" => $show->number_of_episodes,
                    "popularity" => $show->popularity,
                    "vote_average" => $show->vote_average,
                    "vote_count" => $show->vote_count,
                    "status" => $show->status,
                    "type" => $show->type,
                    "episode_run_time" => json_encode($show->episode_run_time)
                ));
                print("[Server] Show {$show->name} Added");
            }else{
                $this->db->update("tmdb_show", array(
                    "id" => $show->id,
                    "name" => $show->name,
                    "overview" => $show->overview,
                    "poster_path" => $show->poster_path,
                    "backdrop_path" => $show->backdrop_path,
                    "first_air_date" => $show->first_air_date,
                    "number_of_seasons" => $show->number_of_seasons,
                    "number_of_episodes" => $show->number_of_episodes,
                    "popularity" => $show->popularity,
                    "vote_average" => $show->vote_average,
                    "vote_count" => $show->vote_count,
                    "status" => $show->status,
                    "type" => $show->type,
                    "episode_run_time" => json_encode($show->episode_run_time)
                ), array("id", $show->id));
                print("[Server] Show {$show->name} Updated");
            }

        }
    }

    public function template(){
        if(isset($_POST["json"])){
            $template = json_decode($_POST["json"]);
            $count = $this->db->where("slug", $template->slug)->count_all_results("templates");
            if($count == 0){
                $this->db->insert("templates", array(
                    "name" => $template->name,
                    "slug" => $template->slug,
                    "description" => $template->description,
                    "screenshot" => $template->screenshot,
                    "source" => $template->source,
                    "links" => $template->links,
                    "file" => $template->file
                ));
                $id = $this->db->insert_id();
                print("Inserted at id {$id}.");
            }else{
                $id = $this->db->where("slug", $template->slug)->get("templates")->row()->id;
                print("Template already exists at {$id}.");
            }
        }
    }

    public function templates(){
        print(json_encode($this->db->get("templates")->result()));
    }
    public function template_update($id, $key, $value){
        $this->db->update("templates", array(
            $key => $value
        ), compact("id"));
        print($id);
    }
}
