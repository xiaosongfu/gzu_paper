$(function() {
   $("#checkAll").click(function() {
        $('input[name="subBox"]').prop("checked",this.checked); 
    });
    var $subBox = $("input[name='subBox']");
    $subBox.click(function(){
        $("#checkAll").prop("checked",$subBox.length == $("input[name='subBox']:checked").length ? true : false);
    });
});