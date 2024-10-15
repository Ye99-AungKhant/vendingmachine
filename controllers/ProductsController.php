<?php
class ProductsController
{
    public function index()
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 5;
        $sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'price';
        $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'ASC';


        $paginationResult = App::get("database")->selectAllWithPagination('products', $itemsPerPage, $currentPage, $sortBy, $orderBy);

        view("product/index", [
            "products" => $paginationResult['data'],
            "totalPages" => $paginationResult['totalPages'],
            "currentPage" => $paginationResult['currentPage'],
            "sortBy" => $sortBy,
            "orderBy" => $orderBy
        ]);
    }
    public function create()
    {
        view("product/productForm");
    }

    public function store()
    {
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
            header("Location:/");
        } else {
            view("product/productForm", ["errors" => $errors]);
        }
    }

    public function edit()
    {
        $id =  $_GET['id'];
        $product = App::get("database")->where('id', '=', $id, 'products');
        if (!$product) {
            header("Location:/");
        }
        view("product/productForm", ["product" => $product]);
    }

    public function update()
    {
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
            view("product/productForm", ["errors" => $errors]);
        }

        if ($product) {
            App::get("database")->update([
                "name" => $name,
                "price" => $price,
                "quantityAvailable" => $qtyAvailable,
            ], 'id', '=', $productId, 'products');
            header("Location:/");
        }
    }
    public function delete()
    {
        $productId = $_POST['id'];
        // dd($productId);
        App::get("database")->delete($productId, 'products');
        header("Location:/");
    }

    public function detail()
    {
        $id =  $_GET['id'];
        $product = App::get("database")->where('id', '=', $id, 'products');
        if (!$product) {
            header("Location:/");
        }
        view("product/detail", ["product" => $product]);
    }

    public function purchase()
    {
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
                    header("Location:/");
                } else {
                    throw new Exception("Product quantity is not enough.", 1);
                }
            } catch (\Throwable $th) {
                $errors["qty"] = $th->getMessage();
                view("product/detail", ["errors" => $errors]);
            }
        } else {
            view("product/detail", ["errors" => $errors]);
        }
    }
}
