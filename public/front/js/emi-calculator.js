(function($) {

    $("#amount-slide").slider({
        range: "min",
        min: 5000,
        max: 500000,
        value: 25000,
        step: 1000,
        slide: function(event, ui) {
            $("#amount").text(ui.value);
            emicalculate();
        }
    });
    $("#amount").text($("#amount-slide").slider("value"));

    $("#duration-slide").slider({
        range: "min",
        min: 3.0,
        max: 30.0,
        step: 1,
        value: 12,
        slide: function(event, ui) {
            $("#duration").text(ui.value);
            emicalculate();
        }
    });
    $("#duration").text($("#duration-slide").slider("value"));

    $("#intrest-slide").slider({
        range: "min",
        min: 12.0,
        max: 120.0,
        step: 1,
        value: 36.0,
        slide: function(event, ui) {
            $("#intrest").text(ui.value);
            emicalculate();
        }
    });
    $("#intrest").text($("#intrest-slide").slider("value"));

    emicalculate();
})(jQuery);

function emicalculate()
{
    var loanAmount =$("#amount").text();
    var numberOfMonths =$("#duration").text();
    var rateOfInterest=$("#intrest").text();
    var monthlyInterestRatio = (rateOfInterest/100)/12;
    var top = Math.pow((1+monthlyInterestRatio),numberOfMonths);
    var bottom = top -1;
    var sp = top / bottom;
    var emi = Math.round((loanAmount * monthlyInterestRatio) * sp);
    var full = numberOfMonths * emi;
    var interest = full - loanAmount;
    var int_pge =  (interest / full) * 100;
    var emi_str = Math.trunc(emi);
    
    var loanAmount_str = loanAmount.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var full_str = Math.trunc(full);
    var int_str = Math.trunc(interest);

    $("#emi").html('&#x20B9;' + emi_str);
    $("#tbl_emi").html('&#x20B9;' + int_str);
    $("#tbl_la").html('&#x20B9;' + full_str);
}