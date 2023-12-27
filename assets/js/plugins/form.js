const monthsInFrench = [
    "Janvier",
    "Février",
    "Mars",
    "Avril",
    "Mai",
    "Juin",
    "Juillet",
    "Août",
    "Septembre",
    "Octobre",
    "Novembre",
    "Décembre"
];

function formatDate(input,id) {
    var date = new Date(document.getElementById(input).value);
    var formattedDate = "Le " + (date.getDate()).toString().padStart(2, '0') + ' '
                      + monthsInFrench[(date.getMonth() + 1).toString().padStart(2, '0')-1] + ' '
                      + date.getFullYear();

    document.getElementById(id).innerText = formattedDate;
}

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