<?php

//funiones distribuidas por https://github.com/picandocodigo/ci_js y https://github.com/leeway-academy/ci_php

class CiValidator
{
    public function clean_ci( string $ci ) : string
    {
        return preg_replace( '/\D/', '', $ci );
    }

    public function validation_digit( string $ci ) : int
    {
        $ci = $this->clean_ci( $ci );

        $ci = str_pad( $ci, 7, '0', STR_PAD_LEFT );
        $a = 0;

        $baseNumber = "2987634";
        for ( $i = 0; $i < 7; $i++ ) {
            $baseDigit = $baseNumber[ $i ];
            $ciDigit = $ci[ $i ];

            $a += ( intval($baseDigit ) * intval( $ciDigit ) ) % 10;
        }

        return $a % 10 == 0 ? 0 : 10 - $a % 10;
    }
    
    function random_ci() : string
    {
        $ci = (string)floor( ((float)rand()/(float)getrandmax() ) * 10000000 );

        return substr( $ci, 0, 7 ) . $this->validation_digit( $ci );
    }
}