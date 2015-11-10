/**
 * Created by tyzzon on 10.11.15.
 */
$("#logout_btn").click(function() {
    $.ajax({
        url: './inc/mainScripts.php?argument=logOut',
        success: function(data){
            window.location.href = data;
        }
    });
});