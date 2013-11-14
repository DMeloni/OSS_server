<?php


$OSPFile = "OSP.json";
if($_GET['action'] === "showCategories"){
    $OSPCategoriesFile = "OSP.categories.json";
    echo file_get_contents($OSPCategoriesFile); 
    return;
}



if($_GET['action'] === "showOpenSourceProjects" && isset($_GET['category'])){
    $OSPJson = json_decode(file_get_contents($OSPFile), true); 
    $categories = array();
    foreach($OSPJson as $OSP){
        if(in_array($_GET['category'], $OSP['categories'])){
            $categories[$OSP['name']] = array(
                                'name' => $OSP['name'],
                                'img' => $OSP['img'],
                                );
        }
    }
    ksort($categories);
    echo json_encode($categories);
}


if($_GET['action'] === "showOpenSourceProject"){
    $OSPJson = json_decode(file_get_contents($OSPFile), true);
    foreach($OSPJson as $OSP){
        if(strtolower($_GET['openSourceProject']) === strtolower($OSP['name'])
        && $_GET['version'] === $OSP['version']
        ){
            echo json_encode($OSP);
            return;
        }
    }
    foreach($OSPJson as $OSP){
        if(strtolower($_GET['openSourceProject']) === strtolower($OSP['name'])
        ){
            echo json_encode($OSP);
            return;
        }
    }    
}




