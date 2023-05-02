<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/models/PersonaActo.php';
    
    class PersonaActoCo {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function updatePonentesActo($id_acto, $Ponentes) {
            try {
                $stmt1 = $this->conn->prepare("DELETE FROM personas_actos WHERE Id_acto = :id_acto AND Ponente = 1");
                $stmt1->bindParam(':id_acto', $id_acto);
                $stmt1->execute();

                foreach ($Ponentes as $reg) {
                    $stmt = $this->conn->prepare("INSERT INTO personas_actos (Id_persona, Id_acto, Ponente) VALUES (:reg, :id_acto, 1)");
                    $stmt->bindParam(':reg', $reg);
                    $stmt->bindParam(':id_acto', $id_acto);
                    $stmt->execute();
                }

                $_SESSION['estadoAccion'] = 'ok';
                header("Location: /views/admin/actosEditar.php?id=" . $id_acto);
            } catch(PDOException $e) {
                $_SESSION['estadoAccion'] = 'ko';
                header("Location: /views/admin/actosEditar.php?id=" . $id_acto);
            }
        }
    }
?>
