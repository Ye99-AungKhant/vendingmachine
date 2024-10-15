<?php
class ApiTransactionController
{
    public function index()
    {
        $isAuthenticated = authorizeRequest();
        if (!$isAuthenticated) {
            return;
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'total_price';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';
        $limit = 5;

        $transactions = App::get("database")->selectTransactionsWithUsersAndProducts($sortBy, $sortOrder, $limit, $page);

        $response = [
            'transactions' => $transactions,
            'page' => $page,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ];

        responsejson($response, 200);
    }
}
