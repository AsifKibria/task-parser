<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Parser Task</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- SmartAddon.com Verification -->
    <meta name="smartaddon-verification" content="936e8d43184bc47ef34e25e426c508fe" />
    <meta name="keywords" content="Flat UI Design, UI design, UI, user interface, web interface design, user interface design, Flat web design, Bootstrap, Bootflat, Flat UI colors, colors">
    <meta name="description" content="The complete style of the Bootflat Framework.">
    <link rel="shortcut icon" href="favicon_16.ico"/>
    <link rel="bookmark" href="favicon_16.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">


</head>
<body >

<!--documents-->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Parse CSV</h3>
                </div>
                <div class="panel-body">
                    <form action="{{route('parser.post')}}" method="post" class="justify-content-center" enctype="multipart/form-data" id="parserForm">
                        @csrf
                        <div id="responseArea"></div>
                        <div class="form-group text-center">
                                <label for="exampleFormControlFile1">CSV file input</label>
                                <input type="file" class="form-control-file" id="csvFile" name="csv_file" required>
                        </div>

                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-success">Parse</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<!--   Core JS Files   -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    $("#parserForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var url = $(this).attr('action');
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data)
            {
                let message = '<div class="alert alert-info alert-dismissable">\n' +
                    '              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                    '              <strong>Processing!</strong>'+data +
                    '            </div>';
                $("#responseArea").html(message);
            }
        });
    });
</script>

</body>
</html>
