<?php
namespace Phppot;

use Phppot\DataSource;
require_once __DIR__ . '/lib/UserModel.php';
$userModel = new UserModel();
if (isset($_POST["import"])) {
    $response = $userModel->readTrainLines();
}
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="jquery-3.2.1.min.js"></script>
<script type="text/javascript">
function validateFile() {
    var csvInputFile = document.forms["frmCSVImport"]["file"].value;
    if (csvInputFile == "") {
      error = "No source found to import";
      $("#response").html(error).addClass("error");;
      return false;
    }
    return true;
  }

</script>
</head>
<body>
    <h2>Import CSV file into Mysql using PHP</h2>
    <div class="outer-scontainer">
        <div class="row">
            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data"
                onsubmit="return validateFile()">
                <div Class="input-row">
                    <input type="file" name="file" id="file"
                        class="file" accept=".csv,.xls,.xlsx">
                    <div class="import">
                        <button type="submit" id="submit" name="import"
                            class="btn-submit">Import</button>
                    </div>
                </div>
            </form>
        </div><?php  require_once __DIR__ . '/list.php';?></div>
    <div id="response"
        class=<?php if(!empty($response["type"])) { echo $response["type"] ; } ?>
        <?php if(!empty($response["message"])) { echo $response["message"]; } ?>
        </div>
</body>
</html>