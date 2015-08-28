/**
*用户模块
*/

define(function(require,exports,module){

    require("./jquery.validate");
    var checkList = function(){
        var val = $.trim($(this).text());
        $(this).parent().siblings(".diy_select_txt").text(val);
        $(this).parent().siblings(":input").val(val);

    }

    var checkAjax = function(){
        $.ajax({
            type : "post",
            url : "",
            data : $("#person_info").serialize(),
            dataType : "json"
        }).done(function(data){
            location.href="";
        }).fail(function(error){

        })
    }

    var checkForm = function(){
        var validate = $("#person_info").validate({
            debug: true,
            errorElement : "p",
            ignore : "",
            submitHandler : function(form){
                checkAjax();
            },
            rules : {
                name :{
                    required : true
                },
                sex :{
                    required : true
                },
                school :{
                    required : true
                },
                education :{
                    required : true
                },
                profession :{
                    required : true
                },
                title :{
                    required : true
                },
                status :{
                    required : true
                },
                year :{
                    required : true
                },
                district :{
                    required : true
                },
                phone :{
                    required : true
                },
                email :{
                    required : true
                },
                introduction :{
                    required : true
                }
            },
            messages : {
                name :{
                    required: "*请填写姓名"
                },
                sex :{
                    required: "*请填写性别"
                },
                school :{
                    required: "*请填写毕业院校"
                },
                education :{
                    required: "*请填写最高学历"
                },
                profession :{
                    required: "*请填写专业"
                },
                title :{
                    required: "*请填写职称"
                },
                status :{
                    required: "*请填写工作状态"
                },
                year :{
                    required: "*请填写工作年限"
                },
                district :{
                    required: "*请填写所在地区"
                },
                phone :{
                    required: "*请填写联系电话"
                },
                email :{
                    required: "*请填写联系邮箱"
                },
                introduction :{
                    required: "*请填写介绍自己"
                }
            }
        })
    }

    module.exports = {
        checkList : checkList,
        checkAjax :checkAjax,
        checkForm : checkForm

    }
})