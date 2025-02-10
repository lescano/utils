<?php

class Correo
{
    function random_correo($nombre, $apellido, $fechaNacimiento) {
    
        // Convertimos todo a minúsculas y eliminamos tildes
        $nombre = strtolower($this->eliminar_tildes($nombre));
        $apellido = strtolower($this->eliminar_tildes($apellido));

        // Extraemos año de nacimiento
        $anioNacimiento = date('Y', strtotime($fechaNacimiento));

        // Posibles dominios de correo
        $dominios = ['gmail.com', 'outlook.com', 'hotmail.com'];

        // Generar tres correos electrónicos aleatorios
        $correos = [];

        $numeroAleatorio = rand(10, 99); // Número aleatorio para variar

        // Formatos de correo posibles
        $formatos = [
            "{$nombre}.{$apellido}{$numeroAleatorio}@{$dominios[array_rand($dominios)]}",
            "{$apellido}_{$nombre}{$anioNacimiento}@{$dominios[array_rand($dominios)]}",
            substr($nombre, 0, 1) . "{$apellido}@{$dominios[array_rand($dominios)]}",
        ];

        $correos = [$formatos[0], $formatos[1], $formatos[2]];
        return $correos;
    }

    function eliminar_tildes($cadena) {
        $dic = [
            "Á"=>"A",
            "É"=>"E",
            "Í"=>"I",
            "Ó"=>"O",
            "Ú"=>"U",11111
            "á"=>"a",
            "é"=>"e",
            "í"=>"i",
            "ó"=>"o",
            "ú"=>"u",
            "Ü"=>"U",
            "ü"=>"u",
        ];
        return strtr($cadena, $dic);
    }

}
?>
