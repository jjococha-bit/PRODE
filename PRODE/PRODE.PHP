function calcularPuntos(
    $realLocal,
    $realVisitante,
    $pronLocal,
    $pronVisitante
) {

    // Marcador exacto
    if (
        $realLocal == $pronLocal &&
        $realVisitante == $pronVisitante
    ) {
        return 90;
    }

    $puntos = 0;

    // Resultado (1/X/2)

    $resultadoReal =
        ($realLocal > $realVisitante) ? 1 :
        (($realLocal < $realVisitante) ? 2 : 0);

    $resultadoPron =
        ($pronLocal > $pronVisitante) ? 1 :
        (($pronLocal < $pronVisitante) ? 2 : 0);

    if ($resultadoReal == $resultadoPron) {
        $puntos += 48;
    }

    // Goles local

    if ($realLocal == $pronLocal) {
        $puntos += 15;
    }

    // Goles visitante

    if ($realVisitante == $pronVisitante) {
        $puntos += 15;
    }

    // Diferencia de goles

    $difReal = $realLocal - $realVisitante;
    $difPron = $pronLocal - $pronVisitante;

    if ($difReal == $difPron) {
        $puntos += 12;
    }

    return $puntos;
}