function isLoginValid() {

    var username = document.forms["loginForm"]["username"].value;
    var password = document.forms["loginForm"]["password"].value;

    if (username === "" || password === "") {
        window.alert("Please enter a username and password");
    } else {
        //location.href = "NewsFeedPage.html";
    }
}
