<?php
require "models/generic.php";

$isPosted = filter_has_var(INPUT_POST, "person");

if ($isPosted) {
    try {
        $addressInput = $_POST["address"];
        $addressFilter = [
            "street" => FILTER_SANITIZE_STRING,
            "zip_code" => FILTER_SANITIZE_STRING,
            "city" => FILTER_SANITIZE_STRING,
        ];
        $address = filter_var_array($addressInput, $addressFilter);

        $addressId = genericInsert($address, "addresses");

        $person = filter_var_array($_POST["person"], [
            "last_name" => FILTER_SANITIZE_STRING,
            "first_name" => FILTER_SANITIZE_STRING,
        ]);
        $person["address_id"] = $addressId;

        genericInsert($person, "persons");
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

echo render("person-form", []);
