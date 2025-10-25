<?php

use App\Repository\OrderRepository;
use App\Repository\UserRepository;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require __DIR__ . '/../vendor/autoload.php';

// --- CONFIGURAZIONE DATABASE ---
$dbConfig = require __DIR__ . '/../config/database.php';

$db = new MysqliDb (
    $dbConfig['host'],
    $dbConfig['username'],
    $dbConfig['password'],
    $dbConfig['db'],
    $dbConfig['port'],
);

// Gestione errore di connessione, in caso esce
if (!$db) {
    http_response_code(500);
    echo json_encode(['error' => 'Connessione al Database non riuscita.']);
    exit;
}

// --- GESTIONE "FINTO" ROUTING ---
$method = $_SERVER['REQUEST_METHOD'];

$full_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$full_path_array = explode('/', $full_path);
// prendiamo solo la fine, users, orders, products
// N.B. casi come user/1/orders in questo caso prevederebbero una implementazione del rounting più avanzata\distaccata a livello globale del progetto
// per questioni di tempo per ora lascio così, eventualmente la sviluppo in un secondo momento
$resource = end($full_path_array);

// i parametri query string
$email = $_GET['email'] ?? null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$days = isset($_GET['days']) ? (int)$_GET['days'] : 30;

// Gestione della richiesta
switch ($resource) {
    case 'user':
        $userRepo = new UserRepository($db);

        echo json_encode($userRepo->getById(2) ?? ['message' => 'Utente non trovato.']);
        break;
    case 'users':
        $userRepo = new UserRepository($db);

        $res = $userRepo->getAllUsers($page);

        echo json_encode(empty($res['users']) ? ['message' => 'La tabella user è vuota.'] : $res);

        break;
    case 'order':

        $orderRepo = new OrderRepository($db);

        if(isset($email)) {
            $userOrder = $orderRepo->getOrderByUserEmail($email, $days);

            if(empty($userOrder)) {
                echo json_encode([
                    'error' => false,
                    'records' => 0,
                    'message' => 'nessun record trovato per la mail: ' . $email
                ]);
            } else {
                echo json_encode([
                    'error' => false,
                    'records' => count($userOrder),
                    'orders' => $userOrder
                ]);
            }
        } else {
            echo json_encode($orderRepo->getAllOrders());
        }
        break;
    case 'products':
        echo json_encode(['message' => 'Endpoint Prodotti (da implementare)']);
        break;

    default:
        // Risorsa non trovata
        http_response_code(404); // Not Found
        echo json_encode([
            'message' => 'Endpoint non valido o risorsa non trovata.'
        ]);
        break;
}

?>