<?php
    
class Model {

    public static $pdo;
    
    public static function Init() {
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();
        
        try{
            // Connexion à la base de données            
            // Le dernier argument sert à ce que toutes les chaines de caractères 
            // en entrée et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                                 array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
              echo $e->getMessage(); // affiche un message d'erreur
            } else {
              echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
    
    /*public static function selectAll() {
        
        $table_name = static::$object;
      
        $rep = Model::$pdo->query('SELECT * FROM NC_'.ucfirst($table_name));
        $rep->setFetchMode(PDO::FETCH_CLASS, 'Model'.ucfirst($table_name));
        $tab = $rep->fetchAll();

        return $tab;
  }
  
    public function save() {
        
        $table_name = static::$object;
        
        $lsAttributs = static::$attributs;
        
        $listAttributs = "(". join(",",$lsAttributs).")";
        $listTag = "(:tag_". join(",:tag_",$lsAttributs).")";
        
        $sql = "INSERT INTO NC_".ucfirst($table_name) ." ". $listAttributs ." VALUES " . $listTag;
        
        $req_prep = Model::$pdo->prepare($sql);
        
        $values = array();
        
        
        foreach ($lsAttributs as $val) {
            $fn_name = 'get'.ucfirst($val);
            
            $values[":tag_".$val] = $this->$fn_name();  
            
        }
        
        $req_prep->execute($values);
    }
    
    public function delete() {
        $table_name = static::$object;
        
        $lsAttributs = static::$attributs;
        
        $sql = "DELETE FROM NC_".ucfirst($table_name) ." WHERE";
        
        $nbAtt = count($lsAttributs);
        $ct = 0;
        
        foreach ($lsAttributs as $att) {
            $ct = $ct + 1;
            $tagAtt = ":tag_".$att;
            $sql = $sql." ".$att."=".$tagAtt;
            if ($ct < $nbAtt) {
                $sql = $sql." AND";
            }   
        }
        
        $sql = $sql.";";
        
        $req_prep = Model::$pdo->prepare($sql);
        
        $values = array();
        
        
        foreach ($lsAttributs as $val) {
            $fn_name = 'get'.ucfirst($val);
            
            $values[":tag_".$val] = $this->$fn_name();  
            
        }
        
        $req_prep->execute($values);
    }
    
    public static function select($params) {
        $table_name = static::$object;       
        $searchKey = static::$searchKeys;
        
        $sql = "SELECT * FROM NC_".ucfirst($table_name) ." WHERE";
        
        $nbAtt = count($searchKey);
        $ct = 0;
        
        foreach ($searchKey as $atb) {
            $ct = $ct + 1;
            $tagAtb = ":tag_".$atb;
            $sql = $sql." ".$atb."=".$tagAtb;
            if ($ct < $nbAtt) {
                $sql = $sql." AND";
            }
        }
        
        $sql = $sql.";"; 
        $req_prep = Model::$pdo->prepare($sql);
        $values = array();
        
        foreach ($searchKey as $atb) {
            $values[":tag_".$atb] = $params[$atb];
        }
        
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model'.ucfirst($table_name));
        $obj = $req_prep->fetchAll();
        
        if (sizeof($obj) == 0) {
            return null;
        }

        return $obj[0];
        
    }
    
    public function update($newAtt) {
        $table_name = static::$object;
        
        $lsAttributs = static::$attributs;
        
        $sql = "UPDATE NC_".ucfirst($table_name) ." SET";
        
        $nbAtt = count($lsAttributs);
        $ct = 0;
        
        foreach ($lsAttributs as $att) {
            $ct = $ct + 1;
            $tagAtt = ":tag1_".$att;
            $sql = $sql." ".$att."=".$tagAtt;
            if ($ct < $nbAtt) {
                $sql = $sql.", ";
            }   
        }
        
        $sql = $sql." WHERE";
        
        $ct2 = 0;
        
        foreach ($lsAttributs as $att) {
            $ct2 = $ct2 + 1;
            $tagAtt = ":tag2_".$att;
            $sql = $sql." ".$att."=".$tagAtt;
            if ($ct2 < $nbAtt) {
                $sql = $sql." AND ";
            }   
        }
        
        $sql = $sql.";";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array();
        
        foreach ($lsAttributs as $atb) {
            $values[":tag1_".$atb] = $newAtt[$atb];
        }
        
        foreach ($lsAttributs as $val) {
            $fn_name = 'get'.ucfirst($val);
            
            $values[":tag2_".$val] = $this->$fn_name();  
            
        }
        
        $req_prep->execute($values);
        
        
    }*/

    public static function createAccount($mail,$signature,$password) {
        $pwd_c = Security::chiffrer($password);

        $sql = "INSERT INTO account (mail,signature,password) VALUES (:tag_mail,:tag_signature,:tag_password);";
        
        $req = Model::$pdo->prepare($sql);
        
        $values = array();
        $values[":tag_mail"] = $mail;
        $values[":tag_signature"] = $signature;
        $values[":tag_password"] = $pwd_c;
        
        
        $req->execute($values);
    }

    public static function getAccount($mail,$password) {
        $pwd_c = Security::chiffrer($password);

        $sql = "SELECT * FROM account WHERE mail=:tag_mail AND password=:tag_password;";
        
        $req = Model::$pdo->prepare($sql);
        
        $values = array();
        $values[":tag_mail"] = $mail;
        $values[":tag_password"] = $pwd_c;

        $req->execute($values);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function addMail($mail) {

        $sql = "INSERT INTO mailinglist (mail) VALUES (:tag_mail);";
        
        $req = Model::$pdo->prepare($sql);
        
        $values = array();
        $values[":tag_mail"] = $mail;        
        
        $req->execute($values);
    }

    public static function getMailingList() {

        $sql = "SELECT * FROM mailinglist ORDER BY mail ASC;";
        
        $req = Model::$pdo->prepare($sql);

        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function deleteAccount($id){
        $sql = "DELETE FROM account WHERE idUser=:tag_id;";
        
        $req = Model::$pdo->prepare($sql);
        
        $values = array();
        $values[":tag_id"] = $id;
        
        
        $req->execute($values);   
    }

    public static function getAllAccount() {
        $sql = "SELECT * FROM account ORDER BY mail ASC;";
        
        $req = Model::$pdo->prepare($sql);

        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
      
}
  


Model::Init();

?>