<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="windows-1251">

<!--    <meta charset="utf-8">-->


    <title>PHP Task - Main Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

</head>
<body>

    <div id="block-content">
        <div class="row">
            <div id="right-menu-block" class="col-sm-3">
                <ul id="right-block">
                    <li>
                        <a target="_blank" href="displayAllCalc.php">List of previously saved calculations</a>
                    </li>
                    <li>
                        <a target="_blank" href="codes_selection.php">Selecting calculated data of secret codes</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <!--  (?<=\{)[+-]?\d+(?=\}) -->
            <form method="post" id="form_submit" action="" >
                <div class="col-sm-8 col-sm-offset-3">
                    <button type="button" class="buttonsMain btn-success" id="btn-clear-fields" >Clear</button>
                    <ul id="info-form">
                        <li>
                            <input  class="success-textbox"  type="text" id="calc-name" name="calc-name" placeholder="Enter the name of this calculation" />
                            <label for="calc-name"  class="error-msg-label"  id="error-msg-label-for-calc-name">Error! Please fill this field!</label>
                        </li>
                        <li>
                            <textarea class="success-textbox"  placeholder="Enter text" name="textContent" id="textContent"></textarea>
                            <label for="textContent" class="error-msg-label" id="error-msg-label-for-textContent">Error! Please fill this field!</label>
                        </li>
                        <li>
                            <button type="button"class="buttonsMain btn-primary" id="btnSubmit"  name="btnSubmit" >Start</button>
                        </li>
                        <li>
                            <textarea name="textResult" placeholder="Result" id="textResult"></textarea>
                        </li>
                    </ul>

                </div>
                </form>
            </div>
</div>
</body>
    </html>