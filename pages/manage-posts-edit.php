<?php 
  $id = $_GET['id'];
  
  $database = connectToDB();

  // check if current user is logged in or not
  checkIfUserIsNotLoggedIn();
  
  

  //load the existing data from the user
    //sql command
      $sql = "SELECT * FROM posts WHERE id = :id";

    //prepare
      $query = $database -> prepare($sql);
    
    //execute
      $query -> execute ([
        'id' => $id
      ]);

    //fetch
       $post = $query -> fetch(); //get only one row of data
  


  require 'parts/header.php' 


?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Post</h1>
      </div>
      <div class="card mb-2 p-4">
        <form method="POST" action="/post/edit">

          <!-- title -->
            <div class="mb-3">
              <label for="post-title" class="form-label">Title</label>
              <input
                type="text"
                class="form-control"
                id="post-title"
                name="title"
                value="<?= $post['title']; ?>"
              />
            </div>

          <!-- content -->
            <div class="mb-3">
              <label for="post-content" class="form-label">Content</label>
              <textarea name="content" class="form-control" id="post-content" rows="10"><?= $post['content']; ?></textarea>
            </div>

          <!-- status -->
            <div class="mb-3">
              <label for="post-content" class="form-label">Status</label>
              <select class="form-control" id="post-status" name="status">

                <option value="pending" <?= $post['status'] == 'pending' ? "selected" : "" ?> >Pending for Review</option>

                <option value="publish" <?= $post['status'] == 'publish' ? "selected" : "" ?> >Publish</option>
              </select>

            </div>

          <!-- hidden input field for id -->
            <input type="hidden" name="id" value=" <?= $post['id']; ?>">

          <div class="text-end">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>

        </form>
      </div>
      <div class="text-center">
        <a href="/manage-posts" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Posts</a
        >
      </div>
    </div>
<?php require 'parts/footer.php'; ?>
