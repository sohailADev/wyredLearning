<?php require APPROOT.'/Views/PartialViews/header.php' ?>
<?php
 
    ?>

<?php flash("postMessage") ; ?>

<!-- Card -->
<div class="card card-image "  style="background-image: url(../Assets/images/main-bg.jpg);">

    <!-- Content -->
    <div class="text-dark text-center  align-items-center rgba-black-strong py-5 px-4" style="background:rgba(255,255,255,0.20); text-align: center">
        <div >
            <h5 class="text-info"><i class="fa fa-graduation-cap"></i> Learning</h5>
            <h3 class="text-info pt-2">
                <strong>Learn PHP with Mongodb</strong>
            </h3>
            <p >Employees at Wyred[Insights] can use this Portal to learn and share their knowledge and skills.</p>
                <div class="col-lg-12">
                

                        <form action="<?php echo URLROOT; ?>/Posts/index" method="post" >

                            <div class="form-group">
                          
                            <input type="text" name="search" class="form-control" id="exampleInputPassword1" placeholder="Search.." value="">
                            <span class="invalid-feedback"><?php echo $data['searchError']?></span>
                              </div>

                            <div class="row">
                                <div class="col">
                                    <input type="submit" value="Search" class="btn btn-primary btn-lg btn-block">
                                </div>
                            </div>
                        </form>
                 </div>

        </div>
    </div>
    <!-- Content -->
</div>
<!-- Card -->
<div class="container-fluid bodyContainer">
    <div class="row mb-3 mt-4">
        <div class="col-md-6">
            <h1>Tutorials</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT; ?>/Posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add Tutorial
            </a>
        </div>
    </div>
    <div class="row" >
        <div >
                <?php  if(!empty($data['posts'])) {foreach ($data['posts'] as $item){?>
                     <div class="card border-primary mr-5 mb-5 w-100" style="width:45% !important;float: left">
                        <div class="card-header"><h3><b><?php echo $item['title']; ?></b></h3></div>
                        <div class="card-body text-secondary">
                  
                       
                            <img class="card-img-top img-thumbnail"  src="<?php echo '../upload/'.$item['image']; ?>" alt="Card image cap" style="height:200px;width:100%;">
                         
                            <div class="text-muted">
                                Written by <?php echo $item['userName']; ?> on <?php

                                $datetime = $item['postCreated']->toDateTime();
                                $time=$datetime->format(DATE_ATOM);
                                $date = date('m-d-Y',strtotime($time));
                                echo $date ?>
                            </div>
                          <a href="<?php echo URLROOT; ?>/Posts/show/<?php echo $item['_id']; ?>" class="btn btn-primary pull-right">Read More</a>
                        </div>

                    </div>
                <?php }}
                else
                {
                    echo  "There is no data to retrieve";}?>
            </div>
    </div>


    </div>





<?php require APPROOT.'/Views/PartialViews/footer.php' ?>
