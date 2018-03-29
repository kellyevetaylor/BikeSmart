function ChatController() {
    var model = new ChatModel(), view = new ChatView();

    this.init = function() {
        model.init();
        view.init();

        model.setNewShowPostCallback( function(message) {
            view.addMessage(message);
        });

        view.setCallbackForMessagePost( model.post );
    };
}

var chatController = new ChatController();
window.addEventListener("load", chatController.init);