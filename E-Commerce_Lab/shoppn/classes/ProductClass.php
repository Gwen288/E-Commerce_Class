<?php

require_once __DIR__ . '/../core/db_class.php';

class ProductClass extends Database
{
    public function addBrand($name)
    {
        $sql = "INSERT INTO brands (brand_name)
                VALUES (?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function getAllBrands()
    {
        $sql = "SELECT *
                FROM brands
                ORDER BY brand_name ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBrandById($id)
{
    $sql = "SELECT *
            FROM brands
            WHERE brand_id = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    }

    return false;
}


public function updateBrand($id, $name)
{
    $sql = "UPDATE brands
            SET brand_name = ?
            WHERE brand_id = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("si", $name, $id);

    return $stmt->execute();
}

public function addCategory($name)
{
    $sql = "INSERT INTO categories (cat_name)
            VALUES (?)";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}


public function getAllCategories()
{
    $sql = "SELECT *
            FROM categories
            ORDER BY cat_name ASC";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

public function getCategoryById($id)
{
    $sql = "SELECT *
            FROM categories
            WHERE cat_id = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    }

    return false;
}


public function updateCategory($id, $name)
{
    $sql = "UPDATE categories
            SET cat_name = ?
            WHERE cat_id = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->bind_param("si", $name, $id);

    return $stmt->execute();
}




}