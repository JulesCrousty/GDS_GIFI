<?php
/**
 * @var string $pageTitle
 * @var string $pageSubtitle
 * @var array<int, array{label: string, value: string}> $articles
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
        <form class="form-grid" autocomplete="off">
            <div class="field">
                <label for="serial-number">Numéro de série</label>
                <input type="text" id="serial-number" name="serial_number" placeholder="Ex: SN-0001-2024" required>
            </div>

            <div class="field">
                <label for="article-search">Article</label>
                <div class="searchable-select" data-articles='<?= json_encode($articles, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>'>
                    <input type="text" id="article-search" name="article" placeholder="Rechercher un article">
                    <span class="searchable-select__icon">🔍</span>
                    <div class="suggestions" aria-live="polite"></div>
                </div>
            </div>

            <div class="field">
                <label for="state">État</label>
                <select id="state" name="state">
                    <option value="neuf">Neuf</option>
                    <option value="reconditionne">Reconditionné</option>
                    <option value="utilise">Utilisé</option>
                    <option value="endommagé">Endommagé</option>
                </select>
            </div>

            <div class="field">
                <label for="remarks">Remarques</label>
                <input type="text" id="remarks" name="remarks" placeholder="Informations complémentaires (facultatif)">
            </div>
        </form>
    </section>
    <script src="assets/js/searchable-select.js"></script>
</body>
</html>
