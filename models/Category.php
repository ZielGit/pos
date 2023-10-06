<?php

namespace Models;

use Models\Conexion;
use PDO;

class Category
{
    public static function IngresarCategoria($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria) VALUES (:categoria)");
        $stmt->bindParam(":categoria", $datos, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function MostrarCategorias($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    public static function EditarCategoria($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id = :id");
        $stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function BorrarCategoria($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }
}
