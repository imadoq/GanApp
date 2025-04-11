<?php
include("dbConnection.php");
function insertUser($id, $firstName, $lastName, $address)
{
    $sql = "INSERT INTO tbl_users (regID, firstName, lastName, address) VALUES (?, ?, ?, ?)";
    if ($stmt = $GLOBALS["conn"]->prepare($sql)) {
        $stmt->bind_param("isss", $id, $firstName, $lastName, $address);
        if ($stmt->execute()) {
            return ["status" => "success", "message" => "New record created successfully"];
        } else {
            return ["status" => "error", "message" => $stmt->error];
        }
    } else {
        return ["status" => "error", "message" => $GLOBALS["conn"]->error];
    }
}