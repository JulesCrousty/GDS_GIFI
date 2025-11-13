<?php
require_once __DIR__ . '/dbconnection.php';
require_once __DIR__ . '/lib/stock.php';

$connection = getDatabaseConnection();
$feedback = null;
$feedbackType = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['serial_number'])) {
    if ($connection) {
        $payload = [
            'serial_number' => $_POST['serial_number'],
            'article' => $_POST['article'] ?? null,
            'attribution' => $_POST['attribution'] ?? null,
            'condition_state' => $_POST['condition_state'] ?? null,
            'status' => $_POST['status'] ?? null,
            'warranty' => $_POST['warranty'] ?? null,
            'inventory_date' => $_POST['inventory_date'] ?? null,
            'device_test_date' => $_POST['device_test_date'] ?? null,
            'stock_out' => $_POST['stock_out'] ?? null,
            'stock_in' => $_POST['stock_in'] ?? null,
        ];

        if (updateStockEntry($connection, $payload)) {
            $feedback = sprintf('La fiche %s a été mise à jour.', htmlspecialchars($payload['serial_number'], ENT_QUOTES));
            $feedbackType = 'success';
        } else {
            $feedback = "La mise à jour a échoué. Veuillez réessayer.";
            $feedbackType = 'error';
        }
    } else {
        $feedback = "Connexion à la base indisponible : impossible de mettre à jour le stock.";
        $feedbackType = 'error';
    }
}

$stockEntries = fetchStockEntries($connection);

$conditionOptions = ['', 'NEUF', 'OCCASION'];
$statusOptions = ['', 'PRET A L EMPLOI', 'FONCTIONNEL', 'NON FONCTIONNEL', 'DEEE'];
$warrantyOptions = ['', 'OUI', 'NON'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaire - Gestion de stock</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <section class="page">
        <header class="page__title">
            <div>
                <p class="page__subtitle">Inventaire centralisé</p>
                <h1>Liste du stock</h1>
            </div>
            <nav class="page__actions">
                <a href="stock-in.php">Entrée de stock</a>
                <a href="stock-out.php">Sortie de stock</a>
            </nav>
        </header>

        <?php if ($feedback): ?>
            <div class="alert alert--<?= htmlspecialchars($feedbackType) ?>">
                <?= $feedback ?>
            </div>
        <?php endif; ?>

        <?php if (!$connection): ?>
            <p class="empty-state">Impossible de contacter la base de données. Vérifiez la configuration réseau.</p>
        <?php elseif (!$stockEntries): ?>
            <p class="empty-state">Aucune donnée n'a encore été enregistrée.</p>
        <?php else: ?>
            <ul class="stock-list">
                <?php foreach ($stockEntries as $entry): ?>
                    <li class="stock-list__item">
                        <form method="post" class="stock-form" autocomplete="off">
                            <input type="hidden" name="serial_number" value="<?= htmlspecialchars($entry['serial_number']) ?>">

                            <div class="stock-field">
                                <span class="stock-field__label">S/N</span>
                                <span class="stock-field__value"><?= htmlspecialchars($entry['serial_number']) ?></span>
                            </div>

                            <div class="stock-field">
                                <label class="stock-field__label" for="article-<?= htmlspecialchars($entry['serial_number']) ?>">Article</label>
                                <input class="stock-field__input" type="text" id="article-<?= htmlspecialchars($entry['serial_number']) ?>" name="article" value="<?= htmlspecialchars($entry['article']) ?>">
                            </div>

                            <div class="stock-field">
                                <label class="stock-field__label" for="attribution-<?= htmlspecialchars($entry['serial_number']) ?>">Attribution</label>
                                <input class="stock-field__input" type="text" id="attribution-<?= htmlspecialchars($entry['serial_number']) ?>" name="attribution" value="<?= htmlspecialchars($entry['attribution']) ?>">
                            </div>

                            <div class="stock-field">
                                <label class="stock-field__label" for="condition-<?= htmlspecialchars($entry['serial_number']) ?>">Neuf/Occasion</label>
                                <select class="stock-field__input" id="condition-<?= htmlspecialchars($entry['serial_number']) ?>" name="condition_state">
                                    <?php foreach ($conditionOptions as $option): ?>
                                        <option value="<?= htmlspecialchars($option) ?>" <?= $entry['condition_state'] === $option ? 'selected' : '' ?>><?= $option === '' ? '—' : htmlspecialchars($option) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="stock-field">
                                <label class="stock-field__label" for="status-<?= htmlspecialchars($entry['serial_number']) ?>">État</label>
                                <select class="stock-field__input" id="status-<?= htmlspecialchars($entry['serial_number']) ?>" name="status">
                                    <?php foreach ($statusOptions as $option): ?>
                                        <option value="<?= htmlspecialchars($option) ?>" <?= $entry['status'] === $option ? 'selected' : '' ?>><?= $option === '' ? '—' : htmlspecialchars($option) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="stock-field">
                                <label class="stock-field__label" for="warranty-<?= htmlspecialchars($entry['serial_number']) ?>">Garantie</label>
                                <select class="stock-field__input" id="warranty-<?= htmlspecialchars($entry['serial_number']) ?>" name="warranty">
                                    <?php foreach ($warrantyOptions as $option): ?>
                                        <option value="<?= htmlspecialchars($option) ?>" <?= $entry['warranty'] === $option ? 'selected' : '' ?>><?= $option === '' ? '—' : htmlspecialchars($option) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="stock-field">
                                <label class="stock-field__label" for="inventory-date-<?= htmlspecialchars($entry['serial_number']) ?>">Date inventaire</label>
                                <input class="stock-field__input" type="date" id="inventory-date-<?= htmlspecialchars($entry['serial_number']) ?>" name="inventory_date" value="<?= htmlspecialchars($entry['inventory_date'] ?? '') ?>">
                            </div>

                            <div class="stock-field">
                                <label class="stock-field__label" for="test-date-<?= htmlspecialchars($entry['serial_number']) ?>">Date test appareil</label>
                                <input class="stock-field__input" type="date" id="test-date-<?= htmlspecialchars($entry['serial_number']) ?>" name="device_test_date" value="<?= htmlspecialchars($entry['device_test_date'] ?? '') ?>">
                            </div>

                            <div class="stock-field">
                                <span class="stock-field__label">Notes</span>
                                <span class="stock-field__value stock-field__value--notes"><?= $entry['notes'] === '' ? '—' : htmlspecialchars($entry['notes']) ?></span>
                            </div>

                            <div class="stock-field">
                                <label class="stock-field__label" for="stock-out-<?= htmlspecialchars($entry['serial_number']) ?>">Sortie stock</label>
                                <input class="stock-field__input" type="text" id="stock-out-<?= htmlspecialchars($entry['serial_number']) ?>" name="stock_out" value="<?= htmlspecialchars($entry['stock_out']) ?>">
                            </div>

                            <div class="stock-field">
                                <label class="stock-field__label" for="stock-in-<?= htmlspecialchars($entry['serial_number']) ?>">Entrée stock</label>
                                <input class="stock-field__input" type="text" id="stock-in-<?= htmlspecialchars($entry['serial_number']) ?>" name="stock_in" value="<?= htmlspecialchars($entry['stock_in']) ?>">
                            </div>

                            <div class="stock-actions">
                                <button type="submit">Mettre à jour</button>
                            </div>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>
</body>
</html>
