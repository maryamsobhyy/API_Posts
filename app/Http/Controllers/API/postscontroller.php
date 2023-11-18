<?php

namespace App\Http\Controllers\API;

use App\Models\post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class postscontroller extends Controller
{
    use ApiresponseTrait;
    public function index(){
        $posts=PostResource::collection(post::get());
        $message="Data get sucessfully";
        $status=201;
        return $this->ApiResponse($posts,$message,$status);
    }
    public function show($id){
        $posts= post::find($id);
        if($posts){
            $message="Data get sucessfully";
            $status=200;
            return $this->ApiResponse(new PostResource($posts),$message,$status);
        }
            $data=null;
            $message="Data Not Found";
            $status=401;
            return $this->ApiResponse($data,$message,$status);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()){
            $data=null;
            $message=$validator->errors();
            $status=400;
            return $this->ApiResponse($data,$message,$status);
        }
        $posts=post::create($request->all());
        if($posts){
            $message="Data insert sucessfully";
            $status=201;
            return $this->ApiResponse($posts,$message,$status);
        }
            $data=null;
            $message="Can't insert this data";
            $status=400;
            return $this->ApiResponse($data,$message,$status);

    }
    public function update(request $request,$id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()){
            $data=null;
            $message=$validator->errors();
            $status=400;
            return $this->ApiResponse($data,$message,$status);
        }
        $posts= post::find($id);
        $posts->update($request->all());
        if($posts){
            $message="Data updated sucessfully";
            $status=201;
            return $this->ApiResponse($posts,$message,$status);
        }
            $data=null;
            $message="Post Not Found";
            $status=401;
            return $this->ApiResponse($data,$message,$status);
        }
        public function distroy($id){
            $posts= post::find($id);
            if(!$posts){
                $message="Post Not Found";
                $status=404;
                return $this->ApiResponse(($posts),$message,$status);
            }
            $posts->delete();
            if($posts){
                $message="Data deleted sucessfully";
                $status=200;
                return $this->ApiResponse(($posts),$message,$status);
            }
                $data=null;
                $message="Data Not Found";
                $status=401;
                return $this->ApiResponse($data,$message,$status);
        }


}


