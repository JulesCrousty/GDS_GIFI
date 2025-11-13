<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de stock</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <main class="home-container">
        <a class="home-card" href="stock-in.php">
            <div class="home-card__content">
                <p class="home-card__eyebrow">Flux entrant</p>
                <h1>Entrée des stocks</h1>
                <p>Scanner ou saisir un produit pour l'ajouter à l'entrepôt.</p>
            </div>
        </a>
        <a class="home-card" href="stock-out.php">
            <div class="home-card__content">
                <p class="home-card__eyebrow">Flux sortant</p>
                <h1>Sortie des stocks</h1>
                <p>Documenter la sortie d'un article de l'entrepôt.</p>
            </div>
        </a>
        <a class="home-card home-card--disabled" href="#" aria-disabled="true">
            <div class="home-card__content">
                <p class="home-card__eyebrow">Suivi</p>
                <h1>Inventaire</h1>
                <p>Fonctionnalité en préparation.</p>
            </div>
        </a>
        <a class="home-card home-card--disabled" href="#" aria-disabled="true">
            <div class="home-card__content">
                <p class="home-card__eyebrow">Administration</p>
                <h1>Rapports</h1>
                <p>Fonctionnalité en préparation.</p>
            </div>
        </a>
    </main>
</body>
</html>
