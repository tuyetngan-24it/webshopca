<?php 
class Route {
  // hàm xử lý route trước khi vào controller
function handleRoutes($url) {
    global $routes; 
    unset($routes['defaultController']); 
    $url = trim($url, '/');

    $handleUrl = $url; 
    // xử lý route
    if (!empty($routes)) {
        foreach($routes as $key => $value) {
            if (preg_match('~'.$key.'~is', $url)){
                $handleUrl = preg_replace('~'.$key.'~is', $value, $url);
            }
        }
    }
    return $handleUrl;
}

}