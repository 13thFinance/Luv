function goto(target)
{
    location.href = target;
}

function gotoLoginOrAdmin()
{
    //this is temporary, just for now(will be a backend call later)
    
    let email = document.getElementById('login-email').value;
    let password = document.getElementById('login-password').value;
    
    if(email === "admin" && password === "admin")
    {
        location.href = "admin-page.html";
    }
    else
    {
        location.href = "accountManagement.html";
    }
}