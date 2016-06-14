/*
 * 是否全选
 * 全选按钮：<input type="checkbox" id="checkAll" />全选</div>
 * 其他的：<input type="checkbox" name="subBox" />
 */
$(function() {
   $("#checkAll").click(function() {
        $("input[name^='barrelWaterGoods']").prop("checked",this.checked); 
    });
    var $subBox = $("input[name^='barrelWaterGoods']");
    $subBox.click(function(){
        $("#checkAll").prop("checked",$subBox.length == $("input[name^='barrelWaterGoods']:checked").length ? true : false);
    });
});
function btnClickYes(){
    $("input[type='checkbox']").prop("checked",true); 
}
function btnClickNo(){
    $("input[type='checkbox']").prop("checked",false); 
}