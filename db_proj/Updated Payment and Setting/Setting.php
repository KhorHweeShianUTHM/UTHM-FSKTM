<?php
$conn = new mysqli("localhost", "root", "", "ahk_payments");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];

        //delete
        if ($action === "delete" && isset($_POST["user_id"])) {
            $id = (int)$_POST["user_id"];
            $stmt = $conn->prepare("DELETE FROM ahk_users WHERE user_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        //edit
        if (
        $action === "edit" &&
        isset($_POST["editUserId"], $_POST["editFullName"], $_POST["editEmail"], $_POST["editRole"])
    ) {
        $id = (int)$_POST["editUserId"];
        $fullName = $_POST["editFullName"];
        $email = $_POST["editEmail"];
        $role = $_POST["editRole"];

        $updatePassword = false;
        if (!empty($_POST["editPassword"])) {
            $password = password_hash($_POST["editPassword"], PASSWORD_BCRYPT);
            $updatePassword = true;
        }

        if ($updatePassword) {
            $stmt = $conn->prepare("UPDATE ahk_users SET full_name = ?, email = ?, password = ?, role = ? WHERE user_id = ?");
            $stmt->bind_param("ssssi", $fullName, $email, $password, $role, $id);
        } else {
            $stmt = $conn->prepare("UPDATE ahk_users SET full_name = ?, email = ?, role = ? WHERE user_id = ?");
            $stmt->bind_param("sssi", $fullName, $email, $role, $id);
        }

        $stmt->execute();
        $stmt->close();
    }


    } else {
        // Add new user
        $fullName = $_POST["full_name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $role = $_POST["role"];

        $stmt = $conn->prepare("INSERT INTO ahk_users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullName, $email, $password, $role);
        $stmt->execute();
        $stmt->close();
    }
}

    // Return updated user table
    $result = $conn->query("SELECT user_id, full_name, email, role FROM ahk_users");
    while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td class='user-id'>#" . str_pad($row["user_id"], 3, '0', STR_PAD_LEFT) . "</td>
        <td class='user-name'>" . htmlspecialchars($row["full_name"]) . "</td>
        <td class='user-email'>" . htmlspecialchars($row["email"]) . "</td>
        <td class='user-role'>" . htmlspecialchars($row["role"]) . "</td>
        <td class='user-actions'>
            <button class='edit-user-btn' title='Edit'
                data-id='" . htmlspecialchars($row["user_id"]) . "'
                data-name='" . htmlspecialchars($row["full_name"]) . "'
                data-email='" . htmlspecialchars($row["email"]) . "'
                data-role='" . htmlspecialchars($row["role"]) . "'>
                <i class='fas fa-pen'></i>
            </button>
            <button class='delete-btn' title='Delete' data-id='" . htmlspecialchars($row["user_id"]) . "'>
                <i class='fas fa-trash'></i>
            </button>
        </td>
    </tr>";
    }



$conn->close();
?>
