<?php 
include('lib/session.php');
include('config.php'); 

?>
<?php include(TEMPLATE_FRONT.DS.'header.php'); ?>
<?php 
include('lib/database.php');

Session::init();
$msg=Session::get('msg');
 ?>
    <div class="container">
      <div class="m-auto p-3 bg-primary" style="height: 89px;">
        <h1 class="float-left">Student Details</h1>
        <a href="addstudent.php" class="btn btn-success float-right">Add Student</a>
      </div>
      <div class="alert alert-danger">
        <h1 class="text-bold"><?php if(!empty($msg)){
          echo $msg; 
          Session::unset();}  ?></h1>
      </div>
      <div class="">
        <table class="table table-striped table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th>Si no</th>
              <th>Name</th>
              <th>Email</th>
              <th>City</th>
              <th>Phone</th>
              <th>Country</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
        <?php 
        $db=new Database();
    
        $table='users';

        $order_by=array('order_by'=>'id DESC');
      /*
        $selectcond=array('select'=>'name');
        */
        /*              
       $wherecond=array(
           'where'=>array('id'=>2,'email'=>'zayed@gmail.com'),
          'return_type'=>'single'
        );*/
          //foreach ($wherecond['where'] as $key => $value) {
                //var_dump(":$key",$value);
                //$stmt->bindValue(":$key",$value);
          //}
        /*
        $limit=array('start'=>2,'limit'=>5);
        
        */
        //$limit=array('start'=>2,'limit'=>4);
        $studentData=$db->select($table,$order_by);
        if(!empty($studentData)){
          $i=0;
          foreach ($studentData as  $value) {
              $i++;
            ?>
            
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $value['name']; ?></td>
              
              <td><?php echo $value['email']; ?></td>
              <td><?php echo $value['city']; ?></td>
              <td><?php echo $value['phone']; ?></td>
              <td><?php echo $value['country']; ?></td>
              
            
              <td>
                <a href="editstudent.php?actio=edit&id=<?php echo $value['id']; ?>" class="btn btn-success">Edit</a>
                <a href="process_student.php?actio=delete&id=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
              </td>
            </tr>
           <?php  } }  ?>  
          </tbody>
        </table>
      </div>
        <div class="text-center bg-danger m-auto p-3">
          <h1>Copyright reserved</h1>
        </div>

    </div>
<?php include(TEMPLATE_FRONT.DS.'footer.php'); ?>