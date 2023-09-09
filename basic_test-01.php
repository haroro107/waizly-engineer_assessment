<?php
$minSum = "";
$maxSum = "";

function miniMaxSum($arr)
{
   sort($arr);

   $minSum = array_sum(array_slice($arr, 0, 4));

   $maxSum = array_sum(array_slice($arr, -4));

   return [$minSum, $maxSum];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $input = $_POST["integerArray"];
   $arr = array_map('intval', explode(' ', $input));
   list($minSum, $maxSum) = miniMaxSum($arr);
}
?>

<!DOCTYPE html>
<html>

<head>
   <title>Kalkulasi MiniMaxSum</title>
</head>

<body>
   <form method="post">
      <label for="integerArray">Enter 5 integer (dipisah dengan spasi):</label>
      <input type="text" id="integerArray" name="integerArray" pattern="[0-9]+(\s[0-9]+){4}" title="Masukkan 5 integer yang dipisah dengan spasi." required>
      <input type="submit" value="Calculate MiniMaxSum">
   </form>

   <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if ($minSum !== "" && $maxSum !== "") {
         echo $minSum . ' ' . $maxSum;
      }
   }
   ?>
</body>

</html>