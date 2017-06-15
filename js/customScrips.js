


$(function() {
    $(".seatFree").each(function(){
         $(this).click(function(){
        var src = $(this).attr('src');
        if(src == 'resources/seat_free.png') {
            $(this).attr("src","resources/seat_selected.png");
            $(this).addClass('selected')
    }
    else{
            $(this).attr("src","resources/seat_free.png");
            $(this).removeClass('selected')
        }
    });
    });
    });

var numSelected = $('.selected').length;
var nOfTickects = $('.tickets').val();

$(function() {
    $('.tickets').keyup(function () {
        if (this.value>6) {
            this.style.borderColor = "#F00";
            $('.ticketsErrOver').show();
            $('.ticketsErrUnder').hide();
            $('.seatsSelect1').hide();
            $('.seatsSelect2').hide();
            $('.seatsSelect3').hide();
            $('.seatsSelect4').hide();
            $('.seatsSelect5').hide();
            $('.seatsSelect6').hide();
        }
        else if (this.value<1) {
            this.style.borderColor = "#F00";
            $('.ticketsErrOver').hide();
            $('.ticketsErrUnder').show();
            $('.seatsSelect1').hide();
            $('.seatsSelect2').hide();
            $('.seatsSelect3').hide();
            $('.seatsSelect4').hide();
            $('.seatsSelect5').hide();
            $('.seatsSelect6').hide();
        }
        else if (this.value==1){
            $('.seatsSelect1').show();
            $('.seatsSelect2').hide();
            $('.seatsSelect3').hide();
            $('.seatsSelect4').hide();
            $('.seatsSelect5').hide();
            $('.seatsSelect6').hide();
            this.style.borderColor = "#A9A9A9";
            $('.ticketsErrOver').hide();
            $('.ticketsErrUnder').hide();
        }
        else if (this.value==2){
            $('.seatsSelect1').show();
            $('.seatsSelect2').show();
            $('.seatsSelect3').hide();
            $('.seatsSelect4').hide();
            $('.seatsSelect5').hide();
            $('.seatsSelect6').hide();
            this.style.borderColor = "#A9A9A9";
            $('.ticketsErrOver').hide();
            $('.ticketsErrUnder').hide();
        }
        else if (this.value==3){
            $('.seatsSelect1').show();
            $('.seatsSelect2').show();
            $('.seatsSelect3').show();
            $('.seatsSelect4').hide();
            $('.seatsSelect5').hide();
            $('.seatsSelect6').hide();
            this.style.borderColor = "#A9A9A9";
            $('.ticketsErrOver').hide();
            $('.ticketsErrUnder').hide();
        }
        else if (this.value==4){
            $('.seatsSelect1').show();
            $('.seatsSelect2').show();
            $('.seatsSelect3').show();
            $('.seatsSelect4').show();
            $('.seatsSelect5').hide();
            $('.seatsSelect6').hide();

            this.style.borderColor = "#A9A9A9";
            $('.ticketsErrOver').hide();
            $('.ticketsErrUnder').hide();
        }
        else if (this.value==5){
            $('.seatsSelect1').show();
            $('.seatsSelect2').show();
            $('.seatsSelect3').show();
            $('.seatsSelect4').show();
            $('.seatsSelect5').show();
            $('.seatsSelect6').hide();
            this.style.borderColor = "#A9A9A9";
            $('.ticketsErrOver').hide();
            $('.ticketsErrUnder').hide();
        }
        else if (this.value==6){
            $('.seatsSelect1').show();
            $('.seatsSelect2').show();
            $('.seatsSelect3').show();
            $('.seatsSelect4').show();
            $('.seatsSelect5').show();
            $('.seatsSelect6').show();
            this.style.borderColor = "#A9A9A9";
            $('.ticketsErrOver').hide();
            $('.ticketsErrUnder').hide();
        }
        else {
            this.style.borderColor = "#A9A9A9";
            $('.ticketsErrOver').hide();
            $('.ticketsErrUnder').hide();
        }
    });
    });

$(function() {
    $('.seats1').change(function () {
        var seat1=$('.seats1').val();
        var seat2=$('.seats2').val();
        var seat3=$('.seats3').val();
        var seat4=$('.seats4').val();
        var seat5=$('.seats5').val();
        var seat6=$('.seats6').val();
        if(seat1==seat2 || seat1==seat3 || seat1==seat4 ||seat1==seat5 || seat1==seat6){
            $('.seatsErr').show();
        }
        else{
            $('.seatsErr').hide();
        }
    });
});


$(function() {
    $('.seats2').change(function () {
        var seat1=$('.seats1').val();
        var seat2=$('.seats2').val();
        var seat3=$('.seats3').val();
        var seat4=$('.seats4').val();
        var seat5=$('.seats5').val();
        var seat6=$('.seats6').val();
        if(seat2==seat1 || seat2==seat3 || seat2==seat4 ||seat2==seat5 || seat2==seat6){
            $('.seatsErr').show();
        }
        else{
            $('.seatsErr').hide();
        }
    });
    });

$(function() {
    $('.seats3').change(function () {
        var seat1=$('.seats1').val();
        var seat2=$('.seats2').val();
        var seat3=$('.seats3').val();
        var seat4=$('.seats4').val();
        var seat5=$('.seats5').val();
        var seat6=$('.seats6').val();
        if(seat3==seat1 || seat3==seat2 || seat3==seat4 ||seat3==seat5 || seat3==seat6){
            $('.seatsErr').show();
        }
        else{
            $('.seatsErr').hide();
        }
    });
});

$(function() {
    $('.seats4').change(function () {
        var seat1=$('.seats1').val();
        var seat2=$('.seats2').val();
        var seat3=$('.seats3').val();
        var seat4=$('.seats4').val();
        var seat5=$('.seats5').val();
        var seat6=$('.seats6').val();
        if(seat4==seat1 || seat4==seat2 || seat4==seat3 ||seat4==seat5 || seat4==seat6){
            $('.seatsErr').show();
        }
        else{
            $('.seatsErr').hide();
        }
    });
});

$(function() {
    $('.seats5').change(function () {
        var seat1=$('.seats1').val();
        var seat2=$('.seats2').val();
        var seat3=$('.seats3').val();
        var seat4=$('.seats4').val();
        var seat5=$('.seats5').val();
        var seat6=$('.seats6').val();
        if(seat5==seat1 || seat5==seat2 || seat5==seat3 ||seat5==seat4 || seat5==seat6){
            $('.seatsErr').show();
        }
        else{
            $('.seatsErr').hide();
        }
    });
});

$(function() {
    $('.seats6').change(function () {
        var seat1=$('.seats1').val();
        var seat2=$('.seats2').val();
        var seat3=$('.seats3').val();
        var seat4=$('.seats4').val();
        var seat5=$('.seats5').val();
        var seat6=$('.seats6').val();
        if(seat6==seat1 || seat6==seat2 || seat6==seat3 ||seat6==seat4 || seat6==seat5 ){
            $('.seatsErr').show();
        }
        else{
            $('.seatsErr').hide();
        }
    });
});






//
// $(document).ready(function() {
//     var group = [];
//     $(".free_seat").on('click', function() {
//         var id = $(this).attr('id');
//         console.log(id);
//         var dataObject = {};
//         dataObject.id = id;
//         group.push(dataObject);
//         console.log(group);
//     });
// });
//
//     var fd = new FormData();
//     for (var i = 0; i < group.length; i++) {
//         fd.append(group[i].id);
//     }
//     $.ajax({
//         type: "POST",
//         url: 'ajaxcheck.php',
//         data: {group:group},
//         // dataType: "json",
//         // data: JSON.stringify({ paramName: group }),
//         success: function(data) {
//             $("#result").html(data);
//         }
//     });
//
