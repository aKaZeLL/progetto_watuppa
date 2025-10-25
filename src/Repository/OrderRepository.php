<?php

namespace App\Repository;

use App\Entity\Order;
use MysqliDb;

class OrderRepository {
    private $db;
    private $tableName = 'order';

    public function __construct(MysqliDb $db) {
        $this->db = $db;
    }

    public function getAllOrders() {
        $ordersData = $this->db->rawQuery('SELECT * from `order`');

        return array_map([Order::class, 'fromArray'], $ordersData);
    }

    public function getOrderByUserEmail(string $userEmail, int $last_days)
    {
        /* --- QUERY CORRETTA ---
            SELECT 
            u.nome, u.cognome,
            o.id as numero_ordine,
            o.data_ordine, o.stato,
            p.nome, op.quantita * op.prezzo_unitario AS totale_prodotto
            FROM `order` o
            JOIN `user` u ON o.user_id = u.id
            JOIN `order_product` op ON o.id = op.order_id
            JOIN `product` p ON op.product_id = p.id
            WHERE u.email = "mario.rossi@example.com"
            AND o.data_ordine >= NOW() - INTERVAL 30 DAY;
        */

        return $this->db->rawQuery(
            '
                SELECT 
                    u.nome as nome_cliente,
                    u.cognome as cognome_cliente,
                    o.id as numero_ordine,
                    o.data_ordine,
                    o.stato as stato_ordine,
                    p.nome as nome_prodotto,
                    p.descrizione as descrizione_prodotto,
                    p.prezzo,
                    op.quantita as qt_prodotto,
                    op.quantita * op.prezzo_unitario AS costo
                FROM `order` o
                JOIN user u ON o.user_id = u.id
                JOIN order_product op ON o.id = op.order_id
                JOIN product p ON op.product_id = p.id
                WHERE u.email = ?
                AND o.data_ordine >= NOW() - INTERVAL ? DAY;
            '
            , Array ($userEmail, $last_days)
        );
    }
}