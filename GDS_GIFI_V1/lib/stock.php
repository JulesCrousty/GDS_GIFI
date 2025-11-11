<?php

/**
 * Récupère l'ensemble des entrées du stock depuis la base.
 *
 * @return array<int, array<string, mixed>>
 */
function fetchStockEntries(?\PDO $connection): array
{
    if (!$connection) {
        return [];
    }

    $sql = <<<SQL
        SELECT
            `S/N` AS serial_number,
            `Article` AS article,
            `Attribution` AS attribution,
            `NEUF/OCCASION` AS condition_state,
            `Etat` AS status,
            `Garantie` AS warranty,
            `Date Inventaire` AS inventory_date,
            `Date test appareil` AS device_test_date,
            `Notes` AS notes,
            `Sortie stock` AS stock_out,
            `Entrée stock` AS stock_in
        FROM `Stock`
        ORDER BY `Article` ASC, `S/N` ASC
    SQL;

    try {
        $statement = $connection->query($sql);
        $rows = [];

        foreach ($statement->fetchAll() as $row) {
            $rows[] = [
                'serial_number' => $row['serial_number'],
                'article' => $row['article'] ?? '',
                'attribution' => $row['attribution'] ?? '',
                'condition_state' => $row['condition_state'] ?? '',
                'status' => $row['status'] ?? '',
                'warranty' => $row['warranty'] ?? '',
                'inventory_date' => $row['inventory_date'],
                'device_test_date' => $row['device_test_date'],
                'notes' => $row['notes'] ?? '',
                'stock_out' => $row['stock_out'] ?? '',
                'stock_in' => $row['stock_in'] ?? '',
            ];
        }

        return $rows;
    } catch (\PDOException $exception) {
        error_log('Impossible de récupérer le stock : ' . $exception->getMessage());
        return [];
    }
}

/**
 * Met à jour une ligne de stock identifiée par son numéro de série.
 */
function updateStockEntry(?\PDO $connection, array $payload): bool
{
    if (!$connection) {
        return false;
    }

    $sql = <<<SQL
        UPDATE `Stock`
        SET
            `Article` = :article,
            `Attribution` = :attribution,
            `NEUF/OCCASION` = :condition_state,
            `Etat` = :status,
            `Garantie` = :warranty,
            `Date Inventaire` = :inventory_date,
            `Date test appareil` = :device_test_date,
            `Notes` = 'x',
            `Sortie stock` = :stock_out,
            `Entrée stock` = :stock_in
        WHERE `S/N` = :serial_number
    SQL;

    $inventoryDate = normaliseDate($payload['inventory_date'] ?? null);
    $deviceTestDate = normaliseDate($payload['device_test_date'] ?? null);

    try {
        $statement = $connection->prepare($sql);

        return $statement->execute([
            ':article' => nullifyEmpty($payload['article'] ?? null),
            ':attribution' => nullifyEmpty($payload['attribution'] ?? null),
            ':condition_state' => nullifyEmpty($payload['condition_state'] ?? null),
            ':status' => nullifyEmpty($payload['status'] ?? null),
            ':warranty' => nullifyEmpty($payload['warranty'] ?? null),
            ':inventory_date' => $inventoryDate,
            ':device_test_date' => $deviceTestDate,
            ':stock_out' => nullifyEmpty($payload['stock_out'] ?? null),
            ':stock_in' => nullifyEmpty($payload['stock_in'] ?? null),
            ':serial_number' => $payload['serial_number'],
        ]);
    } catch (\PDOException $exception) {
        error_log('Impossible de mettre à jour le stock : ' . $exception->getMessage());
        return false;
    }
}

/**
 * Convertit une chaîne vide en null.
 */
function nullifyEmpty(?string $value): ?string
{
    if ($value === null) {
        return null;
    }

    $trimmed = trim($value);

    return $trimmed === '' ? null : $trimmed;
}

/**
 * Normalise une date (format YYYY-MM-DD) ou renvoie null si invalide.
 */
function normaliseDate(?string $value): ?string
{
    $value = nullifyEmpty($value);

    if ($value === null) {
        return null;
    }

    $date = date_create($value);

    if (!$date) {
        return null;
    }

    return $date->format('Y-m-d');
}
