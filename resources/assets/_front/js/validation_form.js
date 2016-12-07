var validateForm = (function() {
    var rules = {
        valid_required : function (str) {
            // console.log(" -> Validation de \""+str+"\"  required");
            return str !== '';
        },
        valid_email : function (str) {
            // console.log(" -> Validation d'un email");
            var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');
            return regEmail.test(str);
        },
        valid_array_length_moreEqual_1 : function(arr) {
            return arr.length >= 1;
        }

    };
    var validate ={
        /**
         *
         * @param s String to validate
         * @param r Rules
         * @param m Error Messages
         */
        validate:function (s, r, m) {
            var nbRules = r.length;
            for(var i= 0; i< nbRules; i++){
                switch ( r[i] ){
                    case "array_length_moreEqual_1" :
                        if ( !rules.valid_array_length_moreEqual_1(s) ){
                            return {
                                is_valid : false,
                                reason : m[i],
                            };
                        }
                        break;
                    case "required" :
                        if ( !rules.valid_required(s) ){
                            return {
                                is_valid : false,
                                reason : m[i],
                            };
                        }
                        break;
                    case "email" :
                        if ( !rules.valid_email(s) ){
                            return {
                                is_valid : false,
                                reason : m[i],
                            };
                        }
                        break;
                }
            }
            return {
                is_valid : true,
            };
        }
    };


    return {
        validate                :   validate.validate,
        rules                   :   rules
    };
})();
