$(function() {
  $( "#datepicker" ).datepicker({
    changeMonth: true,
    changeYear: true
  });
  $( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
});
//货到付款
function orderSettleLocal(){
    $("#localBtn").text("处理中");
    $.ajax({
        url:"index.php?controller=Order&method=orderSettleLocalProc", //表单提交目标 
        type:"post", //表单提交类型 
        data:$("#settleOrderForm").serialize(), //表单数据
        async : true,
        success:function(msg){
          var obj = eval('(' + msg + ')');
          if(obj.code == "200"){
            window.location.href="index.php?controller=Order&method=orderSettleResult&way=localPay";
          }else{
            $("#localBtn").text("货到付款");
            alert(obj.message);
          }
        } 
    }); 
}
//在线支付
function orderSettleOnline(){
    $.ajax({
        url:"index.php?controller=Order&method=orderSettleOnlineProc", //表单提交目标 
        type:"post", //表单提交类型 
        data:$("#settleOrderForm").serialize(), //表单数据
        async : true,
        success:function(msg){
          var obj = eval('(' + msg + ')');
          // if(obj.code == "444"){
          //   document.getElementById("errMes").style.display="none";
          //   document.getElementById("lock").style.display="block";
          //   $("#login_stat").text("登录");
          // }else if(obj.code == "200"){
          //   $("#login_stat").text("登录成功");
          //   setTimeout(function() {
          //     window.location.href="/index.php?controller=Home&method=personPage";
          //   }, 1500);
          // }else{
          //   $("#login_stat").text("登录");
          //   $("#errMes").text(obj.message);
          // }
          alert(obj.message);
        } 
    }); 
}