 $(document).ready(function() {
      /*charges row script */
    $(function () {
    $(".newcolerateral").click(function () {
        if ( $("#colera").val() !='')
        {
        var row = $(".table44").find('tr:last');
        $('<tr><td>'+$("#colera").val()+'</td><td>1000</td><td>23/09/2018</td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
        $("#colera").val('');
        }
        return false;
    });
});
    /* /end of garanters row */

    /*remove script*/
    $('.table44').on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });

/*charges row script */
    $(".newcharge").click(function () {
        if ( $("#charges").val() !='')
        {
        var row = $(".fee").find('tr:last');
        $('<tr><td>'+$("#charges").val()+'</td><td>1.2%</td><td width="20%"><input type="button" class="remove" style="color:red;" value="X" /></td></tr>').insertAfter(row);
        $("#charges").val('');
        }
        return false;
    });
/*end of charge row */
});