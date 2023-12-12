<?php
    function validarTelefono($telefono){
        // Elimina espacios en blanco y otros caracteres no deseados
        $telefono = preg_replace('/\D/', '', $telefono);

        // Verifica si el número de teléfono tiene la longitud adecuada
        if (strlen($telefono) === 9) {
            // Verifica si el número de teléfono comienza con "6"
            if (substr($telefono, 0, 1) === '6') {
                // Verifica si el número de teléfono consiste solo en dígitos
                if (ctype_digit($telefono)) {
                    return true; // Número de teléfono válido
                }
            }
        }

        return false; // Número de teléfono no válido
    }

    function validarDNI($dni) {
        // Elimina espacios en blanco y otros caracteres no deseados
        $dni = strtoupper(preg_replace('/\s/', '', $dni));
    
        // Verifica que el DNI tenga la longitud adecuada
        if (strlen($dni) === 9) {
            // Extrae los dígitos y la letra
            $digitos = substr($dni, 0, 8);
            $letra = substr($dni, 8, 1);
    
            // Verifica que los primeros 8 caracteres sean dígitos
            if (ctype_digit($digitos)) {
                // Calcula la letra correspondiente a los dígitos
                $letraCalculada = substr("TRWAGMYFPDXBNJZSQVHLCKE", $digitos % 23, 1);
    
                // Compara la letra calculada con la letra proporcionada
                if ($letra === $letraCalculada) {
                    return true; // DNI válido
                }
            }
        }
    
        return false;
    }
?>