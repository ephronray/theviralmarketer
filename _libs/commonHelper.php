<?php 

class CommonHepler {
    
function get_value($data , $key) {
		if(is_string($data)){
			$data = json_decode($data);
		}

		if(is_array($data)){
			if (isset($data[$key])) {
				return $data[$key];
			}
		}

		if(is_object($data)){
			if (isset($data->$key)) {
				return $data->$key;
			}
		}
		return false;
	}
	
	function get_value_rand_array($data, $type = "") {
		if(!empty($data)){
			if(is_string($data)){
				$data = explode(',',$data);
			}
			$item = $data[mt_rand(0, count($data)-1)];
			switch ($type) {
				case 'feed':
					return $item;
					break;
				
				default:
					return trim($item);
					break;
			}
		}
		return false;
	}
	
	function getUrl($url, $cursorType , $cursorValue , $dependentParam = "") {
            $pathInfo = parse_url($url);
            //dependent param remove first
            if($dependentParam && $dependentParam != "") { 
            $pathInfo['query'] = str_replace("&".$dependentParam."=".$_GET[$dependentParam],"",$pathInfo['query']);
            }
            //dependent param remove first
            
            if(isset($_GET[$cursorType])) {
                $pathInfo['query'] = str_replace("&".$cursorType."=".$_GET[$cursorType],"",$pathInfo['query']);
                $pathInfo['query'] = $pathInfo['query'].'&'.$cursorType."=".$cursorValue;
            } 
           else {
                $pathInfo['query'] = $pathInfo['query'].'&'.$cursorType."=".$cursorValue;
           }
           
           return $pathInfo['path'].'?'.$pathInfo['query'];
	}
}

?>