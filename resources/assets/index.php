<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spartan</title>
    <link rel="icon" href="favicon.png" type="image/x-icon"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script>
        var content = <?php echo file_get_contents('./report.json');?>

            $(document).ready(function () {
                var $content = $('#content');
                var $nav = $('#nav');
                var i = 0;
                $.each(content, function (index, sites) {
                    var active = '';
                    if (i == 0) {
                        active = 'class="active"';
                    }

                    var title = '<div class="row" style="clear: both; margin-top: 30px;"><div class="col-md-12  text-center title-group"><a name="' + index + '" style="padding-top: 80px;">' + index.toUpperCase() + '</a></div></div>';
                    $nav.append('<li class="item-menu" role="presentation" ' + active + '><a  href="#' + index + '">' + index + '</a></li>');
                    $content.append(title);
                    $.each(sites, function (ind, siteData) {
                        var btnClass;

                        if (siteData.httpCode == 200) {
                            btnClass = 'btn-success';
                        } else if (siteData.httpCode == 0) {
                            btnClass = 'btn-default';
                        } else {
                            btnClass = 'btn-danger';
                        }

                        var string = '' +
                            '<div class="col-md-4 col-xs-6 ">' +
                            '<div class="sub-item item" >' +
                            '<div class="site margin-10"><a target="_blank" href="' + siteData.site + '">' + siteData.site.replace(/http:\/\//g, '') + '</a></div>' +
                            '<div class="col-md-4 col-md-offset-1">' +
                            '<div code="' + siteData.httpCode + '"  class="btn ' + btnClass + ' http-code">HTTP: ' +
                            siteData.httpCode +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-5 col-md-offset-1">' +
                            '<div>' + siteData.time + '</div>' +
                            '</div>' +
                            '<div class="row">' +
                            '<div class="col-md-12 margin-10 "> IP: ' + siteData.ip + '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                        $content.append(string);

                    });
                    i++;
                });


                $('.btn').click(function () {
                    var httpCode = $(this).attr('code');
                    var link = 'https://en.wikipedia.org/wiki/HTTP_';
                    if (httpCode > 0) {
                        window.open(link + httpCode, '_blank')
                    } else {
                        alert('Данный домен не существуе');
                    }
                });

                var $itemMenu = $('.item-menu');

                $itemMenu.click(function () {
                    $itemMenu.removeClass('active');
                    $(this).addClass('active');
                    console.log($(this));
                })
            });


    </script>

    <style type="text/css">
        body {
            font-size: 1.4em;
        }

        a, a:hover {
            text-decoration: none
        }


        .item {
            border: 1px solid #e1e1e8;
            border-radius: 10px;
            background-color: #f7f7f9;
            margin: 10px;
        }

        .site {
            color: #4f9fcf;
            text-transform: uppercase;
        }

        .http-code {
            margin-top: 5px;
        }

        .margin-10 {
            margin: 10px;
        }

        .title-group {
            margin-top: 20px;
            font-size: 3em;
            color: grey;

        }
    </style>
</head>


<body>

<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#w1-collapse"
            aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
</div>

<div class="container-fluid" style="margin-top: 3%;">

    <div class="container navbar-fixed-top">
        <div class="collapse navbar-collapse navbar navbar-inverse" id="bs-example-navbar-collapse-6">
            <div class="row">
                <div class="col-md-3 col-xs-3">
                    <img src="./favicon.png" style="margin: 5px" width="50" height="50" alt="..." class="img-rounded">

                </div>
                <div class="col-md-8 col-xs-8">
                    <ul class="nav navbar-nav" id="nav">
                    </ul>
                </div>
                <div class="col-md-1 col-xs-1">

                </div>
            </div>

        </div>
    </div>

    <div class="container text-center" id="content"></div>


</div>
</body>
</html>




