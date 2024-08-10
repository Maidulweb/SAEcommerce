<script>
    $(document).ready(function() {

        $(document).on('submit','.shopping-cart-form', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'POST',
                url: '{{ route('shopping-cart') }}',
                data: formData,
                success: function(data) {
                    if(data.status === 'success'){
                        getCartCount();
                        getCartSidebarProduct();
                        $('.cart-total-view-checkout').removeClass('d-none');
                        toastr.success(data.message);
                    }else if(data.status === 'error'){
                        toastr.error(data.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        })

        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: '{{ route('cart.count') }}',
                success: function(data) {

                    $('.cart-count-header').text(data);
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
        /** Add To Cart */
        function getCartSidebarProduct() {
            $.ajax({
                method: 'GET',
                url: '{{ route('cart.sidebar-product') }}',
                success: function(data) {
                    $('.cart-sidebar-product').html('');
                    let html = '';
                    for (let item in data) {
                        let test = data[item].options.variants;
                        let testu;
                        for (let itemVariants in test) {
                            testu = itemVariants + '-' + test[itemVariants].itemName;
                        }

                        html += `<li id="cart_sidebar_product_${data[item].rowId}">
                        <div class="wsus__cart_img">
                            <a href="#"><img src="{{ asset('/') }}${data[item].options.image}" alt="product" class="img-fluid w-100"></a>
                            <a class="wsis__del_icon cart-remove-test" data-id="${data[item].rowId}" href="#"><i class="fas fa-minus-circle"></i></a>
                        </div>
                        <div class="wsus__cart_text">
                            <a class="wsus__cart_title" href="{{ url('product-details/') }}${data[item].options.slug}">${data[item].name}</a>
                            <p>${data[item].price}</p>
                          
                            <p>${testu} - {{ $setting->currency_icon }}${data[item].options.variant_item_price}</p>
                            <p>Qty : ${data[item].qty}</p>
                        </div>
                    </li>`

                    }
                    $('.cart-sidebar-product').html(html);
                    getCartSidebarProductTotal();
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        $('body').on('click', '.cart-remove-test', function(e) {
            console.log('test')
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                method: 'GET',
                url: '{{ route('cart.remove.test') }}',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status == 200) {
                        let removeId = '#cart_sidebar_product_' + id;
                        $(removeId).remove();
                        if ($('.cart-sidebar-product').find('li').length === 0) {
                            $('.cart-total-view-checkout').addClass('d-none');
                            $('.cart-sidebar-product').html('<li>No Item</li>');
                        }
                        toastr.success(data.message)
                        getCartSidebarProductTotal();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        })

        function getCartSidebarProductTotal() {
            $.ajax({
                method: 'GET',
                url: '{{ route('cart.sidebar-product.total') }}',
                success: function(data) {
                    $('.cart-total').text("{{ $setting->currency_icon }}" + data);
                },
                error: function() {

                }
            })
        }

        $('.add_to_wishlist').on('click', function(e){
            e.preventDefault();
           
           let id = $(this).data('id');
           $.ajax({
            method:'POST',
            url:'{{route("user.wishlist.store")}}',
            data:{
                id:id
            },
            success:function(data){
                
                if(data.status == 'success'){
                    $('#wishlist_count').text(data.addcount);
                    toastr.success(data.message);
                }else if(data.status == 'info'){
                    $('#wishlist_count').text(data.deletecount);
                    toastr.info(data.message);
                }
                
            },
            error:function(xhr,status,error){
                alert('Please login')
            }
           })
        })

       $('#newsletter').on('submit', function(e){
        e.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            method:'POST',
            url:'{{route("newsletter")}}',
            data:data,
            beforeSend:function(){
                $('.subscription-before-send').text('Loading...');
            },
            success:function(data){
                $('.newsletter-email').val('');
                toastr.success(data.message);
                $('.subscription-before-send').text('Subscribe');
               
            },
            error:function(data){
            $('.subscription-before-send').text('Subscribe');
             let errors = data.responseJSON.errors;
             if(errors){
                $.each(errors, function(key,value){
                    toastr.error(value);
                })
             }
            }
        })
       })

    })
</script>
