
        // Create a client instance
        client = new Paho.MQTT.Client("io.adafruit.com", Number(443), "wwww");
        
        // set callback handlers
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

        // connect the client
        client.connect({onSuccess:onConnect,
                        userName:"username",
                        password:"password",
                        useSSL : true,
                        mqttVersion: 4
                        });


        // called when the client connects
        function onConnect() {
          // Once a connection has been made, make a subscription and send a message.
          console.log("onConnect");
          // client.subscribe("faandree/feeds/teste");
          client.subscribe("feed");
         
        }

        // called when the client loses its connection
        function onConnectionLost(responseObject) {
          if (responseObject.errorCode !== 0) {
            console.log("onConnectionLost:"+responseObject.errorMessage);
          }
        }

        // called when a message arrives
        function onMessageArrived(message) {
          console.log("onMessageArrived:"+message.payloadString);
        }
        