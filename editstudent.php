<?php include('config.php');
include('lib/database.php');
$db=new Database();
$table='users';
$id=$_GET['id'];
 $wherecond=array(
    'where'=>array('id'=>$id),
    'return_type'=>'single'
);
$value=$db->select($table,$wherecond);
?>

<?php include(TEMPLATE_FRONT.DS.'header.php'); ?>
<?php 
if(!empty($value)){
?>
   <div class="container">
       <form action="lib/process_student.php" method="post">
           <div class="form-group">
               <label for="name">Name</label>
               <input type="text" class="form-control" name="name" value="<?php echo $value['name']; ?>">
           </div>
           <div class="form-group">
               <label for="city">Email</label>
               <input type="text" class="form-control" name="email" value="<?php echo $value['email']; ?>">
           </div> 
           <div class="form-group">
               <label for="city">City</label>
               <input type="text" class="form-control" name="city" value="<?php echo $value['city']; ?>">
           </div>  
           <div class="form-group">
               <label for="phone">Phone</label>
               <input type="text" class="form-control" name="phone" value="<?php echo $value['phone']; ?>">
           </div> 
           <div class="form-group">
               <label for="country">Country</label>
               <input type="text" class="form-control" name="country" value="<?php echo $value['country']; ?>">
           </div> 
           <div class="form-group">
               <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
               <input type="hidden" name="action" value="edit">
               <input type="submit" class="btn btn-primary" name="Update">
           </div>                                                  
       </form>
   </div>
<?php } ?>
<?php include(TEMPLATE_FRONT.DS.'footer.php'); ?>