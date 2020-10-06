<html>
    <head>
        <meta charset="UTF-8">
        <title>Image Upload Dialog</title>
    </head>
    <body>
        <div class="container">
            <div class="row col-md-10 col-md-offset-1">
                <div id="upload_form">
                    <p>
                    <form enctype="multipart/form-data" encoding="multipart/form-data" action="/system/news/upload" method="post" target="upload_target" ng-upload="alert(0)">
                        <input class="" name="file_upload" type="file" value="" onChange="this.form.submit()" />
                        {!! csrf_field() !!}
                    </form>
                    </p>
                </div>
                <div id="image_preview" style="display:none; font-style: helvetica, arial;">
                    <iframe frameborder=0 scrolling="no" id="upload_target" name="upload_target" height=240 width=320></iframe>
                </div>
            </div>
            <script type="text/javascript" src="/sys/plugins/tinymce/plugins/imageupload/upload.js"></script>
        </div>
    </body>
</html>

