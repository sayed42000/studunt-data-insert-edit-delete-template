<?php

include('database.php');
include('session.php');
Session::init();
$db=new Database();
$table='users';
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action']=='add'){
       $userdata=array(
           'name'=>$_POST['name'],
           'email'=>$_POST['email'],
           'city'=>$_POST['city'],
           'phone'=>$_POST['phone'],
           'country'=>$_POST['country'],
       );

       $insert=$db->insert($table,$userdata);
       if($insert){
           $msg="Data inserted successfully";
       }else{
           $msg="Data not inserted";
       }
       Session::set('msg',$msg);
       $home_url='../index.php';
       header("Location:".$home_url);
    }elseif($_REQUEST['action']=='edit'){
            $id=$_POST['id'];
            if(!empty($id)){
              $userdata=array(
               'name'=>$_POST['name'],
               'email'=>$_POST['email'],
               'city'=>$_POST['city'],
               'phone'=>$_POST['phone'],
                'country'=>$_POST['country'],
              );
              $table='users';
              $condition=array('id'=>$id);
              $update=$db->update($table,$userdata,$condition);
            if($update){
                $msg="Data updated successfully";
            }else{
                $msg="Data not updated";
            }
           Session::set('msg',$msg);
           $home_url='../index.php';
           header("Location:".$home_url);
            }
        
    }
}
?>