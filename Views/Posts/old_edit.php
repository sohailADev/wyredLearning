<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require APPROOT.'/Views/PartialViews/header.php' ?>
<?php print_r($data); ?>
<a href="<?php echo URLROOT; ?>" class="btn btn-info mb-3"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
<div class="card card-body bg-dark mt-5">
        <h2>Edit Post</h2>
        <p>Change the details of this post</p>
        <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
          <div class="form-group">
              <label>Title:<sup>*</sup></label>
              <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
              <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
          </div>    
          <div class="form-group">
              <label>Body:<sup>*</sup></label>
              <textarea id="summerNoteEdit" name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>">
                  <?php echo $data['body']; ?>
              </textarea>
              <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
          </div>
          <input type="submit" class="btn btn-success" value="Submit">
        </form>
      </div>



<?php require APPROOT.'/Views/PartialViews/footer.php' ?>