<?php
class Conf {
    static private $databases = array(
        //localhost sur votre machine
        'hostname' => 'localhost',
        // Sur votre machine, vous devrez creer une BDD
        'database' => 'phb-newsletter',
        // Sur votre machine, vous avez surement un compte 'root'
        'login' => 'root',
        // Sur votre machine personelle, vous avez creez ce mdp a l'installation
        'password' => ''
    );

    // la variable debug est un boolean
    static private $debug = True; 
    
    static public function getDebug() {
    	return self::$debug;
    }
   
  static public function getLogin() {
    //en PHP l'indice d'un tableau n'est pas forcement un chiffre.
    return self::$databases['login'];
  }
  
  static public function getHostname() {
     return self::$databases['hostname'];
  }
  
  static public function getDatabase() {
      return self::$databases['database'];
  }
  
  static public function getPassword() {
      return self::$databases['password'];     
  } 
  
   
}
?>