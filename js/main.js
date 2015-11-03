$(document).ready( function()
{
    $('#btnSubmit').click( function()
    {
        var succesValidation = true;

        $('#textContent').val(  $('#textContent').val().trim() );
        $('#calc-name').val(  $('#calc-name').val().trim() );

        if ( $('#textContent').val().length == 0 )
        {
            $('#textContent').attr("class", "error-textbox" );
            $('#error-msg-label-for-textContent').show();
            succesValidation = false;
        }
        else
        {
            $('#textContent').attr("class", "success-textbox" );
            $('#error-msg-label-for-textContent').hide();
        }
        if ( $('#calc-name').val().length == 0 )
        {
            $('#calc-name').attr("class", "error-textbox" );
            $('#error-msg-label-for-calc-name').show();
            succesValidation = false;
        }
        else
        {
            $('#calc-name').attr("class", "success-textbox" );
            $('#error-msg-label-for-calc-name').hide();
        }

        if ( succesValidation )
        {
            var calc_name =   $('#calc-name').val();
            var textContent =  $('#textContent').val();

            $.ajax(
                {
                    type : "POST",
                    url : "php_files/startCalc.php",
                    data : "calc-name=" + calc_name + "&textContent=" + textContent,
                    dataType : "html",
                    cashe : false,
                    success : function( data )
                    {
                        $( "#textResult" ).val( data );
                    }
                });
        }
    });

    $('#btn-clear-fields').click(function ()
    {
        $('#textContent').val("");
        $('#textResult').val("");
        $('#calc-name').val("");
    });

    $('#btn-clear-field-numb').click( function()
    {
        $('#numb_field').val("");
    });

    $('#btnSubmitCode').click( function()
    {
        if ( $('#numb_field').val().length == 0 )
        {
            $('#numb_field').attr("class", "error-textbox" );
            $('#error-msg-label-for-calc-code').show();
        }
        else
        {
            $('#numb_field').attr("class", "success-textbox" );
            $('#error-msg-label-for-calc-code').hide();

            var numb = $('#numb_field').val();
            var type = $("#form_delect_codes input[type='radio']:checked").val();



            $.ajax(
                {
                    type : "GET",
                    url : "php_files/getCodes.php",
                    data : "numb=" + numb + "&type=" + type,
                    dataType : "html",
                    cashe : false,
                    success : function( data )
                    {
                       //alert(numb + "  " + type );
                        $( "#divContentCalcTable" ).html( data );
                    }
                });
        }
    });
});
