<!DOCTYPE html>
<html lang="en">
<head>
    <!--        <meta charset="windows-1251">-->

    <meta charset="utf-8">
    <title>PHP Task - List of Calculations</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

</head>
<body>

<div id="block-content">
    <div class="row">
        <h1 style="text-align: center;">Selecting calculated data of secret codes</h1>
        <div class="col-sm-4 col-sm-offset-1">
            <form  id="form_delect_codes" action="choose_date.php" method="post">

                <ul id="info_codes">
                    <li>
                        <button type="button" class="buttonsMain btn-success" id="btn-clear-field-numb" >Clear</button>
                    </li>
                    <li>
                        <input type="number" class="success-textbox" name="numb" id="numb_field"  placeholder="Enter the code"  >
                        <label for="numb_field"  class="error-msg-label"  id="error-msg-label-for-calc-code">Error! Please fill this field!</label>
                    </li>
                    <li>
                        <input type="radio" checked name="group2" id="cbLess" value="Less">
                        <label for="cbLess" id="labelLess">Less</label>
                    </li>
                    <li>
                        <input type="radio"  name="group2" id="cbLarge" value="Large">
                        <label for="cbLarge" id="labelLarge">Large</label>
                    </li>
                    <li>
                        <input type="radio"  name="group2" id="cbEqual" value="Equal" checked>
                        <label for="cbEqual" id="labelEqual">Equal</label>
                    </li>
                    <li>
                        <button type="button"class="buttonsMain btn-primary" id="btnSubmitCode"  name="btnSubmitCode" >Start</button>
                    </li>
                </ul>
<!--                <input type="submit" name="btn" value="Display"/>-->

            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-10 col-sm-offset-1" id="divContentCalcTable">

        </div>
    </div>

</div>



</body>
</html>