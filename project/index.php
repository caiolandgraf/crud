<?php

require_once "vendor/autoload.php";
require_once "config.php";


require_once "template/header.php";

setPath();
$file = getParamUrl(3);

if ($file == null) {
    require_once "views/index.php";
} elseif (file_exists("views/$file.php")) {
    require_once "views/$file.php";
} else {
    echo "<p>Pagina no encontrada!</p>";
}

require_once "template/footer.php";

