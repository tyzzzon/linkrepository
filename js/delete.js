/**
 * Created by tyzzon on 10.11.15.
 */
document.onclick = function( e )
{
    if ( e.target.tagName == "BUTTON" && e.target.getAttribute("butt_class") == "dele")
    {
        var user_id = e.target.getAttribute("user_id");
    }
    $(document).ready(function(){
        $("#myModal").on("click", "#dele", function(){
            userid = user_id;
            $.ajax({
                type: "POST",
                url: target_url+userid,
                success: function(){
                    location.reload();
                    alert(target_url+userid);
                }
            });
        });
    });
}