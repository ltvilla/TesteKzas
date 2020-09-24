<?php


class Listapi
{
    private $con;

    public function __construct()
    {
        $caminhoBanco = 'banco.sqlite';
        return $this->con = new \PDO('sqlite:' . $caminhoBanco);
    }

    public function companies()
    {
        $sql = "SELECT * FROM companies ORDER BY id ASC";
        $sql = $this->con->prepare($sql);
        $sql->execute();

        $resultados = array();
        while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $resultados[] = $row;
        }

        if (!$resultados) {
            throw new Exception("Nenhum item encontrado!");
        }

        return $resultados;

    }

    public function employees()
    {
        $sql = "SELECT * FROM employees ORDER BY id ASC";
        $sql = $this->con->prepare($sql);
        $sql->execute();

        $resultados = array();
        while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $resultados[] = $row;
        }

        if (!$resultados) {
            throw new Exception("Nenhum item encontrado!");
        }

        return $resultados;

    }
}
