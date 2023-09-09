<!DOCTYPE html>
<html>

<head>
   <title>Hitung Porsi Array</title>
</head>

<body>
   <h1>Hitung Porsi Array</h1>
   <form method="post" action="">
      <label for="jumlah-elemen">Jumlah Elemen:</label>
      <input type="number" id="jumlah-elemen" name="jumlah-elemen" min="1" required>
      <br>
      <label for="nilai-array">Nilai Array (dipisahkan dengan spasi):</label>
      <input type="text" id="nilai-array" name="nilai-array" required>
      <br>
      <input type="submit" value="Submit">
   </form>

   <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $jumlahElemen = $_POST["jumlah-elemen"];
      $inputArray = explode(" ", $_POST["nilai-array"]);

      if (count($inputArray) != $jumlahElemen) {
         echo "<p>Jumlah elemen yang dimasukkan tidak sesuai dengan jumlah nilai yang dimasukkan.</p>";
      } else {
         $jumlahPositif = 0;
         $jumlahNegatif = 0;
         $jumlahNol = 0;

         foreach ($inputArray as $value) {
            $nilai = (int) $value;
            if ($nilai > 0) {
               $jumlahPositif++;
            } elseif ($nilai < 0) {
               $jumlahNegatif++;
            } else {
               $jumlahNol++;
            }
         }

         $totalElemen = count($inputArray);
         $porsiPositif = $jumlahPositif / $totalElemen;
         $porsiNegatif = $jumlahNegatif / $totalElemen;
         $porsiNol = $jumlahNol / $totalElemen;

         echo "<p>Porsi Minus: " . number_format($porsiNegatif, 6) . "</p>";
         echo "<p>Porsi Plus: " . number_format($porsiPositif, 6) . "</p>";
         echo "<p>Porsi Nol: " . number_format($porsiNol, 6) . "</p>";
      }
   }
   ?>
</body>

</html>