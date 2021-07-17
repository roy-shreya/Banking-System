<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transfer</title>
        <?php include 'connect.php'?>
        <?php include 'links.php'?>
    </head>
    <body>
        <!-- Navigation bar -->
        <?php include 'navbar.php' ?>
        <div class="form">
            <form action="" method="POST">
                <?php

                    //Fetching sender details
                    $ano = $_GET['id'];
                    $int_ano = (int)$ano;
                    $senderquery = "select * from customers where AccountNo='$int_ano' ";
                    $senderdata = mysqli_query($conn, $senderquery);
                    $senderarrdata = mysqli_fetch_array($senderdata);

                    //On pressing transfer
                    if(isset($_POST['transfer'])){
                        //Getting the details
                        $sname = $_POST['sname'];
                        $saccount = (int)$_POST['saccount'];
                        $rname = $_POST['rname'];
                        $raccount = (int)$_POST['raccount'];
                        $amount = $_POST['amount'];

                        //fetching receiver details
                        $receiverquery = "select * from customers where AccountNo='$raccount'and name='$rname' ";
                        $receiverdata = mysqli_query($conn, $receiverquery);
                        $receiverarrdata = mysqli_fetch_array($receiverdata);
                        if($receiverarrdata == false){
                        ?>
                            <script>
                                alert("Wrong username or account number");
                            </script>
                        <?php
                        }
                        else{
                            //Sender balance after transfer 
                            $senderbalance = $senderarrdata['Balance']-(int)$amount;

                            //Checking if the balance is less than minimum balance
                            if($senderbalance < 1000){
                            ?>
                                <script>
                                    alert('Transaction failed: Insufficient balance');
                                </script>
                            <?php                        
                            }
                            //Checking if the transferable amount more than limit
                            elseif ((int)$amount > 10000) {
                            ?>
                                <script>
                                    alert('Transaction failed: Cannot send more than 10,000');
                                </script>
                            <?php    
                            }
                            else{
                                //Reciever balance after transfer 
                                $receiverbalance = $receiverarrdata['Balance'] + (int)$amount;
                                //Updating details for sender
                                $senderupdatequery = "update customers SET Balance='$senderbalance' WHERE AccountNo = '$saccount' and name='$sname' ";
                                $senderres = mysqli_query($conn, $senderupdatequery);
                                //Updating details for receiver
                                $receiverupdatequery = "update customers SET Balance='$receiverbalance' WHERE AccountNo = '$raccount' and name='$rname' ";
                                $receiverres = mysqli_query($conn, $receiverupdatequery);

                                //Inserting into transaction table
                                $amount = (int)$amount;
                                $transactionquery = "insert into transaction(sender, sender_acc, receiver, receiver_acc, amt) values('$sname','$saccount','$rname','$raccount','$amount') ";
                                $transactiionres = mysqli_query($conn, $transactionquery);
                                if($transactiionres){
                                ?>
                                    <script>
                                        alert("Transaction successsful");
                                    </script>
                                <?php
                                }
                                else{
                                ?>
                                    <script>
                                        alert("Transaction failed");
                                    </script>
                                <?php
                                }
                            }
                        }
                
                    }

                ?>
                <!-- Form for Tranfering money -->
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control form-input" name="sname" value="<?php echo $senderarrdata['name']?>" placeholder="Sender name" readonly>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-input" name="saccount" value="<?php echo $senderarrdata['AccountNo']?>" placeholder="Sender Account Number" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control form-input" name="rname" placeholder="Receiver name" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-input" name="raccount" placeholder="Receiver Account Number" required>
                    </div>
                </div>
                <input type="text" class="form-control form-input" name="amount" placeholder="Amount" required>
                <button type="submit" class="btn btn-secondary form-input" name="transfer">Transfer</button>
            </form>
        </div>
    </body>
</html>