const clientKey = document.getElementById("clientKey").innerHTML;

// Used to finalize a checkout call in case of redirect
const urlParams = new URLSearchParams(window.location.search);
const sessionId = urlParams.get('sessionId'); // Unique identifier for the payment session
const redirectResult = urlParams.get('redirectResult');

// Typical checkout experience
async function startCheckout() {
  // Used in the demo to know which type of checkout was chosen
  const type = document.getElementById("type").innerHTML;

  try {
    const checkoutSessionResponse = await callServer("/api/sessions");
    const checkout = await createAdyenCheckout(checkoutSessionResponse);
    checkout.create(type).mount(document.getElementById("payment"));
    //checkout.create(type).mount(document.getElementById("payment"));

  } catch (error) {
    console.log(error);
    alert("Error occurred. Look at console for details");
  }
}

// Some payment methods use redirects. This is where we finalize the operation
async function finalizeCheckout() {
  try {
    const checkout = await createAdyenCheckout({id: sessionId});
    checkout.submitDetails({details: {redirectResult}});
  } catch (error) {
    update_adyenresponse();
    /*console.error(error);
    alert("Error occurred. Look at console for details");*/
  }
}

async function createAdyenCheckout(session){
  return new AdyenCheckout(
    {
      clientKey,
      locale: "en_UK",
      environment: ENVIRONMENTAL,
      session: session,
      showPayButton: true,
      /*paymentMethodsConfiguration: {
        ideal: {
          showImage: true,
        },
        card: {
          hasHolderName: true,
          holderNameRequired: fa,
          name: "Credit or debit card",
          amount: {
            value: 1000,
            currency: "EUR",
          },
        },
        paypal: {
          amount: {
            value: 1000,
            currency: "USD",
          },
          environment: "test", // Change this to "live" when you're ready to accept live PayPal payments
          countryCode: "US", // Only needed for test. This will be automatically retrieved when you are in production.
        }
      },*/
      onPaymentCompleted: (result, component) => {
       /* console.info("onPaymentCompleted");
        console.info(result, component);
        handleServerResponse(result, component);*/
        update_adyenresponse(result);
      },
      onError: (error, component) => {
        update_adyenresponse();
       /* console.error("onError");
        console.error(error.name, error.message, error.stack, component);
        handleServerResponse(error, component);*/
      },
    }
  );
}

// Calls your server endpoints
async function callServer(url, data) {
  const res = await fetch(url, {
    method: "POST",
    body: data ? JSON.stringify(data) : "",
    headers: {
      "Content-Type": "application/json",
    },
  });

  return await res.json();
}

function handleServerResponse(res, _component) {

  console.log('res' + res);
   /* switch (res.resultCode) {
      case "Authorised":
        window.location.href = "/result/success";
        break;
      case "Pending":
      case "Received":
        window.location.href = "/result/pending";
        break;
      case "Refused":
        window.location.href = "/result/failed";
        break;
      default:
        window.location.href = "/result/error";
        break;
    }*/
}

function update_adyenresponse(result=''){

    var booking_no = $('#booking_no').val();
    $.ajax({
            type: "POST",
            url: POST_URL,
            data: {'booking_no' : booking_no,'result' : result ,"_token": csrf_token},
            beforeSend: function() {
                // $("#state-list").addClass("loader");
            },
            success: function(data){

                if(data.status){

                    window.location.href = data.payment_url;
                }   

            }
        });

}

if (sessionId) { finalizeCheckout() }
//if (!sessionId) { startCheckout() } else { finalizeCheckout(); }