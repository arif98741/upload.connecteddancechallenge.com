$(document).on('focusout','.mdl-required',function (e) {
    mdlRequired($(this));
});

$(document).on('keyup','.mdl-mobile',function (e) {
    mdlMobile($(this));
});

$(document).on('focusout','.mdl-mobile',function (e) {
    mdlMobile($(this));
});

$(document).on('keyup','.mdl-number',function (e) {
    mdlNumber($(this));
});

$(document).on('focusout','.mdl-number',function (e) {
    mdlNumber($(this));
});

$(document).on('keyup','.mdl-email',function (e) {
    mdlEmail($(this));
});

$(document).on('focusout','mdl-email',function (e) {
    mdlEmail($(this));
});

$(document).on('keyup','.mdl-name',function (e) {
    mdlName($(this));
});

$(document).on('focusout','.mdl-name',function (e) {
    mdlName($(this));
});

$(document).on('keyup','.mdl-url',function (e) {
    mdlUrl($(this));
});

$(document).on('focusout','.mdl-url',function (e) {
    mdlUrl($(this));
});

var mdlName=function (elem) {
    var a=$(elem).val();
    var parent=$(elem).parent();
    var errorField=$(parent).find('.mdl-textfield__error');
    if(a.length!=0){
        $(parent).addClass('is-dirty');
        var regexExp=/^[A-Za-z ]+$/;
        if(regexExp.test(a)){
            $(parent).removeClass('is-invalid');
            $(errorField).html('');
            return true;
        }else {
            $(parent).addClass('is-invalid');
            $(errorField).html('Name should be rashid ali | can not spacial character');
            return false;
        }
    }else {
        return true;
    }
};

var mdlUrl=function (elem) {
    var a=$(elem).val();
    var parent=$(elem).parent();
    var errorField=$(parent).find('.mdl-textfield__error');
    if(a.length!=0){
        $(parent).addClass('is-dirty');
        var RegExp = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
        if(RegExp.test(a)){
            $(parent).removeClass('is-invalid');
            $(errorField).html('');
            return true;
        }else {
            $(parent).addClass('is-invalid');
            $(errorField).html('Not a valid email format!. ');
            return false;
        }
    }else {
        return true;
    }
};

var mdlEmail=function (elem) {
    var a=$(elem).val();
    var parent=$(elem).parent();
    var errorField=$(parent).find('.mdl-textfield__error');
    if(a.length!=0){
        $(parent).addClass('is-dirty');
        var at=/[@]/;
        var dot=/[.]/;
        if (at.test(a) && dot.test(a)) {
            var atpos = a.indexOf("@");
            var dotpos = a.lastIndexOf(".");
            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= a.length) {
                $(parent).addClass('is-invalid');
                $(errorField).html('Not a valid email format!. ');
                return false;
            }
            else {
                $(parent).removeClass('is-invalid');
                $(errorField).html('');
                return true;
            }
        }else {
            $(parent).addClass('is-invalid');
            $(errorField).html('Not a valid email format!. ');
            return false;
        }
    }else {
        return true;
    }


};

var mdlRequired=function (elem) {
    var a=$(elem).val();
    var parent=$(elem).parent();
    var errorField=$(parent).find('.mdl-textfield__error');
    if(a.length!=0){
        $(parent).addClass('is-dirty');
        $(parent).removeClass('is-invalid');
        $(errorField).html('');
        return true;
    }else {
        $(parent).addClass('is-invalid');
        $(errorField).html('Required');
        return false;
    }
};

var mdlNumber=function (elem) {
    // var elem=$(this);
    var a=$(elem).val();
    var parent=$(elem).parent();
    var errorField=$(parent).find('.mdl-textfield__error');
    if(a.length!=0){
        $(parent).addClass('is-dirty');
        var regexExp=/^\d+$/;
        if(regexExp.test(a)){
            $(parent).removeClass('is-invalid');
            $(errorField).html('');
            return true;
        }else {
            $(parent).addClass('is-invalid');
            $(errorField).html('Not a number!. ');
            return false;
        }
    }else {
        return true;
    }
};

var mdlMobile=function (elem) {
    var a=$(elem).val();
    var parent=$(elem).parent();
    var errorField=$(parent).find('.mdl-textfield__error');
    var isNumber=mdlNumber($(elem));
    if(isNumber){
        if($(elem).val().length==10 || $(elem).val().length==0){
            $(parent).removeClass('is-invalid');
            $(errorField).append('');
            return true;
        }else {
            $(parent).addClass('is-invalid');
            $(errorField).append('Must be 10 digit!. ');
            return false;
        }
    }else {
        return false;
    }
};


var mdlValidation=function (elem) {
    var hasError;
    if($(elem).hasClass('mdl-required')){
        var validateResult=mdlRequired($(elem));
        if(!validateResult){
            hasError=true;
        }
    }
    return hasError;
};


