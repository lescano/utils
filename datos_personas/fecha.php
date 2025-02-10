<?php

class FechaNacimiento
{
    function random_date() {
        $currentYear = date("Y");
        
        // Rango de edad permitido
        $minAge = 18;
        $maxAge = 70;
        
        $year = rand($currentYear - $maxAge, $currentYear - $minAge);
        
        $month = rand(1, 12);
        
        $day = rand(1, cal_days_in_month(CAL_GREGORIAN, $month, $year));
        
        return sprintf("%04d-%02d-%02d", $year, $month, $day);
    }

    function edad($fechaNacimiento) {
        $fechaNacimiento = new DateTime($fechaNacimiento);
        $hoy = new DateTime(); // Fecha actual
        $edad = $hoy->diff($fechaNacimiento)->y; // Calcula la diferencia en años
        return $edad;
    }

}
?>
