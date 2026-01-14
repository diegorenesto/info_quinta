<?php
// DATETIME
$data = new DateTime();
echo "Data di oggi: " . $data->format("d/m/y") . "<br>";
echo "Ora di adesso: " . $data->format("H:i:s") . "<br>";

$data->modify("+2 days");
echo "Data + 2 giorni: " . $data->format("d/m/y") . "<br>";

$data2 = new DateTime("+2 months");
echo "Data + 2 mesi: " . $data2->format("d/m/y") . "<br>";

echo "Differenza tra due date (giorni): ";
$dif1 = new DateTime("2025-02-10 12:12:35");
$dif2 = new DateTime("2025-01-05 10:10:30");

$differenza = $dif1->diff($dif2);
echo $differenza->days . "<br>";
echo "Differenza completa: " . $differenza->format("%y-%m-%d %H-%i-%s") . "<br>";

// Intervallo: 1 anno, 3 mesi, 4 giorni, 2h 3m 4s
$intervallo = new DateInterval("P1Y3M4DT2H3M4S");

// NUOVA data senza clone → ricreo l'oggetto
$newDate = new DateTime($dif1->format("Y-m-d H:i:s"));
$newDate->add($intervallo);

echo "Nuova data dopo l'intervallo: " . $newDate->format("d/m/y") . "<br>";
