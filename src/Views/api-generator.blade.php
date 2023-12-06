<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: rgba(32,33,35);
        }

        .file-upload {
            background-color: rgb(52,53,65);
            width: 600px;
            border-radius: 8px;
            margin: 30px auto;
            padding: 20px;
            box-shadow: 12px 14px 35px -12px rgba(0, 0, 0, 0.32);
            -webkit-box-shadow: 12px 14px 35px -12px rgba(0, 0, 0, 0.32);
            -moz-box-shadow: 12px 14px 35px -12px rgba(0, 0, 0, 0.32);
        }

        .file-generate-btn {
            width: 100%;
            margin: 0;
            color: #fff;
            background: linear-gradient(45deg, #1AA059, #42d687);
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #15824B;
            transition: all .2s ease;
            outline: none;
            font-weight: 700;
        }

        .file-generate-btn:hover {
            background: linear-gradient(45deg, #127842, #2ca665);
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-generate-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-analyze-btn {
            width: 100%;
            margin: 20px 0;
            color: #1d1d1d;
            background: linear-gradient(45deg, cyan, #a2a2a2);
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #23758c;
            transition: all .2s ease;
            outline: none;
            font-weight: 700;
        }

        .file-analyze-btn:hover {
            background: linear-gradient(45deg, rgb(0, 176, 176), #a2a2a2);
            color: #373737;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-analyze-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            background-color: rgb(52,53,65);
            margin-top: 20px;
            border: 1px solid rgb(86,88,105);
            border-radius: 8px;
            position: relative;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: rgb(86,88,105);
            border: 1px dashed grey;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: rgb(86,88,105);
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            color: #c3c3c3;
            padding: 60px 0;
        }

        .file-upload-image {
            max-height: 400px;
            max-width: 400px;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 200px;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }

        .output-analyze-wrap {
            position: relative;
            background-color: rgb(52,53,65);
            width: 600px;
            min-height: 300px;
            border-radius: 8px;
            margin: 30px auto;
            padding: 20px;
            box-shadow: 12px 14px 35px -12px rgba(0, 0, 0, 0.32);
            -webkit-box-shadow: 12px 14px 35px -12px rgba(0, 0, 0, 0.32);
            -moz-box-shadow: 12px 14px 35px -12px rgba(0, 0, 0, 0.32);
        }

        .loader {
            width: 100%;
            min-height: auto;
            border-radius: 8px;
            margin: 30px auto;
            padding: 20px;
            display: none;
            justify-content: center;
            align-items: center;
            background: rgb(52,53,65);
            transition: visibility 0s, opacity 0.5s linear;
        }

        .wave {
            width: 5px;
            height: 100px;
            background: linear-gradient(45deg, cyan, #fff);
            margin: 10px;
            animation: wave 1s linear infinite;
            border-radius: 20px;
        }

        .wave:nth-child(2) {
            animation-delay: 0.1s;
        }

        .wave:nth-child(3) {
            animation-delay: 0.2s;
        }

        .wave:nth-child(4) {
            animation-delay: 0.3s;
        }

        .wave:nth-child(5) {
            animation-delay: 0.4s;
        }

        .wave:nth-child(6) {
            animation-delay: 0.5s;
        }

        .wave:nth-child(7) {
            animation-delay: 0.6s;
        }

        .wave:nth-child(8) {
            animation-delay: 0.7s;
        }

        .wave:nth-child(9) {
            animation-delay: 0.8s;
        }

        .wave:nth-child(10) {
            animation-delay: 0.9s;
        }

        @keyframes wave {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        .form-label{
            color: #fff;
        }
       
    </style>

    <title>Velodome</title>
</head>

<body>

    <!-- Nav -->
    {{-- <nav class="navbar navbar-dark" style="background-color: #343541;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://cdn.iconscout.com/icon/free/png-256/free-openai-1524262-1290809.png" alt="" width="30"
                    height="30" class="d-inline-block align-text-top">
                Velodome
            </a>
        </div>
    </nav> --}}

    

    @if(!$props)
    <!-- Image input -->
    <div class="file-upload" id="fileUpload">
        <form id="formAnalyze" action="/velodome/api-generator/analize" method="post" enctype="multipart/form-data">

            <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' name="file" id="file" onchange="readURL(this);"
                    accept="image/*" />
                <div class="drag-text">
                    <h3>Drag and drop a file or select add Image</h3>
                </div>
            </div>
            <div class="file-upload-content">
                <img class="file-upload-image" src="#" alt="your image" />
                <div id="loader" class="loader">
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>

                <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span
                            class="image-title">Uploaded Image</span> </button>
                </div>
            </div>

            <button type="submit" id="button_analyze" class="file-analyze-btn">Analyze Image</button>
        </form>
    </div>

    @else
    {{-- Form input --}}
    <form id="formGenerate" action="/velodome/api-generator/generate" method="post" enctype="multipart/form-data">
        <div class="output-analyze-wrap">
            <div class="form-group">
                <label for="object_name" class="form-label">Model name</label>
                <input class="form-control" name="object_name" id="object_name" placeholder="Enter model name..."
                    value="{{ $object_name ?? '' }}">
            </div>

            <div class="form-group mt-3">
                <label for="object_name" class="form-label">Model property</label>
                <div class="d-flex justify-content-between align-items-center" style="background-color:#202123;height:35px;border: 0px;border-radius: 8px 8px 0px 0px">
                    <div class="px-3" style="font-weight: 100;color:whitesmoke">Model</div>
                    {{-- <div class="px-3"><a href="" style="text-decoration: none; color:whitesmoke"><i class="bi bi-clipboard pr-2"></i><small style="font-size: 9pt;padding-left:5px;font-weight: 100;">Copy</small></a></div> --}}
                </div>
                <textarea class="form-control mb-3" name="props" id="props" rows="9" style="background-color: #000;color:rgb(253, 208, 124);border-radius: 0px 0px 8px 8px; border: 0">{{ $props }}</textarea>
            </div>
            <div class="align-self-end">
                <button id="button_generate" type="submit" class="file-generate-btn">Generate</button>
            </div>
        </div>
    </form>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {

            var formAnalyze = $("#formAnalyze");
            var formGenerate = $("#formGenerate")
            var loader = $("#loader");
            var fileUpload =  $("#fileUpload");


            formAnalyze.validate({ // initialize the plugin
                rules: {
                    file: {
                        required: true,
                    },
                },
                messages: {
                    file: {
                        required: 'Please upload image'
                    }
                }
            });

            formGenerate.validate({ // initialize the plugin
                rules: {
                    object_name: {
                        required: true,
                    },
                    props: {
                        required: true,
                    }
                },
                messages: {
                    object_name: {
                        required: 'Model is required',
                    },
                    props: {
                        required: 'Property model is required',
                    }
                }
            });

            $('#button_analyze').click(function(e)
            {
                e.preventDefault();
                if(formAnalyze.valid())
                {
                    loader.css({ display: "flex" });
                    $('#button_analyze').css({ display: "none"});
                    $('.remove-image').css({ display: "none"});
                    formAnalyze.submit();
                }
            });

            $('#button_generate').click(function(e)
            {
                e.preventDefault();
                if(formGenerate.valid())
                {
                    formGenerate.submit();
                }
            });

        });

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-upload-wrap').hide();

                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
    </script>
</body>

</html>