
//set global relative path to it's available through the file
var pageurl = '/admin/crud/';

//load page content on load or set the page to load
function getPosts(page) {
    $.ajax({
        url      : pageurl+'load?offset=' + page, //url to post to
        dataType : 'html', //set the type
    }).done(function (data) {
        $('#crudBody').html(data); // load contents into div with id of crudBody
        location.hash = page; //update hash in url
    }).fail(function () {
        alert('Posts could not be loaded.' + pageurl);
    });
}

//load page content
function loadBody() {

    var url    = window.location.href; // Returns full URL
    var number = url.split('#')[1]; //get the number from the hash on the end of the url

    //if there is a number call getPosts otherwise load the content normally.
    if (number > 0) {
        getPosts(number);
    } else {
        //load page content
        $('#crudBody').load(pageurl+'load');
    }
}


$(document).ready(function() {

    //enable pagination links to be routed via ajax
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();

        page = $(this).attr('href').split('offset=')[1];//get page number from the end of the url
        getPosts(page);//set page
        
    });

    //refresh page content
    loadBody();

    //submit new model form
    $('#create').submit(function(event) {

        // stop the form refreshing the page
        event.preventDefault();

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // process the form
        $.ajax({
            type        : $(this).attr('method'), // define the type of HTTP verb we want to use (POST for our form)
            url         : $(this).attr('action'), // the url where we want to POST
            data        : $(this).serialize(),
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        }).done(function(data) {

            // insert worked
            if (data.success) {

                //show success message using sweet alerts
                swal('Created!', data.message, 'success');

                //remove any form data
                $('#create').trigger("reset");

                //close model
                $('#addmodel').modal('hide');

                //refresh page content
                loadBody();

            } else {

                //if error exists update html
                if (data.errors.title) {
                    $('#title-group').addClass('has-error'); 
                    $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
                } 

                //if error exists update html
                if (data.errors.comment) {
                    $('#comment-group').addClass('has-error'); 
                    $('#comment-group').append('<div class="help-block">' + data.errors.comment + '</div>'); 
                } 

            }
            
        });

        
    });

    //open edit model
    $('body').on('click', '.edit', function(event) {

        // stop the form refreshing the page
        event.preventDefault();

        //get id from the link
        var id = $(this).attr('id');

        $.ajax({
            type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
            url         : pageurl+id+'/edit', // the url where we want to POST
            dataType    : 'json' // what type of data do we expect back from the server
        }).done(function(data) {

            // here we will handle errors and validation messages
            if (data.success) {

                $('#editmodel').modal('show'); //show the edit modal
                $("#update").attr('action', pageurl+id+'/update'); //set the form action url
                $("#editmodel input[name=title]").val(data.title); //update the title input
                $("#editmodel textarea[name=comment]").val(data.comment); //update the textarea value

            }  else {
                
                //show error message with Sweet alerts
                swal('Error!', data.error, 'danger');
            }
            
        });

    });

    //submit edit model form
    $('#update').submit(function(event) {

        // stop the form refreshing the page
        event.preventDefault();

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // process the form
        $.ajax({
            type        : $(this).attr('method'), // define the type of HTTP verb we want to use (POST for our form)
            url         : $(this).attr('action'), // the url where we want to POST
            data        : $(this).serialize(),
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        }).done(function(data) {

            // here we will handle errors and validation messages
            if (data.success) {

                //show success message with sweet alerts
                swal('Updated!', data.message, 'success');

                //close model
                $('#editmodel').modal('hide');

                //refresh page content
                loadBody();

            } else {

                //if error exists update html
                if (data.errors.title) {
                    $('#title-group').addClass('has-error'); 
                    $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
                } 

                //if error exists update html
                if (data.errors.comment) {
                    $('#comment-group').addClass('has-error'); 
                    $('#comment-group').append('<div class="help-block">' + data.errors.comment + '</div>'); 
                } 

            }
            
        });
        
    });

    //clicking on delete button
    $('body').on('click', '.delete', function(event) {

        // stop the form refreshing the page
        event.preventDefault();

        //get id from the link
        var id = $(this).attr('id');

        //popup confirm box using Sweet alerts
        swal({
            title: 'Are you sure to delete this?',
            text: 'You will be deleted immediately!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false }, function(){

                $.ajax({
                    type        : 'post', // define the type of HTTP verb we want to use (POST for our form)
                    url         : pageurl+id+'/destroy', // the url where we want to POST
                    dataType    : 'json' // what type of data do we expect back from the server
                }).done(function(data) {

                    // delete successful
                    if (data.success) {

                        //show success message with Sweet alerts
                        swal('Deleted!', data.message, 'success');

                        //refresh page content
                        loadBody();

                    }  else {
                        
                        //show error message with Sweet alerts
                        swal('Error!', data.error, 'danger');
                    }
                    
                });
                
        })

    });

});