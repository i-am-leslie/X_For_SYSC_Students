document.addEventListener('DOMContentLoaded', function(e) {

    let firstname = document.querySelector("#first_name").value;
    let lastname=document.querySelector("#last_name").value;
    let email = document.querySelector("#email").value;
    let  first_last=document.querySelector("#first_last");
    let program =document.querySelector("#program").value;
    let programinput=document.querySelector("#program_input");
    let emailplacement= document.querySelector("#student_email");


    // For first and last name 
    const text=document.createTextNode(firstname+" " + lastname);
    const p = document.createElement("p");
    p.appendChild(text);
    first_last.appendChild(p);
    console.log(firstname);

    // email
    const text1=document.createTextNode("Email:" + " "+ email);
    const p1 = document.createElement("p");
    p1.appendChild(text1);
    emailplacement.appendChild(p1);
    console.log(email);

    //program 
    const text2=document.createTextNode("Program:" + " "+ program);
    const p2 = document.createElement("p");
    p2.appendChild(text2);
    programinput.appendChild(p2);
    console.log(text2);

    //avatar

})