//call rich text editor 
$(document).ready(function() {
    var $summernote = $('#summernote').summernote({
        height: 200,
        minHeight: null,
        maxHeight: null,
        focus: true,
        //   popover: {
        //     image: [],
        //     link: [],
        //     air: []
        //     },
        placeholder: "Enter Content here ",
        //Call image upload
        callbacks: {
            onImageUpload: function(files) {
                sendFile($summernote, files[0]);
            },
        }
    });

    //Ajax upload image
    function sendFile($summernote, file) {
        var formData = new FormData();
        formData.append("file", file);
        $.ajax({
            url: "/wyredlearning/Posts/imageProcess",
            data: formData,
            type: 'POST',
            dataType: 'json',
            // mimeType: "multipart/form-data",
            // If submit data is FormData type, then the following three sentences must be added
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#summernote').summernote('insertImage', 'http://localhost/wyredlearning/'.concat(data.filePath)); //Directly insert the path, filename optional
                console.log(data.filePath);
            },
            error: function(data) {
                console.log(data);
                alert("Failed to upload pictures!");
            },
            complete: function(data) {
                console.log(data);
            }
        });
    }
    // Prefixes in Firefox and earlier Chrome
    var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
    //The following code must be in var $summernote = $('#summernote').summernote() is finished with class = note-editable, otherwise it will be reported directly
    //
    // Select the target node
    var target = document.querySelector('.note-editable');
    //   Create an observer object
    var observer = new MutationObserver(function(mutations) { // Observe the object's callback function
        console.log(mutations);
        mutations.forEach(function(mutation) //     forEach: Traverses all MutationRecords
            {
                console.log(mutation);
                console.log(mutation.type); //MutationRecord.type
                console.log(mutation.oldValue); // Note that muting.type is childList, you cannot use oldValue to get the value
                if (mutation.addedNodes[0] != null) {
                    console.log(mutation.addedNodes);
                    console.log(mutation.addedNodes[0]);
                    console.log(mutation.addedNodes[0].src);
                    if (mutation.addedNodes[0].tagName == "IMG")
                        console.log("Successfully added an img");
                }
                if (mutation.removedNodes[0] != null) {
                    console.log(mutation.removedNodes);
                    if (mutation.removedNodes[0].tagName == "IMG") {
                        var href = location.href; //current path
                        console.log(href);
                        href = href.substring(0, href.lastIndexOf("/") + 1);
                        console.log(href);
                        var imgSrc = mutation.removedNodes[0].src;
                        imgSrc = imgSrc.replace('http://localhost/wyredlearning/', ''); //A stupid way to separate relative paths
                        // C:\xampp\htdocs\wyredLearning\20180320\Screenshot_6.png
                        // imgSrc = imgSrc.replace("/", "\");
                        console.log(imgSrc);
                        $.ajax({
                            type: "POST",
                            url: "/wyredlearning/Posts/deleteImage",
                            data: { imgSrc: imgSrc },
                            success: function(data) {
                                debugger;
                                console.log(data);
                            }, // Callback function after successful request
                            error: function(data) {
                                debugger;
                                console.log(data);
                            },
                            complete: function(data) {
                                debugger;
                                console.log(data);
                            }
                        });
                    }
                }
            });
    });
    //Weight Watcher Options
    var config = { attributes: true, childList: true, characterData: true, subtree: true };
    // Configure observation options
    observer.observe(target, config);
   // $("#formSubmit").click(function () {
    $("#PostForm").on('submit', function () {
        debugger;
        var content = $('#summernote').summernote('code');
        $("<input>", { type: "hidden", name: "content", value: content }).appendTo("#PostForm");    

        $.ajax({
            url: "/wyredlearning/Posts/add",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            dataType: "html",
         
            success: function(data) {
                
                window.location.href = "index";

              
            },
            error: function() {
                debugger;
                alert("Submission Failed!");
            }
        });
        return false;
    })





    var $summernote = $('#summernoteEdit').summernote({
        height: 200,
        minHeight: null,
        maxHeight: null,
        focus: true,
        //   popover: {
        //     image: [],
        //     link: [],
        //     air: []
        //     },
        placeholder: "Enter Content here ",
        //Call image upload
        callbacks: {
            onImageUpload: function (files) {
                sendFile($summernote, files[0]);
            },
        }
    });

    //Ajax upload image
    function sendFile($summernote, file) {
        var formData = new FormData();
        formData.append("file", file);
        $.ajax({
            url: "/wyredlearning/Posts/imageProcess",
            data: formData,
            type: 'POST',
            dataType: 'json',
            // mimeType: "multipart/form-data",
            // If submit data is FormData type, then the following three sentences must be added
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#summernote').summernote('insertImage', 'http://localhost/wyredlearning/'.concat(data.filePath)); //Directly insert the path, filename optional
                console.log(data.filePath);
            },
            error: function (data) {
                console.log(data);
                alert("Failed to upload pictures!");
            },
            complete: function (data) {
                console.log(data);
            }
        });
    }
    // Prefixes in Firefox and earlier Chrome
    var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
    //The following code must be in var $summernote = $('#summernote').summernote() is finished with class = note-editable, otherwise it will be reported directly
    //
    // Select the target node
    var target = document.querySelector('.note-editable');
    //   Create an observer object
    var observer = new MutationObserver(function (mutations) { // Observe the object's callback function
        console.log(mutations);
        mutations.forEach(function (mutation) //     forEach: Traverses all MutationRecords
        {
            console.log(mutation);
            console.log(mutation.type); //MutationRecord.type
            console.log(mutation.oldValue); // Note that muting.type is childList, you cannot use oldValue to get the value
            if (mutation.addedNodes[0] != null) {
                console.log(mutation.addedNodes);
                console.log(mutation.addedNodes[0]);
                console.log(mutation.addedNodes[0].src);
                if (mutation.addedNodes[0].tagName == "IMG")
                    console.log("Successfully added an img");
            }
            if (mutation.removedNodes[0] != null) {
                console.log(mutation.removedNodes);
                if (mutation.removedNodes[0].tagName == "IMG") {
                    var href = location.href; //current path
                    console.log(href);
                    href = href.substring(0, href.lastIndexOf("/") + 1);
                    console.log(href);
                    var imgSrc = mutation.removedNodes[0].src;
                    imgSrc = imgSrc.replace('http://localhost/wyredlearning/', ''); //A stupid way to separate relative paths
                    // C:\xampp\htdocs\wyredLearning\20180320\Screenshot_6.png
                    // imgSrc = imgSrc.replace("/", "\");
                    console.log(imgSrc);
                    $.ajax({
                        type: "POST",
                        url: "/wyredlearning/Posts/deleteImage",
                        data: { imgSrc: imgSrc },
                        success: function (data) {
                            debugger;
                            console.log(data);
                        }, // Callback function after successful request
                        error: function (data) {
                            debugger;
                            console.log(data);
                        },
                        complete: function (data) {
                            debugger;
                            console.log(data);
                        }
                    });
                }
            }
        });
    });
    //Weight Watcher Options
    var config = { attributes: true, childList: true, characterData: true, subtree: true };
    // Configure observation options
    observer.observe(target, config);
    // $("#formSubmit").click(function () {
    $("#editPostForm").on('submit', function () {
        debugger;

        var content = $('#summernote').summernote('code');
        $("<input>", { type: "hidden", name: "content", value: content }).appendTo("#editPostForm");

        $.ajax({
            url: "/wyredlearning/Posts/edit",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            dataType:"json",

            success: function (data) {
                alert(data.imageError);
                debugger;
                if (!data.bodyError && !data.imageError && !data.titleError)
                {
                    window.location.replace("http://localhost/wyredlearning");
                }
                else
                {
                    window.location.replace("http://localhost/wyredlearning/Posts/edit/" + data.postId);
                   
                }

            },
            error: function () {
                debugger;
                alert("Submission Failed!");
            }
        });
      
    })

  
  

});

$("#editPost").click(function () {
    var _id = $(this).data("value");
    debugger;

    $.ajax({
        url: "/wyredlearning/Posts/edit",
        type: 'POST',
        data: {id:_id},
        dataType: "text",
        success: function (id) {
            debugger;
            var nid = id[0];
            window.location.replace("http://localhost/wyredlearning/Posts/edit/" + id);
    
         
        },
        error: function (data) {
            debugger;
            alert(data);
        }
        

    });



});
