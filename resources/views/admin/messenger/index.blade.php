@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Messenger</h1>
    </div>

    <div class="section-body mb-0">
        <div class="row align-items-center justify-content-center">
            <div class="col-4">
              <div class="card">
                <div class="card-header">
                  <h4>Who's Online?</h4>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled list-unstyled-border">
                    @foreach ($chatUsers as $chatUser)
                    <li class="media chat_user_profile" data-id="{{$chatUser->senderProfile->id}}">
                      <img alt="image" class="mr-3 rounded-circle" width="50" src="{{asset($chatUser->senderProfile->image)}}">
                      <div class="media-body">
                        <div class="mt-0 mb-1 font-weight-bold">{{$chatUser->senderProfile->name}}</div>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-8">
            <div class="card chat-box">
              <div class="card-header">
                <h4>Chat with Rizal</h4>
              </div>
              <div class="card-body chat-content" tabindex="2" style="overflow: hidden; outline: none;">
              
            <div class="chat-item chat-right" style="">
              <img src="../dist/img/avatar/avatar-2.png">
              <div class="chat-details">
                <div class="chat-text">Wat?!</div>
                <div class="chat-time">11:11</div>
              </div>
            </div>
            </div>
              <div class="card-footer chat-form">
                <form id="chat-form">
                  <input type="text" class="form-control chat_box" name="message" placeholder="Type a message">
                  <input type="hidden" name="receiver_id" id="receiver_id" value="">
                  <button id="send_btn" class="btn btn-primary">
                    <i class="far fa-paper-plane"></i>
                  </button>
                </form>
              </div>
            </div>
            </div>
    </div>
  </section>
@endsection

@push('scripts')
    <script>
        function formateDate(dateString){
              const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
              }

              const formatedDate = new Intl.DateTimeFormat('en-Us', options).format(new Date(dateString));
              return formatedDate;
        }

        const chatBox = $('.chat-content');

        function scrollToBottom(){
            chatBox.scrollTop(chatBox.prop("scrollHeight"));
        } 

        $(document).ready(function(){
            $('.chat_user_profile').on('click', function(){
                let receiverId = $(this).data('id');
                $('#receiver_id').val(receiverId);
            /*     let chatUserName = $(this).find('h4').text(); */
            let chatUserImage = $(this).find('img').attr('src');
                $.ajax({
                    method: 'GET',
                    url:'{{route("admin.get-messages")}}',
                    data:{
                        receiverId:receiverId
                    },
                    beforeSend:function(){
                        chatBox.html('');
                        /* $('#chat_user_name').text(`Chat with ${chatUserName}`); */
                    },
                    success:function(response){
                        $.each(response, function(index,value){
                          if(value.sender_id == USER.id){
                            var html = `
                                <div class="chat-item chat-right" style=""><img src="${USER.image}"><div class="chat-details">
                                  <div class="chat-text">${value.message}</div>
                                  <div class="chat-time">${formateDate(value.created_at)}</div>
                                </div>
                                `
                          }else{
                            var html = `
                                <div class="chat-item chat-left" style=""><img src="${chatUserImage}"><div class="chat-details">
                                  <div class="chat-text">${value.message}</div>
                                  <div class="chat-time">${formateDate(value.created_at)}</div>
                                </div>
                                `
                          }
                          
                                chatBox.append(html);
                        })
                        scrollToBottom();
                    },
                    error:function(){},
                    complete:function(){},
                })
            })

           $('#chat-form').on('submit', function(e){
                e.preventDefault();
                let formData = $(this).serialize();
                
                var formSubmitting = false;

                let messageData = $('.chat_box').val();

                if(formSubmitting || messageData === '' ){
                    return;
                }

                let message = `
                 <div class="chat-item chat-right" style="">
                    <img src="${USER.image}">
                    <div class="chat-details">
                      <div class="chat-text">${messageData}</div>
                  </div>
                `;

                chatBox.append(message);
                $('.chat_box').val('');
                scrollToBottom();

                $.ajax({
                    method:'POST',
                    url:'{{route("admin.send-message")}}',
                    data:formData,
                    beforeSend:function(){
                        formSubmitting = true;
                        $('#send_btn').prop('disabled', true);
                    },
                    success:function(data){
                        $('#send_btn').prop('disabled', false);
                        formSubmitting = false;
                    },
                    error:function(xhr,status,error){
                        toastr.error(xhr.responseJSON.message)
                        $('#send_btn').prop('disabled', false);
                        formSubmitting = false;
                    },
                    complete:function(){
                        $('.chat_box').val('');
                        $('#send_btn').prop('disabled', false);
                        formSubmitting = false;
                    }
                })
            }) 
        })
    </script>
@endpush