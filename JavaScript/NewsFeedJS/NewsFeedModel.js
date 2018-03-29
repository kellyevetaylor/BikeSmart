function ChatModel() {

    var newPostCallback = null, lastSeenID = -1,
        postQueue = new Array(), //an empty associative array as a queue of messages to be sent

        getUUID = function() {
            // returns a unique id per message based on the format <userid><msgid>
            // A cheap way of doing this using a random userid, server code would be better

            var rand, millies, userid;

            if (localStorage.chat_uuid){
                localStorage.chat_uuid = localStorage.chat_uuid*1 + 1;
            } else {
                rand = Math.floor( Math.random()*10000 );// an integer between 0 and 9999 - a four digit number
                millies = (new Date()).getMilliseconds() % 100; // an integer between 0 and 99 - a two digit number
                userid = rand*100 + millies; // a six digit number

                localStorage.chat_uuid = userid * 1000;// a nine digit number of the format <userid>000
            }

            return localStorage.chat_uuid;
        },

        updatePosts = function () {
            var http, repliesJSON, messageJSON, parameters;
            if (newPostCallback!==null){
                console.log("in updatePosts");
                http = new XMLHttpRequest();
                parameters = "startID="+((lastSeenID*1)+1);
                http.open("GET", "showChats.php?"+parameters, true);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.onreadystatechange = function() {
                    if (http.readyState == 4 && http.status == 200){
                        console.log("got the reply "+http.responseText);
                        repliesJSON = http.responseText.split("\n");
                        repliesJSON.forEach(function(messageTextLine){
                            if (messageTextLine.length>0){
                                messageJSON = JSON.parse(messageTextLine);
                                lastSeenID = messageJSON.insertID;
                                newPostCallback(messageJSON.message);
                            }
                        });
                    }
                };
                http.send();
            }
        },
        doSendPost = function(message, uuid){
            //Sends message to server using AJAX
            console.log("Posting message "+message);
            var http = new XMLHttpRequest(),
                params = "msg="+encodeURIComponent(message)+"&uid="+uuid ;
            http.open("POST", "postChat.php", true);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.onreadystatechange = function() {
                if (http.readyState==4 && http.status==200) {
                    console.log("Reply: "+http.responseText);
                    if (isNaN(http.responseText)){
                        console.log("Error from server");
                    } else {
                        delete postQueue[http.responseText];
                        console.log("Removed item "+http.responseText);
                    }
                    window.setTimeout(updatePosts, 100);//soon update the display
                }
            };
            http.send(params);
        },
        checkAndSend = function() {
            // check for messages in queue and sends
            var qSize = Object.keys(postQueue).length, k;
            console.log("Queue has "+qSize+" elements");
            if (qSize>0){
                for (k in postQueue){
                    if (postQueue.hasOwnProperty(k)){
                        doSendPost(postQueue[k],k);
                    }
                }
            }
        };

    this.setNewShowPostCallback = function(callback){
        newPostCallback = callback;
    };

    this.post = function(message){
        //add the message to the queue
        postQueue[""+getUUID()] = message;
        setTimeout(checkAndSend, 100);
    };

    this.init = function() {
        setTimeout(updatePosts, 500);
        setInterval(updatePosts, 5000);
        setInterval(checkAndSend, 5000);
    };

}