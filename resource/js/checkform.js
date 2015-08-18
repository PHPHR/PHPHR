/**
 * Created by Administrator on 2015/8/9 0009.
 */
/**
*ע��ģ��
*/
define(function(require,exports,module){
	/*����jquery��validate*/
	require("jquery");
	require("validate");

	/*�ֻ���֤*/
    jQuery.validator.addMethod("phone",function(value,element){
        var val = $.trim(value);
        return this.optional(element) || /^1[3,5,8,7]{1}[0-9]{9}$/.test(val);
    },"����д��ȷ���ֻ���");

    jQuery.validator.addMethod("email",function(value,element){
        var val = $.trim(value);
        return this.optional(element) || /^([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9\-]+@([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}$/.test(val);
    },"����д��ȷ������");

    jQuery.validator.addMethod("checkUser",function(value,element){
        var val = $.trim(value);
        return this.optional(element) || /^1[3,5,8,7]{1}[0-9]{9}$/.test(val) || /^([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9\-]+@([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}$/.test(val);

    },"����д��ȷ���ֻ��Ż�������");
    /**
     *
     * @type {{register: Function}}
     *������֤
     */
    var checkform = {
        /*ע�����*/
        registerIn : function(){
            $(".slideTxtBox :input").val("");
        },
        /*ע��ɹ���ת������Ϣ*/
        registerOk : function(){
            if($("#main").data("id") == "reg_ok"){
                setTimeout(function(){
                  location.href = weburl+"/index.php?m=member&c=person";
                },1000)
            }
        },
        /*ע����֤*/
		register : function(){
			var reg_form = $("#register_form").validate({
				//debug : true,
                /*�ύ����̨*/
                submitHandler : function(form){

                    checkform._ajax({
                        url : "index.php?m=register&c=savereg",
                        type : "post",
                        data : {
                            username : $.trim($(".slideTxtBox [name = 'username']").val()),
                            passsword : $.trim($(".slideTxtBox :password").val())
                        }
                    }).done(function(data){
                        if(data.status == 'succ'){
                            location.href = "index.php?m=register&c=regok";
                        }
                    }).fail(function(error){
                        alert("ע��ʧ��");
                        //$(".slideTxtBox :password").val("");
                        //$(".slideTxtBox [name = 'vcode']").val("");
                        //$("#vcode_img").trigger("click");

                    })
                },
                errorPlacement : function(error,element){
                    $(element).parent("li").append(error);
                },
                errorElement : "p",
                /*У�����*/
				rules : {
					username : {
						required : true,
                        checkUser : true,
                        remote : {
                            url : "index.php?m=register&c=savereguser",
                            type : "post",
                            dataType : "json",
                            data : {
                                username : function(){
                                    return $.trim($(".slideTxtBox [name = 'username']").val());
                                }
                            }

                        }
					},
					password : {
						required : true,
						minlength : 6
					},
					vcode :{
						required : true,
                        remote : {
                            url : "index.php?m=register&c=saveregvcode",
                            type : "post",
                            dataType : "json",
                            data : {
                                vcode : function(){
                                    return $.trim($(".slideTxtBox [name = 'vcode']").val());
                                }
                            }

                        }
					},
                    agree : {
                        required : true
                    }
				},
                /*У����Ϣ*/
				messages :{
					username :{
						required : "*����д�˺�",
                        checkUser : "����д��ȷ�˺�",
                        remote : "�˺��Ѵ���"
					},
					password : {
						required : "*����д����",
                        minlength : "����д����6λ����"
					},
					vcode : {
						required : "*����д��֤��",
                        remote : "����д��ȷ����֤��"
					},
                    agree : {
                        required : "*�빴ѡͬ������"
                    }
				}
			})
		},
        /**
         *
         * @param options
         * @returns {*}
         * @private
         * ajax��װ
         */
        _ajax : function(options){
            var defaults = {
                url : "",
                type : "get",
                dataType : "json",
                data : {}

            }

            var settings = $.extend({},defaults,options);

            var deferred = $.ajax(settings);

            return deferred;
        },

	}

	return checkform;

})
