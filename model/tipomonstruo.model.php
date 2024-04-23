<?php
//Clase que es una representación de la tabla de tipo de monstruo y sus campos

class TipoMonstruo
{

    private $Codigo_Mundo;
    private $Codigo;
    private $Descripcion;
    private $Estado;

    public function name()
    {
        return $this->Descripcion;
    }


    public function __GET($k)
    {
        return $this->$k;
    }
    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }
}

// Clase que contendra todos los metodos para la gestión de la tabla
class TipoMonstruoModel
{
    private $pdo;
    //Constructor de la clase
    public function __CONSTRUCT()
    {
        $conf = new Conf_BD();
        try {
            $this->pdo = new PDO('mysql:host=' . $conf->GetServer() . ';dbname=' . $conf->GetBD(), $conf->GetUser(), $conf->GetPass());
            //$this->pdo = new PDO('mysql:host=localhost;dbname=id3949160_rfg_v1', 'id3949160_rfg_v1','roger');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Metodo que devuelve un listado de todos los tipos de monstruo de un mundo concreto
    public function ListarTipoMonsMundo($codigo)
    {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM Tipo_Monstruo WHERE Codigo_Mundo = ?");
            $stm->execute(array($codigo));

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $alm = new TipoMonstruo();

                $alm->__SET('Codigo', $r->Codigo);
                $alm->__SET('Descripcion', $r->Descripcion);
                $alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);

                $result[] = $alm;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Metodo que devuelve un listado de todos los tipos de monstruo de un mundo concreto
    public function Listar($CodMundo)
    {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM Tipo_Monstruo WHERE Codigo_Mundo=?");
            $stm->execute(array($CodMundo));

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $alm = new TipoMonstruo();

                $alm->__SET('Codigo', $r->Codigo);
                $alm->__SET('Descripcion', $r->Descripcion);
                $alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);

                $result[] = $alm;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //Metodo que obtiene un tipo de monstruo concreto de un mundo concreto
    public function Obtener($Codigo, $Codigo_Mundo)
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT * FROM Tipo_Monstruo WHERE Codigo = ? and Codigo_Mundo = ?");


            $stm->execute(array($Codigo, $Codigo_Mundo));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $alm = new TipoMonstruo();

            $alm->__SET('Codigo', $r->Codigo);
            $alm->__SET('Descripcion', $r->Descripcion);
            $alm->__SET('Codigo_Mundo', $r->Codigo_Mundo);


            return $alm;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

        //Metodo para eliminar un tipo de monstruo concreto de un mundo concreto
    public function Eliminar($Codigo, $Codigo_Mundo)
    {
        try {
            $stm = $this->pdo
                ->prepare("DELETE FROM Tipo_Monstruo WHERE Codigo = ? and Codigo_Mundo = ?");

            $stm->execute(array($Codigo, $Codigo_Mundo));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Metodo para actualizar un registro de la tabla
    public function Actualizar(TipoMonstruo $data, $codigo_viejo)
    {
        try {
            $sql = "UPDATE Tipo_Monstruo SET 
						Codigo			= ?,
                        Descripcion           = ?, 
						Codigo_Mundo = ?
                    WHERE Codigo = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->__GET('Codigo'),
                        $data->__GET('Descripcion'),
                        $data->__GET('Codigo_Mundo'),
                        $codigo_viejo
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

        //Metodo para crear un registro de la tabla
    public function Registrar(TipoMonstruo $data)
    {
        try {
            $sql = "INSERT INTO Tipo_Monstruo (Codigo_Mundo,Codigo,Descripcion) 
                VALUES (?,?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->__GET('Codigo_Mundo'),
                        createGUID(),
                        $data->__GET('Descripcion'),
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
