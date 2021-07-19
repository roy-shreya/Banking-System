<!-- File to fetch data for modal view -->
<?php
$user = 'root';
$pass = '';
$server = 'localhost';
$db  = 'bankingsystem';

$conn = mysqli_connect($server, $user, $pass, $db) or die("No connection".mysqli_connect_error());
if(isset($_POST['checking_viewbtn'])){
    $ano = $_POST['customer_ano'];

    $selectquery = "select * from customers where AccountNo='$ano' ";
    $query = mysqli_query($conn, $selectquery);
    while($res = mysqli_fetch_array($query)){
        echo $return = '
            <h3>'.$res['name'].'</h3>
            <p>Account Number: '.$res['AccountNo'].'</p>
            <p>Email ID: '.$res['Email'].'</p>
            <p>Balance: '.$res['Balance'].'</p>
        ';
    } 
}
?>