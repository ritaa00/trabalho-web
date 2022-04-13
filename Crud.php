<?php

class Crud
{
    private $connect;
    private $nome;
    private $email;
    private $idade;
    
    function __construct($con){

        $this->connect = $con;
    }

    public function setDados($nome,$mail,$idade){
        $this->nome= $nome;
        $this->email=$mail;
        $this->idade=$idade;
    }

        public function insertDados(){
            
                $sql = $this->connect->prepare("INSERT INTO clientes(nome,idade,email, data_now)VALUES(?,?,?,CURRENT_TIMESTAMP)");
                $sql->bindParam(1,$this->nome);
                $sql->bindParam(2,$this->idade);
                $sql->bindParam(3,$this->email);
    
                $sql->execute();
                
               echo "Dados inseridos";

               
            
           
        }
        public function readInfo($id=null){
            if(isset($id)){
                 $sql = $this->connect->prepare("SELECT * FROM clientes WHERE id = ?");

                $sql->bindValue(1,"$id");
    
                $sql->execute();
    
                $result = $sql->fetch(PDO::FETCH_OBJ);
    
                return $result;
            }else{
               $this->getAll();
            
        }
    }
        public function pesquisaInfo($nome=null){
            if(isset($nome)){
                 $sql = $this->connect->prepare("SELECT * FROM clientes WHERE nome LIKE ?");

                $sql->bindValue(1,"%$nome%");
    
                $sql->execute();
    
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
                return $result;
            }else{
               $this->getAll();
            
        }
    }

            public function getAll(){

                $sql = $this->connect->query("SELECT * FROM clientes");
                return $sql->fetchAll();
            }
               

        public function updateDados($id,$nome,$idade,$email){
            $sql = $this->connect->prepare("UPDATE clientes SET nome = ?, email = ?, idade = ? WHERE id = ?");
            
            $sql->bindValue(1,$nome,PDO::PARAM_STR);
            $sql->bindValue(2,$email,PDO::PARAM_STR);
            $sql->bindValue(3,$idade,PDO::PARAM_STR);
            $sql->bindValue(4,$id,PDO::PARAM_STR);

            $sql->execute();
             
            echo "dados alterados";
        
        }

        public function deleteDados($id){
            $sql = $this->connect->prepare("DELETE FROM clientes WHERE id = ?");
            $sql->bindValue(1,$id);
            $sql->execute();
            echo "dados deletados"; 
        }
      
    }