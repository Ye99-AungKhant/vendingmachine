<?php
class QueryBuilder
{
    protected $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statment = $this->pdo->prepare("select * from $table");
        $statment->execute();
        return $statment->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($dataArr, $table)
    {
        $dataKey = implode(',', array_keys($dataArr));
        $dataValue = array_values($dataArr);
        $questionMark = '';
        foreach ($dataArr as $data) {
            $questionMark .= '?,';
        }
        $questionMark = rtrim($questionMark, ',');

        $sql = "insert into $table ($dataKey) values ($questionMark)";
        $statment = $this->pdo->prepare($sql);
        $statment->execute($dataValue);
    }

    public function where($col, $condition, $value, $table)
    {
        $sql = "SELECT * FROM $table WHERE $col $condition '$value'";
        $statment = $this->pdo->prepare($sql);
        $statment->execute();
        return $statment->fetch(PDO::FETCH_OBJ);
    }

    public function update($dataArr, $col, $condition, $value, $table)
    {
        $setClause = [];
        foreach ($dataArr as $key => $val) {
            $setClause[] = "$key = :$key";
        }

        $setClauseString = implode(', ', $setClause);
        $sql = "UPDATE $table SET $setClauseString WHERE $col $condition '$value'";
        $statment = $this->pdo->prepare($sql);
        foreach ($dataArr as $key => $val) {
            $statment->bindValue(":$key", $val);
        }
        $statment->execute();
    }

    public function delete($id, $table)
    {
        $sql = "DELETE FROM $table WHERE id= $id";
        $statment = $this->pdo->prepare($sql);
        $statment->execute();
    }


    public function selectAllWithPagination($table, $itemsPerPage, $currentPage, $sortBy = 'price', $orderBy = 'ASC')
    {
        $offset = ($currentPage - 1) * $itemsPerPage;
        $allowedSortColumns = ['price', 'quantityAvailable'];
        $allowedSortDirections = ['ASC', 'DESC'];

        $sortBy = in_array($sortBy, $allowedSortColumns) ? $sortBy : 'price';
        $orderBy = in_array($orderBy, $allowedSortDirections) ? $orderBy : 'ASC';

        $totalRecordsStatement = $this->pdo->prepare("SELECT COUNT(*) as total FROM $table");
        $totalRecordsStatement->execute();
        $totalRecords = $totalRecordsStatement->fetch(PDO::FETCH_OBJ)->total;

        $sql = "SELECT * FROM $table ORDER BY $sortBy $orderBy LIMIT :limit OFFSET :offset";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_OBJ);

        return [
            'data' => $results,
            'totalRecords' => $totalRecords,
            'totalPages' => ceil($totalRecords / $itemsPerPage),
            'currentPage' => $currentPage,
        ];
    }


    public function selectTransactionsWithUsersAndProducts($sortBy = 'total_price', $sortOrder = 'DESC', $limit = 10, $page = 1)
    {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT t.*, u.name AS user_name, p.name AS product_name
            FROM transactions t
            JOIN users u ON t.user_id = u.id
            JOIN products p ON t.product_id = p.id
            ORDER BY $sortBy $sortOrder
            LIMIT :limit OFFSET :offset";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offset, PDO::PARAM_INT);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}
