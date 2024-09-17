<?php 

  $database = connectToDB();

  // check if current user is logged in or not
  checkIfUserIsNotLoggedIn();
  

  if ( ($_SESSION['loggeduser']['role'] == 'admin') ||  ($_SESSION['loggeduser']['role'] == 'editor') ) {
    $sql = "SELECT * FROM posts";
    $query = $database -> prepare($sql);
    $query -> execute(); 
    $posts = $query -> fetchAll();
  } else {
    $sql = "SELECT * FROM posts WHERE user_id = :user_id";
    $query = $database -> prepare($sql);
    $query -> execute([
       'user_id' => $_SESSION['loggeduser']['id'] 
      ]);
    $posts = $query -> fetchAll();
  } 

  require 'parts/header.php' 
 
 ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        <div class="text-end">
          <a href="/manage-posts-add" class="btn btn-primary btn-sm"
            >Add New Post</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 40%;">Title</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>    
            </tr>
          </thead>
          <tbody>

              <?php foreach ($posts as $index => $post) : ?>
                <tr>
                  <th scope="row"><?= $post['id'] ?></th>
                  <td><?= $post['title'] ; ?></td>

                  <?php if ( $post['status'] == 'pending' ) : ?>
                    <td>
                      <span class="badge bg-warning">Pending Review</span>
                    </td>
                  <?php else : ?>
                    <td>
                      <span class="badge bg-success">Publish</span>
                    </td>
                  <?php endif ; ?>

                  <td class="text-end">
                    <div class="buttons">
                      <a
                        href="/pages/post"
                        target="_blank"
                        class="btn btn-primary btn-sm me-2 disabled"
                        ><i class="bi bi-eye"></i
                      ></a>

                      <a
                        href="/manage-posts-edit?id=<?= $post['id'] ; ?>"
                        class="btn btn-secondary btn-sm me-2"
                        ><i class="bi bi-pencil"></i
                      ></a>
                      
                      <!-- delete -->
                        <!-- button -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-user-<?= $post['id']; ?>">
                          <i class="bi bi-trash"></i>
                        </button>

                          
                        <!-- modal -->
                          <div class="modal fade" id="delete-user-<?= $post['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabdel">Delete Post: <?= $post['title']; ?> </h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  This action cannot be reversed.
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <form method="POST" action="/user/delete">
                                    <input type="hidden" name="id" value="<?= $post['id']; ?>" />
                                    <button class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i>Delete</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        


                      

                    </div>
                  </td>
                </tr>
              <?php endforeach ; ?>
            
            
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>
<?php require 'parts/footer.php'; ?>
