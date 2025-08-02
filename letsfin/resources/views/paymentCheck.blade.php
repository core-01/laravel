<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    
<!-- <script type="module" src="https://uat1.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.esm.js"></script>-->
 
<!--<script nomodule="" src="https://uat1.billdesk.com/jssdk/v1/dist/billdesksdk.js-->
<!--"></script>-->

<!--<link href="https://uat1.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.css" rel="stylesheet">-->

    <script type="module" src="https://uat1.billdesk.com/merchant-
	uat/sdk/dist/billdesksdk/billdesksdk.esm.js"></script>
<script nomodule="" src="https://uat1.billdesk.com/merchant-uat/sdk/dist/billdesksdk.js"></script>

<link href="https://uat1.billdesk.com/merchant-uat/sdk/dist/billdesksdk/billdesksdk.css" rel="stylesheet">
	<script type="text/javascript">
  
    
    
        
        var flow_config = {
            merchantId: "UATTRISOV2",
            bdOrderId: "<?php echo $result_array['bdorderid'] ?>",
            authToken: "<?php echo $authToken ?>",
            childWindow: true,
            returnUrl: "https://trishodaya.com/payment-response",
            retryCount: 3,
            
            }
        var responseHandler = function (txn) {
            if (txn.response) {
                alert("callback received status:: ", txn.status);
                alert("callback received response:: ", txn.response);
            }
        };

        var config = {
            responseHandler: responseHandler,
            // merchantLogo: "data:image/png;base64:eqwewqesddhgjdxsc==",
            flowConfig: flow_config,
            // flowType: "emandate"
            flowType: "payments"
        };
        window.onload = function () {
            // console.log(<?php echo json_encode($authToken) ?>);
            
            window.loadBillDeskSdk(config);
        };

    </script>
    
</head>
<body>

</body>
</html>