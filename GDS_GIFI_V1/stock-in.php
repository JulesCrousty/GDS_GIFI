<?php

require_once __DIR__ . '/dbconnection.php';
require_once __DIR__ . '/lib/articles.php';
require_once __DIR__ . '/lib/stock.php';

$connection = getDatabaseConnection();
$articles = loadArticles($connection);

$pageTitle = 'Entrée des stocks';
$pageSubtitle = 'Scanner ou saisir un article afin de l\'ajouter à votre inventaire.';

$defaultFormData = [
    'serial_number' => '',
    'article' => '',
    'attribution' => 'Non attribuée',
    'condition_status' => 'Neuf',
    'state' => '',
    'warranty' => '',
    'inventory_date' => '',
    'test_date' => '',
    'notes' => 'x',
];

$formData = $defaultFormData;
$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = array_merge($formData, [
        'serial_number' => trim($_POST['serial_number'] ?? ''),
        'article' => trim($_POST['article'] ?? ''),
        'attribution' => trim($_POST['attribution'] ?? 'Non attribuée') ?: 'Non attribuée',
        'condition_status' => $_POST['condition_status'] ?? 'Neuf',
        'state' => trim($_POST['state'] ?? ''),
        'warranty' => trim($_POST['warranty'] ?? ''),
        'inventory_date' => trim($_POST['inventory_date'] ?? ''),
        'test_date' => trim($_POST['test_date'] ?? ''),
        'notes' => trim($_POST['notes'] ?? ''),
    ]);

    if ($formData['notes'] === '') {
        $formData['notes'] = 'x';
    }

    if ($formData['serial_number'] === '') {
        $errors['serial_number'] = 'Le numéro de série est obligatoire.';
    }

    if ($formData['article'] === '') {
        $errors['article'] = 'Veuillez sélectionner un article.';
    } else {
        $availableArticles = array_map(static fn(array $item): string => $item['label'], $articles);
        if (!in_array($formData['article'], $availableArticles, true)) {
            $errors['article'] = 'L\'article sélectionné est invalide.';
        }
    }

    if (!$connection) {
        $errors['database'] = 'La connexion à la base de données est indisponible. Vérifiez la configuration.';
    }

    if (!$errors) {
        $now = new DateTimeImmutable('now');

        $payload = [
            'serial_number' => $formData['serial_number'],
            'article' => $formData['article'],
            'attribution' => $formData['attribution'],
            'condition_status' => $formData['condition_status'],
            'state' => $formData['state'],
            'warranty' => $formData['warranty'],
            'inventory_date' => $formData['inventory_date'],
            'test_date' => $formData['test_date'],
            'notes' => $formData['notes'] === '' ? 'x' : $formData['notes'],
            'stock_out' => null,
            'stock_in' => $now->format('Y-m-d H:i:s'),
        ];

        try {
            if (!createStockItem($connection, $payload)) {
                $errors['database'] = 'Impossible d\'enregistrer l\'article : une erreur inconnue est survenue.';
            } else {
                $successMessage = 'Article enregistré avec succès dans le stock.';
                $formData = $defaultFormData;
            }
        } catch (PDOException $exception) {
            $errors['database'] = 'Impossible d\'enregistrer l\'article : ' . $exception->getMessage();
        }
    }
}

require __DIR__ . '/templates/stock-form.php';
