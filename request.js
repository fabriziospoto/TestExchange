$(document).ready(function() {
    function time() {
        var date = new Date();
        return date.toLocaleTimeString();
    }
    
    async function getUSD() {
        let response = await fetch(
           "https://api.exchangerate.host/convert?from=USD&to=CZK"
        );
        let data = await response.json();
        return data;
    }
    
    async function getEur() {
        let response = await fetch(
           "https://api.exchangerate.host/convert?from=EUR&to=CZK"
        );
        let data = await response.json();
        return data;
    }
    
    async function getGBP() {
        let response = await fetch(
           "https://api.exchangerate.host/convert?from=GBP&to=CZK"
        );
        let data = await response.json();
        return data;
    }

    
    function triggerExchange() {
        const interval = setInterval(() => {
            $('#usd_to_czk').html("");
            $('#eur_to_czk').html("");
            $('#gbp_to_czk').html("");
            getUSD().then(data => $('#usd_to_czk').append('1 USD is equal to ' + data.result + ' CZK at ' + time()));
            getEur().then(data => $('#eur_to_czk').append('1 EUR is equal to ' + data.result + ' CZK at ' + time()));
            getGBP().then(data => $('#gbp_to_czk').append('1 GBP is equal to ' + data.result + ' CZK at ' + time()));
        }, 60000)
        return () => clearInterval(interval);
    };

     // Call the function a first time to avoid setInterval initial delay 
    getUSD().then(data => $('#usd_to_czk').append('1 USD is equal to ' + data.result + ' CZK at ' + time()));
    getEur().then(data => $('#eur_to_czk').append('1 EUR is equal to ' + data.result + ' CZK at ' + time()));
    getGBP().then(data => $('#gbp_to_czk').append('1 GBP is equal to ' + data.result + ' CZK at ' + time()));

    // Call the function a second time with setInterval
    triggerExchange(); 
    
});
