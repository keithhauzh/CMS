<!-- check if user is logged in or not -->
<?php checkIfUserIsNotLoggedIn(); ?>

<!-- check if logged in user is admin or not -->
<?php checkIfIsAdmin(); ?>

<?php

  //get the id from the URL /manage-users.edit?id=1
  $id = $_GET['id'];

  //connect to database
  $database = connectToDB();

  //load the existing data from the user
    //sql command
    $sql = "SELECT * FROM users WHERE id = :id";

    //prepare
    $query = $database->prepare($sql);
    
    //execute
    $query->execute([
      'id' => $id
    ]);

    //fetch
    $user = $query->fetch(); //get only one row of data

    /*
      name - $user['name']
      email - $user['email]
      role - $user['role]
    */

?>

<?php require 'parts/header.php' ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit User</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/user/edit">
          <?php require 'parts/error_box.php'; ?>
          <div class="mb-3">
            <div class="row">

              <!-- name -->
                <div class="col">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>"/>
                </div>

              <!-- email (not updatable) -->
                <div class="col">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" disabled value="<?= $user['email']; ?>"/>
                </div>

            </div>
          </div>

          <!-- role -->
            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-control" id="role" name="role">
                <option value="">Select an option</option>

                <option value="user" <?= $user['role'] == 'user' ? "selected" : "" ?> >User</option>

                <option value="editor" <?= $user['role'] == 'editor' ?"selected" : "" ?> >Editor</option>

                <option value="admin" <?= $user['role'] == 'admin' ? "selected" : "" ?> >Admin</option>

              </select>
            </div>
            
          <!-- hidden input field to post id -->
          <input type="hidden" name="id" value= "<?= $user['id'];?>" >

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>

        </form>
      </div>
      <div class="text-center">
        <a href="/manage-users" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Users</a
        >
      </div>
    </div>
<?php require 'parts/footer.php'; ?>
