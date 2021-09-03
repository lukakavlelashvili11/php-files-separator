<html>
    <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/style.css"/>
    </head>
    <body>
        <div class="inputs-container">
            <form>
                <div class="inputs">
                    <button id="choose-button" class="choose-button">Choose files</button>
                    <input type="file" id="file" hidden multiple>
                    <input id="zipName" class="input" type="text" placeholder="Zip name(optional)"/>
                    <div id="fileNames" class="filenames"></div>
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
                    <div id="link" class="download-link">
                        <div id="loader" class="loader"></div>
                        <div id="error" class="error">Files are not choosen!</div>
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script src="./assets/js/handleFiles.js"></script>
</html>