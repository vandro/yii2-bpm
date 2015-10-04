<div class="upload-default-index">
    <div class="container">
        <div class="page-header">
            <h1>Simple Ajax Uploader</h1>
            <h3>Basic Example</h3>
        </div>
        <div class="row" style="padding-top:10px;">
            <div class="col-xs-2">
                <button id="uploadBtn" class="btn btn-large btn-primary">Choose File</button>
            </div>
            <div class="col-xs-10">
                <div id="progressOuter" class="progress progress-striped active" style="display:none;">
                    <div id="progressBar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    </div>
                </div>
            </div>
            <div class="col-xs-10">
                <div id="progressOuter" class="progress progress-striped active" style="display:none;">
                    <div id="progressBox" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-top:10px;">
            <div class="col-xs-10">
                <div id="msgBox">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function escapeTags( str ) {
        return String( str )
            .replace( /&/g, '&amp;' )
            .replace( /"/g, '&quot;' )
            .replace( /'/g, '&#39;' )
            .replace( /</g, '&lt;' )
            .replace( />/g, '&gt;' );
    }

    window.onload = function() {

        var btn = document.getElementById('uploadBtn'),
            progressBar = document.getElementById('progressBar'),
            progressOuter = document.getElementById('progressOuter'),
            msgBox = document.getElementById('msgBox');

        var uploader = new ss.SimpleUpload({
            button: btn,
            url: '<?=Yii::$app->getUrlManager()->createAbsoluteUrl('upload/do/file-upload')?>', //'file-upload'
            progressUrl: '<?=Yii::$app->getUrlManager()->createAbsoluteUrl('upload/do/upload-progress')?>', //'upload-progress',
            name: 'uploadFile',
            multipart: true,
            hoverClass: 'hover',
            focusClass: 'focus',
            responseType: 'json',
            startXHR: function() {
                progressOuter.style.display = 'block'; // make progress bar visible
                this.setProgressBar( progressBar );
            },
            onSubmit: function(filename, extension) {
                msgBox.innerHTML = ''; // empty the message box
                btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
                // Create the elements of our progress bar
                var progress = document.createElement('div'), // container for progress bar
                    bar = document.createElement('div'), // actual progress bar
                    fileSize = document.createElement('div'), // container for upload file size
                    wrapper = document.createElement('div'), // container for this progress bar
                    progressBox = document.getElementById('progressBox'); // on page container for progress bars

                // Assign each element its corresponding class
                progress.className = 'progress';
                bar.className = 'bar';
                fileSize.className = 'size';
                wrapper.className = 'wrapper';

                // Assemble the progress bar and add it to the page
                progress.appendChild(bar);
                wrapper.innerHTML = '<div class="name">'+filename+'</div>'; // filename is passed to onSubmit()
                wrapper.appendChild(fileSize);
                wrapper.appendChild(progress);
                progressBox.appendChild(wrapper); // just an element on the page to hold the progress bars

                // Assign roles to the elements of the progress bar
                this.setProgressBar(bar); // will serve as the actual progress bar
                this.setFileSizeBox(fileSize); // display file size beside progress bar
                this.setProgressContainer(wrapper); // designate the containing div to be removed after upload
            },
            onComplete: function( filename, response ) {
                btn.innerHTML = 'Choose Another File';
                progressOuter.style.display = 'none'; // hide progress bar when upload is completed

                if ( !response ) {
                    msgBox.innerHTML = 'Unable to upload file';
                    return;
                }

                if ( response.success === true ) {
                    msgBox.innerHTML = '<strong>' + escapeTags( filename ) + '</strong>' + ' successfully uploaded.';

                } else {
                    if ( response.msg )  {
                        msgBox.innerHTML = escapeTags( response.msg );

                    } else {
                        msgBox.innerHTML = 'An error occurred and the upload failed.';
                    }
                }
            },
            onError: function() {
                progressOuter.style.display = 'none';
                msgBox.innerHTML = 'Unable to upload file';
            }
        });
    };
</script>
