<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbIssuesCommentImage extends Model
{
    public static function hasImages($issue_id, $comment_id){
    	// echo $issue_id."<br>". $comment_id;
    	// exit;
    	return $results =  DtbIssuesCommentImage::where('issue_id', $issue_id)->where('comment_id', $comment_id)->get();
    	//dd($results);
    	
    }
}
