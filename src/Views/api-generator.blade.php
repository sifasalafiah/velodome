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
            background-color: rgba(32, 33, 35);
        }

        .file-upload {
            background-color: rgb(52, 53, 65);
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
            background-color: rgb(52, 53, 65);
            margin-top: 20px;
            border: 1px solid rgb(86, 88, 105);
            border-radius: 8px;
            position: relative;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: rgb(86, 88, 105);
            border: 1px dashed grey;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: rgb(86, 88, 105);
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            color: #c3c3c3;
            padding: 0 0 60px 0;
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
            background-color: rgb(52, 53, 65);
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
            background: rgb(52, 53, 65);
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

        .form-label {
            color: #fff;
        }

        .pop-alert {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .error {
            color: rgb(171, 3, 3);
            font-size: 8pt;
            padding: 5px;
        }


        .typewriter h6 {
            color: rgb(86, 88, 105);
            font-family: monospace;
            overflow: hidden;
            /* Ensures the content is not revealed until the animation */
            border-right: .15em solid orange;
            /* The typwriter cursor */
            white-space: nowrap;
            /* Keeps the content on a single line */
            margin: 0 auto;
            /* Gives that scrolling effect as the typing happens */
            letter-spacing: .15em;
            /* Adjust as needed */
            animation:
                typing 3.5s steps(30, end),
                blink-caret .5s step-end infinite;
        }

        /* The typing effect */
        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        /* The typewriter cursor effect */
        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: orange
            }
        }
    </style>

    <title>Velodome</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://cdn.iconscout.com/icon/free/png-256/free-openai-1524262-1290809.png" alt="" width="30"
                    height="30" class="d-inline-block align-text-top">
                <span class="text-muted">Velodome</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-secondary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-info-circle"></i> Help
            </button>
                <a href="/velodome/api-generator">
                    <button class="btn btn-outline-secondary"><i class="bi bi-arrow-repeat"></i> Reload</button>
                </a>
            </div>
        </div>
    </nav>

    @if ($flash)
    <div class="pop-alert alert alert-{{$flash['type']}} alert-dismissible fade show" role="alert">
        <strong>{{$flash['title']}}</strong><br> {{$flash['message']}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    @if(!$props)
    <!-- Image input -->
    <div class="file-upload" id="fileUpload">
        <form id="formAnalyze" action="/velodome/api-generator/analize" method="post" enctype="multipart/form-data">

            <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' name="file" id="file" onchange="readURL(this);"
                    accept="image/*" />
                <div class="drag-text pt-3">
                    <i style="font-size: 50pt; color: rgb(164, 164, 164);" class="bi bi-upload"></i>
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

            <div class="d-flex justify-content-center">
                <div id="loaderText" class="typewriter">
                    <h6>Analyzing images.</h6>
                </div>
            </div>


            <button type="submit" id="button_analyze" class="file-analyze-btn">Analyze Image</button>
        </form>
    </div>

    @else
    {{-- Form input --}}
    <form id="formGenerate" action="/velodome/api-generator/generate" method="post" enctype="multipart/form-data">
        <div class="output-analyze-wrap">
            <h6 class="text-center" style="color:rgb(86, 87, 99)">Analysis results</h6>
            <div class="form-group">
                <label for="object_name" class="form-label">Model name</label>
                <input class="form-control" name="object_name" id="object_name" placeholder="Enter model name..."
                    value="{{ $object_name ?? '' }}">
            </div>

            <div class="form-group mt-3">
                <label for="object_name" class="form-label">Model property</label>
                <div class="d-flex justify-content-between align-items-center"
                    style="background-color:#202123;height:35px;border: 0px;border-radius: 8px 8px 0px 0px">
                    <div class="px-3" style="font-weight: 100;color:whitesmoke">Model</div>
                    {{-- <div class="px-3"><a href="" style="text-decoration: none; color:whitesmoke"><i
                                class="bi bi-clipboard pr-2"></i><small
                                style="font-size: 9pt;padding-left:5px;font-weight: 100;">Copy</small></a></div> --}}
                </div>
                <textarea class="form-control" name="props" id="props" rows="9"
                    style="background-color: #000;color:rgb(253, 208, 124);border-radius: 0px 0px 8px 8px; border: 0">{{ $props }}</textarea>
            </div>

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


            <div class="align-self-end mt-3">
                <button id="button_generate" type="submit" class="file-generate-btn">Generate</button>
            </div>
        </div>
    </form>
    @endif

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark" style="border-radius: 8px">
          <div class="modal-content bg-dark">
            <div class="modal-header bg-dark" style="border-bottom: 1px solid rgb(77, 77, 77);">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Help</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-white">
              How to use
              <ul>
                <li>Upload image</li>
                <li>Click analyze image</li>
                <li>Wait for result model</li>
                <li>Type name of model</li>
                <li>Edit the model as desired</li>
                <li>Click generate</li>

              </ul>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgb(77, 77, 77);">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    <footer class="bg-dark text-center text-lg-start fixed-bottom">
        <div class="text-center" style="color: rgb(144, 144, 144)">
            <small>Version 1.0</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>

        $(document).ready(function () {

            var formAnalyze = $("#formAnalyze");
            var formGenerate = $("#formGenerate")
            var loader = $("#loader");
            var loaderText = $("#loaderText");
            var fileUpload = $("#fileUpload");
            loaderText.hide();


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

            $('#button_analyze').click(function (e) {
                e.preventDefault();
                if (formAnalyze.valid()) {
                    loader.css({ display: "flex" });
                    loaderText.show();
                    $('#button_analyze').css({ display: "none" });
                    $('.remove-image').css({ display: "none" });
                    formAnalyze.submit();
                }
            });

            $('#button_generate').click(function (e) {
                e.preventDefault();
                if (formGenerate.valid()) {
                    loader.css({ display: "flex" });
                    $('#button_generate').css({ display: "none" });
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