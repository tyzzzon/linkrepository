/**
 * Created by tyzzon on 10.11.15.
 */
$(document).ready(function() {
    $("#logout_btn").click(function () {
        $.ajax({
            url: '/user/log_out',
            success: function () {
                location.reload();
            }
        });
    });
});