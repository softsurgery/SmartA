function pwd(name) {
    var x = document.getElementById(name);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function isGmail(email) {
    var gmailRegex = /@gmail\.com$/;
    return gmailRegex.test(email);
}

//"fa fa-times" X
//"fa fa-check" OK
function showValidation(){
    var iconElements = document.querySelectorAll('.icon');
    iconElements.forEach(function(icon) {
      icon.style.opacity = '1'; 
    });
}

function check_times(v,class1,class2,color){
    v.classList.remove(class1);
    v.classList.add(class2);
    v.style.color = color;
    return v;
}

function validation0(){

}

function validation1(){

}

function validation2(){

}

function validation3(){

}