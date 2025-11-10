<?php

/**
 * Récupère la liste des articles en base.
 *
 * @return array<int, array{label: string, value: string}>
 */
function loadArticles(?\PDO $connection): array
{
    if (!$connection) {
        return getFallbackArticles();
    }

    try {
        $statement = $connection->query('SELECT id, name FROM articles ORDER BY name ASC');
        $items = [];

        foreach ($statement->fetchAll() as $row) {
            $items[] = [
                'label' => $row['name'],
                'value' => (string) $row['id'],
            ];
        }

        if (!$items) {
            return getFallbackArticles();
        }

        return $items;
    } catch (\PDOException $exception) {
        error_log('Impossible de récupérer les articles : ' . $exception->getMessage());
        return getFallbackArticles();
    }
}

/**
 * Valeurs de repli affichées en attendant la configuration de la base.
 *
 * @return array<int, array{label: string, value: string}>
 */
function getFallbackArticles(): array
{
    return [
        ['label' => 'Carton de vis M4', 'value' => 'sample-1'],
        ['label' => 'Boîte de connecteurs RJ45', 'value' => 'sample-2'],
        ['label' => 'Ordinateur portable 14"', 'value' => 'sample-3'],
        ['label' => 'Écran 24" Full HD', 'value' => 'sample-4'],
        ['label' => 'Clavier mécanique AZERTY', 'value' => 'sample-5'],
        ['label' => 'Souris sans fil', 'value' => 'sample-6'],
        ['label' => 'Switch 24 ports PoE', 'value' => 'sample-7'],
        ['label' => "Rouleau d'étiquettes", 'value' => 'sample-8'],
        ['label' => 'Casque antibruit', 'value' => 'sample-9'],
        ['label' => 'Batterie externe 10 000 mAh', 'value' => 'sample-10'],
    ];
}
