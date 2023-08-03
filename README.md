# ip-log-api

This is a php api where you can send the ip as the content to it and it acts as a proxy to send to a discord webhook.
<br>
This way, people cannot use the discord webhook deleter or spam your webhook. It also validates if it is a ip and not just spam.
<br>
This also origin checks so that only your domain can send post requests to this api. 
<br>
Below is a javascript example of sending to the api:
<br>
```javascript
fetch("https://api.ipify.org?format=json")
  .then((t) => t.json())
  .then((t) => {
    fetch("https://youdomain.com/api/", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ ip: t.ip }),
    });
  });
```
