<html>
    <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <style>
            body{
                background-image: linear-gradient(to right, #6b4bc9, #8e4bc9,#b84bc9,#c94bac,#f250a9); 
            }
            .inputs-container{
                width: 420px;
                height: 400px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 100px;
                background: rgba(235, 242, 238,0.2);
                border-radius: 10px;
                padding: 20px;
            }
            .inputs{
                width: 90%;
                margin-left: auto;
                margin-right: auto;
            }
            .inputs .input{
                width: 100%;
                border: none;
                outline: none;
                height: 40px;
                border-radius: 10px;
                margin-top: 20px;
                padding-left: 10px;
                font-size: 17px;
                background: white;
            }
            .inputs .choose-button{
                width: 100%;
                height: 45px;
                font-size: 17px;
                outline: none;
                border: none;
                background: rgba(32, 28, 140,0.2);
                border-radius: 10px;
                cursor: pointer;
                color: white;
            }
            .inputs .handling-button{
                width: 100%;
                height: 45px;
                font-size: 17px;
                outline: none;
                border: none;
                background: rgba(71, 17, 66,0.2);
                border-radius: 10px;
                cursor: pointer;
                color: white;
            }
            .radio-buttons{
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
                margin-bottom: 70px;
            }
            .radio-buttons div .radio{
                -ms-transform: scale(1.2);
                -webkit-transform: scale(1.2);
                transform: scale(1.2);
            }
        </style>
    </head>
    <body>
        <div class="inputs-container">
            <form>
                <div class="inputs">
                    <button id="choose-button" class="choose-button">Choose files</button>
                    <input type="file" id="file" hidden multiple>
                    <input id="zipName" class="input" type="text" placeholder="Zip name(optional)"/>
                    <div id="fileNames" class="input"></div>
                    <div class="radio-buttons">
                        <div>
                            <label>Sort by type(df)</label>
                            <input id="sortByType" class="radio" type="radio" name="sort" checked="checked">
                        </div>
                        <div>
                            <input class="radio" type="radio" name="sort">
                            <label>Sort by extension(df)</label>
                        </div>
                    </div>
                    <button id="handling-button" class="handling-button">Handling</button>
                </div>
            </form>
        </div>
    </body>
    <script>
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
                $('#fileNames').text(fileNames);
            });

            $('#handling-button').on('click',(e) => {
                e.preventDefault();
                let formData = new FormData();
                let files = $('#file')[0].files;
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
                    url: 'web.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success(res){
                        console.log(res);
                    },
                    error(res){
                        console.log(res);
                    }
                });
            });
        });
    </script>
</html>