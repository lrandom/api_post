<?php

class Connect
{
    protected $pdo = null;

    public function __construct ()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=blog_post',
            'root', 'koodinh');
        $this->pdo->exec('SET NAMES UTF8');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//exception
    }


}

?>