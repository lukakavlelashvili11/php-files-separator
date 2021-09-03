
$(() => {
    $('#choose-button').on('click',(e) => {
        e.preventDefault();
        $('#file').click();
    });

    $('#file').on('change',(e) => {
        let fileNames = '';
        for(file of e.target.files){
            fileNames += ' | ' + file.name;
        }
        $('#fileNames').show('fast').text(fileNames);
    });

    $('#handling-button').on('click',(e) => {
        e.preventDefault();
        let formData = new FormData();
        let files = $('#file')[0].files;
        if(!!files.length){
            for(var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }
            if($('#sortByType').is(":checked"))
                formData.append('sortType','Type');
            else
                formData.append('sortType','Extension');
            if(!!$('#zipName').val())
                formData.append('name',$('#zipName').val());
            $.ajax({
                method: 'POST',
                url: 'api.php',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend(){
                    $("#loader").show();
                    $("#error").hide();
                },
                success: function(res){
                    $('#link')
                    .html(`<a href="uploads/${res}" download="${res}" class="link">Download your zip folder.</a>`);
                },
                error(res){
                    console.log(res);
                }
            });
        }else{
            $("#error").show();
        }
    });
});