@extends('frontend.dashboard.layouts.master')
@section('content')
<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-star" aria-hidden="true"></i> Message</h3>
            <div class="wsus__dashboard_review">
                <div class="row">
                    <div class="col-xl-4 col-md-5">
                        <div class="wsus__chatlist d-flex align-items-start">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <h2>Seller List</h2>
                                <div class="wsus__chatlist_body">
                                    @foreach ($chatUsers as $chatUser)
                                    <button class="chat_user_profile"
                                    data-id="{{$chatUser->receiverProfile->id}}" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab"
                                    aria-controls="v-pills-{{$chatUser->receiverProfile->id}}" aria-selected="true">
                                    <div class="wsus_chat_list_img">
                                        @if ($chatUser->receiverProfile->image != null )
                                        <img src="{{asset($chatUser->receiverProfile->image)}}"
                                        alt="user" class="img-fluid">
                                        @else
                                        <img src="http://127.0.0.1:8000/uploads/custom-images/robert-james-2022-08-15-01-18-57-7752.png"
                                        alt="user" class="img-fluid">
                                        @endif
                                       
                                        <span class="pending d-none" id="pending-6">0</span>
                                    </div>
                                    <div class="wsus_chat_list_text">
                                        <h4>{{$chatUser->receiverProfile->name}}</h4>
                                    </div>
                                </button>
                                    @endforeach
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-7">
                        <div class="wsus__chat_main_area">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-2-tab">
                                    <div id="chat_box">
                                        <div class="wsus__chat_area">
                                            <div class="wsus__chat_area_header">
                                                <h4 id="chat_user_name">Chat with Daniel Paul</h4>
                                            </div>
                                            
                                            <div class="wsus__chat_area_body">
                                                <div class="wsus__chat_single">
                                                    <div class="wsus__chat_single_img">
                                                        <img src="http://127.0.0.1:8000/uploads/custom-images/daniel-paul-2022-08-15-01-16-48-4881.png"
                                                            alt="user" class="img-fluid">
                                                    </div>
                                                    <div class="wsus__chat_single_text">
                                                        <p>Welcome to Shop name 2!

                                                            Lorem Ipsum is simply dummy text of the printing
                                                            and typesetting industry. Lorem Ipsum has been
                                                            the industry's standard dummy text ever since
                                                            the 1500s, when an unknown printer took a galley
                                                            of type and scrambled it to make a type specimen
                                                            book.</p>
                                                        <span>15 August, 2022, 12:56 PM</span>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="wsus__chat_area_footer">
                                                <form id="user_chat">
                                                    @csrf
                                                    <input type="text" placeholder="Type Message" class="chat_box" name="message">
                                                    <input type="hidden" name="receiver_id" id="receiver_id">
                                                    <button id="send_btn" type="submit"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
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

        const chatBox = $('.wsus__chat_area_body');

        function scrollToBottom(){
            chatBox.scrollTop(chatBox.prop("scrollHeight"));
        } 

        $(document).ready(function(){
            $('.chat_user_profile').on('click', function(){
                let receiverId = $(this).data('id');
                $('#receiver_id').val(receiverId);
                let chatUserName = $(this).find('h4').text();
                $.ajax({
                    method: 'GET',
                    url:'{{route("user.get-messages")}}',
                    data:{
                        receiverId:receiverId
                    },
                    beforeSend:function(){
                        chatBox.html('');
                        $('#chat_user_name').text(`Chat with ${chatUserName}`);
                    },
                    success:function(response){
                        $.each(response, function(index,value){
                            let html = `
                                 <div class="wsus__chat_single single_chat_2">
                                    <div class="wsus__chat_single_img">
                                        <img src="${USER.image}"
                                            alt="user" class="img-fluid">
                                    </div>
                                    <div class="wsus__chat_single_text">
                                        <p>${value.message}</p>
                                        <span>${formateDate(value.created_at)}</span>
                                    </div>
                                </div>
                                `
                                chatBox.append(html);
                        })
                        scrollToBottom();
                    },
                    error:function(){},
                    complete:function(){},
                })
            })

            $('#user_chat').on('submit', function(e){
                e.preventDefault();
                let formData = $(this).serialize();
                
                var formSubmitting = false;

                let messageData = $('.chat_box').val();

                if(formSubmitting || messageData === '' ){
                    return;
                }

                let message = `
                <div class="wsus__chat_single single_chat_2">
                    <div class="wsus__chat_single_img">
                        <img src="${USER.image}"
                            alt="user" class="img-fluid">
                    </div>
                    <div class="wsus__chat_single_text">
                        <p>${messageData}</p>
                        <span></span>
                    </div>
                </div>
                `;

                chatBox.append(message);

                scrollToBottom();

                $.ajax({
                    method:'POST',
                    url:'{{route("user.send-message")}}',
                    data:formData,
                    beforeSend:function(){
                        formSubmitting = true;
                        $('#send_btn').prop('disabled', true);
                    },
                    success:function(data){
                        $('.chat_box').val('');
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