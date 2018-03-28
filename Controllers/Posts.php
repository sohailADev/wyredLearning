<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 1/29/2018
 * Time: 1:40 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Posts extends BaseController
{
    public function __construct()
    {
        if (!isLogedIn()) {
            redirect('Users/login');
        }
        $this->postModel = $this->model('Post');
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
             'search' => trim($_POST['search']),
             'searchError' => ''

                ];

            if (empty($data['search']))
            {

                $data['searchError'] = 'Please enter in search field';
                if(empty($data['searchError']))

                    die($data['searchError']);

            }
            elseif (strlen($data['password']) < 3)
            {
                $data['searchError'] = 'Text must be at least 3 characters';
            }


            if (empty($data['searchError']))
            {
                $posts = $this->postModel->search($data);
                $data =
                   [
                       'posts' => $posts
                   ];
                $this->view('Posts/index', $data);
            }
            else
            {

                //load view with errors
                $this->view('Posts/index', $data);
            }
        }

        $posts = $this->postModel->getPosts();

        $data =
            [
                'posts' => $posts
            ];
        $this->view('Posts/index', $data);
    }
    public function add()
    {

         if ($_SERVER['REQUEST_METHOD'] == 'POST')
         {
             //die($_POST['content']);
             //return;
             $data = [
                'imageError' => ''
            ];
            $filename = null;
//            dnd($_FILES);



            // Sanitize POST array

           // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $date = new MongoDB\BSON\UTCDateTime((new DateTime())->getTimestamp()*1000);
            $target_dir = APPROOT.'/upload/';

                // die($target_dir);
          // Check if file was uploaded without errors
             if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0)           {

                            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                            $filename = $_FILES["image"]["name"];
                            $filetype = $_FILES["image"]["type"];
                            $filesize = $_FILES["image"]["size"];
                            // Verify file extension
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);

                            if(!array_key_exists($ext, $allowed))
                            {
                                 $data['imageError'] = 'Please select a valid file format.';
                             }
                            // Verify file size - 5MB maximum
                            $maxsize = 5 * 1024 * 1024;
                            if($filesize > $maxsize)
                                {
                                $data['imageError'] = 'File size is larger than the allowed limit.';
                               }
                            // Verify MYME type of the file
                            if(in_array($filetype, $allowed))
                                    {
                                            // Check whether file exists before uploading it
                                            if(file_exists($target_dir. $_FILES["image"]["name"]))
                                            {
                                                 $data['imageError'] =  $_FILES["image"]["name"] . " is already exists.";
                                            }
                                            else
                                            {

                                                move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir. $_FILES["image"]["name"]);
                                //die('stop');

                                            }
                            }
                            else
                            {
                                $data['imageError'] =   " Please selecet image file";
                                   //die( "There was a problem uploading your file. Please try again.");
                            }
                }
                else

                {

                     $data['imageError'] =  'Please select an iamge';

                }


            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['content']),
                'userName' =>  $_SESSION['userName'],
                'userId' =>  $_SESSION['userId'],
                'postCreated' =>$date,
                'image' =>$filename,
                'titleError' => '',
                'bodyError' => '',

            ];


            // Validate data
            if (empty($data['title'])) {
                $data['titleError'] = 'Please enter title';
            }
            if (empty($data['body'])) {
                $data['bodyError'] = 'Please enter body text';
            }
            if (empty($data['image'])) {
                $data['imageError'] = 'Please select an image to upload';
            }

            if (empty($data['titleError']) && empty($data['bodyError']) && empty($data['imageError']) )
            {

                // Validated
                if ($this->postModel->addPost($data)) {
                    flash('postMessage', 'Post Added');
                    die("image uploaded ");
                    //redirect('Posts/index');
                } else {
                    die('Something went wrong');
                }
            }
            else
             {
                // Load view with errors
                $this->view('Posts/add', $data);
            }
        }
        else
        {
        $data = [
            'title' => '',
            'body' => '',
             ];
            $this->view('Posts/add', $data);
        }
    }




    public function show($id)
    {
        $post = $this->postModel->getPost($id);
        $data = [
            'post'=>$post
        ];
        
        $this->view('Posts/show', $data);
    }
    public function edit(){

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = [
                    'title' => '',
                    'body' => '',
                    'userName' =>  '',
                    'userId' =>  '',
                    'postCreated' =>'',
                    'image' =>'',
                    'titleError' => '',
                    'bodyError' => '',
                    'imageError'=>'',
                    'postId'=>''
                    ];

            if(isset($_POST['id']))
            {
                $_SESSION['postId'] =$_POST['id'];
                print_r($_POST['id']);
            }
            else
            {


                $data['postCreated'] = new MongoDB\BSON\UTCDateTime((new DateTime())->getTimestamp()*1000);
                $target_dir = APPROOT.'/upload/';
                // Check if file was uploaded without errors
                if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0)
                {
                    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                    $filename = $_FILES["image"]["name"];
                    $filetype = $_FILES["image"]["type"];
                    $filesize = $_FILES["image"]["size"];
                    // Verify file extension
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    if(!array_key_exists($ext, $allowed))
                    {

                        $data['imageError'] = 'Please select a valid file format.';
                    }
                    // Verify file size - 5MB maximum
                    $maxsize = 5 * 1024 * 1024;
                    if($filesize > $maxsize)
                    {
                        $data['imageError'] = 'File size is larger than the allowed limit.';
                    }
                    // Verify MYME type of the file
                    if(in_array($filetype, $allowed))
                    {
                       $data['image'] = $_FILES["image"]["name"];
                       move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir. $_FILES["image"]["name"]);
                        
                    }
                    else
                    {
                        $data['imageError'] =   " Please selecet image file";
                    }
                }
                else
                {
                    $data['imageError'] =  'Please select an iamge';
                }
                $data['title'] = trim($_POST['title']);
                $data['body'] = trim($_POST['content']);
                $data['userName'] = $_SESSION['userName'];
                $data['userId'] = $_SESSION['userId'];

                // Validate data
                if (empty($data['title'])) {
                    $data['titleError'] = 'Please enter title';
                }
                if (empty($data['body'])) {
                    $data['bodyError'] = 'Please enter body text';
                }
                if (empty($data['image']))
                {
                    if(empty($data['imageError']))
                    {
                        $data['imageError'] = 'Please select an image to upload';
                    }

                }

                if (empty($data['titleError']) && empty($data['bodyError']) && empty($data['imageError']) )
                {
                   $data['postId'] =  $_SESSION['postId'];

                    if($this->postModel->updatePost($data)){
                        // Redirect to login
                        flash('postMessage', 'Post Updated');
                       
                        print_r(json_encode($data));

                    } else {

                         die('Something went wrong');
                    }


                }
                else
                {
                    $data['postId'] =  $_SESSION['postId'];
                    print_r(json_encode($data));
                }
            }
        }
        else
        {

            // Get post from model
            $post = $this->postModel->getPost($_SESSION['postId']);

            // Check for owner
            if($post->userId != $_SESSION['userId']){
                redirect('posts');
            }
            $data = [
              'id' =>$_SESSION['postId'],
              'title' => $post->title,
              'body' => $post->body,
            ];
            $this->view('Posts/edit', $data );
        }

    }
    // Delete Post
    public function delete($id)
    {


        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Execute
            if($this->postModel->deletePost($id)){
                flash('postMessage', 'Post Removed');
                // Redirect to login
                redirect('Posts/index');


            }
            else
            {
                die('Something went wrong');
            }
        }
        else
        {
            redirect('posts');
        }
    }
    // process image
    public function imageProcess()
    {
        $result = [
            'status'=> 'ook',
            'message'=> 'All Done',
            'fileExist'=> 'yes',
            'filesName'=> 'noName',
            'filesTmpName'=> 'noName',
            'filePath'=> 'noPath',
            ];

        date_default_timezone_set('America/Los_Angeles');//Get Timezone of usa

        if(!file_exists(date("Ymd",time())))    // If the folder does not exist, create one
        {
            $result['fileExist'] ='no';
            mkdir(date("Ymd",time()));
        }
        $filesName ="";
        if(isset($_FILES['file']['name']))
        {
            $filesName = $_FILES['file']['name']; // array of file names
        }


        $result['filesName'] = $filesName;
        $filesTmpName = "";// array of temporary file names
        if(isset($_FILES['file']['tmp_name']))
        {
            $filesTmpName = $_FILES['file']['tmp_name'];
        }

        $result['filesTmpName'] = $filesTmpName;
        $filePath = date("Ymd",time()).'/'.$filesName; //file path
        $result['filePath'] =  $filePath;


        if(!file_exists(date("Ymd",time()).'/'.$filesName))
        {
            if(move_uploaded_file($filesTmpName, $filePath))
            {
                $result['status'] ='yahoo';
                $result['message'] ='Image inserted';
                $result['filePath'] =$filePath;
                die(json_encode($result));
            }
            else
            {
                $result['status'] ='error';
                die(json_encode($result));
            }
        }
        else
        {
            $result['status'] ='error';
            $result['message'] ='Image already exists! Insert failed';

            die(json_encode($result));

        }
        // die(json_encode($result));
    }
    public function deleteImage()
    {
        $imgSrc =$_POST['imgSrc'];
        $url =   "./";
        $final = $url.$imgSrc;

        $result = [
            'imgSrc' => 'Nothing',
            'message' => 'nothing',
        ];

        if(file_exists($final))
        {

            if(unlink($final))
            {
                $result['imgSrc'] = $final;
                $result['message'] = "Picture deleted successfully!";
                redirect('Posts/index');
                die(json_encode($result));
            }
            else
            {

                $result['imgSrc'] = $final;
                $result['message'] = "Unsuccessful deletion!";
                die(json_encode($result));
            }
        }
        else
        {

            $result['imgSrc'] = $final;
            $result['message'] = "Delete operation failed!";
            print_r($result);
        }
    }
    public function isXmlHttpRequest()
    {
        $header = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : null;
        return ($header === 'XMLHttpRequest');
    }
    public function test()
    {
        $data =
          [
              'posts' => 'nothing'
          ];
        $this->view('Posts/test', $data);
    }



}