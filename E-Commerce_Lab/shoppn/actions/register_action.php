<?php

require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/CustomerController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../views/register.php');
}

$name = trim(strip_tags($_POST['name'] ?? ''));
$email = trim(strip_tags($_POST['email'] ?? ''));
$pass = $_POST['pass'] ?? '';
$country = trim(strip_tags($_POST['country'] ?? ''));
$city = trim(strip_tags($_POST['city'] ?? ''));
$contact = trim(strip_tags($_POST['contact'] ?? ''));

// Check that all required fields were provided
if (
    $name === '' ||
    $email === '' ||
    $pass === '' ||
    $country === '' ||
    $city === '' ||
    $contact === ''
) {
    $_SESSION['error'] = 'All required fields must be completed.';
    redirect('../views/register.php');
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Please enter a valid email address.';
    redirect('../views/register.php');
}

// Check email length based on the database schema
if (strlen($email) > 100) {
    $_SESSION['error'] = 'Email address must not exceed 100 characters.';
    redirect('../views/register.php');
}

$data = [
    'name' => $name,
    'email' => $email,
    'pass' => $pass,
    'country' => $country,
    'city' => $city,
    'contact' => $contact
];

$controller = new CustomerController();

$result = $controller->register($data);

// Registration successful
if ($result['success']) {
    $_SESSION['customer_id'] = $result['customer_id'];
    $_SESSION['user_role'] = $result['user_role'];

    redirect('../views/account/my_account.php');
    exit;
}

// Registration failed
$_SESSION['error'] = $result['error'];

redirect('../views/register.php');

