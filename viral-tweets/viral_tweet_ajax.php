<?php

    $doing_ajax = !empty($_POST) && $_POST['doing_ajax'] == 'true';

    if(!$doing_ajax) {return;}



    require_once '../_libs/dbConnect.php';
    require_once '../_libs/TwitterMatrics.php';


    $consumerKey = "LixTUmdppMAmK3Ginv00487lG";
    $consumerSecretKey = "WuOxmm3aLQ1oYZCS31AiIJJZLYM9HLkbghQM62fXQpLzGp37dq";
    $tokenAccessKey = "821752782-XrkRY35HBvX9zQHSP16yjxsRcaT6zNttZSDMFX3F";
    $tokenSecretKey = "cM67zdy0PjyqtgCMS8P59Dmr3Uuk4riAtdAZ92WGQQ5JW";
//
//     $consumerKey = "pnNkATXHOgwHt9EAwzaZrENN6";
//	 $consumerSecretKey = "fVrkfRlBJDz6q40TWL4ZOnBc1ZDqlJPfz2KkQkKaaxbg0YFuPR";
//	 $tokenAccessKey = "19438656-Af2zYaBwlZsJlf0DmaPOuyK7Nr37JYeWaLJBnEXQO";
//	 $tokenSecretKey = "2OTth9KKlN841TJ63HFbie1V5hGLHVtYIFAFBkHjcdFjy";

    $twitter = new TwitterMatrics($consumerKey, $consumerSecretKey, $tokenAccessKey, $tokenSecretKey);

    if(isset($_POST['viral_first_request'])){

        $time_line = $twitter->get_user_tweets_metrics('mr_abdul_razzaq');

        echo json_encode($time_line);
        exit;

    }


    if(isset($_POST['viral_mentions_request'])){

        $time_line = $twitter->get_user_mention_timelines_all();

        $ids_storage = $twitter->ids_storage;

        $result_array = array();

        if(!empty($ids_storage)){

            foreach ($ids_storage as $id => $time){

                $single_result = array(

                    'created_at' => $time,
                    'id' => $id,
                    'organic_metrics' => array(
                        'mentions_count' => 1,
                        'impression_count' => 0,
                        'like_count' => 0,
                        'reply_count' => 0,
                        'retweet_count' => 0,
                        'user_profile_clicks' => 0,
                    ),

                );

                $result_array[] = $single_result;

            }
        }

        echo json_encode($result_array);
        exit;

    }



