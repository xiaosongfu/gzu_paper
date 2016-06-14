/*
 * 是否全选
 * 全选按钮：<input type="checkbox" id="checkAll" />全选</div>
 * 其他的：<input type="checkbox" name="subBox" />
 */
// $(function() {
//    $("#checkAll").click(function() {
//         $('input[name="subBox"]').prop("checked",this.checked); 
//     });
//     var $subBox = $("input[name='subBox']");
//     $subBox.click(function(){
//         $("#checkAll").prop("checked",$subBox.length == $("input[name='subBox']:checked").length ? true : false);
//     });
// });
$(function() {
   $("#checkAll").click(function() {
        $("input[name^='subBox']").prop("checked",this.checked); 
    });
    var $subBox = $("input[name^='subBox']");
    $subBox.click(function(){
        $("#checkAll").prop("checked",$subBox.length == $("input[name^='subBox']:checked").length ? true : false);
    });
});