const tester = document.getElementById("login-div");
const loginBtn = document.getElementById("login-btn");
const backdrop = document.querySelector(".backdrop");
const closeBtn = document.querySelector("#close-btn");
const signup = document.getElementById("signup-div")
const signupBtn = document.getElementById("signup-btn")
const closeSignup = document.getElementById("close-signup");

const changeStyle = () => {
    if(!signup.classList.contains("not")) {
        signup.classList.add("not");
    }
    if(tester.classList.contains("not")) {
        tester.classList.remove("not");
        backdrop.classList.remove("not");
    } else {
        tester.classList.add("not");
        backdrop.classList.add("not");
    }
}

const openSignup = () => {
    if(!tester.classList.contains("not")) {
        tester.classList.add("not");
    }
    if(signup.classList.contains("not")) {
        signup.classList.remove("not");
        backdrop.classList.remove("not");
    } else {
        signup.classList.add("not");
        backdrop.classList.add("not");
    }
}

loginBtn.addEventListener("click", changeStyle);
closeBtn.addEventListener("click", changeStyle);

signupBtn.addEventListener("click", openSignup)
closeSignup.addEventListener("click", openSignup);