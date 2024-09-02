$('form').submit(function(event){
    event.preventDefault();
    var formData = new FormData($('this')[0]);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
        url: "/subirexcel",
        data: formData,
        type: 'post',
        async: false,
        processData: false,
        contentType: false,
        success:function(response){
            // console.log(response);
            alert('uploaded');
        }
    });

});
