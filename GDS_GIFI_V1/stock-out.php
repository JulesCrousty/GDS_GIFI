<?php

require_once __DIR__ . '/dbconnection.php';
require_once __DIR__ . '/lib/articles.php';

$connection = getDatabaseConnection();
$articles = loadArticles($connection);

$pageTitle = 'Sortie de stock';
$pageSubtitle = 'Renseignez le matériel sortant du stock.';

require __DIR__ . '/templates/stock-form.php';
