<?php

/**
 * Insère un nouvel article dans la table stock.
 *
 * @param array<string, mixed> $data
 */
function createStockItem(PDO $connection, array $data): bool
{
    $sql = <<<'SQL'
        INSERT INTO `Stock` (`S/N`, `Article`, `Attribution`, `NEUF/OCCASION`, `Etat`, `Garantie`, `Date Inventaire`, `Date test appareil`, `Notes`, `Sortie stock`, `Entrée stock`)
        VALUES (:serial_number, :article, :attribution, :condition_status, :state, :warranty, :inventory_date, :test_date, :notes, :stock_out, :stock_in)
    SQL;

    $statement = $connection->prepare($sql);

    return $statement->execute([
        ':serial_number' => $data['serial_number'],
        ':article' => $data['article'],
        ':attribution' => $data['attribution'],
        ':condition_status' => $data['condition_status'],
        ':state' => $data['state'],
        ':warranty' => $data['warranty'],
        ':inventory_date' => $data['inventory_date'] ?: null,
        ':test_date' => $data['test_date'] ?: null,
        ':notes' => $data['notes'],
        ':stock_out' => $data['stock_out'],
        ':stock_in' => $data['stock_in'],
    ]);
}
