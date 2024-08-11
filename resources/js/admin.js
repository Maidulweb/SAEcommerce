window.Echo.private("messenger." + USER.id).listen("MessengerEvent", (e) => {
    console.log(e);
    function formateDate(dateString) {
        const options = {
            year: "numeric",
            month: "short",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
        };

        const formatedDate = new Intl.DateTimeFormat("en-Us", options).format(
            new Date(dateString)
        );
        return formatedDate;
    }

    const chatBox = $(".chat-content");

    function scrollToBottom() {
        chatBox.scrollTop(chatBox.prop("scrollHeight"));
    }

    let message = `<div class="chat-item chat-left" style="">
                        <img src="${e.image}">
                        <div class="chat-details">
                        <div class="chat-text">${e.message}</div>
                        <div class="chat-time">
                        ${formateDate(e.chat_time)}
                        </div>
                    </div>
                    `;
    chatBox.append(message);

    scrollToBottom();
});
