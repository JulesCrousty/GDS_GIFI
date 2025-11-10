<?php

require_once __DIR__ . '/dbconnection.php';
require_once __DIR__ . '/lib/articles.php';

$connection = getDatabaseConnection();
$articles = loadArticles($connection);

$pageTitle = 'Entrée de stock';
$pageSubtitle = 'Saisissez un nouvel article entrant dans votre inventaire.';

require __DIR__ . '/templates/stock-form.php';
