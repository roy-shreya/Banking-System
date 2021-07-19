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
                                <th colspan=2>Operation</th>
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
                                <td class="ano"><?php echo $res['AccountNo']?></td>                                                
                                <td><?php echo $res['Email']?></td>
                                <td><?php echo $res['Balance']?></td>
                                <td><a class=" btn btn-dark btn-sm view" href="#">View</a></td>
                                <td><a class=" btn btn-dark btn-sm" href="transfer.php?id=<?php echo $res['AccountNo']; ?>">Transfer</a></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Details: </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="details">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
        <script type='text/javascript'>
            $(document).ready(function(){
                $('.view').click(function (e){
                    e.preventDefault();
                    var cust_ano = $(this).closest('tr').find('.ano').text();

                    $.ajax({
                        type: "POST",
                        url: "view.php",
                        data: {
                            "checking_viewbtn": true,
                            "customer_ano": cust_ano
                        },
                        success: function(response){
                            $('.details').html(response)
                            $('#customerModal') .modal('show');

                        }
                    })
                })
            });
        </script>
    </body>
</html>