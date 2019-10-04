<?php include('config.php'); ?>
<?php include(TEMPLATE_FRONT.DS.'header.php'); ?>
   <div class="container">
       <form action="lib/process_student.php" method="post">
           <div class="form-group">
               <label for="name">Name</label>
               <input type="text" class="form-control" name="name">
           </div>
           <div class="form-group">
               <label for="city">Email</label>
               <input type="text" class="form-control" name="email">
           </div> 
           <div class="form-group">
               <label for="city">City</label>
               <input type="text" class="form-control" name="city">
           </div>  
           <div class="form-group">
               <label for="phone">Phone</label>
               <input type="text" class="form-control" name="phone">
           </div> 
           <div class="form-group">
               <label for="country">Country</label>
              <input type="text" class="form-control" name="country"> 
           </div> 
           <div class="form-group">
               <input type="hidden" name="action" value="add">
               <input type="submit" class="btn btn-primary" name="Submit">
           </div>                                                  
       </form>
   </div>
<?php include(TEMPLATE_FRONT.DS.'footer.php'); ?>