// 1
function ajaxFileUpload1(){
    $("#uploadPhotoBtn1").text("上传中...");
    $.ajaxFileUpload({
        url:"index.php?controller=WaterStore&method=uploadBarrelWaterGoodsPhotos",
        secureuri:false,
        fileElementId:'inputFile1',
        dataType: 'json',
        success: function (res, status){
            if(status == "success") {
                if(res.code == "200"){
                    $("#uploadPhotoBtn1").text("上传成功");
            //         $("#photoImg1").attr("src",res.data['imagePath']);
                    $("#photoPath1").val(res.data['photoPath']);

                }else{
                    $("#uploadPhotoBtn1").text("上传图片");
                    alert(res.message);
                }
            }else{
                alert(res.message);
                $("#uploadPhotoBtn1").text("上传图片");
            }
        },
        error: function (data, status, e){
            $("#uploadPhotoBtn1").text("上传图片");
            alert("系统错误,请重试");
        }
    });
    return false;
}
//  2
function ajaxFileUpload2(){
    $("#uploadPhotoBtn2").text("上传中...");
    $.ajaxFileUpload({
        url:"index.php?controller=WaterStore&method=uploadBarrelWaterGoodsPhotos",
        secureuri:false,
        fileElementId:'inputFile2',
        dataType: 'json',
        success: function (res, status){
            if(status == "success") {
                if(res.code == "200"){
                    $("#uploadPhotoBtn2").text("上传成功");
            //         $("#photoImg2").attr("src",res.data['imagePath']);
                    $("#photoPath2").val(res.data['photoPath']);

                }else{
                    $("#uploadPhotoBtn2").text("上传图片");
                    alert(res.message);
                }
            }else{
                alert(res.message);
                $("#uploadPhotoBtn2").text("上传图片");
            }
        },
        error: function (data, status, e){
            $("#uploadPhotoBtn2").text("上传图片");
            alert("系统错误,请重试");
        }
    });
    return false;
}
//  3
function ajaxFileUpload3(){
    $("#uploadPhotoBtn3").text("上传中...");
    $.ajaxFileUpload({
        url:"index.php?controller=WaterStore&method=uploadBarrelWaterGoodsPhotos",
        secureuri:false,
        fileElementId:'inputFile3',
        dataType: 'json',
        success: function (res, status){
            if(status == "success") {
                if(res.code == "200"){
                    $("#uploadPhotoBtn3").text("上传成功");
            //         $("#photoImg3").attr("src",res.data['imagePath']);
                    $("#photoPath3").val(res.data['photoPath']);

                }else{
                    $("#uploadPhotoBtn3").text("上传图片");
                    alert(res.message);
                }
            }else{
                alert(res.message);
                $("#uploadPhotoBtn3").text("上传图片");
            }
        },
        error: function (data, status, e){
            $("#uploadPhotoBtn3").text("上传图片");
            alert("系统错误,请重试");
        }
    });
    return false;
}
//  4
function ajaxFileUpload4(){
    $("#uploadPhotoBtn4").text("上传中...");
    $.ajaxFileUpload({
        url:"index.php?controller=WaterStore&method=uploadBarrelWaterGoodsPhotos",
        secureuri:false,
        fileElementId:'inputFile4',
        dataType: 'json',
        success: function (res, status){
            if(status == "success") {
                if(res.code == "200"){
                    $("#uploadPhotoBtn4").text("上传成功");
            //         $("#photoImg4").attr("src",res.data['imagePath']);
                    $("#photoPath4").val(res.data['photoPath']);

                }else{
                    $("#uploadPhotoBtn4").text("上传图片");
                    alert(res.message);
                }
            }else{
                alert(res.message);
                $("#uploadPhotoBtn4").text("上传图片");
            }
        },
        error: function (data, status, e){
            $("#uploadPhotoBtn4").text("上传图片");
            alert("系统错误,请重试");
        }
    });
    return false;
}
//  5
function ajaxFileUpload5(){
    $("#uploadPhotoBtn5").text("上传中...");
    $.ajaxFileUpload({
        url:"index.php?controller=WaterStore&method=uploadBarrelWaterGoodsPhotos",
        secureuri:false,
        fileElementId:'inputFile5',
        dataType: 'json',
        success: function (res, status){
            if(status == "success") {
                if(res.code == "200"){
                    $("#uploadPhotoBtn5").text("上传成功");
            //         $("#photoImg5").attr("src",res.data['imagePath']);
                    $("#photoPath5").val(res.data['photoPath']);

                }else{
                    $("#uploadPhotoBtn5").text("上传图片");
                    alert(res.message);
                }
            }else{
                alert(res.message);
                $("#uploadPhotoBtn5").text("上传图片");
            }
        },
        error: function (data, status, e){
            $("#uploadPhotoBtn5").text("上传图片");
            alert("系统错误,请重试");
        }
    });
    return false;
}
//  2
function ajaxFileUpload6(){
    $("#uploadPhotoBtn6").text("上传中...");
    $.ajaxFileUpload({
        url:"index.php?controller=WaterStore&method=uploadBarrelWaterGoodsPhotos",
        secureuri:false,
        fileElementId:'inputFile6',
        dataType: 'json',
        success: function (res, status){
            if(status == "success") {
                if(res.code == "200"){
                    $("#uploadPhotoBtn6").text("上传成功");
            //         $("#photoImg2").attr("src",res.data['imagePath']);
                    $("#photoPath6").val(res.data['photoPath']);

                }else{
                    $("#uploadPhotoBtn6").text("上传图片");
                    alert(res.message);
                }
            }else{
                alert(res.message);
                $("#uploadPhotoBtn6").text("上传图片");
            }
        },
        error: function (data, status, e){
            $("#uploadPhotoBtn6").text("上传图片");
            alert("系统错误,请重试");
        }
    });
    return false;
}