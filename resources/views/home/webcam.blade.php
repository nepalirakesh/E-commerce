<!DOCTYPE html>
<html>

<head>
    <title>laravel webcam capture image and save from camera</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results {
            padding: 20px;
            border: 1px solid;
            background: #ccc;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center"> Upload 5 photos. It</h1>

        <form method="POST" action="{{ route('webcam.capture') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div id="my_camera"></div>
                    <br />
                    <input type="button" value="Take Photos" onClick="take_photos(5)">
                    <input type="hidden" name="image1" class="image-tag">
                    <input type="hidden" name="image2" class="image-tag">
                    <input type="hidden" name="image3" class="image-tag">
                    <input type="hidden" name="image4" class="image-tag">
                    <input type="hidden" name="image5" class="image-tag">
                </div>
                <div class="col-md-12">
                    <div id="results">Your captured images will appear here and it take... <br></div>
                </div>
                <div class="col-md-12 text-center">
                    <br />
                    <button class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script language="JavaScript">
        Webcam.set({
            width: 350,
            height: 275,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_photos(num_photos) {
            var imageCount = $('.image-tag').filter(function() {
                return this.value !== '';
            }).length;
            if (imageCount >= 5) {
                return;
            }
            var index = imageCount + 1;
            var take_photo = function() {
                if (index <= num_photos) {
                    Webcam.snap(function(data_uri) {
                        $(".image-tag[name='image" + index + "']").val(data_uri);
                        document.getElementById('results').innerHTML += '<img src="' + data_uri + '"/>';
                        index++;
                        setTimeout(take_photo, 1000); // wait 1 second between photos
                    });
                }
            }
            take_photo();
        }
    </script>

</body>

</html>
