function ChatView() {
    var chatHistoryDiv, postForm, postTextField;

    this.init = function() {
        chatHistoryDiv = document.getElementById("chatHistoryDiv");
        postForm = document.getElementById("chatForm");
        postTextField = document.getElementById("messageText");
        postTextField.focus();
    };


    this.addMessage = function(message){
        chatHistoryDiv.innerHTML = chatHistoryDiv.innerHTML +"<p>" + message + "</p>";
        chatHistoryDiv.scrollTop = chatHistoryDiv.scrollHeight;
    };

    this.setCallbackForMessagePost = function(callback){
        postForm.addEventListener("submit", function(event){
            callback(postTextField.value);
            postTextField.value = "";
            postTextField.focus();
            event.preventDefault();
        });
    };
}