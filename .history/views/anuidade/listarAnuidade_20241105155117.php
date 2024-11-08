<?php
// Inclui a configuração do banco de dados
require_once '../../config/config.php';
require_once '../../model/Associado.php';

$anuidadeModel = new Anuidade($pdo);

$anuidadeModel = $anuidadeModel->list();