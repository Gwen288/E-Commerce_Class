
<?php

require_once __DIR__ . '/../core/db_class.php';

class CustomerClass extends Database
{
    public function emailExists($email)
    {
        $sql = "SELECT customer_email
                FROM customer
                WHERE customer_email = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }


    public function addCustomer($name, $email, $pass, $country, $city, $contact)
    {
        // Hash the password before storing it
        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

        // Customer image is optional
        $customerImage = null;

        // 2 = customer
        $userRole = 2;

        $sql = "INSERT INTO customer
                (
                    customer_name,
                    customer_email,
                    customer_pass,
                    customer_country,
                    customer_city,
                    customer_contact,
                    customer_image,
                    user_role
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "sssssssi",
            $name,
            $email,
            $hashedPassword,
            $country,
            $city,
            $contact,
            $customerImage,
            $userRole
        );

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }

        return false;
    }

public function getCustomerByEmail($email){

    $sql="Select * from customer where customer_email= ?";

    $stmt= $this->conn->prepare($sql);

    $stmt->bind_param("s",$email);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1){
         return $result->fetch_assoc();
        
    }

    return false;
}



public function login($email,$pass){

    $customer= $this->getCustomerByEmail($email);

    if($customer === false){
        return false;
    }

    if(password_verify($pass,$customer["customer_pass"])){
        return $customer;
    }

    return false;


}






}
