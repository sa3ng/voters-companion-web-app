<?php
require_once 'globals.php';
require_once '../phpModels/UserModel.php';
require_once 'usr_page_functions.php';


function fetchUsers(array $db_credentials)
{
    $return = [];
    $conn = connectDB($db_credentials);

    $stmt = $conn->prepare("SELECT * FROM accTBL");
    $stmt->execute();

    $result = $stmt->get_result();
    while ($current = $result->fetch_assoc()) {

        if (isLoggedIn()) {
            if ((isAdmin($db_credentials))) {
                if (!($_COOKIE['acc_name'] == $current['name'])) {
                    array_push(
                        $return,
                        new UserModel(
                            $current['acc_id'],
                            $current['name'],
                            $current['email'],
                            $current['type']
                        )
                    );
                }
            }
        } else { //temporary else to catch if not logged in; Mainly for debug
            array_push(
                $return,
                new UserModel(
                    $current['acc_id'],
                    $current['name'],
                    $current['email'],
                    $current['type']
                )
            );
        }
    }

    $stmt->close();
    $conn->close();

    return $return;
}

function displayUsers(array $users)
{
    foreach ($users as $value) {
        echo
        "
        <tr>
            <td data-label='ID'>" . $value->getAccID() . "</td>
            <td data-label='Username'>" . $value->getName() . "</td>
            <td data-label='Role'>" . $value->getType() . "</td>
            <td data-label='UpdateRole'>
            <div class='buttons are-small'>
                <button name='edit-role' class='button is-info is-light'>user</button>
                <button name='edit-role' class='button is-warning is-light'>editor</button>
                <button name='edit-role' class='button is-danger is-light'>admin</button>
            </div>
            </td>
            <td data-label='Created'>
            <small class='has-text-grey is-abbr-like'>June 9, 2022</small>
            </td>


            <td class='is-actions-cell'>
            <div class='buttons is-right'>
                <button class='button is-small is-primary' type='button'>
                <span class='icon'><i class='fa fa-eye'></i></span>
                </button>
                <button name='delete-user' class='button is-small is-danger jb-modal' data-target='sample-modal' type='button'>
                <i class='fa fa-trash'></i>
                </button>
            </div>
            </td>
        </tr>
        ";
    }
}
