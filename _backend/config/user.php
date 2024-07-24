<?php

class User
{
    private $connection;
    private $table_name = 'users';

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function read()
    {
        $limit = $_GET['limit'];
        $page = $_GET['page'];
        $start = ($page - 1) * $limit;
        $query = "SELECT * FROM {$this->table_name} LIMIT {$start}, {$limit}";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readAll()
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

        $this->username = $row["username"];
        $this->password = $row["password"];
        $this->email = $row["email"];
        $this->address = $row["address"];
        $this->status = $row["status"];
        $this->avatar = $row["avatar"];
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
        $username = htmlspecialchars($input["username"]);
        $password = htmlspecialchars($input["password"]);
        $email = htmlspecialchars($input["email"]);
        $address = htmlspecialchars($input["address"]);
        $status = htmlspecialchars($input["status"]);

        if (empty(trim($username))) {
            return $this->error404("Please enter number");
        } elseif (empty(trim($password))) {
            return $this->error404("Please enter password");
        } else {
            try {

                if ($_FILES["avatar"]["error"] === 4) {
                    # Image does not exist
                } else {
                    $fileName = $_FILES['avatar']['name'];
                    $fileSize = $_FILES['avatar']['size'];
                    $tmpName = $_FILES['avatar']['tmp_name'];
                    $folder = __DIR__ . '/avatar/';

                    $validImagesExtension = ['jpg', 'jpeg', 'png'];

                    $imagesExtension = explode('.', $fileName);
                    $imagesExtension = strtolower(end($imagesExtension));

                    if (!in_array($imagesExtension, $validImagesExtension)) {
                        #Images not support
                    } else {

                        $newImageName = uniqid();
                        $newImageName .= '.' . $imagesExtension;

                        if (!is_dir($folder)) {
                            mkdir($folder, 0777, true);
                        }

                        $uploadFile = $folder . basename($newImageName);

                        move_uploaded_file($tmpName, $uploadFile);
                        $avatar = $newImageName;
                        $query = "INSERT INTO users (username, password, email, address, status, avatar) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $this->connection->prepare($query);
                        $stmt->execute([$username, $password, $email, $address, $status, $avatar]);

                        $data = [
                            "code" => 1,
                            "status" => 201,
                            "msg" => "User Created Successfully!",
                            'data' => [
                                "id" => $this->connection->lastInsertId(),
                                'username' => $username,
                                'password' => $password,
                                'email' => $email,
                                'address' => $address,
                                'status' => $status,
                                'avatar' => $avatar
                            ]
                        ];
                        http_response_code(201); // Set HTTP response code

                        return json_encode($data, JSON_PRETTY_PRINT);


                    }
                }

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

    public function modify($input)
    {
        $user_id = htmlspecialchars($input["id"]);
        $username = htmlspecialchars($input["username"]);
        $email = htmlspecialchars($input["email"]);
        $address = htmlspecialchars($input["address"]);
        $status = htmlspecialchars($input["status"]);

        if (empty(trim($username))) {
            return $this->error404("Please enter a username");
        } elseif (empty(trim($email))) {
            return $this->error404("Please enter an email");
        } elseif (empty(trim($address))) {
            return $this->error404("Please enter an address");
        } else {
            try {
                // $avatar = null;
                if ($_FILES["avatar"]["error"] === 4) {
                    # Image does not exist
                } else {
                    $fileName = $_FILES['avatar']['name'];
                    $fileSize = $_FILES['avatar']['size'];
                    $tmpName = $_FILES['avatar']['tmp_name'];
                    $folder = __DIR__ . '/avatar/';

                    $validImagesExtension = ['jpg', 'jpeg', 'png'];

                    $imagesExtension = explode('.', $fileName);
                    $imagesExtension = strtolower(end($imagesExtension));

                    if (!in_array($imagesExtension, $validImagesExtension)) {
                        #Images not support
                    } else {

                        $newImageName = uniqid();
                        $newImageName .= '.' . $imagesExtension;

                        if (!is_dir($folder)) {
                            mkdir($folder, 0777, true);
                        }

                        $uploadFile = $folder . basename($newImageName);

                        move_uploaded_file($tmpName, $uploadFile);
                        $avatar = $newImageName;



                        $query = "UPDATE users SET username = ?, email = ?, address = ?, status= ?, avatar = ? WHERE id = ?";
                        $stmt = $this->connection->prepare($query);
                        $stmt->execute([$username, $email, $address, $status, $avatar, $user_id]);

                        $data = [
                            "code" => 1,
                            "status" => 201,
                            "msg" => "User Updated Successfully!",
                            'data' => [
                                'id' => $user_id,
                                'username' => $username,
                                'email' => $email,
                                'address' => $address,
                                'status' => $status,
                                'avatar' => $avatar,
                            ]
                        ];
                        http_response_code(201); // Set HTTP response code

                        return json_encode($data, JSON_PRETTY_PRINT);

                    }
                }

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

    public function disableUser($input)
    {
        $user_id = htmlspecialchars($input["id"]);

        if ($user_id != "") {
            try {

                $status = 0;
                $query = "UPDATE users SET status = '$status' WHERE id = ?";
                $stmt = $this->connection->prepare($query);
                $stmt->execute([$user_id]);

                $data = [
                    "code" => 1,
                    "status" => 201,
                    "msg" => "User Updated Successfully!",
                    'data' => null
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
            // $avatar = null;
        } else {
            $data = [
                "code" => 0,
                "status" => 400,
                "msg" => "User ID is required"
            ];
            http_response_code(400); // Set HTTP response code for bad request
            return json_encode($data, JSON_PRETTY_PRINT);
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