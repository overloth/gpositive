<?php
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = Aws\S3\S3Client::factory();
$bucket = getenv('S3_BUCKET_NAME')?: die('No "S3_BUCKET_NAME" config var in found in env!');
?>


   



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CENTAR ZA POZITIVNU PSIHOLOGIJU') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap-social.css" rel="stylesheet">

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="bapp">
        <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0px;">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" style="{{ Request::is('/') ? 'background-color: #eeeeee;' : '' }}" href="{{ url('/') }}">
                        Home
                    </a>

                    <!--<a class="navbar-brand" href="{{ url('/articles') }}">
                        articles
                    </a>

                    <a class="navbar-brand" href="{{ url('/courses') }}">
                        courses
                    </a>-->
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('articles') ? 'active' : '' }}"><a class="djek" href="{{ url('/articles') }}">@lang('various.articles')</a></li>
                        <li class="{{ Request::is('courses') ? 'active' : '' }}"><a href="{{ url('/courses') }}">@lang('various.courses')</a></li>
                        <li class="{{ Request::is('workshops') ? 'active' : '' }}"><a href="{{ url('/workshops') }}">@lang('various.workshops')</a></li>
                      <!--  <li class="{{ Request::is('events') ? 'active' : '' }}"><a href="{{ url('/events') }}">@lang('various.events')</a></li> -->
                    </ul>

                    <!-- Right Side Of Navbar -->

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><div style="border: solid #cccccc 1px; width: 40px; height: 22px; background:url('/images/flag_{{Cookie::get('lang')}}.png'); background-size:cover;""></div>
                            </a>

                            <ul class="dropdown-menu" role="menu">

                                <a href="{{ url('/language/en') }}" onclick="event.preventDefault(); window.location.href = '/language/en';" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <div style="clear:both">
                                    <div style="float:left; margin:4px; border: solid #cccccc 1px; width: 40px; height: 22px; background:url('/images/flag_en.png'); background-size:cover;""></div> 
                                    <div style="margin:4px; padding-top: 4px;">English</div>
                                </div>
                                </a>

                                <a href="{{ url('/language/sr') }}" onclick="event.preventDefault(); window.location.href = '/language/sr';" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <div style="clear:both">
                                    <div style="float:left; margin:4px; border: solid #cccccc 1px; width: 40px; height: 22px; background:url('/images/flag_sr.png'); background-size:cover;""></div> 
                                    <div style="margin:4px; padding-top: 4px;">Srpski</div>
                                </div>
                                </a>

                                <a href="{{ url('/language/de') }}" onclick="event.preventDefault(); window.location.href = '/language/de';" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <div style="clear:both">
                                    <div style="float:left; margin:4px; border: solid #cccccc 1px; width: 40px; height: 22px; background:url('/images/flag_de.png'); background-size:cover;""></div> 
                                    <div style="margin:4px; padding-top: 4px;">Deutch</div>
                                </div>
                                </a>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>

    <!-- Scripts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <script src="/js/presentation.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#technig').summernote({
                height:300,
                callbacks: {
                    onImageUpload: function(files, editor, $editable) {
                        sendFile(files[0],editor,$editable);
                    }
                }
            });

            function sendFile(file,editor,welEditable) {
                data = new FormData();
                data.append("file", file);
                jQuery.ajax({
                    url: "{{ url('/upload/image') }}",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(s){
                        console.log("good summernote upload");
                        jQuery('#technig').summernote("insertImage", s);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("error with picture upload!");
                        console.log(textStatus+" gi "+errorThrown);
                    }
                });
            }
        });
    </script>

</body>
</html>
