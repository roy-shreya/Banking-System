<!-- Displaying the transaction history -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SparksBank</title>
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
                                    <th>Transaction Id</th>
                                    <th>Sender Name </th>
                                    <th>Sender Account Number </th>
                                    <th>Receiver Name </th>
                                    <th>Receiver Account Number </th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $selectquery = "select * from transaction";
                                $query = mysqli_query($conn, $selectquery);
                                while($res = mysqli_fetch_array($query)){
                            ?>
                                <tr>
                                    <td><?php echo $res['tran_id'];?></td>
                                    <td><?php echo $res['sender'];?></td>
                                    <td><?php echo $res['sender_acc'];?></td>                        
                                    <td><?php echo $res['receiver'];?></td>
                                    <td><?php echo $res['receiver_acc'];?></td>
                                    <td><?php echo $res['amt'];?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>