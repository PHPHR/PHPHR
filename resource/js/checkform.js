/**
 * Created by Administrator on 2015/8/9 0009.
 */
/**
*注册模块
*/
define(function(require,exports,module){
	/*引入jquery与validate*/
	require("jquery");
	require("validate");

	/*手机验证*/
    jQuery.validator.addMethod("phone",function(value,element){
        var val = $.trim(value);
        return this.optional(element) || /^1[3,5,8,7]{1}[0-9]{9}$/.test(val);
    },"请填写正确的手机号");

    jQuery.validator.addMethod("email",function(value,element){
        var val = $.trim(value);
        return this.optional(element) || /^([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9\-]+@([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}$/.test(val);
    },"请填写正确的邮箱");

    jQuery.validator.addMethod("checkUser",function(value,element){
        var val = $.trim(value);
        return this.optional(element) || /^1[3,5,8,7]{1}[0-9]{9}$/.test(val) || /^([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9\-]+@([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,4}$/.test(val);

    },"请填写正确的手机号或者邮箱");
    /**
     *
     * @type {{register: Function}}
     *表彰验证
     */
    var checkform = {
        /*注册加载*/
        registerIn : function(){
            $(".slideTxtBox :input").val("");
        },
        /*注册成功跳转个人信息*/
        registerOk : function(){
            if($("#main").data("id") == "reg_ok"){
                setTimeout(function(){
                  location.href = weburl+"/index.php?m=member&c=person";
                },1000)
            }
        },
        /*注册验证*/
		register : function(){
			var reg_form = $("#register_form").validate({
				//debug : true,
                /*提交到后台*/
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
                        alert("注册失败");
                        //$(".slideTxtBox :password").val("");
                        //$(".slideTxtBox [name = 'vcode']").val("");
                        //$("#vcode_img").trigger("click");

                    })
                },
                errorPlacement : function(error,element){
                    $(element).parent("li").append(error);
                },
                errorElement : "p",
                /*校验规则*/
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
                /*校验信息*/
				messages :{
					username :{
						required : "*请填写账号",
                        checkUser : "请填写正确账号",
                        remote : "账号已存在"
					},
					password : {
						required : "*请填写密码",
                        minlength : "请填写至少6位密码"
					},
					vcode : {
						required : "*请填写验证码",
                        remote : "请填写正确的验证码"
					},
                    agree : {
                        required : "*请勾选同意条款"
                    }
				}
			})
		},
        /**
         *
         * @param options
         * @returns {*}
         * @private
         * ajax封装
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
