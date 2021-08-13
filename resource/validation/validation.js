/**
 * Created by adnan on 1/16/16.
 */



function userNameValidation() {

    var letterPattern=/[^a-zA-Z0-9]/;
    var username = $("#UserName").val();
    if(letterPattern.test(username)){
        $("#p01").text('Username can contain alphanumeric characters only');
        $("#p01").show();
        return false;
    }
    else if($("#UserName").val()==''){
        $("#p01").text('Username can not be blank');
        $("#p01").show();
        return false;
    }
    else {
        $("#p01").text('');
        return true;
    }
}





function passwordValidation(){


    var specialChar=/[@,!,#,$,%,^,&,*,(,),_,+,-]/;
    var digit=/[0-9]/;
    var alphabets=/[a-zA-Z]/;
    var password = $("#Password").val();

    if (password.length >= 6 && password.length <=15) {
        $("#p03").text('');

        if (specialChar.test(password) && digit.test(password)&&alphabets.test(password)) {
            $('.pass').text('Strong');

            return true;
        }
        else if (specialChar.test(password)&&digit.test(password)||specialChar.test(password)&&alphabets.test(password)||digit.test(password)&&alphabets.test(password)) {
            $('.pass').text('Good');

            return true;
        }
        else {
            $('.pass').text('weak');
            return true;
        }
    }
    else {
        $(".pass").text('');
        $("#p03").text("Password must be between in 6 characters and 15 characters");
        $("#p03").show();
        return false;
    }
}

function confirmValidation() {

    if ($(".ConfirmPassword").val() != '') {
        if ($(".Password").val() == $(".ConfirmPassword").val()) {
            $(".pass").text('').show();
            return true;
        }

        else {
            $("#p04").text("please enter same password").show();
            return false;
        }
    }

    else {
        $("#p04").text("please enter confirm password.").show();
        return false;
    }

}


$(".ConfirmPassword").on('focusout',function(){
    confirmValidation();
});

//************ number-only validation on keyup  *********************//
$(document).on('keyup','.number-only',function () {
    if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    }
});

$(document).on('focusout','.number-only',function () {
    if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    }
});


//************ mobile-number validation on keyup  *********************//
$(document).on('keyup','.mobile-number',function(){
    if($(this).val().length >= 10){
        var d=$(this).val();
        $(this).val(d.substring(0,10));
    }
});
//************ pin-code validation on keyup  *********************//
$(document).on('keyup','.pin-code',function(){

    if($(this).val().length >= 6){
        var d=$(this).val();
        $(this).val(d.substring(0,6));
    }
});





//************* required validation on focusout event **********************//
$(document).on('focusout','.required',function(){
    required($(this));
});
//************* required validation on click event **********************//
$(document).on('click','.required',function(){
    if($(this).prop("localName")=='select'){
        selectRequired($(this));
    }
});
//************* required validation on select tag  event **********************//
$(document).on('focus','.required',function(){
    if($(this).prop("localName")=='select'){
        var elementType = $(this).prop('nodeName');
        $(this).children().css('color','black');
    }
});


//************* email validation on focusout event **********************//
$(document).on('focusout','.email',function(){
    emailValidation($(this));
});
//************* email validation on keyup event **********************//
$(document).on('keyup','.email',function(){
    emailValidation($(this));
});





//************ functions  *********************//

//***********urlValidation Function *******************//
function urlValidation(inputUrl){

    var url = $(inputUrl).val();
    var errorDiv=$(inputUrl).parent();
    var errorSpan=$(inputUrl).next();

    var RegExp = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
    if(url==''){
        return true;
    }
    else if (RegExp.test(url)) {
        $(errorDiv).removeClass('has-error has-feedback');
        $(errorSpan).removeClass('glyphicon glyphicon-remove form-control-feedback');
        return true;
    }
    else  {
        $(inputUrl).addClass('placeholder1');
        $(inputUrl).attr('placeholder','Please enter correct url');
        $(errorDiv).addClass('has-error has-feedback');
        $(errorSpan).addClass('glyphicon glyphicon-remove form-control-feedback');
        return false;
    }
}

//************ emailValidation function  *********************//
// function emailValidation(inputEmail){
//     if(required($(inputEmail)) && emailFormatValidation($(inputEmail))){
//         return true;
//     }else {
//         return false;
//     }
// }

function emailValidation(inputEmail){

   return emailFormatValidation($(inputEmail));
    /*var length=$(inputEmail).val().length;

    if(length!=0){
        emailFormatValidation($(inputEmail));
    }*/
    /*if(emailFormatValidation($(inputEmail))){
        return true;
    }else {
        return false;
    }*/
}

//************ emailFormatValidation function  *********************//
function emailFormatValidation(inputEmail){
    var email = $(inputEmail).val();
    var length = email.length;
    var at=/[@]/;
    var dot=/[.]/;
    var errorDiv=$(inputEmail).parent();
    var errorSpan=$(inputEmail).next();
    if (at.test(email) && dot.test(email)) {
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
            $(errorDiv).addClass('has-error has-feedback');
            $(errorSpan).addClass('glyphicon glyphicon-remove form-control-feedback');
            return false;
        }
        else {
            $(errorDiv).removeClass('has-error has-feedback');
            $(errorSpan).removeClass('glyphicon glyphicon-remove form-control-feedback');
            return true;
        }
    }
    else if( $(inputEmail).val()==''){
        $(errorDiv).removeClass('has-error has-feedback');
        $(errorSpan).removeClass('glyphicon glyphicon-remove form-control-feedback');
        return false;
    }
    else {
        $(errorDiv).addClass('has-error has-feedback');
        $(errorSpan).addClass('glyphicon glyphicon-remove form-control-feedback');
        return false;
    }
}

//************ required function  *********************//
function required(input){
    var elementType=$(input).prop('localName');

    if(elementType=='select'){
        var result= selectRequired($(input));
        return result;
    }else {

        if($(input).val()!=''){
            return true;
        }else {
            var inputDiv=$(input).parent();
            $(input).addClass('placeholder1');
            $(input).attr('placeholder','Please enter '+$(inputDiv).prev().text());
            return false;
        }
    }
}

function required2(input){
    var elementType=$(input).prop('localName');

    if(elementType=='select'){
        var result= selectRequired($(input));
        return result;
    }else {

        if($(input).val()!=''){
            return true;
        }else {
            var inputDiv=$(input).parent();
            $(input).addClass('placeholder1');
            $(input).attr('placeholder','Please enter '+$(inputDiv).prev().text());
            return false;
        }
    }
}

//************ selectRequired function  for select element *********************//
function selectRequired(input){
    var a=$(input).val();
    var b=$(input);
    if(a=='0'){
        $(input).css('color','red');
        return false;
    }else {
        $(input).css('color','black');
        return true;
    }
}

function isNumber(num) {
    if(num.match(/^\d+$/)){
        return true
    }else {
        return false;
    }
}


var validation=function (elem) {
    var hasError;
    if($(elem).hasClass('required')){
        var validateResult=required($(elem));
        if(!validateResult){
            hasError=true;
        }
    }
    if($(elem).hasClass('required2')){
        var validateResult=required($(elem));
        if(!validateResult){
            hasError=true;
        }
    }
    if($(elem).hasClass('email')){
        var validateResult=emailValidation($(elem));
        if(!validateResult){
            hasError=true;
        }
    }
    return hasError;
};
