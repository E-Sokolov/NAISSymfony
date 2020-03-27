function insertDate(){
    //alert('incert');
    var date1 = $('#date1').val();
    var date2 = $('#date2').val();
    alert(date1);
    alert(date2);
    if(date1 != ''){
        var date = date1+'//'+date2;
    }
    $('input[name="date"]').val(date);
}
$(document).on('click','#form_submit', function(){
    insertDate();
    $('#form_submit').submit();
    alert('click');
});
$(document).on('keypress',function(e) {
    if(e.which == 13) {
        alert('Enter');
        insertDate();
    }
});