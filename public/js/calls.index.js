function insertDate(){
    var date1 = $('#date1').val();
    var date2 = $('#date2').val();
    if(date1 != ''){
        var date = date1+'//'+date2;
    }
    $('input[name="date"]').val(date);
}
$(document).on('click','#go', function(){
    insertDate();
    $('#go').submit();
});
$(document).on('keypress',function(e) {
    if(e.which == 13) {
        alert(date);
        insertDate();
    }
});