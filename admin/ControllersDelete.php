<?php

    include_once '../services/config.php';


    if (isset($_GET['delete_user']))
    {
        $id_deleteUser = mysqli_real_escape_string($conn, $_GET['delete_user']);

        $stmt_user = mysqli_prepare($conn, "DELETE FROM users WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt_user, "i", $id_deleteUser);
        $execute_user = mysqli_stmt_execute($stmt_user);

        if ($execute_user) {
            header('Location: users.php');
            exit;
        }
    }


    if (isset($_GET['delete_role']))
    {
        $id_deleteRole = mysqli_real_escape_string($conn, $_GET['delete']);

        $stmt_role = mysqli_prepare($conn, "DELETE FROM roles WHERE role_id = ?");
        mysqli_stmt_bind_param($stmt_role, "i", $id_delete);
        $execute_role = mysqli_stmt_execute($stmt_role);

        if ($execute_role) {
            header('Location: roles.php');
            exit;
        }
    }


    if (isset($_GET['delete_domain']))
    {
        $id_deleteDomain = mysqli_real_escape_string($conn, $_GET['delete_domain']);

        $stmt_domain = mysqli_prepare($conn, "DELETE FROM domains WHERE domain_id = ?");
        mysqli_stmt_bind_param($stmt_domain, "i", $id_deleteDomain);
        $execute_domain = mysqli_stmt_execute($stmt_domain);

        if ($execute_domain) {
            header('Location: domain.php');
            exit;
        }
    }


    if (isset($_GET['delete_satker']))
    {
        $id_deleteSatker = mysqli_real_escape_string($conn, $_GET['delete_satker']);

        $stmt_satker = mysqli_prepare($conn, "DELETE FROM sarkers WHERE satker_id = ?");
        mysqli_stmt_bind_param($stmt_satker, "i", $id_deleteSatker);
        $execute_satker = mysqli_stmt_execute($stmt_satker);

        if ($execute_satker) {
            header('Location: satker.php');
            exit;
        }
    }

    // function deleteDomain(int $id)
    // {
    //     $id_deleteDomain = $id;

    //     $stmt = mysqli_prepare($conn, "DELETE FROM roles WHERE role_id = ?");
    //     mysqli_stmt_bind_param($stmt, "i", $id_deleteDomain);
    //     $execute = mysqli_stmt_execute($stmt);

    //     if ($execute) {
    //         header('Location: roles.php');
    //         exit;
    //     }
    // }

?>