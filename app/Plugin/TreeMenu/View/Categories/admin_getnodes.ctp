<?php

$data = array();

foreach ($nodes as $node){
    $data[] = array(
        "text" => $node['Category']['name'],
        "id" => $node['Category']['id'],
        "cls" => "folder",
        "leaf" => ($node['Category']['lft'] + 1 == $node['Category']['rght']),
        "href" => 'javascript:cargar('.$node['Category']['id'].');'

    );
}

echo json_encode($data);

?>