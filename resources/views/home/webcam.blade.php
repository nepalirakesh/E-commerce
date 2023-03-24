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
    @if (Session::get('error'))
    <div class="col-md-8">
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    </div>
@endif
    <div class="container">
        <h1 class="text-center"> Upload photos for Face Authentication </h1>

        <form method="POST" action="{{ route('webcam.capture') }}">
            @csrf
            <div class="row">
              
                <div class="col-md-6">
                    <div id="my_camera" style="margin-top:50px"></div>
                    <br />
                    <input type="button" class="button btn-primary" value="Take Photo" onClick="take_photos()">
                    
                    <input type="hidden" name="image" class="image-tag" required>
                    <div class="col-md-12"> 

                        <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
    
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div id="results">Your captured images will appear here and it take... <br></div>
                </div>
                <div class="col-md-12 text-center">
                    <br />
                    <button class="btn btn-success">Submit</button>
                    <a href="{{route('login')}}" class="btn btn-success">Back</a>


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

        function take_photos() {
    

            var take_photo = function() {

                $('#my_camera').css("display","value");
                Webcam.snap(function(data_uri) {
                    $(".image-tag[name='image']").val(data_uri);
                    document.getElementById('results').innerHTML += '<img src="' + data_uri + '"/>';
                    index++;
                    setTimeout(take_photo, 1000); // wait 1 second between photos
                });

            }
            take_photo();
        }
    </script>

</body>

</html>
