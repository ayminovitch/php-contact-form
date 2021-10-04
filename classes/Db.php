<?php

class Db
{
    /**
     * @return \PDO
     */
    public function dbHandler(){
        try {
            return new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        } catch (\PDOException $e) {
            exit('Error While Connecting To The Database: '.$e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function executeQuery($data){
        try {
            $date = date('Y-m-d H:i:s');
            $sql = "INSERT INTO  tblcontactdata(Salutation,FullName,Email,Inquiry,Description,CreatedAt) VALUES(:salutation,:fname,:email,:inquiry,:description,:createdAt)";
            $query = $this->dbHandler()->prepare($sql);
            // Bind parameters
            $query->bindParam(':salutation', $data['salutation'], \PDO::PARAM_STR);
            $query->bindParam(':fname', $data['name'], \PDO::PARAM_STR);
            $query->bindParam(':email', $data['email'], \PDO::PARAM_STR);
            $query->bindParam(':inquiry', $data['inquiry'], \PDO::PARAM_STR);
            $query->bindParam(':description', $data['description'], \PDO::PARAM_STR);
            $query->bindParam(':createdAt', $date, \PDO::PARAM_STR);
            $query->execute();
        }catch (Exception $e){
            exit('Error While Insert To The Database: '.$e->getMessage());
        }
    }
}
