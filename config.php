<?php
    include('lib/app.php');

    function chargerClasse($classe) {
            require'class/'.$classe .'.php';
    }

    spl_autoload_register('chargerClasse'); 
    

    $db=getDatabase();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>