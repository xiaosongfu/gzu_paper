function ajaxFileUpload(){
    $("#upBtn").text("上传中...");
    $.ajaxFileUpload({
        url:"index.php?controller=WaterStore&method=upLoadBusinessLicense",
        secureuri:false,
        fileElementId:'businessLicense',
        dataType: 'json',
        success: function (res, status){
            if(status == "success") {
                if(res.code == "200"){
                    document.getElementById("upload_box").style.display = "none";
                    // alert(res.data['imagePath']);
                    $("#licenseImg").attr("src",res.data['imagePath']);
                    $("#businessLicenseImg").val(res.data['fullImagePath']);
                }else{
                    $("#upBtn").text("上传执照图片");
                    alert(res.message);
                }
            }else{
                alert(res.message);
            }
        },
        error: function (data, status, e){
            $("#upBtn").text("上传执照图片");
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
