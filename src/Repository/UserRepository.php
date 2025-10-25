<?php

namespace App\Repository;

use App\Entity\User;
use MysqliDb;

class UserRepository {
    private $db;
    private $tableName = 'user';

    public function __construct(MysqliDb $db) {
        $this->db = $db;
    }

    public function getById(int $userId): mixed {

        $this->db->where('id', $userId);
        $userRow = $this->db->getOne($this->tableName);
        /* N.B. potevo ovviamente fare un return $userRow e avevo un array terminando qui
        * Ho voluto "complicarmi la vita" (seppur in casi di progetti semplici non serve o in test\demo come queste)
        * solo per mostrare come lavorerei, visto che appunto è un test per conoscerci.
        * Il database a mio avviso deve tornare sempre un "oggetto consistente" entità, di cui poi un repository si occuperà della logica
        */
        if ($this->db->count > 0) {
            // Restituisce una entità User
            $user = new User();

            return $user::fromArray($userRow);
        }
        return null;
    }

    public function getAllUsers(int $page = 1, int $limit = 10): array
    {
        // esempio anche con paginazione e limite risultati per pagina
        $this->db->pageLimit = $limit;

        $usersData = $this->db->arraybuilder()->paginate($this->tableName, $page);

        $users = array_map([User::class, 'fromArray'], $usersData);

        return [
            'users' => $users,
            'page' => $page,
            'totalPages' => $this->db->totalPages,
            'totalCount' => $this->db->totalCount,
            'limit' => $limit
        ];
    }
}