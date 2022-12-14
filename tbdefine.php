<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Define Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
    error_reporting(0);
    ini_set('display_errors', 0);
    function _Download($f_location, $f_name)
    {
        $file = $f_name;

        file_put_contents($file, file_get_contents($f_location));

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename=' . basename($f_name));

        readfile($file);
    }


    function addFolderToZip($dir, $zipArchive, $zipdir = '')
    {
        //Enter the name of directory
        $pathdir = $dir . "/";
        //Enter the name to creating zipped directory
        $zipcreated = $dir . "-view.zip";
        //Create new zip class
        $newzip = new ZipArchive;
        if ($newzip->open($zipcreated, ZipArchive::CREATE) === TRUE) {
            $dir = opendir($pathdir);
            while ($file = readdir($dir)) {
                if (is_file($pathdir . $file)) {
                    $newzip->addFile($pathdir . $file, $file);
                }
            }
            $dir = opendir($pathdir . "functions/");

            while ($file = readdir($dir)) {
                if (is_file($pathdir . "functions/" . $file)) {
                    echo $pathdir . "functions/" . $file;
                    $newzip->addFile($pathdir . "functions/"  . $file, "functions/" . $file);
                }
            }
            $newzip->close();
        }
    }

    if ($_POST['submit']) {
        $view_name = $_POST['view_name'];
        $Table_name  = $_POST['Table_name'];
        $table_key = $_POST['table_key'];

        foreach ($table_key as $index => $value) {
            $data[$index]['table_key'] = $value;
            $data[$index]['table_title']  = $_POST['table_title'][$index];
        }
        /*************
         * MAKE VIEW *
         *************/
        $dirname = str_replace(' ', '-', $view_name);
        $dirname = strtolower($dirname);
        $view_title = ucwords($view_name);
        $className = str_replace(' ', '_', $view_title);
        /********************
         * MAKE VIEW FOLDER *
         ********************/
        mkdir($dirname);
        mkdir($dirname . "/functions");
        /*********************
         * MAKE DEFAULT FILE *
         *********************/
        $myfile = fopen($dirname . "/default.php", "w") or die("Unable to open file!");
        $txt = '<?php ';
        include('defualt.php');
        fwrite($myfile, $txt);
        fclose($myfile);
        /******************
         * MAKE EDIT FILE *
         ******************/
        $myfile = fopen($dirname . "/edit.php", "w") or die("Unable to open file!");
        $txt    = "<?php";
        include 'edit.php';

        fwrite($myfile, $txt);

        fclose($myfile);
        /**********************
         * MAKE FUNCTION FILE *
         **********************/
        $myfile = fopen($dirname . "/functions" . "/" . $dirname . "-class.php", "w") or die("Unable to open file!");
        $txt    = "<?php";
        include 'class.php';
        fwrite($myfile, $txt);
        fclose($myfile);

        /***************
         * ZIP ARCHIVE *
         ***************/

        addFolderToZip($dirname, "");
        _Download($dirname . "-view.zip", $dirname . "-view.zip");
        unlink($dirname . "-view.zip");
        array_map('unlink', glob("$dirname/functions/*.*"));
        rmdir($dirname . "/functions");
        array_map('unlink', glob("$dirname/*.*"));
        rmdir($dirname);
        header("location:afterDownload.php");

    ?>

    <?php
    } else {
    ?>
    <div class="mt-10" style="margin-top:30px">
        <h1 class="mb-10 text-center">Define Table</h1>
    </div>
    <form class="form form-horizontal table table-striped" method="post" id="form" action="">
        <div class="container">
            <div class="row">
                <h3>Define View</h3>

                <div class="mt-3" style="margin:30px 0"></div>
                <fieldset>
                    <div class="mb-3 form-group">
                        <label class="col-md-4 control-label strong" for="class">
                            <h3>View Name</h3>
                        </label><br />
                        <small class="badge bg-warning disable">Use Lower Case ex:product list</small>
                        <div class="col-md-5">
                            <input id="class" name="view_name" type="text" placeholder="view Name"
                                class="form-control input-md" required
                                value="<?php echo isset($_POST['view_name']) ? $_POST['view_name'] : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 form-group">
                        <label class="col-md-4 control-label" for="heading">
                            <h3>Table Name</h3>
                        </label><br />
                        <small class="badge bg-warning disable">Just Fill your dbName without Prefix </small>
                        <div class="col-md-5">
                            <input id="heading" name="Table_name" type="text" placeholder="Table Name"
                                class="form-control input-md"
                                value="<?php echo isset($_POST['Table_name']) ? $_POST['Table_name'] : ''; ?>">
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="mt-10" style="margin:30px 0"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Table Columns</h3>

                    <h5 class="badge bg-info">Considerations </h5>
                    <div class="card1">

                        <ul class="list-group">
                            <li class="list-group-item">1 - Column Title Used For Showing In the View and it doesn't
                                have any relation whit You Table</li>
                            <li class="list-group-item">2- Your Table Should Have id columd as primary and auto
                                increment Do Not enter your id Column Here ! we assume you have it. </li>
                        </ul>
                    </div>
                    <div class="mt-10" style="margin:20px 0"></div>
                    <div class="row">
                        <div class="col-md-4"> <input name="table_key[]" type="text" placeholder="Column Name"
                                class="form-control input-md" required></div>
                        <div class="col-md-4"> <input name="table_title[]" type="text" placeholder="Column Title"
                                class="form-control input-md" required></div>
                        <div class="col-md-4"> <a href="#" class="btn btn-sm btn-success add_button">+</a>
                            <a href="#" class="btn btn-sm btn-danger remove-row">-</a>
                        </div>
                    </div>
                    <div class="addrow"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="submit"></label>
                    <div class="col-md-4">
                        <!--   <a onclick="generateTable()" class="btn btn-primary">Generate Table</a> -->
                        <button class="btn btn-success" value="submit" name="submit" type="submit">submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="assets/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.addrow'); //Input field wrapper
        var x = 1;
        var fieldHTML = '<div class="' + x + '"><div class="row">' +
            '<div class="col-md-4"> <input name="table_key[]" type="text" placeholder="Colum Name"' +
            'class="form-control input-md" required></div>' +
            ' <div class="col-md-4"> <input name="table_title[]" type="text" placeholder="Colum Title"' +
            ' class="form-control input-md" required></div>' +
            '<div class="col-md-4"> <a href="#"' +
            ' class="btn btn-sm btn-success" onclick="addrow(' + x + ')">+</a>' +
            '<a href="#" class="btn btn-sm btn-danger remove-row" onclick="removeline(' + x + ')">-</a>' +
            ' </div>' +
            '</div></div>'; //New input field html 
        //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });


        //Once remove button is clicked

    });

    function addrow(x) {
        var wrapper = $('.addrow'); //Input field wrapper
        var x = x + 1;
        var fieldHTML = '<div class="' + x + '"><div class="row">' +
            '<div class="col-md-4"> <input name="table_key[]" type="text" placeholder="Colum Name"' +
            'class="form-control input-md" required></div>' +
            ' <div class="col-md-4"> <input name="table_title[]" type="text" placeholder="Colum Title"' +
            ' class="form-control input-md" required></div>' +
            '<div class="col-md-4"> <a href="#"' +
            ' class="btn btn-sm btn-success" onclick="addrow(' + x + ')">+</a>' +
            '<a href="#" class="btn btn-sm btn-danger remove-row" onclick="removeline(' + x + ')">-</a>' +
            ' </div>' +
            '</div></div>'; //New input field html 
        $(wrapper).append(fieldHTML);
    }

    function removeline(x) {
        $("." + x).remove();

    }
    </script>
    <?php } ?>
</body>

</html>