const express = require('express');
const RSS = require('rss');
const request = require('request');
const app = express();

app.get("/api/:id",function(req, res, next) {
    var link = `http://localhost/Rssinfo/index.php/${req.params.id}`;
    var options = {
        'method': 'GET',
        'url': link,
        'headers': {
            "User-Agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36",
        }
    };
    request(options, function (error, response, body) {
        if (error) throw new Error(error);
        try {
            const data = Function(
                body.match(/var passage = \{.*};/gm)[0]
                + 'let json_data=JSON.parse(JSON.stringify(passage));'
                + 'return json_data;'
            )();
            var feed = new RSS(data);
            var xml = feed.xml();
            res.contentType('application/xml');
            res.send(xml)
        }catch (e) {
            console.log(e);
            res.send('error');
        }
    })
})
app.listen(3000);