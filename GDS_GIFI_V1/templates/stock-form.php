<?php
/**
 * @var string $pageTitle
 * @var string $pageSubtitle
 * @var array<int, array{label: string, value: string}> $articles
 * @var array<string, string> $formData
 * @var array<string, string> $errors
 * @var string $successMessage
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - Gestion de stock</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <section class="page">
        <header class="page__title">
            <div>
                <p class="page__subtitle"><?= htmlspecialchars($pageSubtitle) ?></p>
                <h1><?= htmlspecialchars($pageTitle) ?></h1>
            </div>
            <a href="index.php">Retour</a>
        </header>

        <?php if ($successMessage): ?>
            <p class="status-message status-message--success"><?= htmlspecialchars($successMessage) ?></p>
        <?php endif; ?>

        <?php if (!empty($errors['database'])): ?>
            <p class="status-message status-message--error"><?= htmlspecialchars($errors['database']) ?></p>
        <?php endif; ?>

        <form class="form-grid" method="post" autocomplete="off" novalidate>
            <section class="scan-panel">
                <div class="scan-panel__content" id="scan-panel">
                    <h2>Scanner ici</h2>
                    <p>Placez le lecteur sur le code-barres pour remplir automatiquement le numéro de série.</p>
                    <button type="button" class="button-secondary" id="open-manual-serial">Vous ne pouvez pas scanner ?</button>
                </div>
            </section>

            <div class="field field--full">
                <label for="serial-number">S/N</label>
                <input
                    type="text"
                    id="serial-number"
                    name="serial_number"
                    placeholder="Scannez un numéro de série"
                    value="<?= htmlspecialchars($formData['serial_number'] ?? '') ?>"
                    required
                >
                <?php if (!empty($errors['serial_number'])): ?>
                    <p class="field__error"><?= htmlspecialchars($errors['serial_number']) ?></p>
                <?php endif; ?>
            </div>

            <div class="field field--full">
                <label for="article">Article</label>
                <select id="article" name="article" required>
                    <option value="" disabled <?= ($formData['article'] ?? '') === '' ? 'selected' : '' ?>>Sélectionnez un article</option>
                    <?php foreach ($articles as $article): ?>
                        <option value="<?= htmlspecialchars($article['label']) ?>" <?= ($formData['article'] ?? '') === $article['label'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($article['label']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($errors['article'])): ?>
                    <p class="field__error"><?= htmlspecialchars($errors['article']) ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="attribution">Attribution</label>
                <input
                    type="text"
                    id="attribution"
                    name="attribution"
                    value="<?= htmlspecialchars($formData['attribution'] ?? 'Non attribuée') ?>"
                >
            </div>

            <div class="field">
                <label for="condition-status">Neuf / Occasion</label>
                <select id="condition-status" name="condition_status" class="auto-note-trigger">
                    <option value="Neuf" <?= ($formData['condition_status'] ?? '') === 'Neuf' ? 'selected' : '' ?>>Neuf</option>
                    <option value="Occasion" <?= ($formData['condition_status'] ?? '') === 'Occasion' ? 'selected' : '' ?>>Occasion</option>
                </select>
            </div>

            <div class="field">
                <label for="state">État</label>
                <input
                    type="text"
                    id="state"
                    name="state"
                    value="<?= htmlspecialchars($formData['state'] ?? '') ?>"
                    class="auto-note-trigger"
                >
            </div>

            <div class="field">
                <label for="warranty">Garantie</label>
                <input
                    type="text"
                    id="warranty"
                    name="warranty"
                    value="<?= htmlspecialchars($formData['warranty'] ?? '') ?>"
                    class="auto-note-trigger"
                >
            </div>

            <div class="field">
                <label for="inventory-date">Date inventaire</label>
                <input
                    type="date"
                    id="inventory-date"
                    name="inventory_date"
                    value="<?= htmlspecialchars($formData['inventory_date'] ?? '') ?>"
                    class="auto-note-trigger"
                >
            </div>

            <div class="field">
                <label for="test-date">Date test appareil</label>
                <input
                    type="date"
                    id="test-date"
                    name="test_date"
                    value="<?= htmlspecialchars($formData['test_date'] ?? '') ?>"
                    class="auto-note-trigger"
                >
            </div>

            <div class="field field--full">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" rows="3"><?= htmlspecialchars($formData['notes'] ?? '') ?></textarea>
            </div>

            <div class="form-actions field--full">
                <button type="submit" class="button-primary">Créer l'article</button>
            </div>
        </form>
    </section>

    <div class="modal" id="manual-serial-modal" role="dialog" aria-modal="true" aria-labelledby="manual-serial-title" hidden>
        <div class="modal__content">
            <h2 id="manual-serial-title">Saisissez le numéro de série</h2>
            <p>Indiquez manuellement le S/N si aucun scanner n'est disponible.</p>
            <form id="manual-serial-form">
                <label for="manual-serial-input" class="sr-only">Numéro de série</label>
                <input type="text" id="manual-serial-input" placeholder="Ex : SN-00001" required>
                <div class="modal__actions">
                    <button type="submit" class="button-primary">Valider</button>
                    <button type="button" class="button-secondary" id="close-manual-serial">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-backdrop" id="modal-backdrop" hidden></div>

    <script src="assets/js/stock-in.js"></script>
</body>
</html>
