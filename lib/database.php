<?php


class Database{
    private $host="localhost";
    private $user="root";
    private $pass="";
    private $name="student";

    private $pdo;

    public function __construct(){
        if(!isset($this->pdo)){
            try {
            $link=new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass);
            $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $link->exec('SET CHARACTER set utf8');
            $this->pdo=$link;
            } catch (PDOException $e) {
                die("Failed to connect".$e->getMessage());
            }
        }
    }
    /*
    public function select(){
    $sql=$this->pdo->prepare('SELECT * FROM users');
    var_dump($sql);
    $sql->execute();
    $result= $sql->fetchAll();
    var_dump($result);
    }*/
    
    public function select($table,$data=array()){
        $sql=' SELECT ';
        $sql .=array_key_exists('select',$data)?$data['select']:' * ';
        $sql .= ' FROM '.$table;
        if(array_key_exists('where',$data)){
             $sql .=' WHERE ';
             $i=0;
             foreach($data['where'] as $key=>$value){
                 $add = ($i>0)?' AND ':' ';
                 $sql .="$add"."$key=:$key";
                 $i++;
             }
        }
        if(array_key_exists('order_by',$data)){
            $sql .=' ORDER BY '.$data['order_by'];
        }
        if(array_key_exists('start',$data) AND array_key_exists('limit',$data)){
            $sql .=' LIMIT '.$data['start'].','.$data['limit'];
        }elseif(array_key_exists('start',$data)){
            $sql .=' LIMIT '.$data['start'];
        }elseif(array_key_exists('limit',$data)){
            $sql .=' LIMIT '.$data['limit'];
        }

        $stmt=$this->pdo->prepare($sql);

        if(array_key_exists('where',$data)){
            foreach ($data['where'] as $key => $value) {
                $stmt->bindValue(":$key",$value);
            }
        }



        $stmt->execute();

        
        if(array_key_exists('return_type',$data)){
            switch ($data['return_type']) {
                case 'count':
                    $value=$stmt->rowCount();
                    break;
                case 'single':
                    $value=$stmt->fetch(PDO::FETCH_ASSOC);
                    break;                    
                
                default:
                    $value='';
                    break;
            }
        }else{
            if($stmt->rowCount()>0){
                $value=$stmt->fetchAll();
            }
        }

        return !empty($value)?$value:false;


    }

    /*
    $sql=insert into users (name,email,city,phone,country) values('name','email','city','phone','country');
    $stmt=$this->pdo->prepare($sql);
    $stmt->execute();
    */
    
    public function insert($table,$data){
        if(!empty($data) && is_array($data)){
           $keys='';
           $values='';
           $i=0;

           $keys=implode(',',array_keys($data));
           $values=':'.implode(', :',array_keys($data));

           $sql="INSERT INTO ".$table."(".$keys.") VALUES (".$values.")";
           $stmt=$this->pdo->prepare($sql);

           foreach($data as $key=>$value){
               $stmt->bindValue(":$key",$value);
           }
           $insertdata=$stmt->execute();

           if($insertdata){
               $lastId=$this->pdo->lastInsertId();
               return $lastId;
           }else{
               return false;
           }
        }
    }
    /*
    $sql="update table set name=:name ,email=:email,city=:city where id=:id";
    $stmt=$this->pdo->prepare($sql);
    $stmt->bindValue(":name",$name);
    $stmt->bindValue(":email",$email);
    $stmt->bindValue(":city",$city);
    $stmt->bindValue(":phone",$phone);
    $stmt->execute();
    */
    public function update($table,$userdata,$condition){
        if(!empty($userdata) && is_array($userdata)){
            $keyvalue='';
            $cond='';
            $i=0;
            foreach ($userdata as $key => $value) {
                $add=($i > 0)?' , ':'';
                $keyvalue .="$add"."$key=:$key";
                $i++;
            }
            if(!empty($condition) && is_array($condition)){
                $wherecond=" WHERE ";
                $i=0;
                foreach ($condition as $key => $value) {
                    $add=($i>0)?" AND ":'';
                    $wherecond .="$add"."$key=:$key";
                    $i++;
                }
            }
            $sql=" UPDATE ".$table." SET ".$keyvalue.$wherecond;
            $stmt=$this->pdo->prepare($sql);
            foreach ($userdata as $key => $value) {
                $stmt->bindValue(":$key",$value);
            }
            foreach ($condition as $key => $value) {
                $stmt->bindValue(":$key",$value);
            }

            $update=$stmt->execute();
            return $update?$stmt->rowCount():false;
        }

    }
    public function delete(){

    }
}

?>
