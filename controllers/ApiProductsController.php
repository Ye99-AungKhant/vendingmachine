<?php
class ApiProductsController
{
    public function index()
    {
        $isAuthenticated = authorizeRequest();
        if (!$isAuthenticated) {
            return;
        }

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 5;
        $sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'price';
        $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'ASC';


        $paginationResult = App::get("database")->selectAllWithPagination('products', $itemsPerPage, $currentPage, $sortBy, $orderBy);

        $response = [
            "products" => $paginationResult['data'],
            "totalPages" => $paginationResult['totalPages'],
            "currentPage" => $paginationResult['currentPage'],
            "sortBy" => $sortBy,
            "orderBy" => $orderBy
        ];
        responsejson($response, 200);
    }

    public function store()
    {
        $isAuthenticated = authorizeRequest();
        if (!$isAuthenticated) {
            return;
        }

        $errors = [];
        $name = trim($_POST['name']);
        $price = trim($_POST['price']);
        $qtyAvailable = trim($_POST['qtyAvailable']);

        $validations = [
            'name' => ['validateRequired'],
            'price' => ['validateRequired', 'validateNumeric'],
            'qtyAvailable' => ['validateRequired', 'validateNumeric', 'validateNonNegative']
        ];

        $errors = validateInput($_POST, $validations);

        if (empty($errors)) {
            App::get("database")->insert([
                "name" => $name,
                "price" => $price,
                "quantityAvailable" => $qtyAvailable,
            ], 'products');

            responsejson(["success" => "Product create successfully"], 200);
        } else {
            responsejson(["errors" => $errors], 400);
        }
    }

    public function update()
    {
        $isAuthenticated = authorizeRequest();
        if (!$isAuthenticated) {
            return;
        }

        $errors = [];
        $name = trim($_POST['name']);
        $price = trim($_POST['price']);
        $qtyAvailable = trim($_POST['qtyAvailable']);

        $validations = [
            'name' => ['validateRequired'],
            'price' => ['validateRequired', 'validateNumeric'],
            'qtyAvailable' => ['validateRequired', 'validateNumeric', 'validateNonNegative']
        ];

        $errors = validateInput($_POST, $validations);

        $productId = $_POST['id'];
        $product =  App::get("database")->where("id", "=", $productId, 'products');

        if (!empty($errors)) {
            responsejson(["errors" => $errors], 400);
        }

        if ($product) {
            App::get("database")->update([
                "name" => $name,
                "price" => $price,
                "quantityAvailable" => $qtyAvailable,
            ], 'id', '=', $productId, 'products');

            responsejson(["success" => "Product update successfully"], 200);
        }
    }
    public function delete()
    {
        $isAuthenticated = authorizeRequest();
        if (!$isAuthenticated) {
            return;
        }

        $productId = $_POST['id'];
        App::get("database")->delete($productId, 'products');
        responsejson(["success" => "Product delete successfully"], 200);
    }

    public function detail()
    {
        $isAuthenticated = authorizeRequest();
        if (!$isAuthenticated) {
            return;
        }

        $id =  $_GET['id'];
        $product = App::get("database")->where('id', '=', $id, 'products');
        if (!$product) {
            responsejson(["message" => "Product not found"], 404);
        }
        responsejson(["product" => $product], 200);
    }

    public function purchase()
    {
        $isAuthenticated = authorizeRequest();
        if (!$isAuthenticated) {
            return;
        }

        $errors = [];
        $userId = $_POST['userId'];
        $productId = $_POST['productId'];
        $price = $_POST['price'];
        $qty = trim($_POST['qty']);

        $validations = [
            'userId' => ['validateRequired'],
            'productId' => ['validateRequired'],
            'price' => ['validateRequired'],
            'qty' => ['validateRequired', 'validateNumeric', 'validateNonNegative']
        ];

        $errors = validateInput($_POST, $validations);
        if (empty($errors)) {
            $totalPrice = $qty * $price;
            $product = App::get("database")->where('id', '=', $productId, 'products');

            try {

                if ($product->quantityAvailable >= $qty) {
                    $qtyAvailable = $product->quantityAvailable - $qty;

                    App::get("database")->update([
                        "quantityAvailable" => $qtyAvailable,
                    ], 'id', '=', $productId, 'products');

                    App::get("database")->insert([
                        "user_id" => $userId,
                        "product_id" => $productId,
                        "quantity" => $qty,
                        "total_price" => $totalPrice
                    ], 'transactions');
                    responsejson(["success" => "Purchase successfully"], 200);
                } else {
                    throw new Exception("Product quantity is not enough.", 1);
                }
            } catch (\Throwable $th) {
                $errors["qty"] = $th->getMessage();
                responsejson(["errors" => $errors], 400);
            }
        } else {
            responsejson(["errors" => $errors], 400);
        }
    }
}
