
<?php
class Signup {

private $error = "";

public function evaluate($data) {
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $this->error .= $key . " is empty!! <br>";
        }

        if ($key === "first-name") {
            if (is_numeric($value)) {
                $this->error .= "First name must NOT be numeric <br>";
            }

            if (!preg_match("/^[a-zA-Z]{3,20}(?: ?[a-zA-Z]{0,20}){0,2}$/", $value)) {
                $this->error .= "Invalid format for first name (should contain only letters, between 3 and 20 characters) <br>";
            }
        }

        if ($key === "last-name") {
            if (is_numeric($value)) {
                $this->error .= "Last name must NOT be numeric <br>";
            }

            if (!preg_match("/^[a-zA-Z]{3,20}(?: ?[a-zA-Z]{0,20}){0,2}$/", $value)) {
                $this->error .= "Invalid format for last name (should contain only letters, between 3 and 20 characters) <br>";
            }
        }

        if ($key === "phone_number") {
            if (!is_numeric($value)) {
                $this->error .= "Phone number must be numeric ONLY <br>";
            }

            if (!preg_match("/^[0-9]{10}$/", $value)) {
                $this->error .= "Invalid mobile number. Please enter a 10-digit phone number. <br>";
            }
        }

        if ($key === "email") {
            if (!filter_var(trim($value), FILTER_VALIDATE_EMAIL)) {
                $this->error .= "Invalid email format <br>";
            }
        }

        if ($key === "password") {
            if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)[a-zA-Z0-9\W]{8,}$/", trim($value))) {
                $this->error .= "Invalid password format. Password must contain at least 8 characters long and include at least one lowercase letter, one uppercase letter, one special character, and one number. <br>";
            }
        }
    }

    if ($this->error == "") {
        // No error
        $this->create_user($data);
    } else {
        // There are errors
        return "alert('The following errors occurred: \\n\\n" . $this->error . "');";
    }
}

public function create_user($data) {
    $firstName = $data["first-name"];
    $lastName = $data["last-name"];
    $phoneNumber = $data["phone-number"];
    $email = $data["email"];
    $password = $data["password"];

    // Sanitize input if necessary

    // Create a connection to the database

    // Assuming you have a connection to the database and $DB->save() method in Database class
    $query = "INSERT INTO user (first_name, last_name, Phone_number, Email, password) VALUES ('$firstName', '$lastName', '$phoneNumber', '$email', '$password')";

    // Execute the query
     $DB = new Database();
    //  $DB->save($query);
// }
}}
?>
