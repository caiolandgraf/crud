<?php

use SK\Models\User;

// takes the URL ID
$id = getParamUrl(4);

// valid ID
if (empty($id)) {
    echo "ID não informado";
    exit;
}

try{
    User::Delete($id);
    header('Location: /crud/project');
}catch (\Exception $e){
    echo "Erro ao remover o registro!";
}
