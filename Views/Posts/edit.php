<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 2/6/2018
 * Time: 3:01 PM
 */


require APPROOT.'/Views/PartialViews/header.php' ?>

<div class="container">

    <a href="<?php echo URLROOT; ?>" class="btn btn-info mb-3">
        <i class="fa fa-backward" aria-hidden="true"></i> Back
    </a>
    <br />


    <div class="card card-body bg-light mt-5 text-white">
        <h4 class="card-title">Edit the content Please !</h4>
    </div>
    <form id="editPostForm" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control  <?php echo (!empty($data['titleError'])) ? 'is-invalid' : '' ?>" id="titleExample" placeholder="Enter title" value="<?php echo $data['title'] ; ?>" />
            <span class="invalid-feedback">
                <?php echo $data['titleError']?>
            </span>

        </div>
        <div class="form-group">
            <label for="body">Content:</label>
            <textarea id="summernote" name="body" class="form-control  <?php echo (!empty($data['bodyError'])) ? 'is-invalid' : '' ?>">
                <?php echo $data['body'] ; ?>
            </textarea>
            <span class="invalid-feedback">
                <?php echo $data['bodyError']?>
            </span>
        </div>


        <div class="form-group">
            <label for="image">Select Image:</label>
            <input type="file" name="image" id="file" class="form-control <?php echo (!empty($data['imageError'])) ? 'is-invalid' : '' ?>" />
            <span class="invalid-feedback">
                <?php echo $data['imageError']?>
            </span>

        </div>
        <input type="submit" name="submit" class="btn btn-success " value="Submit" />

    </form>

</div>


<?php require APPROOT.'/Views/PartialViews/footer.php' ?>
