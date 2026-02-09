    <?php
    session_start();
    if (!isset($_SESSION['admin'])) {
        echo "<h1>Entra aqui mediante el panel de admin</h1>";
        echo '<a href="index.php"><button>Inicio</button></a><br>';
        die();
    }
    require_once 'funciones.php';
    $con = conectar();
    //USO EL MAX PARA VER SI AL MENOS UNA DE LAS SOLICITUDES ESTA ADMITIDA
    $stmt = $con->prepare("SELECT dni, puntos,
        (SELECT MAX(admitido) FROM solicitudes WHERE solicitudes.dni = solicitantes.dni) as admitido
        FROM solicitantes");
    $stmt->execute();
    $admitidos = [];
    $noAdmitidos = [];
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //VEO EL ADMITIDO Y ASI PUEDO CONSTRUIR LA COLA, SI EL USUARIO ES ADMITIDO SE VA AL FINAL
        if ($fila['admitido'] == 1) {
            $admitidos[$fila['dni']] = $fila['puntos'];
        } else {
            $noAdmitidos[$fila['dni']] = $fila['puntos'];
        }
    }
    //ORDENO POR PUNTOS AMBOS ARRAYS ANTES DE FUSIONARLOS
    arsort($noAdmitidos);
    arsort($admitidos);
    $cola = $noAdmitidos + $admitidos;
    //PRECARGAMOS TODAS LAS PLAZAS EN UN ARRAY ASOCIATIVO
    $resPlazas = $con->query("SELECT codigo, numeroplazas FROM cursos");
    $plazasDisponibles = [];
    while ($c = $resPlazas->fetch(PDO::FETCH_ASSOC)) {
        $plazasDisponibles[$c['codigo']] = $c['numeroplazas'];
    }
    foreach ($cola as $dni => $puntos) {
        //HACEMOS UNA VUELTA POR CADA SOLICITUD EN LA COLA
        $query = $con->prepare("SELECT codigocurso,admitido FROM solicitudes WHERE dni = :dni");
        $query->execute([':dni' => $dni]);
        while ($linea = $query->fetch(PDO::FETCH_ASSOC)) {
            $curso = $linea['codigocurso'];
            //SI EL CURSO TIENE PLAZAS, GUARDAMOS LA SOLICITUD Y HACEMOS EL UPDATE EN LA BASE DE DATOS
            if ($plazasDisponibles[$curso] > 0) {
                if ($linea['admitido'] == 0) {
                    //SOLO MODIFICO LAS PLAZAS Y LA ADMISION, SI NO ESTA ADMITIDO
                    $plazasDisponibles[$curso]--;
                    $update = $con->prepare("UPDATE solicitudes set admitido = 1 where dni= :dni and codigocurso = :codigocurso");
                    $update2 = $con->prepare("UPDATE cursos set numeroplazas = numeroplazas-1 where codigo = :codigo");
                    $update->execute([":dni" => $dni, ":codigocurso" => $curso]);
                    $update2->execute([":codigo" => $curso]);
                }

            }
        }
    }
    //HEADER PARA VOLVER
    header("Location: panelAdmin.php");
    ?>
