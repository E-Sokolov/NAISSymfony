function insertDate(){
    var date1 = $('#date1').val();
    var date2 = $('#date2').val();
    if(date1 != ''){
        var date = date1+'//'+date2;
    }
    $('input[name="calls_search_form[date]"]').val(date);
}
$(document).on('click','#form_submit', function(){
    insertDate();
    $('#form_submit').submit();
});
$(document).on('keypress',function(e) {
    if(e.which == 13) {
        insertDate();
    }
});