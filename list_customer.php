<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    From: <input id="from" type="text" name="from" placeholder="yyyyy/mm/dd"
                 value="<?php echo isset($from_date) ? $from_date : ''; ?>"/>
    To: <input id="to" type="text" name="to" placeholder="yyyy/mm/dd"
               value="<?php echo isset($to_date) ? $to_date : ''; ?>"/>
    <input type="submit" id="submit" value="Lọc"/>
</form>
<?php
$customer_list = array(
    "0" => array("name" => "Mai Van Hoang", "day_of_birth" => "1983/08/20", "address" => "ha noi", "profile" => "img.jpg"),
    "1" => array("name" => "Nguyen Van A", "day_of_birth" => "1983/07/11", "address" => "son tay", "profile" => "img1.jpg"),
    "2" => array("name" => "Nguyen Van B", "day_of_birth" => "1983/10/21", "address" => "hai phong", "profile" => "img2.jpg"),

);

function searchByDate($customers, $from_date, $to_date)
{
    if (empty($from_date) && empty($to_date)) {
        return $customers;
    }
    $filtered_customers = [];
    foreach ($customers as $customer) {
        if (!empty($from_date) && (strtotime($customer['day_of_birth']) < strtotime($from_date)))
            continue;
        if (!empty($to_date) && (strtotime($customer['day_of_birth']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}

?>
<?php
$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customer_list, $from_date, $to_date);
?>
<table border="0">
    <caption><h2>Danh sach khach hang</h2></caption>
    <tr>
        <th>STT</th>
        <th>Name</th>
        <th>Date of birth</th>
        <th>Address</th>
        <th>Picture</th>
    </tr>
    <?php if (count($filtered_customers) === 0): ?>
        <tr>
            <td colspan="5" class="message">khong tim thay khach hang nao</td>
        </tr>
    <?php endif; ?>
    <?php foreach ($filtered_customers as $index => $customer): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $customer['name']; ?></td>
            <td><?php echo $customer['day_of_birth']; ?></td>
            <td><?php echo $customer['address']; ?></td>
            <td>
                <div class="profile"><img src="<?php echo $customer['profile']; ?>"></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
