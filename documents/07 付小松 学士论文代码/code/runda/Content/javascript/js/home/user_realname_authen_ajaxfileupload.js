function ajaxFileUpload1(){
    $("#upBtn1").text("上传中...");
    $.ajaxFileUpload({
        url:"index.php?controller=Home&method=userRealNameAuthenIDCardImgProc",
        secureuri:false,
        fileElementId:'idCardGraphFrontImgID',
        dataType: 'json',
        success: function (res, status){
            if(status == "success") {
                if(res.code == "200"){
                    document.getElementById("upload_box1").style.display = "none";
                    // alert(res.data['imagePath']);
                    $("#idFront").attr("src",res.data['imagePath']);
                    $("#idCardGraphFrontID").val(res.data['fullImagePath']);
                }else{
                    $("#upBtn1").text("上传");
                    alert(res.message);
                }
            }else{
                alert(res.message);
            }
        },
        error: function (data, status, e){
            $("#upBtn1").text("上传");
            alert("系统错误,请重试");
        }
    });
    return false;
}

function ajaxFileUpload2(){
    $("#upBtn2").text("上传中...");
    $.ajaxFileUpload({
        url:"index.php?controller=Home&method=userRealNameAuthenIDCardImgProc",
        secureuri:false,
        fileElementId:'idCardGraphBackImgID',
        dataType: 'json',
        success: function (res, status){
            if(status == "success") {
                if(res.code == "200"){
                    document.getElementById("upload_box2").style.display = "none";
                    // alert(res.data['imagePath']);
                    $("#idBack").attr("src",res.data['imagePath']);
                    $("#idCardGraphBackID").val(res.data['fullImagePath']);
                }else{
                    $("#upBtn2").text("上传");
                    alert(res.message);
                }
            }else{
                alert(res.message);
            }
        },
        error: function (data, status, e){
            $("#upBtn2").text("上传");
            alert("系统错误,请重试");
        }
    });
    return false;
}

//异步上传文件笔记：
// （1）如上的这个函数
//     要改：url fileElementId。
// （2）引入
//  <script type="text/javascript" language="javascript"
//   src="/Content/javascript/ajaxfileupload/ajaxfileupload.js">
// </script>这个文件。
