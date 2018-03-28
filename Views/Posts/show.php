<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 2/6/2018
 * Time: 5:11 PM
 *

 */

require APPROOT.'/Views/PartialViews/header.php' ?>


<div class="container">

    <div class="row">
   <a href="<?php echo URLROOT; ?>" class="btn btn-primary mb-3"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
  <br>
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $data['post']->title; ?>
     
            </h1>
      
        </div>

    </div>

    <div class="row">

        <div class="col">

            <hr style=" background-color: #27A4E1;" />
            <p><i class="fa fa-clock-o"></i> Posted on
                <?php
                                                            $datetime = $data['post']->postCreated->toDateTime();
                                                            //  $datetime->setTimezone(new DateTimeZone('Asia/Kolkata'));
                                                            $time=$datetime->format(DATE_ATOM);
                                                            $date = date('m-d-Y',strtotime($time));
                                                            echo  $date;



                                                            ?>

                by  <?php echo $data['post']->userName ?>
            </p>
            <div style="border:solid 1px #27A4E1; padding:5px;">
                <p class="lead">
                    <?php
                echo $data['post']->body;
                    ?>
                </p>
            </div>

          

            <!-- the comment box -->

        </div>

    </div>

</div>


<div class="container" style="margin-top:10px;">

 <?php if($data['post']->userId == $_SESSION['userId']) : ?>

    

    <button type="submit" id="editPost" class="btn btn-primary" data-value="<?php echo $data['post']->_id; ?>">        <i class="fa fa-edit"></i> Edit
    </button>



    <form class="pull-right" action="<?php echo URLROOT; ?>/Posts/delete/<?php echo $data['post']->_id; ?>" method="post">
    <input type="submit" class="btn btn-danger icon-trash" value="&#xf1f8 Delete">

    </form>
   
  <?php endif; ?>


   </div>
<?php require APPROOT.'/Views/PartialViews/footer.php' ?>
