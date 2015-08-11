/**
 * Created by Administrator on 2015/8/9 0009.
 */
/**
*×¢²áÄ£¿é
*/
define(function(require,exports,module){
	/*ÒıÈëjqueryÓëvalidate*/
	require("jquery");
	require("validate");

	var reg = {


		login : function(){
			var oUser = $.trim($(".slideTxtBox [name = 'username']"));
			var oPwd = $.trim($(".slideTxtBox :passsword"));
			var oVcode = $.trim($(".slideTxtBox [name='text']"));

		},

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
        /*×¢²áÑéÖ¤*/
		checkLogin : function(){
			$("#login_form").validate({
				debug : true,
                errorPlacement : function(error,element){
                    $(element).parent("li").append(error);
                },
                errorElement : "p",
				rules : {
					username : {
						required : true
					},
					password : {
						required : true
					},
					vcode :{
						required : true
					}
				},
				messages :{
					username :{
						required : "*ÇëÌîĞ´ÕËºÅ"
					},
					password : {
						required : "*ÇëÌîĞ´ÃÜÂë"
					},
					vcode : {
						required : "*ÇëÌîĞ´ÑéÖ¤Âë"
					}
				}
			})
		}
	}

	return reg; 

})
