<?php
define("right_way", TRUE);
require_once("db.inc.php");

if (isset($_POST['disable']) and isset($_POST['check'])) {
    foreach ($_POST['check'] as $value) {
        $stmt = $db->prepare("UPDATE employee SET enabled = 0 WHERE id=:id LIMIT 1");
        $stmt->bindParam('id', $value);
        $stmt->execute();
    }
}


if (isset($_POST['enable']) and isset($_POST['check'])) {
    foreach ($_POST['check'] as $value) {
        $stmt = $db->prepare("UPDATE employee SET enabled = 1 WHERE id=:id LIMIT 1");
        $stmt->bindParam('id', $value);
        $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.js"></script>
    <title>Active and Deactive accounts page</title>
    <style>
    @font-face {
        font-family: clock;
        src: url(time/digital-7/digital-7.ttf);
    }

    #time {
        width: 25%;
        float: right;
        margin: 0 auto;
        font-family: clock;
        font-size: 3rem;
        bottom: 0;
        right: 0;
    }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Active Accounts</h2>
    <form id="form1" action="" method="post">
        <table border="1" cellpadding="0" cellspacing="0" width = 1000 style="text-align:center;">
            <thead style="background-color: green; color: white;">
                <th>
                <input type="checkbox" name="select-all" id="select-all" title="Select all">
                </th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Job</th>
                <th>Salary</th>
            </thead>
            <?php
            $stmt = $db->prepare("SELECT * FROM employee WHERE enabled = 1");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $f = $row['first_name'];
                $l = $row['last_name'];
                $t = $row['job_title'];
                $s = $row['salary'];
                $id = $row['id'];
            ?>
            <tr>
                <td>
                    <input type="checkbox" name="check[]" value="<?= $id ?>" title="Select this row">
                </td>
                <td><?= $f ?></td>
                <td><?= $l ?></td>
                <td><?= $t ?></td>
                <td><?= $s ?>/yr</td>
            </tr>
            <?php } ?>
        </table>
        <br><br>
        <input type="submit" name="disable" value="Disable Account"><br/><br>
    </form>
    <form action="" method="post" id="form2">

        <h2 style="text-align: center;">Deactivated Accounts</h2>
        <table border="1" cellpadding="0" cellspacing="0" width=1000 style="text-align: center;">
            <thead style="background-color:orangered; color: white;">
                <th>
                <input type="checkbox" name="select-all" id="select-all" title="Select all">
                </th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Job</th>
                <th>Salary</th>
            </thead>
            <?php
            $stmt = $db->prepare("SELECT * FROM employee WHERE enabled = 0");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $f = $row['first_name'];
                $l = $row['last_name'];
                $t = $row['job_title'];
                $s = $row['salary'];
                $id = $row['id'];
            ?>
            <tr>
                <td>
                    <input type="checkbox" name="check[]" value="<?= $id ?>" title="Select this row">
                </td>
                <td><?= $f ?></td>
                <td><?= $l ?></td>
                <td><?= $t ?></td>
                <td><?= $s ?>/yr</td>
            </tr>
            <?php } ?>
        </table>
        <br><br>
        <input type="submit" name="enable" value="Enable Account"><br><br>
    </form>
    <div id="time">
        00 : 00 : 00 PM
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <script>
    $(document).ready(function() {
        setInterval(function() {
            $('#time').load('time.php');
        }, 1000);
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#form1 #select-all").click(function() {
            $("#form1 input[type='checkbox']").prop('checked', this.checked);
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $("#form2 #select-all").click(function() {
            $("#form2 input[type='checkbox']").prop('checked', this.checked);
        });
    });
    </script>
</body>

</html>