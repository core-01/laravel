/*
  Home Loan
  EMI Calculator
*/
$('input[type=range]').on('input', function () {
    $(this).trigger('change');
});
// range variables
let amountRange = $("#amountRange");
let tenureRange = $("#tenureRange");
let interestRange = $("#interestRange");

// input variables
let amountInput = $("#amountInput");
let tenureInput = $("#tenureInput");
let interestInput = $("#interestInput");



/*
  Illustration: How is EMI on Loan Calculated?
  Formula for EMI Calculation is -
  P x R x (1+R)^N / [((1+R)^N)-1] where-
  P = Principal loan amount
  N = Loan tenure in months
  R = Monthly interest rate
  The rate of interest (R) on your loan is calculated per month.
  R = Annual Rate of interest/12/100
  For example, if rate of interest is 7.2% p.a. then r = 7.2/12/100 = 0.006
  If a person avails a loan of ₹10,00,000 at an annual interest rate of 7.2% for a tenure of 120 months (10 years), then his EMI will be calculated as under:
  EMI= ₹10,00,000 * 0.006 * (1 + 0.006)120 / ((1 + 0.006)120 - 1) = ₹11,714.
  The total amount payable will be ₹11,714 * 120 = ₹14,05,703. Principal loan amount is ₹10,00,000 and the Interest amount will be ₹4,05,703
  Calculating the EMI manually using the formula can be tedious.
*/
amountInput.on('keyup',calculateEMI);
tenureInput.on('keyup',calculateEMI);
interestInput.on('keyup',calculateEMI);
amountRange.on('change',calculateEMI);
tenureRange.on('change',calculateEMI);
interestRange.on('change',calculateEMI);

function calculateEMI(){
  // range variables
  let amountRange = $("#amountRange");
  let tenureRange = $("#tenureRange");
  let interestRange = $("#interestRange");

  // input variables
  let amountInput = $("#amountInput");
  let tenureInput = $("#tenureInput");
  let interestInput = $("#interestInput");

  // output variables
  let monthlyEMI = $("#monthlyEMI");
  let principleAmount = $("#principleAmount");
  let interestAmount = $("#interestAmount");
  let totalAmountPayable = $("#totalAmountPayable");

  let p = amountInput.val();
  let r = interestInput.val() / 12 / 100;
  let n = tenureInput.val() * 12;
  let EMI = p * r * ((1+r)**n) / (((1+r)**n)-1);
  monthlyEMI.text(Math.round(EMI,0));
  principleAmount.text(Math.round(p,0));
  totalAmountPayable.text(Math.round(EMI*n,0));
  interestAmount.text(Math.round((EMI*n)-p,0));

}
$(document).ready(()=>{
  calculateEMI();
});