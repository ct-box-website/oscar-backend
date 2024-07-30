<?php

class Room
{
    private $connection;
    private $table_name = 'room';
    private $category_table = 'categories';

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function readRoom()
    {
        // $query = "SELECT * FROM {$this->table_name} INNER JOIN {$this->category_table} ON {$this->table_name}.category_id={$this->category_table}.id";
        $query = "SELECT * FROM {$this->table_name}";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readLimit()
    {
        $limit = $_GET['limit'];
        $page = $_GET['page'];
        $start = ($page - 1) * $limit;
        $query = "SELECT * FROM {$this->table_name} LIMIT $start, $limit";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readCount()
    {
        $query = "SELECT COUNT(id) as id FROM {$this->table_name}";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;

    }

    public function readById()
    {
        $query = "SELECT * FROM {$this->table_name} WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->category_id = $row['category_id'];
        $this->price = $row['price'];
        $this->status = $row['status'];
        $this->scale = $row['scale'];
        $this->images = $row['images'];
        $this->created_at = $row['created_at'];
        $this->updated_at = $row['updated_at'];
    }

    public function error404($message)
    {
        $data = [
            "code" => 0,
            "status" => 404,
            "msg" => $message,
            "data" => null
        ];
        header("HTTP/1.0 404 $message");
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function create($input)
    {
        $title = htmlspecialchars($input['title']);
        $description = htmlspecialchars($input['description']);
        $price = htmlspecialchars($input['price']);
        $category_id = htmlspecialchars($input['category_id']);
        $scale = htmlspecialchars($input['scale']);
        $status = 1;
        $images = htmlspecialchars($input['images']);



        if (empty(trim($title))) {
            return $this->error404("Please enter title");
        } elseif (empty(trim($price))) {
            return $this->error404("Please enter price");
        } elseif (empty(trim($category_id))) {
            return $this->error404("Please enter category_id");
        } elseif (empty(trim($scale))) {
            return $this->error404("Please enter scale");
        } elseif (empty(trim($status))) {
            return $this->error404("Please enter status");
        } elseif ($_FILES["images"]["error"] == 4) {
            return $this->error404("No image selected");
        } else {
            try {
                $query = "INSERT INTO {$this->table_name} (title, description, category_id, price, status, scale, images, created_at) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
                $stmt = $this->connection->prepare($query);
                $stmt->execute([
                    $title,
                    $description,
                    $category_id,
                    $price,
                    $status,
                    $scale,
                    $images,
                    date('Y-m-d H:i:s')
                ]);

                $data = [
                    "code" => 1,
                    "status" => 201,
                    "msg" => "Room Added Successfully!",
                    'data' => [
                        "id" => $this->connection->lastInsertId(),
                        "title" => $title,
                        "description" => $description,
                        "category_id" => $category_id,
                        "price" => $price,
                        "status" => $status,
                        "scale" => $scale,
                        "images" => $images,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s'),
                    ]
                ];
                http_response_code(201); // Set HTTP response code

                return json_encode($data, JSON_PRETTY_PRINT);

            } catch (PDOException $e) {
                $data = [
                    "code" => 0,
                    "status" => 500,
                    "msg" => "Internal Server Error: " . $e->getMessage(),
                ];
                http_response_code(500); // Set HTTP response code

                return json_encode($data, JSON_PRETTY_PRINT);
            }
        }
    }

    public function modify($input)
    {
        $user_id = htmlspecialchars($input["id"]);
        $username = htmlspecialchars($input["username"]);
        $email = htmlspecialchars($input["email"]);
        $address = htmlspecialchars($input["address"]);

        if (empty(trim($username))) {
            return $this->error404("Please enter a username");
        } elseif (empty(trim($email))) {
            return $this->error404("Please enter an email");
        } elseif (empty(trim($address))) {
            return $this->error404("Please enter an address");
        } else {
            try {
                $query = "UPDATE users SET username = ?, email = ?, address = ? WHERE id = ?";
                $stmt = $this->connection->prepare($query);
                $stmt->execute([$username, $email, $address, $user_id]);

                $data = [
                    "code" => 1,
                    "status" => 201,
                    "msg" => "User Updated Successfully!",
                    'data' => [
                        'id' => $user_id,
                        'username' => $username,
                        'email' => $email,
                        'address' => $address
                    ]
                ];
                http_response_code(201); // Set HTTP response code

                return json_encode($data, JSON_PRETTY_PRINT);

            } catch (PDOException $e) {
                $data = [
                    "code" => 0,
                    "status" => 500,
                    "msg" => "Internal Server Error: " . $e->getMessage()
                ];
                http_response_code(500); // Set HTTP response code

                return json_encode($data, JSON_PRETTY_PRINT);
            }
        }
    }

    public function delete()
    {
        try {
            $query = "DELETE FROM users WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $data = [
                    "code" => 1,
                    "status" => 200,
                    "msg" => "User Deleted Successfully!"
                ];
                http_response_code(200); // Set HTTP response code for success
                return json_encode($data, JSON_PRETTY_PRINT);
            } else {
                $data = [
                    "code" => 0,
                    "status" => 404,
                    "msg" => "User Not Found!"
                ];
                http_response_code(404); // Set HTTP response code for not found
                return json_encode($data, JSON_PRETTY_PRINT);
            }
        } catch (PDOException $e) {
            // Log the error message internally
            error_log("Internal Server Error: " . $e->getMessage());

            $data = [
                "code" => 0,
                "status" => 500,
                "msg" => "Internal Server Error"
            ];
            http_response_code(500); // Set HTTP response code for server error
            return json_encode($data, JSON_PRETTY_PRINT);
        }
    }

}

?>