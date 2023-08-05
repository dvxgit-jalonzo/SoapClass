<?php

include "DiavoxSoapClass.php";
$diavoxSoap = new DiavoxSoapClass();
$requestXml = file_get_contents('request.txt');
if (isset($_POST['request'])) {
    $keys = $_REQUEST['key'];
    $values = $_REQUEST['value'];
    $headers = [];
    for ($x = 0; $x < count($keys); $x++) {
        if (!empty($key[$x]) && !empty($values[$x])) {
            $headers[$keys[$x]] = $values[$x];
        }
    }
    $requestXml = $_REQUEST['body'];
    $url = $_REQUEST['url'];
    $xmlnamespace = $_REQUEST['namespace'];
    $response = $diavoxSoap->soapRequest($requestXml, $url, $headers);

    $type = $_REQUEST['type'];
    $namespace = "SOAP-ENV";
    if ($type == 'json') {
        $result = $diavoxSoap->toJson($namespace);
    } else if ($type == 'xml') {
        $result = $diavoxSoap->toXml();
    }

    echo $result;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soap UI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label for="" class="text-muted text-sm">URL</label>
                                    <input type="text" class="form-control" name="url" value="http://192.168.0.110:80/mpwebservices/services/MP">
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="" class="text-muted text-sm">Body</label>
                                    <textarea name="body" class="form-control" id="" cols="30" rows="10"><?= isset($requestXml) ? $requestXml : "" ?></textarea>
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="" class="text-muted text-sm">Namespace</label>
                                    <input type="text" name="namespace" class="form-control" value="SOAP-ENV">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <button type="button" id="add_header" class="btn btn-primary">Add Header</button>
                                    <button name="request" class="btn btn-primary">Send Request</button>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="" class="text-muted text-sm">Response Type</label>
                                    <select name="type" class="form-control" id="" required>
                                        <option selected disabled></option>
                                        <option value="json">To Json</option>
                                        <option value="xml">To Xml</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="row" id="headers">
                                        <div class="col-6">
                                            <label for="" class="text-muted text-sm">Key</label>
                                            <input type="text" name="key[]" id="" class="form-control" value="Content-Type">
                                        </div>
                                        <div class="col-6">
                                            <label for="" class="text-muted text-sm">Value</label>
                                            <input type="text" name="value[]" id="" class="form-control" value="text/xml; charset=utf-8">
                                        </div>
                                        <div class="col-6">
                                            <label for="" class="text-muted text-sm">Key</label>
                                            <input type="text" name="key[]" id="" class="form-control" value="SOAPAction">
                                        </div>
                                        <div class="col-6">
                                            <label for="" class="text-muted text-sm">Value</label>
                                            <input type="text" name="value[]" id="" class="form-control" value="urn:#manageData">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        $("#add_header").on('click', function() {
            var keyDiv = $('<div class="col-6"></div>');
            var keyLabel = $('<label for="" class="text-muted text-sm">Key</label>');
            var keyInput = $('<input type="text" name="key[]" class="form-control">');
            keyDiv.append(keyLabel).append(keyInput);

            var valueDiv = $('<div class="col-6"></div>');
            var valueLabel = $('<label for="" class="text-muted text-sm">Value</label>');
            var valueInput = $('<input type="text" name="value[]" class="form-control">');
            valueDiv.append(valueLabel).append(valueInput);

            $("#headers").append(keyDiv).append(valueDiv);
        });
    </script>
</body>

</html>