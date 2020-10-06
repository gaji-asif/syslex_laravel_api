<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbIssueComments extends Model
{
    
    protected $guarded = [];
    public static function getComments($issue_id){
         $dtbIssueComments = DtbIssueComments::query()
                ->from('dtb_issue_comments as i')
                ->where('issue_id', '=', $issue_id)
                ->get([ 'i.*']);

                return $dtbIssueComments;
    } 
}
