<?php

/**
 * Connects to MySQL using PDO
 */
function db_connect()
{
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    return $PDO;
}


/**
 * Convert dates between ISO and Brazilian standards
 * Font: http://rberaldo.com.br/php-conversao-de-datas-formato-brasileiro-e-formato-iso/
 */
function dateConvert($date)
{
    if (!strstr($date, '/')) {
        // $date está no formato ISO (yyyy-mm-dd) e deve ser convertida
        // para dd/mm/yyyy
        sscanf($date, '%d-%d-%d', $y, $m, $d);
        return sprintf('%02d/%02d/%04d', $d, $m, $y);
    } else {
        // $date está no formato brasileiro e deve ser convertida para ISO
        sscanf($date, '%d/%d/%d', $d, $m, $y);
        return sprintf('%04d-%02d-%02d', $y, $m, $d);
    }

    return false;
}


/**
 * Calculates age from date of birth
 *
 * About the DateTime class: http://rberaldo.com.br/php-usando-a-classe-nativa-datetime/
 */
function calculateAge($birthdate)
{
    $now = new DateTime();
    $diff = $now->diff(new DateTime($birthdate));

    return $diff->y;
}

/**
 * @param $obj
 */
function dbug($obj)
{
    echo "<pre>";
    print_r($obj);
    echo "</pre>";
}

/**
 *
 */
define('PATH_URL', 'PATH_URL');
/**
 *
 */
function setPath()
{
    $path = explode('/', $_SERVER['REQUEST_URI']);
    array_slice($path, 0, 1);
    $_SESSION[PATH_URL] = $path;
}

/**
 * @param $int
 * @return mixed
 */
function getParamUrl($int)
{
    return $_SESSION[PATH_URL][$int];
}

function isCpfValid($cpf)
{
    //Etapa 1: Cria um array com apenas os digitos numÃ©ricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
    $j = 0;
    for ($i = 0; $i < (strlen($cpf)); $i++) {
        if (is_numeric($cpf[$i])) {
            $num[$j] = $cpf[$i];
            $j++;
        }
    }
    //Etapa 2: Conta os dÃ­gitos, um cpf vÃ¡lido possui 11 dÃ­gitos numÃ©ricos.
    if (count($num) != 11) {
        $isCpfValid = false;
    } //Etapa 3: CombinaÃ§Ãµes como 00000000000 e 22222222222 embora nÃ£o sejam cpfs reais resultariam em cpfs vÃ¡lidos apÃ³s o calculo dos dÃ­gitos verificares e por isso precisam ser filtradas nesta parte.
    else {
        for ($i = 0; $i < 10; $i++) {
            if ($num[0] == $i && $num[1] == $i && $num[2] == $i && $num[3] == $i && $num[4] == $i && $num[5] == $i && $num[6] == $i && $num[7] == $i && $num[8] == $i) {
                $isCpfValid = false;
                break;
            }
        }
    }
    //Etapa 4: Calcula e compara o primeiro dÃ­gito verificador.
    if (!isset($isCpfValid)) {
        $j = 10;
        for ($i = 0; $i < 9; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[9]) {
            $isCpfValid = false;
        }
    }
    //Etapa 5: Calcula e compara o segundo dÃ­gito verificador.
    if (!isset($isCpfValid)) {
        $j = 11;
        for ($i = 0; $i < 10; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[10]) {
            $isCpfValid = false;
        } else {
            $isCpfValid = true;
        }
    }
    //Trecho usado para depurar erros.
    /*
    if($isCpfValid==true)
        {
            echo "<font color=\"GREEN\">Cpf Ã© VÃ¡lido</font>";
        }
    if($isCpfValid==false)
        {
            echo "<font color=\"RED\">Cpf InvÃ¡lido</font>";
        }
    */
    //Etapa 6: Retorna o Resultado em um valor booleano.
    return $isCpfValid;
}