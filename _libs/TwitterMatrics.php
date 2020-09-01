<?php

require "twitterApi/twitteroauth/autoload.php";
require "twitterApi/twitteroauth/commonHelper.php";
$spintax  = new Spintax();

use Abraham\TwitterOAuth\TwitterOAuth;

function pree($data){
    echo '<pre>';
    print_r($data);
    echo '<pre>';
}


class TwitterMatrics
{

    private $twitter;
    private $urls = array(
        'tweets' => 'https://api.twitter.com/2/tweets',
        'user_timeline' => 'https://api.twitter.com/1.1/statuses/user_timeline.json',
        'mentions_timeline' => 'https://api.twitter.com/1.1/statuses/mentions_timeline.json',
    );

    public $storage;
    public $ids_storage;


    function __construct($consumerKey, $consumerSecretKey, $tokenAccessKey, $tokenSecretKey)
    {

        $this->twitter = new TwitterOAuth($consumerKey, $consumerSecretKey, $tokenAccessKey, $tokenSecretKey);
        $this->storage = new SplObjectStorage();

        $this->storage = array();
        $ids_storage = array();


    }


    function get($url, $parms, $json = false){

        $url = array_key_exists($url, $this->urls) ? $this->urls[$url] : '';



        if(!$url){return (Object)array();}

        return  $this->twitter->publicMakeRequests($url, 'GET', $parms, $json);


    }


    function get_metrics_by_tweet_ids($ids){

        $ids_str = implode(',', $ids);

        $parms = array(

            'ids'=>$ids_str,
            'tweet.fields'=>'organic_metrics,created_at',
        );


        try {

            return $this->get('tweets', $parms);

        }catch (Exception  $e){

            return array(

                'status' => 'error',
                'message' => $e->getMessage(),
            );


        }

    }

    function get_user_mentions_timelines($params = array()){


        $params['count'] = 10;


        try {

            return $this->get('mentions_timeline', $params);;

        }catch (Exception  $e){

            return array(

                'status' => 'error',
                'message' => $e->getMessage(),
            );


        }


    }


    function get_user_tweets_timelines($screen_name, $params = array()){


        $params['screen_name'] = $screen_name;
        $params['count'] = 200;


        try {

            return $this->get('user_timeline', $params);;

        }catch (Exception  $e){

            return array(

                'status' => 'error',
                'message' => $e->getMessage(),
            );


        }


    }

    function startsWith ($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }

    private  function get_min_id_of_tweets($top_tweets){


        if(!empty($top_tweets)){

            $ids_array = array();
            $month_complete = false;

            $top_tweets_ids = array_map(function($o)use(&$ids_array, &$month_complete){


                $one_month_old =  strtotime('-1 month');
                $created_at = $o->created_at;
                $created_at_time = strtotime($created_at);


                if(!$this->startsWith($o->text, 'RT @')){


                    if($created_at_time > $one_month_old){

                        $this->ids_storage[$o->id] = $o->created_at;
                        $ids_array[] = $o->id;
                    }else{

                        $month_complete = true;
                    }
                }

                return $o->id;

            },$top_tweets);

            return array('min' => min($top_tweets_ids), 'ids' => $ids_array, 'month_complete' => $month_complete);
        }

    }

    function get_user_mention_timelines_all($params = array()){


        $top_mentions = $this->get_user_mentions_timelines($params);



        if(is_array($top_mentions) && isset($top_mentions['status']) && $top_mentions['status'] == 'error'){

            return $top_mentions;
        }

        if(is_object($top_mentions)){
            return  $top_mentions;
        }



//        $this->storage = array_merge($this->storage, $top_tweets);
        $min_val = $this->get_min_id_of_tweets($top_mentions);



        if(empty($top_mentions) || (isset($min_val['month_complete']) && $min_val['month_complete'] == true)){


            return $this->ids_storage;

        }else{

            $min_val = $min_val['min'];

            $params = array(
                'since_id' => 1,
                'max_id' => $min_val-1,
                );



            sleep(1);
            $this->get_user_mention_timelines_all($params);


        }

    }

    function get_user_tweets_timelines_all($screen_name, $params = array()){


        $top_tweets = $this->get_user_tweets_timelines($screen_name, $params);


        if(is_array($top_tweets) && isset($top_tweets['status']) && $top_tweets['status'] == 'error'){

            return $top_tweets;
        }

        if(is_object($top_tweets)){
            return  $top_tweets;
        }


//        $this->storage = array_merge($this->storage, $top_tweets);
        $min_val = $this->get_min_id_of_tweets($top_tweets);


        if(empty($top_tweets) || (isset($min_val['month_complete']) && $min_val['month_complete'] == true)){


            return $this->ids_storage;

        }else{

            $min_val = $min_val['min'];

            $params = array(
                'since_id' => 1,
                'max_id' => $min_val-1,          );



            sleep(1);
            $this->get_user_tweets_timelines_all($screen_name, $params);


        }

    }

    function get_user_metrics_loop($tweets_ids){

        if(!empty($tweets_ids)){

            $metrics =  $this->get_metrics_by_tweet_ids($tweets_ids);

            if(is_array($metrics) && isset($metrics['status']) && $metrics['status'] == 'error'){

                return $metrics;
            }

            if(is_object($metrics)){

                return  $metrics;
            }

            return $metrics->data;

        }
    }


    function get_user_tweets_metrics($screen_name){

        $time_line = $this->get_user_tweets_timelines_all($screen_name, array());

        if(is_array($time_line) && isset($time_line['status']) && $time_line['status'] == 'error'){

            return $time_line;

        }

        if(is_object($time_line)){

            return $time_line;

        }

        $tweets_ids = array_keys($this->ids_storage);


        if(count($tweets_ids) > 100){

            $ids_chunk = array_chunk($tweets_ids, 100);



            $metrics_array = array();

            foreach ($ids_chunk as $single_array){

                $chunk_metrics =  $this->get_metrics_by_tweet_ids($single_array);


                if(is_array($chunk_metrics) && isset($chunk_metrics['status']) && $chunk_metrics['status'] == 'error'){

                    return $chunk_metrics;
                }

                if(is_object($chunk_metrics)){

                    return  $chunk_metrics;
                }


                if($chunk_metrics->data){

                    $metrics_array[] = $chunk_metrics->data;

                }



            }


            $new_array = array_reduce($metrics_array, 'array_merge', array());

            return $new_array;

        }else{

            $metrics =  $this->get_metrics_by_tweet_ids($tweets_ids);

            if(is_array($metrics) && isset($metrics['status']) && $metrics['status'] == 'error'){

                return $metrics;
            }

//            if(is_object($metrics)){
//
//                return  $metrics;
//            }


            if(isset($metrics->data)){

                return $metrics->data;

            }else{

                return  $metrics;
            }


        }





    }


    function get_user_tweets_first_request($screen_name, $params = array()){


        $top_tweets = $this->get_user_tweets_timelines($screen_name, $params);


        if(is_array($top_tweets) && isset($top_tweets['status']) && $top_tweets['status'] == 'error'){

            return $top_tweets;
        }

        if(is_object($top_tweets)){
            return  $top_tweets;
        }

//        pree($top_tweets);exit;


        if(!empty($top_tweets)){

            $total_tweets = count($top_tweets);
            $min_val_array = $this->get_min_id_of_tweets($top_tweets);
            $min_val = $min_val_array['min'];
            $tweet_ids = $min_val_array['ids'];

            $metrics = $this->get_user_tweets_metrics($tweet_ids);



            $return_data = array(
                'data' => $metrics,
                'total_tweets' => $total_tweets,
                'next_request_id' => $min_val-1,
            );


            echo json_encode($return_data);


        }else{






            sleep(1);
            $this->get_user_tweets_timelines_all($screen_name, $params);


        }

    }




}






