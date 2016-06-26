<?php

$data = array();

foreach ($nodes as $node){
    if ($node['Category']['classification']!= 'Genero'){
        $data[] = array(
            "text" => $node['Category']['name'],
            "id" => $node['Category']['id'],
            "cls" => "folder",
            "leaf" => ($node['Category']['lft'] + 1 == $node['Category']['rght']),
            "href" => 'javascript:cargar('.$node['Category']['id'].');'
        );
    }
    else{
         $data[] = array(
            "text" => $node['Category']['name'],
            "id" => $node['Category']['id'],
            "cls" => "folder",
            "leaf" => ($node['Category']['lft'] + 1 == $node['Category']['rght']),
            "href" => 'javascript:view('.$node['Category']['id'].');'
        );
    }
}

echo json_encode($data);

?>