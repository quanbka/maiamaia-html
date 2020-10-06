
<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var closes = document.getElementsByClassName("close");
        for (i = 0; i < closes.length; i++) {
            closes.item(i).addEventListener('click', function (e) {
                var r = confirm("Do you want close ads!");
                if (r) {
                    document.body.innerHTML = "";
                }
            }, false);
        }
    });
</script>
@yield('content')