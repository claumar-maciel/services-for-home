<?php

namespace App\Helpers;

class StringHelper
{

    public static function somenteNumeros(string $valor): string
    {
        $valor = preg_replace('/[^0-9]/', '', $valor);
        
        return $valor;
    }

    public static function removerFormatacaoValor( $stringValor)
    {
        if( is_null( $stringValor) || empty( $stringValor)) {
            return null;
        }
        
        $stringValor = preg_replace('/[^0-9,.]/', '', $stringValor);
        $firstMarkNotFound = 1;
        $tmpStr = '';
        for ($i = $j = strlen($stringValor) - 1; $i >= 0; $i--) {

            if ($firstMarkNotFound && ($stringValor[$i] == ',' || $stringValor[$i] == '.')) {
                $firstMarkNotFound = 0;
                $tmpStr[$j] = '.';
                $j--;
            }

            if ($stringValor[$i] != ',' && $stringValor[$i] != '.') {
                $tmpStr[$j] = $stringValor[$i];
                $j--;
            }
        }
        return trim($tmpStr);
    }

    public static function removerZerosAEsquerda( string $stringComZerosAEsquerda) {

        $retorno = '';
        for( $i = 0; $i < strlen( $stringComZerosAEsquerda); $i++) {
            if( $stringComZerosAEsquerda[$i] != '0') {
                $retorno = substr( $stringComZerosAEsquerda, $i);
                break;
            }
        }

        return $retorno;
    }

    public static function removerCaracteresNaoAlphanumericos( string $string) {
        return preg_replace("/[^A-Za-z0-9 ]/", '', $string);
    }

    public static function removerAcentos( string $string) {
        return strtr(utf8_decode($string), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }
}
