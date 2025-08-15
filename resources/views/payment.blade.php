<!DOCTYPE html>
<html>
<head>
  <title>Picker API Quickstart</title>
  <meta charset="utf-8" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <style type="text/css">

  </style>
</head>

<body>
  <button type="button" onclick="pay()" class="btn">Pay</button> 
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://services.billdesk.com/checkout-widget/src/app.bundle.js"></script> 

  <script type="module" src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.esm.js"></script>
    <script nomodule="" src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk.js"></script>
    <link href="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.css" rel="stylesheet">
  <script>
  function pay() {

    var o_id ='23543mat'+Math.floor(Math.random() * 10);
    $.ajax({
        type: 'GET',
        url: '/getChecksum',
        data: {
            "_token": "{{ csrf_token() }}",
            "oid": o_id,
        },
        success: function (data) {
            alert(data); 
            const sec_id ='koVpdfgmTmMR0hpWABcTyxZWgmsS0hXg';
            bdPayment.initialize({
                // "msg": "UATTRISOV2|"+o_id+"|NA|100.00|NA|NA|NA|INR|NA|R|uattrisov2|NA|NA|F|amitkumar735194@gmail.com|9105369914|NA|NA|NA|NA|NA|NA"+data,
                "msg" :`UATTRISOV2|TRTRT${o_id}|NA|100.00|NA|NA|NA|INR|HDF|R|uattrisov2|NA|NA|F|NA|NA|NA|NA|
NA|NA|NA|https://trishodaya.com/payment-response|${data}`,

                "options": {
                    "enableChildWindowPosting": true,
                    "enablePaymentRetry": true,
                    "retry_attempt_count": 2,
                    "txtPayCategory": "NETBANKING"
                },
                // "callbackUrl": "https://trishodaya.com/payment-response"
            });
            


        },
        error: function (error) {

        }
    });
}
  
    </script>
</body>
</html>


<!-- <html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <script type="module" src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.esm.js"></script>
    <script nomodule="" src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk.js"></script>
    <link href="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.css" rel="stylesheet">
    <script>

        var flow_config = {
            merchantId: "UATTRISOV2",
            bdOrderId: "OADY19XTURZ7NE", // get from orderCreate response
            authToken: "OToken 9354B109F14EE72CD4B45C6135B6AD1636ECDAE5F8D2F6CF29577E447CCFAF8C", // get from orderCreate response
            childWindow: false,
            returnUrl: "Return URL",
            crossButtonHandling: 'Y',
            retryCount: 0
        };
        var responseHandler = function (txn) {
            if (txn.response) {
                alert("callback received status:: ", txn.status);
                alert("callback received response:: ", txn.response);
            }
        };

        var config = {
            flowConfig: flow_config,
            flowType: "payments"
        };
        window.onload = function () {
            window.loadBillDeskSdk(config);
        };

    </script>
    
</head>
<body>

</body>
</html> -->
