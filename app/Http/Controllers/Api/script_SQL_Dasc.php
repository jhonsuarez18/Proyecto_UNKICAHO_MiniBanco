<?php
// revisar la extension de zen.. en php info de xammp, hayq ue instalar xammp
// copiar los archivos dll y crear las extension en php.ini en la opcion zen
// extension=php_pdo_sqlsrv_73_ts
//extension=php_sqlsrv_73_ts
// comando php - "script que se ejecutara"
//http://www.youtube.com/watch?v=YWROWXDSZfk  tutorial para hacer en enlace
//paa solicitudes App/Http/Kernel.php --- cambiar aqui para perimitir varias solicitudes
// 'api' => [
//            'throttle:5000,1',
//            'bindings',
//        ],
class CurlRequest
{

    public function postItemPedido($idped, $numped, $tipPed)
    {
            $serverName = "(local)";
            $connectionInfo = array( "Database"=>"SIGA_725");
            $conn = sqlsrv_connect( $serverName, $connectionInfo);
        echo "Conexión establecida.<br />";
        if ($conn) {
            echo "Conexión establecida.<br />";
        } else {
            echo "Conexión no se pudo establecer.<br />";
            die(print_r(sqlsrv_errors(), true));
        }
         $new = new CurlRequest();
          if ($conn) {
              echo ' OBTENIENDO DATOS' . "\n";;
              $sqlNEW = "
select ISNULL((SELECT top 1 prec_unit_moneda
FROM SIG_ORDEN_ADQUISICION OA left outer
JOIN SIG_MAESTRO_PROCESO  MP
ON (MP.ANO_EJE = OA.ANO_EJE
AND MP.CODIGO = 'TIPO_PROCESO'
AND MP.CODIGO_DET = OA.TIPO_PROCESO)
 RIGHT join SIG_ORDEN_ITEM OI
  on ( OA.ANO_EJE   = OI.ANO_EJE    and
       OA.NRO_ORDEN = OI.NRO_ORDEN  and
       OA.TIPO_BIEN = OI.TIPO_BIEN  and
       OA.TIPO_PPTO = OI.TIPO_PPTO )
 where oa.ANO_EJE=2021 and mp.ANO_EJE=2021 and oi.ANO_EJE=2021 and
  concat(oa.ANO_EJE,OA.sec_ejec,OA.TIPO_BIEn,GRUPO_BIEN,CLASE_BIEN,FAMILIA_BIEN,ITEM_BIEN)
  =concat(pe.ANO_EJE,pe.sec_ejec,pe.TIPO_BIEN,pe.GRUPO_BIEN,pe.CLASE_BIEN,pe.FAMILIA_BIEN,pe.ITEM_BIEN)
  order by OA.FECHA_REG desc),0) as PRECIO_UNIT  ,
  ISNULL((SELECT top 1 prec_unit_moneda
FROM SIG_ORDEN_ADQUISICION OA left outer
JOIN SIG_MAESTRO_PROCESO  MP
ON (MP.ANO_EJE = OA.ANO_EJE
AND MP.CODIGO = 'TIPO_PROCESO'
AND MP.CODIGO_DET = OA.TIPO_PROCESO)
 RIGHT join SIG_ORDEN_ITEM OI
  on ( OA.ANO_EJE   = OI.ANO_EJE    and
       OA.NRO_ORDEN = OI.NRO_ORDEN  and
       OA.TIPO_BIEN = OI.TIPO_BIEN  and
       OA.TIPO_PPTO = OI.TIPO_PPTO )
 where oa.ANO_EJE=2021 and mp.ANO_EJE=2021 and oi.ANO_EJE=2021 and
  concat(oa.ANO_EJE,OA.sec_ejec,OA.TIPO_BIEn,GRUPO_BIEN,CLASE_BIEN,FAMILIA_BIEN,ITEM_BIEN)
  =concat(pe.ANO_EJE,pe.sec_ejec,pe.TIPO_BIEN,pe.GRUPO_BIEN,pe.CLASE_BIEN,pe.FAMILIA_BIEN,pe.ITEM_BIEN)
  order by OI.FECHA_REG desc) *
  case when CANT_APROBADA !=0 then CANT_APROBADA
  else CANT_SOLICITADA end,0)
   as VALOR_TOTAL,pe.ANO_EJE,pe.sec_ejec,pe.TIPO_BIEN,TIPO_PEDIDO,SECUENCIA,pe.GRUPO_BIEN,pe.CLASE_BIEN,
                      pe.FAMILIA_BIEN,pe.ITEM_BIEN,pe.UNIDAD_MEDIDA,CODIGO_ACTIVO,
                      NRO_CUADRO,CANT_SOLICITADA,CANT_APROBADA,CANT_ATENDIDA,ESTADO_PED,ESTADO_ATEND,ESTADO_CONFOR,convert(date ,FECHA_APROB) as FECHA_APROB,ESTADO_COMPRA,ESTADO_PROG,
                      cat.nombre_item ITEM
                      from SIG_DETALLE_PEDIDOS pe
                      join catalogo_bien_serv_original cat
                        on (pe.TIPO_BIEN    = cat.TIPO_BIEN    and
                            pe.GRUPO_BIEN   = cat.GRUPO_BIEN   and
                            pe.CLASE_BIEN   = cat.CLASE_BIEN   and
                            pe.FAMILIA_BIEN = cat.FAMILIA_BIEN and
                            pe.ITEM_BIEN    = cat.ITEM_BIEN )
                       where NRO_PEDIDO='" . $numped . "'  and pe.ANO_EJE=2021
                      and pe.TIPO_BIEN='" . $tipPed . "' and TIPO_PEDIDO=2
                      ";
              $stmtNEW = sqlsrv_query($conn, $sqlNEW);
              if ($stmtNEW === false) {
                  die(print_r(sqlsrv_errors(), true));
              }
              echo ' CORRECTO' . "\n";;
              while ($row = sqlsrv_fetch_array($stmtNEW, SQLSRV_FETCH_ASSOC)) {
                  $row['peId'] = $idped;
                  $ch = curl_init("http://127.0.0.1:8000/api/apiitmpedido");
                  //a true, obtendremos una respuesta de la url, en otro caso,sd
                  //true si es correcto, false si no lo es
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  //establecemos el verbo http que queremos utilizar para la petición
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                  //enviamos el array data
                  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($row));
                  //obtenemos la respuesta
                  $response = curl_exec($ch);
                  // Se cierra el recurso CURL y se liberan los recursos del sistema
                  curl_close($ch);
                  echo '....' . $response . ' ....';
                  echo '........';
              }
              echo "\n" . 'ACTUALIZANDO  PEDIDO' . "\n";
              echo 'PEDIDO : ' . $numped . ' TIPO : ' . $tipPed . ' ITEMS ACTUALIZADOS CORRECTAMENTE ' . "\n";
              echo 'PEDIDO ACTUALIZADO.. ' . "\n";
          }
    }

    public function callPostItemPedido()
    {
        $new = new CurlRequest();
        $resultado = $new->getPedidosTipo1();
        echo "******************** ************************* ************************* " . "\n";
        echo "******************** ************************* *************************" . "\n";
        echo "******************** Registrando items por pedido*************************" . "\n";
        echo "******************** ************************* *************************" . "\n";
        echo "******************** ************************* *************************" . "\n";
        for ($i = 0; $i < count($resultado); $i++) {
            $tip = ($resultado[$i]['tId'] === 1) ? 'B' : 'S';
            $new->postItemPedido($resultado[$i]['peId'], $resultado[$i]['peCodPed'], $tip);

        }
    }

    public function callPostDetPedido()
    {
        $new = new CurlRequest();
        $resultado = $new->getPedidosTipo1();
        echo "******************** ************************* ************************* " . "\n";
        echo "******************** ************************* *************************" . "\n";
        echo "******************** Actualizando infromacion pedidos*************************" . "\n";
        echo "******************** ************************* *************************" . "\n";
        echo "******************** ************************* *************************" . "\n";
        for ($i = 0; $i < count($resultado); $i++) {
            $tip = ($resultado[$i]['tId'] === 1) ? 'B' : 'S';
            $new->postDetPedido($resultado[$i]['peId'], $resultado[$i]['peCodPed'], $tip);
        }
    }

    public function postDetPedido($idped, $numped, $tipPed)
    {

        $serverName = "(local)";
        $connectionInfo = array( "Database"=>"SIGA_725");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
    echo "Conexión establecida.<br />";
        $new = new CurlRequest();
        if ($conn) {
            echo ' OBTENIENDO DATOS' . "\n";;
            $sqlNEW = "SELECT
                        CENTRO_COSTO,
                        NRO_PEDIDO,
                        MOTIVO_PEDIDO,
                        FECHA_PEDIDO,
                        ANO_EJE
                         FROM [dbo].[SIG_PEDIDOS]
                         where CAST(NRO_PEDIDO AS int)= CAST(" . $numped . " AS int) and ANO_EJE=2021
                         and TIPO_BIEN='" . $tipPed . "'and TIPO_PEDIDO=2 ";
            $stmtNEW = sqlsrv_query($conn, $sqlNEW);
            if ($stmtNEW === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            echo ' CORRECTO' . "\n";;
            while ($row = sqlsrv_fetch_array($stmtNEW, SQLSRV_FETCH_ASSOC)) {
                // var_dump($row);
                $row['peId'] = $idped;
                $ch = curl_init("http://127.0.0.1:8000/api/apidetpedido");
                //a true, obtendremos una respuesta de la url, en otro caso,
                //true si es correcto, false si no lo es
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //establecemos el verbo http que queremos utilizar para la petición
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                //enviamos el array data
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($row));
                //obtenemos la respuesta
                $response = curl_exec($ch);
                // Se cierra el recurso CURL y se liberan los recursos del sistema
                curl_close($ch);
                echo '....' . $response . ' ....';
            }
            echo "\n" . 'ACTUALIZANDO DETALLE PEDIDO' . "\n";
            echo 'PEDIDO : ' . $numped . ' TIPO : ' . $tipPed . "\n" . ' DETALLES ACTUALIZADOS CORRECTAMENTE ' . "\n";
        }
    }


    public function updateMonto()
    {


        $serverName = "localhost\MSSQLSERVER2014"; //serverName\instanceName
        echo ' CONEXION LOCAL ESTABLECIDA' . "\n";;
// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
// La conexión se intentará utilizando la autenticación Windows.
        $connectionInfo = array("Database" => "SIGA_725");
        echo ' CONEXION A BASE DE DATOS ESTABLECIDA' . "\n";
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $new = new CurlRequest();
        $vect_res = [];
        if ($conn) {
            echo ' OBTENIENDO DATOS' . "\n";;
            $resultado = $new->getPedidosTipo1();
            echo ' CORRECTO' . "\n";;
            for ($i = 0; $i < count($resultado); $i++) {
                $tip = ($resultado[$i]['tId'] === 1) ? 'B' : 'S';
                $sqlNEW = "
     select sum(VALOR_MONEDA) as tot from (concat(oa.ANO_EJE,OA.sec_ejec,OA.TIPO_BIEn,GRUPO_BIEN,CLASE_BIEN,FAMILIA_BIEN,ITEM_BIEN,
CLASIFICADOR,META.sec_func,OI.SEC_ITEM,CANT_ITEM) as id,oi.PREC_VENTA_MONEDA,OI.PREC_IMPTO_SOLES
,CLASIFICADOR,META.sec_func,VALOR_MONEDA
FROM SIG_ORDEN_ADQUISICION OA left outer
JOIN SIG_MAESTRO_PROCESO  MP
ON (MP.ANO_EJE = OA.ANO_EJE
AND MP.CODIGO = 'TIPO_PROCESO'
AND MP.CODIGO_DET = OA.TIPO_PROCESO) LEFT OUTER

JOIN SIG_CUADRO_ADQUISICION CA
ON(
	OA.ANO_EJE = CA.ANO_EJE AND
	OA.SEC_EJEC=CA.SEC_EJEC AND
	OA.TIPO_BIEN=CA.TIPO_BIEN AND
	OA.TIPO_PPTO=CA.TIPO_PPTO AND
	OA.SEC_CUADRO = CA.SEC_CUADRO
)
JOIN SIG_ORDEN_ITEM_PPTO OIP
  ON ( OIP.ANO_EJE = OA.ANO_EJE
  AND OIP.SEC_EJEC = OA.SEC_EJEC
  AND OIP.NRO_ORDEN = OA.NRO_ORDEN
  AND OIP.TIPO_BIEN = OA.TIPO_BIEN
  AND OIP.TIPO_PPTO = OA.TIPO_PPTO)

  JOIN META  --esta tmb
  ON ( OIP.ANO_EJE = META.ANO_EJE AND
       OIP.SEC_EJEC = META.SEC_EJEC AND
       OIP.SEC_FUNC = META.SEC_FUNC)
 RIGHT join SIG_ORDEN_ITEM OI
  on ( OA.ANO_EJE   = OI.ANO_EJE    and
       OA.NRO_ORDEN = OI.NRO_ORDEN  and
       OA.TIPO_BIEN = OI.TIPO_BIEN  and
       OA.TIPO_PPTO = OI.TIPO_PPTO and oip.SEC_ITEM=OI.SEC_ITEM )

 where
  concat(oa.ANO_EJE,OA.sec_ejec,OA.TIPO_BIEn,GRUPO_BIEN,CLASE_BIEN,FAMILIA_BIEN,ITEM_BIEN,
CLASIFICADOR,META.sec_func,OI.SEC_ITEM,CANT_ITEM) in (
  SELECT concat(
 dp.ANO_EJE,dp.sec_ejec,dp.TIPO_BIEn,dp.GRUPO_BIEN,dp.CLASE_BIEN,dp.FAMILIA_BIEN,dp.ITEM_BIEN,
dp.CLASIFICADOR,p.sec_func,dp.SECUENCIA,CANT_APROBADA
 ) as id FROM SIGA_725.DBO.SIG_DETALLE_PEDIDOS dp
 JOIN DBO.SIG_PEDIDOS p ON p.NRO_PEDIDO=dp.NRO_PEDIDO
 WHERE dp.NRO_PEDIDO='" . $resultado[$i]['peCodPed'] . "' AND dp.ANO_EJE=2021 AND dp.TIPO_BIEN='" . $tip . "'
 and dp.ANO_EJE=p.ANO_EJE AND dp.TIPO_BIEN='" . $tip . "' AND p.TIPO_BIEN='" . $tip . "')
";

                $stmtNEW = sqlsrv_query($conn, $sqlNEW);
                $result = sqlsrv_fetch_array($stmtNEW);

                if (!is_null($result) && $result['tot'] > 0 && !empty($result['tot'])) {
                    var_dump($stmtNEW);
                    echo ' ACTUALIZANDO PEDIDOS' . "\n";;
                    if ($new->sendUpdate($resultado[$i]['peId'], $result['tot'])) {
                        echo 'PEDIDO : ' . $resultado[$i]['peCodPed'] . ' TIPO : ' . $tip . ' MONTO ACTUALIZADO CORRECTAMENTE A : ' . $result['tot'] . "\n";
                        echo 'PEDIDO ACTUALIZADO.. ' . "\n";
                    }
                }
            }
            echo '******************** FIN *************************';
        } else {
            echo "Conexión no se pudo establecer.<br />";
            die(print_r(sqlsrv_errors(), true));
        }
    }

    public function getPedidosTipo1()
    {
        //datos a enviar
        // $data = array("a" => "a");
        //url contra la que atacamos
        $ch = curl_init("http://127.0.0.1:8000/api/apipedido");
        //a true, obtendremos una respuesta de la url, en otro caso,
        //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //establecemos el verbo http que queremos utilizar para la petición
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        //enviamos el array data
        // curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        //obtenemos la respuesta
        $response = curl_exec($ch);
        // Se cierra el recurso CURL y se liberan los recursos del sistema

        if (!$response) {
            return false;
        } else {
            return $res = json_decode($response, true);
        }
    }

    public function sendUpdate($id, $mont)
    {
        echo $id . '*********** ' . $mont;
        //datos a enviar
        $data = array("a" => "a");
        //url contra la que atacamos
        $ch = curl_init("http://127.0.0.1:8000/pedidomontoact/" . $id . "/" . $mont . "");

        //a true, obtendremos una respuesta de la url, en otro caso,
        //true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //establecemos el verbo http que queremos utilizar para la petición
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        //enviamos el array data
        // curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        //obtenemos la respuesta
        $response = curl_exec($ch);
        // Se cierra el recurso CURL y se liberan los recursos del sistema

        if (!$response) {
            return false;
        } else {
            return $response;
        }
    }
}

echo "******************** ************************* ************************* " . "\n";
echo "******************** ************************* *************************" . "\n";
echo "******************** SCRIPT ACTUALIZACION SIGA *************************" . "\n";
echo "******************** ************************* *************************" . "\n";
echo "******************** ************************* *************************" . "\n";
// revisar la extension de zen.. en php info de xammp, hayq ue instalar xammp
// copiar los archivos dll y crear las extension en php.ini
// extension=php_pdo_sqlsrv_73_ts
//extension=php_sqlsrv_73_ts
// comando php - "script que se ejecutara"
//http://www.youtube.com/watch?v=YWROWXDSZfk  tutorial para hacer en enlace

$new = new CurlRequest();
$resultado = $new->callPostDetPedido();
$resultado = $new->callPostItemPedido();
?>
