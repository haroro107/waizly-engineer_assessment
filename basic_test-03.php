<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Konversi Waktu</title>
</head>

<body>
   <form method="post">
      <label for="waktu">Waktu (hh:mm:ssAM/PM):</label>
      <input type="text" id="waktu" name="waktu" pattern="^(0[1-9]|1[0-2]):[0-5][0-9]:[0-5][0-9](AM|PM)$">
      <button type="submit" name="konversi">Konversi ke 24 Jam</button>
   </form>

   <?php
   if (isset($_POST['konversi'])) {
      $inputWaktu = $_POST['waktu'];
      $regex = '/^(0[1-9]|1[0-2]):[0-5][0-9]:[0-5][0-9](AM|PM)$/';

      if (preg_match($regex, $inputWaktu)) {
         $parts = explode(':', $inputWaktu);
         $time = substr($parts[2], 0, 2);
         $isPM = substr($parts[2], 2) === "PM";
         $hours = (int) $parts[0];
         $minutes = (int) $parts[1];

         if ($isPM && $hours !== 12) {
            $hours += 12;
         } elseif (!$isPM && $hours === 12) {
            $hours = 0;
         }

         $formattedTime = sprintf('%02d:%02d:%s', $hours, $minutes, $time);
         echo "Waktu dalam format 24 Jam: $formattedTime";
      } else {
         echo "Format waktu tidak valid. Gunakan format hh:mm:ssAM/PM.";
      }
   }
   ?>
</body>

</html>