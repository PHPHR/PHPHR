/**
*�û�ģ��
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
                    required: "*����д����"
                },
                sex :{
                    required: "*����д�Ա�"
                },
                school :{
                    required: "*����д��ҵԺУ"
                },
                education :{
                    required: "*����д���ѧ��"
                },
                profession :{
                    required: "*����дרҵ"
                },
                title :{
                    required: "*����дְ��"
                },
                status :{
                    required: "*����д����״̬"
                },
                year :{
                    required: "*����д��������"
                },
                district :{
                    required: "*����д���ڵ���"
                },
                phone :{
                    required: "*����д��ϵ�绰"
                },
                email :{
                    required: "*����д��ϵ����"
                },
                introduction :{
                    required: "*����д�����Լ�"
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