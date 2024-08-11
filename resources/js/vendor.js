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

    let chatBox = $(".wsus__chat_area_body");

    function scrollToBottom() {
        chatBox.scrollTop(chatBox.prop("scrollHeight"));
    }

    let message = `
                <div class="wsus__chat_single">
                    <div class="wsus__chat_single_img">
                        <img src="${e.image}"
                            alt="user" class="img-fluid">
                    </div>
                    <div class="wsus__chat_single_text">
                        <p>${e.message}</p>
                        <span>${formateDate(e.chat_time)}</span>
                    </div>
                </div>
                `;
    chatBox.append(message);

    scrollToBottom();
});
