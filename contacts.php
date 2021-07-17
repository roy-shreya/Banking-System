<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customers</title>
        <?php include 'links.php' ?>
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include 'navbar.php' ?>
        <div class="main_div">
            <div class="center_div">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer Name </th>
                                <th>Account Number </th>
                                <th>Email-id </th>
                                <th>Balance </th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $selectquery = "select * from customers";
                                $query = mysqli_query($conn, $selectquery);
                                $num = mysqli_num_rows($query);
                                while($res = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td><?php echo $res['name']?></td>
                                <td><?php echo $res['AccountNo']?></td>                                                
                                <td><?php echo $res['Email']?></td>
                                <td><?php echo $res['Balance']?></td>
                                <td><a class=" btn btn-dark btn-sm" href="transfer.php?id=<?php echo $res['AccountNo']; ?>">Transfer</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
    </body>
</html>