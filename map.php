<iframe src="https://createaclickablemap.com/map.php?&id=70133&maplocation=false&online=true" width="900" height="525" style="border: none;"></iframe>
<script>
    if (window.addEventListener) {
        window.addEventListener("message", function(event) {
            if (event.data.length >= 22) {
                if (event.data.substr(0, 22) == "__MM-LOCATION.REDIRECT") location = event.data.substr(22);
            }
        }, false);
    } else if (window.attachEvent) {
        window.attachEvent("message", function(event) {
            if (event.data.length >= 22) {
                if (event.data.substr(0, 22) == "__MM-LOCATION.REDIRECT") location = event.data.substr(22);
            }
        }, false);
    }
</script>