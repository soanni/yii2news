$(document).ready(function(){
    $('#reservation-customer_id').change(function(ev){
        $('#detail').hide();
        var customerId = $(this).val();
        $.get(
            'http://yiiex.ubuntu/reservations/ajax-drop-down-list-by-customer-id',
            {'customer_id' : customerId},
            function(data){
                $('#reservation-id').html(data);
            }
        );
        ev.preventDefault();
    });
    $('#reservation-id').change(function(ev){
        $(this).parents('form').submit();
        ev.preventDefault();
    });
});