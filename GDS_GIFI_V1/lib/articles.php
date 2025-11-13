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
        $query = <<<SQL
            SELECT
                `Article` AS article,
                `Marque` AS brand,
                `Type de matériel` AS hardware_type
            FROM `Articles`
            ORDER BY `Article` ASC
        SQL;

        $statement = $connection->query($query);
        $items = [];

        foreach ($statement->fetchAll() as $row) {
            $labelParts = array_filter([
                $row['article'],
                $row['brand'],
                $row['hardware_type'],
            ]);

            $items[] = [
                'label' => implode(' · ', $labelParts),
                'value' => $row['article'],
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
        ['label' => '15G2 · LENOVO · Ordinateur portable 15"', 'value' => '15G2'],
        ['label' => 'L15 (Gen 1) · LENOVO · Ordinateur portable 15"', 'value' => 'L15 (Gen 1)'],
        ['label' => 'L15 (Gen 2) · LENOVO · Ordinateur portable 15"', 'value' => 'L15 (Gen 2)'],
        ['label' => 'L580 · LENOVO · Ordinateur portable 15"', 'value' => 'L580'],
        ['label' => 'L580 16Go · LENOVO · Ordinateur portable 15"', 'value' => 'L580 16Go'],
        ['label' => 'X13 · LENOVO · Ordinateur portable 13"', 'value' => 'X13'],
        ['label' => 'X280 · LENOVO · Ordinateur portable 13"', 'value' => 'X280'],
    ];
}
